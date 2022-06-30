import {Injectable} from '@angular/core';
import {baseElements} from './definitions/base';
import {bootstrapElements} from './definitions/bootstrap';
import {Translations} from '../../../common/core/translations/translations.service';
import {BuilderElement} from './builder-element';

@Injectable({
    providedIn: 'root'
})
export class Elements {

    private elements: BuilderElement[] = [];

    /**
     * Default element config.
     */
    private defaults = {
        name: 'Generic',
        canModify: ['padding', 'margin', 'box', 'text', 'attributes', 'float', 'shadows', 'background'],
        canDrag: true,
        showWysiwyg: true,
        attributes: {},
        previewScale: 1,
        scaleDragPreview: true,
        resizable: true,
        types: ['flow'],
        validChildren: ['flow'],
    };

    /**
     * Array of special cases conditions when selecting a DOM node.
     */
    private specialCases = [

        // if selecting label with parent with .checkbox should select parent instead.
        function(node, parent, classes, pClasses) {
            if (node.nodeName.toLowerCase() === 'label' && pClasses.indexOf('checkbox') > -1) {
                return node.parentElement;
            }
        },

        // if selecting .progress-bar, select parent instead
        function(node, parent, classes, pClasses) {
            if (classes.indexOf('progress-bar') > -1) {
                return node.parentElement;
            }
        },

        // if selecting .container-fluid with .navbar parent, select parent instead
        function(node, parent, classes, pClasses) {
            if (classes.indexOf('container-fluid') > -1 && pClasses.indexOf('navbar') > -1) {
                return node.parentElement;
            }
        },
    ];

    constructor(private i18n: Translations) {}

    public getAll() {
        return this.elements;
    }

    public findByName(name: string) {
        return this.elements.find(el => el.name === name);
    }

    public getDisplayName(el: BuilderElement, node: HTMLElement) {
        if ( ! el) return;

        if (el.name === 'div container') {
            if (node.id) {
                return node.id;
            } else if (node.classList[0]) {
                return node.classList[0];
            } else {
                return el.name;
            }
        } else {
            return el.name;
        }
    }

    public canModifyText(element: BuilderElement) {
        return this.canModify('text', element) && element.showWysiwyg;
    }

    /**
     * Check if specified property/style of this element can be modified.
     */
    public canModify(property: string, element: BuilderElement) {
        if ( ! element) return;
        return element.canModify.indexOf(property.toLowerCase()) > -1;
    }

    /**
     * Check if specified node is an image.
     */
    public isImage(node: HTMLElement): boolean {
        if ( ! node) return false;
        return node.nodeName.toLowerCase() === 'img';
    }

    /**
     * Check if specified node is a link.
     */
    public isLink(node: HTMLElement): boolean {
        if ( ! node) return false;
        return node.nodeName.toLowerCase() === 'a';
    }

    public isIcon(node: HTMLElement) {
        if ( ! node) return false;
        return node.nodeName.toLowerCase() === 'i' || (typeof node?.className === 'string' && node.className.includes('icon-'));
    }

    /**
     * Check if node is column, row, or container.
     */
    public isLayout(node: HTMLElement): boolean {
        if ( ! node) return false;
        return this.isColumn(node) || this.isRow(node) || this.isContainer(node);
    }

    public isContainer(node: HTMLElement): boolean {
        if (!node || !node.classList) return false;
        return node.classList.contains('container');
    }

    public isRow(node: HTMLElement): boolean {
        if ( ! node || ! node.classList) return false;
        return node.classList.contains('row');
    }

    public isColumn(node: HTMLElement): boolean {
        if ( ! node) return false;
        if ( ! node.className || typeof node.className !== 'string') return false;
        return node.className.indexOf('col-') > -1;
    }

    public checkForSpecialCases(node: HTMLElement): HTMLElement|boolean {
        if ( ! node ) return false;

        // cache some needed node properties
        const parent = node.parentElement,
            classes = node.nodeName,
            parentClasses = parent ? parent.nodeName : '';

        // test node against every special case until the end or until we find a match
        for (let i = 0; i < this.specialCases.length; i++) {
            const check = this.specialCases[i](node, parent, classes, parentClasses);
            if (check) return check;
        }
    }

    /**
     * Check if given node accepts currently active element as a child.
     */
    public canInsert(parent: HTMLElement, element: BuilderElement) {
        if (parent.nodeName.toLowerCase() === 'body') return true;
        if (parent.nodeName.toLowerCase() === 'html') return false;

        // match given node to an element in element repository
        const el = this.match(parent);

        // if we've got an element match and it has any valid children check
        // if specified child can be inserted into given node
        if (el && el.validChildren && element.types) {
            for (let i = el.validChildren.length - 1; i >= 0; i--) {
                if (element.types.indexOf(el.validChildren[i]) > -1) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Match specified DOM node to an element in the repository.
     */
    public match(node: HTMLElement, type = null, matchParent = true) {
        if ( ! node || ! node.nodeName) return false;

        const isSpecialCase = this.checkForSpecialCases(node),
              nodeName = node.nodeName.toLowerCase();

        if (isSpecialCase) {
            node = isSpecialCase as HTMLElement;
        }

        // find by class
        if (node.className) {
            for (let i = 0; i < this.elements.length; i++) {
                const element = this.elements[i];
                const classes = typeof node.className === 'string' ? node.className.toLowerCase().split(/\s+/) : [];

                for (let i = 0; i < classes.length; i++) {

                    // if element has no class we'll bail
                    if ( ! element.class) continue;

                    // if element and passed in node classes match exactly we'll just return current element
                    if (classes[i] === element.class) {
                        return element;
                    }

                    // if we didn't match an element by this time we'll try to do it using
                    // a wildcard so we can match bootstrap columns and similar stuff
                    if (element.class.indexOf('*') > -1 && classes[i].match(new RegExp(element.class.replace('*', '.*')))) {
                        return element;
                    }
                }
            }
        }

        for (let i = 0; i < this.elements.length; i++) {
            const element = this.elements[i];

            // find by name attribute
            if (node.dataset && node.dataset.name) {
                return this.findByName(node.dataset.name);
            }

            // find by input type
            if (node['type']) {
                const type = nodeName + '=' + node['type'];

                if (Array.isArray(element.nodes) && element.nodes.find(nodeName => nodeName === type)) {
                    return element;
                }
            }

            // find by node name
            if (element.nodes.indexOf(nodeName) > -1) {
                return element;
            }
        }

        // if we've got no matches by this point and we've got
        // a true flag, will try to match this nodes parent instead
        if (matchParent) {
            return this.match(node.parentElement as HTMLElement, type, true);

        // if no true flag passed we'll just return a generic object
        } else {
            const className = node.className && node.className.split(/\s+/)[0];
            const defaults = Object.assign({}, this.defaults);

            if (className) {
                defaults.name = className.replace('-', ' ');
            } else {
                defaults.name = node.nodeName.toLowerCase();
            }

            return defaults;
        }
    }

    /**
     * Register a new element with the builder.
     */
    public addElement(config) {
        // merge defaults and passed in element config objects
        const el = Object.assign({}, this.defaults, config);
        el.name = this.i18n.t(el.name);

        // element already exists
        if (this.elements.find(curr => curr.name === el.name)) return;

        // push newly created element to all elements object
        this.elements.push(el);
    }


    /**
     * Register all the base builder elements
     */
    public init(customElements: BuilderElement[]) {
        const elements = baseElements.concat(bootstrapElements);
        elements.forEach(element => this.addElement(element));
        this.addCustomElements(customElements);
    }

    private addCustomElements(customElements: {html: string, css: string, config: string}[]) {
        let customCss = '';

        customElements.forEach(element => {
            const config = eval(element.config);
            config.html = element.html;
            config.css = element.css;

            this.addElement(config);

            customCss += "\n" + config.css;
        });
    }
}
