import {LivePreview} from '../../live-preview.service';

export const baseElements = [];

baseElements.push({
    name: 'paragraph',
    frameworks: ['base'],
    nodes: ['p'],
    html: '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor ' +
    'incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation' +
    'ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in' +
    'voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non' +
    'proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>',
    types: ['flow'],
    validChildren: ['phrasing'],
    category: 'typography',
    icon: 'short-text'
});

baseElements.push({
    name: 'divider',
    frameworks: ['base'],
    nodes: ['hr'],
    html: '<hr>',
    types: ['flow'],
    validChildren: false,
    category: 'layout',
    dragHelper: true,
    icon: 'remove'
});

baseElements.push({
    name: 'marked text',
    frameworks: ['base'],
    nodes: ['mark'],
    html: '<mark>Marked Text</mark>',
    types: ['flow', 'phrasing'],
    validChildren: ['phrasing'],
    category: 'typography',
    icon: 'info'
});

baseElements.push({
    name: 'definition list',
    frameworks: ['base'],
    nodes: ['dl'],
    html: '<dl class="dl-horizontal">' +
    '<dt>Description lists</dt>' +
    '<dd>A description list is perfect for defining terms.</dd>' +
    '<dt>Euismod</dt>' +
    '<dd>Vestibulum id ligula porta felis euismod semper eget lacinia odio sem nec elit.</dd>' +
    '<dd>Donec id elit non mi porta gravida at eget metus.</dd>' +
    '<dt>Malesuada porta</dt>' +
    '<dd>Etiam porta sem malesuada magna mollis euismod.</dd>' +
    '<dt>Felis euismod semper eget lacinia</dt>' +
    '<dd>Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</dd>' +
    '</dl>',
    types: ['flow', 'sectioning root'],
    validChildren: ['dt', 'dd'],
    category: 'typography',
    previewScale: '0.4',
    scaleDragPreview: false,
    icon: 'view-list'
});

baseElements.push({
    name: 'blockqoute',
    frameworks: ['base'],
    nodes: ['blockqoute'],
    html: '<blockquote>' +
    '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>' +
    '<footer>Someone famous in <cite title="Source Title">Source Title</cite></footer>' +
    '</blockquote>',
    types: ['flow', 'sectioning root'],
    validChildren: ['flow'],
    category: 'typography',
    previewScale: '0.5',
    scaleDragPreview: false,
    icon: 'format-quote'
});

baseElements.push({
    name: 'list item',
    frameworks: ['base'],
    nodes: ['li'],
    html: '<li>A basic list item</li>',
    types: ['li'],
    validChildren: ['flow'],
});

baseElements.push({
    name: 'unordered list',
    frameworks: ['base'],
    nodes: ['ul'],
    html: '<ul><li>List item #1</li><li>List item #2</li><li>List item #3</li><ul>',
    types: ['flow'],
    validChildren: ['li'],
    category: 'typography',
    icon: 'format-list-bulleted'
});

baseElements.push({
    name: 'body',
    frameworks: ['base'],
    nodes: ['body'],
    html: false,
    draggable: false,
    showWysiwyg: false,
    types: ['flow'],
    validChildren: ['flow'],
});

baseElements.push({
    name: 'button',
    frameworks: ['base'],
    nodes: ['button'],
    html: '<button class="btn btn-success">Click Me</button>',
    types: ['flow', 'phrasing', 'interactive', 'listed', 'labelable', 'submittable', 'reassociateable', 'form-associated'],
    validChildren: ['phrasing'],
    category: 'buttons',
    icon: 'button-custom'
});

baseElements.push({
    name: 'div container',
    frameworks: ['base'],
    nodes: ['div'],
    html: '<div></div>',
    types: ['flow'],
    validChildren: ['flow'],
    category: 'layout',
    dragHelper: true,
    previewScale: '0.7',
    icon: 'crop-landscape'
});

baseElements.push({
    name: 'heading',
    nodes: ['h1', 'h2', 'h3', 'h4', 'h5', 'h6'],
    frameworks: ['base'],
    html: '<h2>Heading</h2>',
    types: ['heading', 'flow'],
    validChildren: ['phrasing'],
    category: 'typography',
    icon: 'format-size',
    attributes: {
        types: {
            list: [
                {name: 'h1', value: 'h1'},
                {name: 'h2', value: 'h2'},
                {name: 'h3', value: 'h3'},
                {name: 'h4', value: 'h4'},
                {name: 'h5', value: 'h5'},
                {name: 'h6', value: 'h6'},
            ],
            value: 'h1',
            onAssign: function (livePreview: LivePreview) {
                let name = livePreview.selected.node.nodeName.toLowerCase();

                for (let i = this.list.length - 1; i >= 0; i--) {
                    if (name == this.list[i].value) {
                        return this.value = this.list[i].value;
                    }
                }
            },
            onChange: function (livePreview: LivePreview, value: any) {
                let newNode = document.createElement(value);
                newNode.innerHTML = livePreview.selected.node.innerHTML;
                livePreview.selected.node.parentElement.replaceChild(newNode, livePreview.selected.node);
                livePreview.selected.node = newNode;
                livePreview.repositionBox('selected');
            }
        }
    }
});

baseElements.push({
    name: 'icon',
    nodes: ['i'],
    frameworks: ['base', 'bootstrap'],
    html: false,
    types: ['flow', 'phrasing'],
    validChildren: false,
    category: false,
    canDrag: true,
    canModify: ['text', 'attributes'],
    attributes: {
        size: {
            list: [
                {name: 'Default', value: 'default'},
                {name: 'Large', value: 'fa-lg'},
                {name: '2x', value: 'fa-2x'},
                {name: '3x', value: 'fa-3x'},
                {name: '4x', value: 'fa-4x'},
                {name: '5x', value: 'fa-5x'}
            ],
            value: 'default',
            onAssign: function (livePreview: LivePreview) {
                for (let i = this.list.length - 1; i >= 0; i--) {
                    if (livePreview.selected.node.className.indexOf(this.list[i].value) > -1) {
                        return this.value = this.list[i].value;
                    }
                }
            },
            onChange: function (livePreview: LivePreview, size: string) {
                // strip any previously assigned size classes from the icon
                for (let i = this.list.length - 1; i >= 0; i--) {
                    if ( ! this.list[i].value) continue;
                    livePreview.selected.node.classList.remove(this.list[i].value);
                }

                livePreview.selected.node.classList.add(size);
            }
        }
    },
    dragHelper: true,
});

baseElements.push({
    name: 'generic',
    nodes: ['em', 'strong', 'u', 's', 'small'],
    frameworks: ['base'],
    html: false,
    types: ['flow', 'phrasing'],
    validChildren: false,
    category: false,
    canDrag: false,
    canModify: ['text', 'attributes']
});

baseElements.push({
    name: 'label',
    nodes: ['label'],
    frameworks: ['base'],
    html: false,
    types: ['flow', 'phrasing'],
    validChildren: false,
    category: false,
    canDrag: false,
    canModify: ['text', 'attributes']
});

baseElements.push({
    name: 'svg',
    frameworks: ['base'],
    nodes: ['svg'],
});
