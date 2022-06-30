import {ContentChildren, Directive, ElementRef, NgZone, QueryList, Renderer2} from '@angular/core';
import {LivePreview} from '../../live-preview.service';
import {UndoManager} from '../../undo-manager/undo-manager.service';
import {Elements} from '../../elements/elements.service';
import {BaseDragAndDrop} from './base-drag-and-drop';
import {SelectedElement} from '../selected-element.service';
import {BuilderDocument} from '../../builder-document.service';
import {DragVisualHelper} from './drag-visual-helper/drag-visual-helper.service';

@Directive({
    selector: '[previewDragAndDrop]'
})
export class PreviewDragAndDropDirective extends BaseDragAndDrop {
    @ContentChildren('dragHandle') dragElements: QueryList<ElementRef>;

    /**
     * PreviewDragAndDropDirective Constructor.
     */
    constructor(
        protected livePreview: LivePreview,
        protected renderer: Renderer2,
        protected undoManager: UndoManager,
        protected elements: Elements,
        protected zone: NgZone,
        protected selectedElement: SelectedElement,
        protected builderDocument: BuilderDocument,
        protected dragHelper: DragVisualHelper,
    ) {
        super();
    }

    protected getDragHandles() {
        return document.querySelectorAll('.context-box-drag-handle');
    }

    protected setDragElement(e: HammerInput) {
        if (e.target.closest('.selected-box')) {
            this.dragEl = this.livePreview.selected;
        } else {
            this.dragEl = this.livePreview.hover;
        }
    }

    protected sortColumns(node: HTMLElement, e: HammerInput) {
        if ( ! node.parentElement) return;

        const className = node.parentElement.className;

        if (node === this.dragEl.node || node.parentElement !== this.dragEl.node.parentElement) return;

        // constrain column ordering withing row
        if (className && className.match('row')) {

            // switch column positions
            if (e.direction === Hammer.DIRECTION_RIGHT) {
                this.dragEl.node['before'](node);
            } else if (e.direction === Hammer.DIRECTION_LEFT) {
                this.dragEl.node['after'](node);
            }

            this.livePreview.repositionBox('selected');
        }
    }
}
