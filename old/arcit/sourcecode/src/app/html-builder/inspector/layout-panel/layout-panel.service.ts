import {Injectable} from '@angular/core';
import {Columns, Container} from './layout-panel-types';
import {UndoManager} from '../../undo-manager/undo-manager.service';
import {SelectedElement} from '../../live-preview/selected-element.service';
import {BuilderDocument} from '../../builder-document.service';
import {ContextBoxes} from '../../live-preview/context-boxes.service';
import {Elements} from '../../elements/elements.service';
import {randomString} from '@common/core/utils/random-string';

const CONTAINER_CLASS = '.container, .container-fluid';

@Injectable({
    providedIn: 'root'
})
export class LayoutPanel {

    /**
     * All existing containers in the live preview.
     */
    public containers: Container[] = [];

    /**
     * Currently selected row.
     */
    public selectedRow: {node: HTMLElement, columns: Columns, preset: number[]};

    public selectedContainer: Container;

    constructor(
        private builderDocument: BuilderDocument,
        private selected: SelectedElement,
        private undoManager: UndoManager,
        private contextBoxes: ContextBoxes,
        private elements: Elements,
    ) {
        this.selected.changed.subscribe(() => {
            this.selectRowAndContainerUsing(this.selected.node);
        });
    }

    /**
     * Load all containers from live preview.
     */
    public loadContainers() {
        this.containers = [];
        Array.from(this.builderDocument.findAll(CONTAINER_CLASS)).forEach((node: HTMLElement) => {
            const rows = Array.from(node.querySelectorAll('.row')) as HTMLElement[];
            this.containers.push({node, rows, id: randomString()});
        });

        if (this.selectedContainer) this.selectContainer(this.selectedContainer.node);
    }

    /**
     * Add a row before or after specified reference element.
     */
    public createRow(container: HTMLElement, ref: HTMLElement, dir: 'before'|'after'|'start') {
        const row = this.builderDocument.createElement('div');
        row.appendChild(this.createColumnNode(12));
        row.classList.add('row');

        if (dir === 'start') {
            if (ref) {
                ref.parentElement.insertBefore(row, ref);
            } else {
                container.appendChild(row);
            }
        } else {
            ref[dir](row);
        }

        this.selectRow(row);
        this.builderDocument.contentChanged.next('builder');
    }

    /**
     * Create new container node and add it to the container's list.
     */
    public createContainer(ref: HTMLElement, dir: 'before'|'after'|'start') {
        const row = this.builderDocument.createElement('div');
        row.appendChild(this.createColumnNode(12));
        row.classList.add('row');

        const container = this.builderDocument.createElement('div');
        container.classList.add('container');
        container.appendChild(row);

        if (dir === 'start') {
            const body = this.builderDocument.getBody();
            body && body.appendChild(container);
        } else {
            ref[dir](container);
        }

        this.builderDocument.contentChanged.next('builder');

        this.selectContainer(container);
        this.selected.selectNode(this.selectedContainer.node);
    }

    public selectContainer(container: Container|HTMLElement, selectRow = true) {
        if ( ! container) return;

        if (container['nodeType']) {
            this.selectedContainer = this.containers.find(cont => cont.node === container);
        } else {
            this.selectedContainer = container as Container;
        }

        if (this.selectedContainer && selectRow) {
            this.selectRow(this.selectedContainer.rows[0]);
        }
    }

    public rowIsSelected(node: HTMLElement) {
        return this.selectedRow && this.selectedRow.node === node;
    }

    public containerIsSelected(node: HTMLElement) {
        return this.selectedContainer && this.selectedContainer.node === node;
    }

    /**
     * Select specified row.
     */
    public selectRow(node: HTMLElement, selectNode = true) {
        if ( ! node) return;

        if (selectNode) this.selected.selectNode(node);

        const columns = this.getColumns(node),
              preset  = columns.map(col => col.span);

        this.builderDocument.scrollIntoView(node);

        this.selectedRow = {node, columns, preset};
    }

    private getColumns(node: HTMLElement): Columns {
        const cols = this.nodeListToArray(node.children).filter(node => {
            return node.className.indexOf('col-') > -1;
        });

        return cols.map(column => {
            return {node: column, span: this.getSpan(column), id: randomString()};
        });
    }

    public selectColumn(node: HTMLElement) {
        this.selected.selectNode(node);
        this.builderDocument.scrollIntoView(node);
    }

    public applyPreset(preset: number[]) {
        const oldNode = this.selectedRow.node.cloneNode(true) as HTMLElement;

        // remove extra columns
        if (this.selectedRow.columns.length > preset.length) {
            const cols = this.selectedRow.columns.slice(preset.length);
            cols.forEach(col => col.node.remove());
        }

        preset.forEach((span, i) => {
            // resize existing columns
            if (this.selectedRow.columns[i]) {
                this.resizeColumn(this.selectedRow.columns[i].node, span);
            } else if (this.selectedRow.columns[i - 1]) {
                this.addNewColumn(this.selectedRow.columns[i - 1].node, span);

            // row is empty
            } else {
                this.selectedRow.node.appendChild(this.createColumnNode(span));
            }
        });

        this.undoManager.add('domChanges', {
            oldNode: oldNode,
            newNode: this.selectedRow.node.cloneNode(true) as HTMLElement,
            node: this.selectedRow.node,
        });

        this.selectRow(this.selectedRow.node);
        this.builderDocument.contentChanged.next('builder');
        this.contextBoxes.repositionBox('selected', this.selected.node);
    }

    /**
     * Insert new column before or after the given one.
     */
    public addNewColumn(node: HTMLElement, span: number, dir: 'before'|'after' = 'after') {
        const nodeIndex = this.getNodeIndex(this.selectedRow.columns, node),
            siblings  = this.nodeListToArray(node.parentElement.childNodes),
            colsAfter = siblings.filter(siblingIndex => nodeIndex < siblingIndex),
            colsBefore = siblings.filter(siblingIndex => nodeIndex > siblingIndex);
        let inserted = false;

        // add new column without resizing other columns if there's enough space left
        if ((this.getTotalSpan(this.selectedRow.columns) + span) <= 12) {
            node[dir](this.createColumnNode(span));
            inserted = true;
        }

        // try to reduce the next column by one
        if ( ! inserted && this.widerThen(1, colsAfter[0])) {
            this.resizeColumn(colsAfter[0], 1, '-');
            node[dir](this.createColumnNode(span));
            inserted = true;
        } else if ( ! inserted && this.widerThen(1, node)) {
            this.resizeColumn(node, 1, '-');
            node['after'](this.createColumnNode(span));
            inserted = true;
        }

        // loop trough all columns after given one and
        // reduce the first one that's wider then one
        if ( ! inserted) {
            for (let i = 0; i < colsAfter.length; i++) {
                if (this.widerThen(1, colsAfter[i])) {
                    this.resizeColumn(colsAfter[i], 1, '-');
                    node[dir](this.createColumnNode(span));
                    inserted = true;
                    break;
                }
            }
        }

        // loop trough all columns before given one and
        // reduce the first one that's wider then one
        if ( ! inserted) {
            for (let i = 0; i < colsBefore.length; i++) {
                if (this.widerThen(1, colsBefore[i])) {
                    this.resizeColumn(colsBefore[i], 1, '-');
                    node[dir](this.createColumnNode(span));
                    inserted = true;
                    break;
                }
            }
        }

        this.selectedRow.columns = this.getColumns(this.selectedRow.node);
    }

    /**
     * Get total span for specified row.
     */
    private getTotalSpan(columns: Columns): number {
        const spans = columns.map(col => this.getSpan(col.node));

        return spans.reduce((total, span) => {
            return total + span;
        });
    }

    /**
     * Create new column node of specified span.
     */
    private createColumnNode(span: number): HTMLElement {
        const col = this.builderDocument.createElement('div');
        col.className = 'col-sm-' + span;
        return col;
    }

    /**
     * Return whether given column is wider then
     * given number of spans or not.
     */
    private widerThen(span: number, node: HTMLElement) {
        if (this.isColumn(node)) {
            return this.getSpan(node) > span;
        }
    }

    /**
     * Check whether or not specified node is a column.
     */
    private isColumn(node: HTMLElement) {
        if (node && node.className) {
            return node.className.indexOf('col-') > -1;
        }
    }

    private getNodeIndex(nodeList: NodeList|Columns, node: Node) {
        for (let i = nodeList.length - 1; i >= 0; i--) {
            if (nodeList[i] === node) return i;
        }
    }

    /**
     * Resize passed in column in the DOM.
     */
    private resizeColumn(node: HTMLElement, newSpan: number, operator?: '+'|'-') {
        if ( ! newSpan) newSpan = 1;

        node.className = node.className.replace(/(col-[a-z]+-)([0-9]+)/, function(full, start, oldSpan) {
            if (operator) {
                return operator === '+' ? start + (parseInt(oldSpan) + newSpan) : start + (parseInt(oldSpan) - newSpan);
            }

            return start + newSpan;
        });
    }

    /**
     * Return given columns span.
     */
    private getSpan(node: HTMLElement): number {
        const matches = node.className.match(/col-[a-z]+-([0-9]+)/);
        return parseInt(matches ? matches[1] : null);
    }

    private nodeListToArray(nodeList: NodeListOf<Element>|HTMLCollection|any[]|NodeList) {
        const array = [];

        for (let i = 0; i < nodeList.length; i++) {
            array.push(nodeList[i]);
        }

        return array;
    }

    /**
     * Select row and container using specified node (column, row or container).
     */
    public selectRowAndContainerUsing(node: HTMLElement) {
        let row, container;

        if ( ! node || ! this.selected.isLayout()) return;

        if (this.elements.isRow(this.selected.node)) {
            row = node;
            container = row.closest(CONTAINER_CLASS) as HTMLElement;
        }

        if (this.elements.isColumn(this.selected.node)) {
            row = node.closest('.row') as HTMLElement;
            if (row) {
                container = row.closest(CONTAINER_CLASS) as HTMLElement;
            }
        }

        if (this.elements.isContainer(this.selected.node)) {
            container = node;
            row = container.querySelector('.row');
        }

        if ( ! this.rowIsSelected(row)) {
            this.selectRow(row, false);
        }

        if ( ! this.containerIsSelected(container)) {
            this.selectContainer(container, false);
        }
    }
}
