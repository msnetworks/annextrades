import {ElementRef, Injectable, NgZone} from '@angular/core';
import {Elements} from './elements/elements.service';
import {ActiveElement} from './live-preview/active-element';
import {UndoManager} from './undo-manager/undo-manager.service';
import {InlineTextEditor} from './live-preview/inline-text-editor/inline-text-editor.service';
import {ActiveProject} from './projects/active-project';
import {ContextMenu} from 'common/core/ui/context-menu/context-menu.service';
import {LivePreviewContextMenuComponent} from './live-preview/live-preview-context-menu/live-preview-context-menu.component';
import {Keybinds} from 'common/core/keybinds/keybinds.service';
import {SelectedElement} from './live-preview/selected-element.service';
import {ContextBoxes} from './live-preview/context-boxes.service';
import {BuilderDocument} from './builder-document.service';
import {LivePreviewLoader} from './live-preview/live-preview-loader.service';
import {LinkEditor} from './live-preview/link-editor/link-editor.service';
import {DomHelpers} from '../shared/dom-helpers.service';
import {randomString} from '@common/core/utils/random-string';

@Injectable({
    providedIn: 'root'
})
export class LivePreview {

    /**
     * Whether element is currently being dragged in live preview.
     */
    dragging = false;

    /**
     * Element user's cursor is hovering over.
     */
    public hover = new ActiveElement();

    /**
     * Live preview iframe element.
     */
    private iframe: HTMLIFrameElement;

    /**
     * Current width of live preview.
     */
    public activeWidth: 'phone'|'tablet'|'laptop'|'desktop' = 'desktop';

    /**
     * LivePreview Constructor.
     */
    constructor(
        private zone: NgZone,
        private elements: Elements,
        private undoManager: UndoManager,
        private inlineTextEditor: InlineTextEditor,
        private parsedProject: ActiveProject,
        private contextMenu: ContextMenu,
        private keybinds: Keybinds,
        public selected: SelectedElement,
        public contextBoxes: ContextBoxes,
        private builderDocument: BuilderDocument,
        public activeProject: ActiveProject,
        private loader: LivePreviewLoader,
        private linkEditor: LinkEditor,
    ) {}

    public init(iframe: ElementRef) {
        this.loader.show();

        this.iframe = iframe.nativeElement;
        this.iframe.src = `${this.activeProject.getBaseUrl()}${this.activeProject.getActivePage().name}.html?v=${randomString()}`;

        this.iframe.onload = () => {
            this.builderDocument.setBaseUrl(this.activeProject.getBaseUrl());
            this.builderDocument.init(this.iframe.contentDocument);

            this.builderDocument.reload('activeProject').then(() => {
                this.registerKeybinds();
                this.bindToIframeEvents();
                this.bindToUndoCommandExecuted();
                this.loader.hide();

                // trigger load event again, so listeners
                // in custom user js work as expected
                const e = new Event('load');
                this.iframe.contentWindow && this.iframe.contentWindow.dispatchEvent(e);
            });
        };
    }

    private bindToUndoCommandExecuted() {
        this.undoManager.executedCommand.subscribe(() => {
            this.repositionBox('selected');
            this.hideBox('hover');
        });
    }

    private bindToIframeEvents() {
        const hammer = new Hammer.Manager(this.builderDocument.get()),
            doubleTap = new Hammer.Tap({event: 'double_tap', taps: 2});

        hammer.add(doubleTap);

        this.listenForHover();
        this.listenForClick();
        this.listenForDoubleClick(hammer);
        this.listenForContextMenu();
        this.keybinds.listenOn(this.builderDocument.get());

        this.builderDocument.on('scroll', e => {
            this.contextBoxes.hideBox('hover');
            if (this.selected.node) this.repositionBox('selected');
            this.inlineTextEditor.close();
            this.contextMenu.close();
        }, true);
    }

    private listenForContextMenu() {
        this.builderDocument.on('contextmenu', e => {
            this.zone.run(() => {
                e.preventDefault();
                this.selected.selectNode(e.target as HTMLElement);
                this.contextMenu.open(LivePreviewContextMenuComponent, e, {offsetX: 380});
            });
        });
    }

    private registerKeybinds() {
        this.keybinds.add('ctrl+shift+x', () => this.builderDocument.actions.cutNode(this.selected.node));
        this.keybinds.add('ctrl+shift+c', () => this.builderDocument.actions.copyNode(this.selected.node));
        this.keybinds.add('ctrl+shift+v', () => this.builderDocument.actions.pasteNode(this.selected.node));
        this.keybinds.add('ctrl+z', () => this.undoManager.undo());
        this.keybinds.add('ctrl+y', () => this.undoManager.redo());
        this.keybinds.addWithPreventDefault('arrow_up', () => this.builderDocument.actions.moveSelected('up'));
        this.keybinds.addWithPreventDefault('arrow_down', () => this.builderDocument.actions.moveSelected('down'));
        this.keybinds.add('delete', () => {
            if ( ! DomHelpers.nodeIsEditable(this.selected.node) && ! this.selected.isHtmlOrBody()) {
                this.builderDocument.actions.removeNode(this.selected.node);
            }
        });
    }

    private listenForHover() {
        this.builderDocument.on('mousemove', e => {
            this.zone.run(() => {
                if (this.dragging) return;

                const node = this.builderDocument.elementFromPoint(e.pageX, e.pageY - this.builderDocument.getScrollTop());

                if ( ! node || node === this.hover.node) return;

                this.hover.previous = this.hover.node;

                // hide hover box and bail if we're hovering over a selected node
                if (this.selected.node && this.selected.node == node) {
                    return this.contextBoxes.hideBox('hover');
                }

                this.hover.node = node;

                this.hover.element = this.elements.match(this.hover.node, 'hover', true);

                if ( ! this.dragging) {
                    this.repositionBox('hover');
                }
            });
        });
    }

    private listenForClick() {
        this.builderDocument.get().addEventListener('click', e => {
           this.zone.run(() => {
               const node = e.target as HTMLElement;

               this.handleLinkClick(e);

               this.handleFormSubmitButtonClick(e);

               this.builderDocument.focus();

               // node is already selected, bail
               if (this.selected.node == node) return true;

               // node text is being edited, bail
               if (DomHelpers.nodeIsEditable(node)) return;

               // hide context menu
               this.contextMenu.close();

               // hide wysiwyg toolbar when clicked outside it
               this.inlineTextEditor.close();

               // hide link editor
               this.linkEditor.close();

               // select node
               this.selected.selectNode(node);
           });
        }, true);
    }

    private listenForDoubleClick(hammer: HammerManager) {
        hammer.on('double_tap', e => {
            this.zone.run(() => {
                const matched = this.elements.match(e.target);

                // node text is already being edited, bail
                if (DomHelpers.nodeIsEditable(e.target)) return;

                const canModify = matched.canModify || [];
                if (canModify.indexOf('text') > -1 && matched.showWysiwyg) {
                    this.hideBox('selected');
                    this.inlineTextEditor.open(e.target);
                }
            });
        });
    }

    private handleLinkClick(e: MouseEvent) {
        let node = e.target as HTMLElement;

        // clicked node is not a link
        if ( ! node.matches('a, a *')) return;

        e.preventDefault();
        e.stopPropagation();

        // if element is not a link, find first link parent
        if (node.tagName.toLowerCase() !== 'a') {
            node = node.closest('a');
        }

        // get relative url of for the link
        const link = node as HTMLLinkElement,
              href = link.href ? link.href.replace(this.activeProject.getBaseUrl(), '') : '';

        // link just scrolls to a node on the page, bail
        if (href.indexOf('#') === 0) return;

        // link navigates to an external site, bail
        if (href.indexOf('//') > -1) return;

        // link navigates to a different page
        const pageName = href.replace('.html', '');
        this.activeProject.setActivePage(pageName);
    }

    private handleFormSubmitButtonClick(e: MouseEvent) {
        const node = e.target as HTMLElement;

        // clicked node is not a submit button
        if ( ! node.matches('button[type=submit], button[type=submit] *')) return;

        e.preventDefault();
        e.stopPropagation();

        //
    }

    public repositionBox(name: 'hover'|'selected') {
        this.contextBoxes.repositionBox(name, this[name].node);
    }

    /**
     * Hide specified context box.
     */
    public hideBox(name: 'hover'|'selected') {
        this.contextBoxes.hideBox(name);
    }

    public getElementDisplayName(el: any, node: HTMLElement): string {
        return this.elements.getDisplayName(el, node);
    }

    /**
     * Set live preview with to specified device.
     */
    public setWidth(device: 'phone'|'tablet'|'laptop'|'desktop') {
        this.activeWidth = device;
    }

    public getIframe() {
        return this.iframe;
    }
}
