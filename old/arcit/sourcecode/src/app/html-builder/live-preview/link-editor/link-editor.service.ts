import {ElementRef, Injectable} from '@angular/core';
import {ConnectedPosition} from '@angular/cdk/overlay';
import {LinkEditorComponent} from './link-editor.component';
import {OverlayPanel} from '@common/core/ui/overlay-panel/overlay-panel.service';
import {OverlayPanelRef} from '@common/core/ui/overlay-panel/overlay-panel-ref';
import {BreakpointsService} from '@common/core/ui/breakpoints.service';

@Injectable({
    providedIn: 'root'
})
export class LinkEditor {
    public overlayRef: OverlayPanelRef<LinkEditorComponent>;

    constructor(
        private overlayPanel: OverlayPanel,
        private breakpoints: BreakpointsService,
    ) {}

    public open(node: HTMLLinkElement) {
        // on mobile sidebar is overlaid, so no offset is needed
        const offsetX = this.breakpoints.isMobile$.value ? 0 : 380;
        const bottom = [
            {originX: 'center', originY: 'bottom', overlayX: 'center', overlayY: 'top', offsetY: 25, offsetX}, // bottom
            {originX: 'end', originY: 'bottom', overlayX: 'end', overlayY: 'top', offsetY: 25, offsetX}, // bottom
            {originX: 'start', originY: 'bottom', overlayX: 'start', overlayY: 'top', offsetY: 25, offsetX}, // bottom
            {originX: 'center', originY: 'top', overlayX: 'center', overlayY: 'bottom', offsetY: -25, offsetX}, // top
        ] as ConnectedPosition[];

        this.overlayRef = this.overlayPanel.open(LinkEditorComponent, {
            position: bottom,
            origin: new ElementRef(node),
            data: {node}
        });
    }

    public close() {
        this.overlayRef && this.overlayRef.close();
    }
}
