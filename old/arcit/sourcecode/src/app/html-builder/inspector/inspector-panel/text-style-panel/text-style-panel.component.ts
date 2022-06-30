import {Component, ElementRef, OnInit, ViewChild, ViewEncapsulation} from '@angular/core';
import {baseFonts, fontWeights} from '../../../text-style-values';
import {InspectorFloatingPanel} from '../../inspector-floating-panel.service';
import {GoogleFontsPanelComponent} from './google-fonts-panel/google-fonts-panel.component';
import {SelectedElement} from '../../../live-preview/selected-element.service';
import {BuilderDocumentActions} from '../../../builder-document-actions.service';
import {ColorpickerPanelComponent} from '@common/core/ui/color-picker/colorpicker-panel.component';
import {RIGHT_POSITION} from '@common/core/ui/overlay-panel/positions/right-position';
import {OverlayPanel} from '@common/core/ui/overlay-panel/overlay-panel.service';

@Component({
    selector: 'text-style-panel',
    templateUrl: './text-style-panel.component.html',
    styleUrls: ['./text-style-panel.component.scss'],
    encapsulation: ViewEncapsulation.None,
})
export class TextStylePanelComponent implements OnInit {
    @ViewChild('googleFontsOrigin', {static: true}) googleFontsOrigin: ElementRef;

    public styles: any = {};
    public baseFonts: {name: string, css: string}[] = [];
    public fontWeights = fontWeights.slice();

    constructor(
        private selectedElement: SelectedElement,
        private panel: InspectorFloatingPanel,
        private builderActions: BuilderDocumentActions,
        private overlayPanel: OverlayPanel,
    ) {}

    ngOnInit() {
        this.selectedElement.changed.subscribe(() => {
            this.getSelectedElementTextStyles();
        });
    }

    public applyTextStyle(name: string, addUndoCommand = true) {
        let value = '' + this.styles[name];
        if (name === 'fontSize') {
            value += 'px';
        }
        this.builderActions.applyStyle(this.selectedElement.node, name, value, addUndoCommand);
    }

    /**
     * Toggle between specified style and "initial".
     */
    public toggleTextStyle(name: string, value: string) {
        if (this.textStyleIs(name, value)) {
            this.builderActions.applyStyle(this.selectedElement.node, name, 'initial');
        } else {
            this.builderActions.applyStyle(this.selectedElement.node, name, value);
        }
    }

    /**
     * Check if selected element's specified style equals given value.
     */
    public textStyleIs(name: string, value: string) {
        return this.selectedElement.getStyle(name).indexOf(value) > -1;
    }

    public openColorpickerPanel(origin: HTMLElement) {
        const currentColor = this.styles.color;
        this.overlayPanel.open(
            ColorpickerPanelComponent,
            {position: RIGHT_POSITION, origin: new ElementRef(origin), data: {color: currentColor}}
        ).valueChanged().subscribe(color => {
            this.styles.color = color;
            this.applyTextStyle('color', false);
        });
    }

    public openGoogleFontsPanel() {
        this.panel.open(GoogleFontsPanelComponent, this.googleFontsOrigin).selected.subscribe(fontFamily => {
            this.builderActions.applyStyle(this.selectedElement.node, 'fontFamily', fontFamily);
        });
    }

    /**
     * Get current text styles of element selected in the builder.
     */
    private getSelectedElementTextStyles() {
        this.styles = {
            color: this.selectedElement.getStyle('color'),
            fontSize: this.selectedElement.getStyle('fontSize').replace('px', ''),
            textAlign: this.selectedElement.getStyle('textAlign'),
            fontStyle: this.selectedElement.getStyle('fontStyle'),
            fontFamily: this.selectedElement.getStyle('fontFamily'),
            lineHeight: this.selectedElement.getStyle('lineHeight'),
            fontWeight: this.selectedElement.getStyle('fontWeight'),
            textDecoration: this.selectedElement.getStyle('textDecoration')
        };

        // make sure current font is always shown in select,
        // event if it's google font and not base font
        this.baseFonts = baseFonts.slice();
        if ( ! this.baseFonts.includes(this.styles.fontFamily)) {
            this.baseFonts.push({name: this.styles.fontFamily.split(',')[0], css: this.styles.fontFamily});
        }
    }
}
