import {Injectable} from '@angular/core';
import {UndoManager} from './undo-manager/undo-manager.service';
import {Subject} from 'rxjs';
import {SelectedElement} from './live-preview/selected-element.service';
import {Elements} from './elements/elements.service';
import {ContextBoxes} from './live-preview/context-boxes.service';
import {changeSources} from './builder-document.service';

@Injectable({
    providedIn: 'root'
})
export class BuilderDocumentActions {
    public copiedNode: HTMLElement;
    public contentChanged = new Subject<string>();

    constructor(
        private undoManager: UndoManager,
        private selected: SelectedElement,
        private elements: Elements,
        private contextBoxes: ContextBoxes,
    ) {}

    /**
     * Apply specified css style to node.
     */
    public applyStyle(node: HTMLElement, name: string, value: string, addUndoCommand = true) {
        if (addUndoCommand) {
            this.undoManager.wrapDomChanges(node, () => {
                node.style[name] = value;
                this.contextBoxes.repositionBox('selected', node);
                this.contentChanged.next('builderDocument');
            });
        } else {
            node.style[name] = value;
            this.contextBoxes.repositionBox('selected', node);
            this.contentChanged.next('builderDocument');
        }
    }

    /**
     * Clone specified node inside the project.
     */
    public cloneNode(node: HTMLElement): HTMLElement {
        const cloned = node.cloneNode(true) as HTMLElement;

        this.undoManager.wrapDomChanges(node.parentElement, () => {
            node.parentElement.insertBefore(cloned, node.nextElementSibling);
            this.contentChanged.next('nodeAdded');
        });

        return cloned as HTMLElement;
    }

    /**
     * Delete specified node from the project.
     */
    public removeNode(node: HTMLElement): HTMLElement {
        if ( ! node) return;

        this.undoManager.wrapDomChanges(node.parentElement, () => {
            if (this.selected.node === node) this.selected.selectParent();
            node.parentElement.removeChild(node);
            this.contentChanged.next('nodeRemoved');
        });

        this.contextBoxes.hideBoxes();

        return node;
    }

    /**
     * Copy specified node for later use or pasting.
     */
    public copyNode(node: HTMLElement) {
        if (node && node.nodeName != 'BODY') {
            this.copiedNode = node.cloneNode(true) as HTMLElement;
        }
    }

    /**
     * Paste copied DOM node if it exists.
     */
    public pasteNode(ref: HTMLElement, copiedNode?: HTMLElement) {
        if ( ! copiedNode) copiedNode = this.copiedNode;

        if (ref && copiedNode) {
            this.undoManager.wrapDomChanges(ref.parentElement, () => {
                // make sure we don't paste refs after body
                if (ref.nodeName == 'BODY') {
                    ref.appendChild(copiedNode);
                } else {
                    ref.parentElement.insertBefore(copiedNode, ref.nextSibling);
                }

                this.contextBoxes.hideBox('selected');
            });

            // add undo
            this.contentChanged.next('nodeAdded');
        }
    }

    /**
     * Copy and remove the given node.
     */
    public cutNode(node: HTMLElement) {
        if (node && node.nodeName != 'BODY') {
            this.copyNode(node);
            this.removeNode(node);
        }
    }

    public duplicateNode(node: HTMLElement) {
        const cloned = node.cloneNode(true) as HTMLElement;
        this.pasteNode(this.selected.node, cloned);
    }

    public setChangedSubject(subject: Subject<changeSources>) {
        this.contentChanged = subject;
    }

    /**
     * Move selected node by one element in the specified direction.
     */
    public moveSelected(dir: 'up'|'down') {
        if ( ! this.selected.node) return;

        if (dir === 'down') {
            const next = this.selected.node.nextElementSibling as HTMLElement;

            if (next) {
                // check if we can insert selected node into the next one
                if (this.elements.canInsert(next, this.selected.element)) {
                    next.insertBefore(this.selected.node, next.firstChild);
                } else {
                    next.parentElement.insertBefore(this.selected.node, next.nextElementSibling);
                }

            } else {
                const parentParent = this.selected.node.parentElement.parentElement as HTMLElement;

                if (this.elements.canInsert(parentParent, this.selected.element)) {
                    parentParent.parentElement.insertBefore(this.selected.node, parentParent.nextElementSibling);
                }
            }
        } else if (dir === 'up') {
            const prev = this.selected.node.previousElementSibling as HTMLElement;

            if (prev) {
                // check if we can insert selected node into the prev one
                if (this.elements.canInsert(prev, this.selected.element)) {
                    prev.appendChild(this.selected.node);
                } else {
                    prev.parentElement.insertBefore(this.selected.node, prev);
                }
            } else {
                const parentParent = this.selected.node.parentElement.parentElement;

                if (this.elements.canInsert(parentParent, this.selected.element)) {
                    parentParent.insertBefore(this.selected.node, this.selected.node.parentElement);
                }
            }
        }

        this.contextBoxes.repositionBox('selected', this.selected.node);
    }
}
