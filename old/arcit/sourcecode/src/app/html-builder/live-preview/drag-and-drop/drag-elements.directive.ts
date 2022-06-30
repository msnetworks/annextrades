import {ContentChildren, Directive, ElementRef, NgZone, QueryList, Renderer2} from '@angular/core';
import {LivePreview} from "../../live-preview.service";
import {UndoManager} from "../../undo-manager/undo-manager.service";
import {Elements} from "../../elements/elements.service";
import {BaseDragAndDrop} from "./base-drag-and-drop";
import {SelectedElement} from "../selected-element.service";
import {BuilderDocument} from "../../builder-document.service";
import {ActiveProject} from "../../projects/active-project";
import {DragVisualHelper} from "./drag-visual-helper/drag-visual-helper.service";
import {DomHelpers} from '../../../shared/dom-helpers.service';

@Directive({
    selector: '[dragElements]'
})
export class DragElementsDirective extends BaseDragAndDrop {
    @ContentChildren('dragElement') dragElements: QueryList<ElementRef>;

    /**
     * DragElementsDirective Constructor.
     */
    constructor(
        protected livePreview: LivePreview,
        protected undoManager: UndoManager,
        protected elements: Elements,
        protected zone: NgZone,
        protected selectedElement: SelectedElement,
        protected builderDocument: BuilderDocument,
        protected activeProject: ActiveProject,
        protected renderer: Renderer2,
        protected dragHelper: DragVisualHelper,
    ) {
        super();
    }

    protected getDragHandles() {
        return document.querySelectorAll('.element-drag-handle');
    }

    protected setDragElement(e: HammerInput) {
        const el = this.elements.findByName(e.target.closest('.element')['dataset'].name);
        const node = DomHelpers.nodeFromString(el.html);
        this.dragEl = {node: node, element: el};
    }

    protected handleDragEnd(e: HammerInput) {
        super.handleDragEnd(e);

        if (this.dragEl.element.css) {
            const params = {thumbnail: false, params: {custom_element_css: this.dragEl.element.css}};
            this.activeProject.save(params).subscribe(() => {
                this.builderDocument.reloadCustomElementsCss();
            });
        }
    }
}
