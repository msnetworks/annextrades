import {ElementRef, Injectable} from '@angular/core';
import {Elements} from '../elements/elements.service';
import {LocalStorage} from 'common/core/services/local-storage.service';
import {of} from 'rxjs';

@Injectable({
    providedIn: 'root'
})
export class ContextBoxes {

    /**
     * Live preview iframe client rect.
     */
    private previewRect: ClientRect;

    private hoverBox: HTMLElement;
    private selectedBox: HTMLElement;

    public minHeight = 40;

    /**
     * Spacing between context box and selected element.
     */
    private spacing = 10;

    public minWidth = 100;

    private minLeft = 15;

    /**
     * ContextBoxes service constructor.
     */
    constructor(
        private elements: Elements,
        private localStorage: LocalStorage
    ) {}

    public repositionBox(name: 'hover'|'selected', node: HTMLElement) {
        // hide context boxes depending on user settings
        if ( ! this.localStorage.get('settings.' + name + 'BoxEnabled', true)) return;

        if ( ! node || node.nodeType !== Node.ELEMENT_NODE || this.nodeIsHtmlOrBody(node)) {
            return this.hideBox(name);
        }

        if (name === 'selected') {
            this.hideBox('hover');
        }

        const rect = node.getBoundingClientRect();

        if ( ! rect.width || ! rect.height) {
            this.hideBox(name);
        } else {
            this.getBox(name).style.top = this.getBoxTop(rect) + 'px';
            this.getBox(name).style.left = this.getBoxLeft(rect) + 'px';
            this.getBox(name).style.height = this.getBoxHeight(rect) + 'px';
            this.getBox(name).style.width = this.getBoxWidth(rect) + 'px';
            this.showBox(name);
        }

        // place context box toolbar on the bottom, if there's not enough space top
        if (parseInt(this.getBox(name).style.top) < 20) {
            this.getBox(name).classList.add('toolbar-bottom');
        } else {
            this.getBox(name).classList.remove('toolbar-bottom');
        }
    }

    public getBoxHeight(rect: ClientRect) {
        const height = rect.height < this.minHeight ? this.minHeight : rect.height;
        return height + (this.spacing * 2);
    }

    public getBoxWidth(rect: ClientRect) {
        let width = rect.width < this.minWidth ? this.minWidth : rect.width;
        width = width + (this.spacing * 2);

        // min left distance - scrollbar width
        const maxWidth = this.previewRect.width - (this.minLeft * 2) - 20;

        return width > maxWidth ? maxWidth : width;
    }

    public getBoxTop(rect: ClientRect) {
        const offset = rect.height < this.minHeight ? this.minHeight - rect.height : 0;
        return (rect.top - (offset / 2) - this.spacing);
    }

    private getBoxLeft(rect: ClientRect) {
        let offset = rect.width < this.minWidth ? this.minWidth - rect.width : 0;
        offset = rect.left - (offset / 2) - this.spacing;
        return offset < this.minLeft ? this.minLeft : offset;
    }

    /**
     * Hide specified context box.
     */
    public hideBox(name: 'hover'|'selected') {
        const box = this.getBox(name);
        box && box.classList.add('hidden');
    }

    /**
     * Hide all context boxes.
     */
    public hideBoxes() {
        this.hideBox('selected');
        this.hideBox('hover');
    }

    public showBox(name: 'hover'|'selected') {
        this.getBox(name).classList.remove('hidden');
    }

    public set(hover: HTMLElement, selected: HTMLElement, iframe: ElementRef) {
        this.hoverBox = hover;
        this.selectedBox = selected;
        this.previewRect = iframe.nativeElement.getBoundingClientRect();
    }

    public getBox(name: 'hover'|'selected'): HTMLElement {
        return name === 'hover' ? this.hoverBox : this.selectedBox;
    }

    private nodeIsHtmlOrBody(node: HTMLElement) {
        if ( ! node) return false;
        return node.nodeName === 'BODY' || node.nodeName === 'HTML';
    }
}
