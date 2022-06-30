import {Component, ElementRef, OnInit, Renderer2, ViewChild, ViewEncapsulation} from '@angular/core';
import {SelectedElement} from '../../../live-preview/selected-element.service';
import {BuilderDocumentActions} from '../../../builder-document-actions.service';
import {OverlayPanel} from '@common/core/ui/overlay-panel/overlay-panel.service';
import {ColorpickerPanelComponent} from '@common/core/ui/color-picker/colorpicker-panel.component';
import {RIGHT_POSITION} from '@common/core/ui/overlay-panel/positions/right-position';

@Component({
    selector: 'shadows-panel',
    templateUrl: './shadows-panel.component.html',
    styleUrls: ['./shadows-panel.component.scss'],
    encapsulation: ViewEncapsulation.None
})
export class ShadowsPanelComponent implements OnInit {
    @ViewChild('colorButton', {static: true}) colorButton: ElementRef;

    public props;

    public sliders = ['angle', 'distance', 'blur', 'spread'];

    constructor(
        private selectedElement: SelectedElement,
        private renderer: Renderer2,
        private overlay: OverlayPanel,
        private builderActions: BuilderDocumentActions,
    ) {
        this.resetProps();
    }

    ngOnInit() {
        this.selectedElement.changed.subscribe(() => {
            if (this.props.type === 'boxShadow') {
                this.stringToProps(this.selectedElement.getStyle('boxShadow'));
            } else {
                this.stringToProps(this.selectedElement.getStyle('textShadow'));
            }

            this.setColorButtonColor();
        });
    }

    public applyStyle(name: string, value: string, addUndoCommand = true) {
        this.props[name] = value;
        this.builderActions.applyStyle(this.selectedElement.node, this.props.type, this.propsToString(this.props), addUndoCommand);
        this.clearShadow(this.props.type === 'boxShadow' ? 'textShadow' : 'boxShadow');
    }

    public clearShadow(type: string) {
        this.builderActions.applyStyle(this.selectedElement.node, type, 'none', false);
    }

    public openColorpickerPanel() {
        this.overlay.open(
            ColorpickerPanelComponent,
            {origin: this.colorButton, position: RIGHT_POSITION, data: {color: this.props.color}}
        ).valueChanged().subscribe(color => {
            this.setColorButtonColor();
            this.applyStyle('color', color);
        });
    }

    private setColorButtonColor() {
        if (this.props.color === 'rgba(0, 0, 0, 0)') return;
        this.renderer.setStyle(this.colorButton.nativeElement, 'backgroundColor', this.props.color);
    }

    private propsToString(props: any) {
        const blur   = Math.round(props.blur),
            spread = Math.round(props.spread),
            angle  = parseInt(props.angle) * ((Math.PI) / 180),
            x      = Math.round(props.distance * Math.cos(angle)),
            y      = Math.round(props.distance * Math.sin(angle)),
            inset  = props.inset && props.type === 'boxShadow' ? 'inset ' : '';
        let css = inset + x + 'px ' + y + 'px ' + blur + 'px ';

        // text shadows have no spread property
        if (props.type === 'boxShadow') {
            css += spread + 'px ';
        }

        return css + props.color;
    }

    private stringToProps(string: string) {
        if ( ! string || string === 'none') {
            return this.resetProps();
        }

        const array = string.replace(/, /g, ',').split(' ').map(val => {
            return val.indexOf('px') > -1 ? +val.replace('px', '') : val;
        });

        // text shadow
        if (array.length === 4) {
            this.props.color = array[0];
            this.props.angle = array[1];
            this.props.distance = array[2];
            this.props.blur = array[3];
        } else if (array.length === 5 || array.length === 6) {
            this.props.color = array[0];
            this.props.angle = array[1];
            this.props.distance = array[2];
            this.props.blur = array[3];
            this.props.spread = array[4];
        }
    }

    /**
     * Reset shadow props to default state.
     */
    private resetProps() {
        this.props = {
            type: 'boxShadow',
            inset: false,
            angle: 0,
            distance: 5,
            blur: 10,
            color: 'rgba(0, 0, 0, 0.5)',
            spread: 0
        };
    }
}
