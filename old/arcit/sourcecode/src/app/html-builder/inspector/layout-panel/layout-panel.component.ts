import {Component, OnInit, ViewEncapsulation} from '@angular/core';
import {LayoutPanel} from './layout-panel.service';
import {Container} from './layout-panel-types';
import {Inspector} from '../inspector.service';
import {SelectedElement} from '../../live-preview/selected-element.service';
import {ContextBoxes} from '../../live-preview/context-boxes.service';
import {BuilderDocument} from '../../builder-document.service';
import {CdkDragDrop, moveItemInArray} from '@angular/cdk/drag-drop';
import {DomHelpers} from '../../../shared/dom-helpers.service';
import {LivePreview} from '../../live-preview.service';
import {UndoManager} from '../../undo-manager/undo-manager.service';

@Component({
    selector: 'layout-panel',
    templateUrl: './layout-panel.component.html',
    styleUrls: ['./layout-panel.component.scss'],
    encapsulation: ViewEncapsulation.None,
})
export class LayoutPanelComponent implements OnInit {
    constructor(
        private builderDocument: BuilderDocument,
        private selectedElement: SelectedElement,
        private contextBoxes: ContextBoxes,
        public layoutPanel: LayoutPanel,
        private inspector: Inspector,
        private livePreview: LivePreview,
        private undoManager: UndoManager,
    ) {}

    ngOnInit() {
        this.builderDocument.contentChanged.subscribe(e => {
            if ( ! this.inspector.activePanelIs('layout')) return;
            this.layoutPanel.loadContainers();
        });

        // reload container once layout panel is opened
        this.inspector.panelChanged.subscribe(name => {
            if (name !== 'layout') return;
            this.layoutPanel.loadContainers();
        });
    }

    public openInspectorPanel(node: HTMLElement) {
        this.selectedElement.selectNode(node);
        this.inspector.togglePanel('inspector');
    }

    public cloneContainer(container: Container) {
        const cloned = this.builderDocument.actions.cloneNode(container.node);
        this.layoutPanel.selectContainer(cloned);
    }

    public cloneRow(row: HTMLElement) {
        const cloned = this.builderDocument.actions.cloneNode(row);
        this.layoutPanel.selectRow(cloned, true);
    }

    public removeItem(node: HTMLElement) {
        this.builderDocument.actions.removeNode(node);
    }

    public repositionHoverBox(node: HTMLElement) {
        this.contextBoxes.repositionBox('hover', node);
    }

    public hideHoverBox() {
        this.contextBoxes.hideBox('hover');
    }

    public containerIsSelected(container: Container): boolean {
        if ( ! this.layoutPanel.selectedContainer) return false;
        return this.layoutPanel.selectedContainer.node === container.node;
    }

    /**
     * Called when container panel is opened.
     */
    public onPanelOpen(container: Container) {
        this.layoutPanel.selectedContainer = container;

        if (container.rows.length) {
            this.layoutPanel.selectRow(container.rows[0]);
        }
    }

    /**
     * Check if specified node is selected in live preview.
     */
    public isSelected(node: HTMLElement) {
        return this.selectedElement.node === node;
    }

    /**
     * Get width percentage from specified column span.
     */
    public widthFromSpan(span: number): string {
        return ((span * 100) / 12) + '%';
    }

    public reorder(e: CdkDragDrop<any>, type: 'container'|'row'|'column') {
        const oldArray = this.getNodeList(type),
            newArray = oldArray.slice();

        moveItemInArray(newArray, e.previousIndex, e.currentIndex);

        DomHelpers.reorderDom(newArray, oldArray);

        this.livePreview.repositionBox('selected');
        this.builderDocument.contentChanged.next('builder');

        this.createUndoCommand(oldArray, newArray);
    }

    private getNodeList(type: 'container'|'row'|'column') {
        switch (type) {
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
