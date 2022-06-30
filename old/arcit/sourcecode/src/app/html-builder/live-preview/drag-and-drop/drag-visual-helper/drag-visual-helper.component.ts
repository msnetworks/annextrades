import {Component, ElementRef, Renderer2, ViewEncapsulation} from '@angular/core';
import {DragVisualHelper} from "./drag-visual-helper.service";

@Component({
    selector: 'drag-visual-helper',
    templateUrl: './drag-visual-helper.component.html',
    styleUrls: ['./drag-visual-helper.component.scss'],
    encapsulation: ViewEncapsulation.None,
})
export class DragVisualHelperComponent {
    constructor(
        public renderer: Renderer2,
        public el: ElementRef,
        public dragHelper: DragVisualHelper,
    ) {}
}