import {ElementRef, Injectable} from '@angular/core';
import {InlineTextEditorComponent} from './inline-text-editor.component';
import {OverlayPanel} from '@common/core/ui/overlay-panel/overlay-panel.service';
import {OverlayPanelRef} from '@common/core/ui/overlay-panel/overlay-panel-ref';

@Injectable({
    providedIn: 'root',
})
export class InlineTextEditor {
    public overlayRef: OverlayPanelRef<InlineTextEditorComponent>;

    constructor(
        private overlayPanel: OverlayPanel,
    ) {}

    public open(node: HTMLElement, params: {activePanel?: 'icons'} = {}) {
        this.close();
        this.overlayRef = this.overlayPanel.open(InlineTextEditorComponent, {
            data: params,
            origin: new ElementRef(node),
            hasBackdrop: false,
            position: [
                {originX: 'center', originY: 'top', overlayX: 'center', overlayY: 'bottom', offsetX: 380, offsetY: -10},
                {originX: 'center', originY: 'bottom', overlayX: 'center', overlayY: 'top', offsetX: 380, offsetY: 10},
            ]
        });

        node.setAttribute('contenteditable', 'true');
        node.focus();
    }

    public close() {
        this.overlayRef && this.overlayRef.close();
    }
}
