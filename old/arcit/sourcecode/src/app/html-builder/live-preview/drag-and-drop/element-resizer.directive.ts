import {AfterViewInit, Directive, ElementRef, NgZone} from '@angular/core';
import {SelectedElement} from '../selected-element.service';
import {ContextBoxes} from '../context-boxes.service';
import {LivePreview} from '../../live-preview.service';

const IFRAME_OFFSET = 380;

@Directive({
    selector: '[elementResizer]'
})
export class ElementResizerDirective implements AfterViewInit {
    protected dragOverlay: HTMLElement;
    private node: HTMLElement;
    private aspectRatio: number;
    private previewWidth: number;
    private previewHeight: number;

    constructor(
        private zone: NgZone,
        private el: ElementRef<HTMLElement>,
        private selectedEl: SelectedElement,
        private contextBoxes: ContextBoxes,
        private livePreview: LivePreview,
    ) {}

    ngAfterViewInit(): void {
        this.dragOverlay = document.querySelector('.drag-overlay') as HTMLElement;

        // account for scrollbar
        const iframeBody = this.livePreview.getIframe().contentDocument.body;
        this.previewWidth = iframeBody.clientWidth - 20;
        this.previewHeight = iframeBody.scrollHeight - 20;

        this.zone.runOutsideAngular(() => {
            const hammer = new Hammer.Manager(this.el.nativeElement);
            const pan = new Hammer.Pan({direction: Hammer.DIRECTION_ALL, threshold: 0});
            hammer.add([pan]);

            hammer.on('panstart', e => this.handleDragStart(e));
            hammer.on('panmove', e => this.handleDrag(e));
            hammer.on('panend', e => this.handleDragEnd(e));
        });
    }

    private handleDragStart(e: HammerInput) {
        this.node = this.selectedEl.node;
        const rect = this.node.getBoundingClientRect();
        this.aspectRatio = rect.width / rect.height;
        this.dragOverlay.style.display = 'block';

        this.node.style.maxWidth = 'none';
        this.node.style.maxHeight = 'none';
    }

    private handleDrag(e: HammerInput) {
        const rect = this.node.getBoundingClientRect(),
            clientX = e.center.x - IFRAME_OFFSET;

        // trying to scroll (and resize) element beyond preview width, bail
        if (this.previewWidth <= clientX) {
            return;
        }

        // trying to scroll (and resize) element beyond preview body height, bail
        if (this.previewHeight <= e.center.y) {
            return;
        }

        // calc new width
        const newWidth = clientX - rect.left;
        let finalWidth = newWidth < this.contextBoxes.minWidth ? this.contextBoxes.minWidth : newWidth;

        // calc new height
        const newHeight = e.center.y - rect.top;
        let finalHeight = newHeight < this.contextBoxes.minHeight ? this.contextBoxes.minHeight : newHeight;

        // adjust aspect ratio
        if (this.selectedEl.isImage) {
            ({finalWidth, finalHeight} = this.resizeAndPreserveAspectRatio(finalWidth, finalHeight));
        }

        // if image was scaled lower then min width or min height, bail
        if (finalWidth < this.contextBoxes.minWidth || finalHeight < this.contextBoxes.minHeight) {
            return;
        }

        this.node.style.width = finalWidth + 'px';
        this.node.style.height = finalHeight + 'px';

        this.contextBoxes.repositionBox('selected', this.node);
    }

    private handleDragEnd(e: HammerInput) {
        this.dragOverlay.style.display = 'none';
    }

    public resizeAndPreserveAspectRatio(oldWidth: number, oldHeight: number) {
        let newWidth = oldWidth,
            newHeight = oldHeight;

        if (oldHeight * this.aspectRatio > oldWidth) {
            newHeight = oldWidth / this.aspectRatio;
        } else {
            newWidth = oldHeight * this.aspectRatio;
        }

        return {finalWidth: newWidth, finalHeight: newHeight};
    }
}
