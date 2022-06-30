import {AfterContentInit, Directive, ElementRef, Input} from '@angular/core';
import {UndoManager} from "../../undo-manager/undo-manager.service";
import {LivePreview} from "../../live-preview.service";
import {LayoutPanel} from "./layout-panel.service";
import {BuilderDocument} from "../../builder-document.service";
import {DomHelpers} from '../../../shared/dom-helpers.service';

@Directive({
    selector: '[reorderLayoutItems]'
})
export class ReorderLayoutItemsDirective implements AfterContentInit {
    @Input('reorderLayoutItems') type: 'container'|'row'|'column';

    /**
     * ReorderLayoutItemsDirective Constructor.
     */
    constructor(
        private undoManager: UndoManager,
        private livePreview: LivePreview,
        private layoutPanel: LayoutPanel,
        private builderDocument: BuilderDocument,
        private el: ElementRef,
    ) {}

    ngAfterContentInit() {
        // new Sortable(this.el.nativeElement, {
        //     draggable: '.'+this.type+'-drag-wrapper',
        //     handle: '.drag-handle',
        //     animation: 250,
        //     onUpdate: (e) => {
        //         let oldOrder = this.getNodeList(),
        //             newOrder = oldOrder.slice();
        //
        //         utils.moveArrayElement(newOrder, e['oldIndex'], e['newIndex']);
        //         DomHelpers.reorderDom(newOrder, oldOrder);
        //         this.livePreview.repositionBox('selected');
        //         this.builderDocument.contentChanged.next('builder');
        //
        //         this.createUndoCommand(oldOrder, newOrder);
        //     }
        // });
    }

    private getNodeList() {
        switch (this.type) {
            case 'container':
                return this.layoutPanel.containers.map(container => container.node);
            case 'row':
                return this.layoutPanel.selectedContainer.rows;
            case 'column':
                return this.layoutPanel.selectedRow.columns.map(col => col.node);
        }
    }

    private createUndoCommand(oldOrder: HTMLElement[], newOrder: HTMLElement[]) {
        this.undoManager.add('generic', {
            undo: () => {
                DomHelpers.reorderDom(oldOrder, newOrder);
                this.livePreview.repositionBox('selected');
            },
            redo: () => {
                DomHelpers.reorderDom(newOrder, oldOrder);
                this.livePreview.repositionBox('selected');
            }
        });
    }
}
