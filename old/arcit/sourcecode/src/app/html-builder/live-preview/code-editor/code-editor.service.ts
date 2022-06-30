import {ElementRef, Injectable} from '@angular/core';
import {CodeEditorComponent} from './code-editor.component';
import {Observable} from 'rxjs';
import {OverlayPanel} from '@common/core/ui/overlay-panel/overlay-panel.service';
import {OverlayPanelRef} from '@common/core/ui/overlay-panel/overlay-panel-ref';
import {BreakpointsService} from '@common/core/ui/breakpoints.service';

@Injectable({
    providedIn: 'root',
})
export class CodeEditor {
    public overlayRef: OverlayPanelRef<CodeEditorComponent>;
    private origin: ElementRef;

    constructor(
        private overlayPanel: OverlayPanel,
        private breakpoints: BreakpointsService,
    ) {}

    public toggle() {
        if (this.overlayRef && this.overlayRef.isOpen()) {
            this.close();
        } else {
            this.open();
        }
    }

    public open(): Observable<CodeEditorComponent> {
        if (this.overlayRef && this.overlayRef.isOpen()) {
            return this.overlayRef.componentRef.instance.afterLoaded();
        }

        const rect = document.querySelector('live-preview').getBoundingClientRect();
        const width = rect.width - 50;
        const height = rect.height - 30;

        this.overlayRef = this.overlayPanel.open<CodeEditorComponent>(CodeEditorComponent, {
            position: [
                {originX: 'end', originY: 'bottom', overlayX: 'start', overlayY: 'bottom', offsetX: 15, offsetY: 15},
                {originX: 'end', originY: 'top', overlayX: 'start', overlayY: 'top', offsetX: 15, offsetY: 15}
            ],
            mobilePosition: 'center',
            hasBackdrop: this.breakpoints.isMobile$.value,
            width,
            height,
            origin: this.origin,
        });

        return this.overlayRef.componentRef.instance.afterLoaded();
    }

    public close() {
        if ( ! this.overlayRef) return;
        this.overlayRef.close();
        this.overlayRef = null;
    }

    public setOrigin(origin: ElementRef) {
        this.origin = origin;
    }
}
