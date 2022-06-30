import {Component, ElementRef, OnInit, Renderer2, ViewChild, ViewEncapsulation} from '@angular/core';
import {GradientBackgroundPanelComponent} from './gradient-background-panel/gradient-background-panel.component';
import {InspectorFloatingPanel} from '../../inspector-floating-panel.service';
import {ImageBackgroundPanelComponent} from './image-background-panel/image-background-panel.component';
import {SelectedElement} from '../../../live-preview/selected-element.service';
import {BuilderDocumentActions} from '../../../builder-document-actions.service';
import {UndoManager} from '../../../undo-manager/undo-manager.service';
import {OverlayPanel} from '@common/core/ui/overlay-panel/overlay-panel.service';
import {ColorpickerPanelComponent} from '@common/core/ui/color-picker/colorpicker-panel.component';
import {RIGHT_POSITION} from '@common/core/ui/overlay-panel/positions/right-position';

@Component({
    selector: 'background-panel',
    templateUrl: './background-panel.component.html',
    styleUrls: ['./background-panel.component.scss'],
    encapsulation: ViewEncapsulation.None,
})
export class BackgroundPanelComponent implements OnInit {
    @ViewChild('gradientButton', {static: true}) gradientButton: ElementRef;
    @ViewChild('backgroundButton', {static: true}) backgroundButton: ElementRef;

    public styles = {
        backgroundImage: '',
        backgroundColor: '',
    };

    constructor(
        private selectedElement: SelectedElement,
        private panel: InspectorFloatingPanel,
        private renderer: Renderer2,
        private builderActions: BuilderDocumentActions,
        private overlayPanel: OverlayPanel,
        private undoManager: UndoManager,
    ) {}

    ngOnInit() {
        this.selectedElement.changed.subscribe(() => {
            this.styles.backgroundImage = this.selectedElement.getStyle('backgroundImage');
            this.styles.backgroundColor = this.selectedElement.getStyle('backgroundColor');
            this.setBackgroundButtonColor();
        });
    }

    public openGradientPanel() {
        this.panel.open(GradientBackgroundPanelComponent, this.gradientButton).selected.subscribe(gradient => {
            this.setBackgroundButtonColor();
            this.applyBackgroundStyle('backgroundImage', gradient);
        });
    }

    public openColorpickerPanel() {
        const currentColor = this.styles.backgroundColor;
        this.overlayPanel.open(
            ColorpickerPanelComponent,
            {position: RIGHT_POSITION, origin: this.gradientButton, data: {color: currentColor}}
        ).valueChanged().subscribe(color => {
            this.setBackgroundButtonColor();
            this.applyBackgroundStyle('backgroundColor', color, false);
        });
    }

    public openBackgroundPanel() {
        this.panel.open(ImageBackgroundPanelComponent, this.gradientButton).selected.subscribe(url => {
            this.applyBackgroundStyle('backgroundImage', 'url(' + url + ')');
        });
    }

    private setBackgroundButtonColor() {
        if (this.styles.backgroundColor === 'rgba(0, 0, 0, 0)') return;
        this.renderer.setStyle(this.backgroundButton.nativeElement, 'backgroundColor', this.styles.backgroundColor);
    }

    public applyBackgroundStyle(type: string, value, addUndoCommand = true) {
        this.styles[type] = value;
        this.builderActions.applyStyle(this.selectedElement.node, type, this.styles[type], addUndoCommand);
    }

    public removeBackground() {
        this.styles.backgroundColor = '';
        this.styles.backgroundImage = '';

        this.undoManager.wrapDomChanges(this.selectedElement.node, () => {
            this.builderActions.applyStyle(this.selectedElement.node, 'backgroundImage', '', false);
            this.builderActions.applyStyle(this.selectedElement.node, 'backgroundColor', '', false);
        });
    }
}
