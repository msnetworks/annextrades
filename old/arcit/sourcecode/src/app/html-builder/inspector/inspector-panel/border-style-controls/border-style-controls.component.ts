import {Component, ElementRef, OnInit, ViewChild, ViewEncapsulation} from '@angular/core';
import {SelectedElement} from '../../../live-preview/selected-element.service';
import {BuilderDocumentActions} from '../../../builder-document-actions.service';
import {OverlayPanel} from '@common/core/ui/overlay-panel/overlay-panel.service';
import {ColorpickerPanelComponent} from '@common/core/ui/color-picker/colorpicker-panel.component';
import {RIGHT_POSITION} from '@common/core/ui/overlay-panel/positions/right-position';

@Component({
    selector: 'border-style-controls',
    templateUrl: './border-style-controls.component.html',
    styleUrls: ['./border-style-controls.component.scss'],
    encapsulation: ViewEncapsulation.None,
})
export class BorderStyleControlsComponent implements OnInit {
    @ViewChild('colorButton', {static: true}) colorButton: ElementRef;

    public borderStyle = 'none';
    public borderColor = '#eee';

    constructor(
        private selected: SelectedElement,
        private overlayPanel: OverlayPanel,
        private builderActions: BuilderDocumentActions,
    ) {}

    ngOnInit() {
        this.selected.changed.subscribe(() => {
            this.setInitialBorderStyles();
        });
    }

    /**
     * Apply border color to selected element.
     */
    public applyBorderColor(color: string) {
        this.borderColor = color;
        this.builderActions.applyStyle(this.selected.node, 'borderColor', color);
    }

    /**
     * Apply border style to selected element.
     */
    public applyBorderStyle() {
        this.builderActions.applyStyle(this.selected.node, 'borderStyle', this.borderStyle);
    }

    /**
     * Open color picker panel and update border color.
     */
    public openColorpickerPanel() {
        this.overlayPanel.open(
            ColorpickerPanelComponent,
            {position: RIGHT_POSITION, origin: this.colorButton, data: {color: this.borderColor}}
        ).valueChanged().subscribe(color => {
            this.applyBorderColor(color);
        });
    }

    /**
     * Set styles of selected element on component.
     */
    private setInitialBorderStyles() {
        this.borderStyle = this.selected.getStyle('borderStyle');
        this.borderColor = this.selected.getStyle('borderColor');
    }
}
