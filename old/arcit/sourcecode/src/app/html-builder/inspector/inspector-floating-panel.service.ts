import {ElementRef, Injectable} from '@angular/core';
import {Overlay, OverlayRef} from '@angular/cdk/overlay';
import {ComponentPortal, ComponentType} from '@angular/cdk/portal';
import {Observable} from 'rxjs';

@Injectable({
    providedIn: 'root'
})
export class InspectorFloatingPanel {
    public overlayRef: OverlayRef;
    private componentRef: any;

    constructor(private overlay: Overlay) {}

    public open<T>(component: ComponentType<T>, origin: ElementRef, config = {}): {selected: Observable<any>, closed: Observable<any>} {
        config = Object.assign({}, this.getDefaultConfig(), config);
        this.close();

        const strategy = this.overlay.position().flexibleConnectedTo(origin)
            .withPositions([
                {originX: 'end', originY: 'center', overlayX: 'start', overlayY: 'center', offsetX: 35},
                {originX: 'start', originY: 'center', overlayX: 'end', overlayY: 'center', offsetX: 35},
            ]);

        this.overlayRef = this.overlay.create({positionStrategy: strategy, hasBackdrop: true});

        this.overlayRef.backdropClick().subscribe(() => this.close());

        this.componentRef = this.overlayRef.attach(new ComponentPortal(component));

        this.componentRef.instance.closed.subscribe(() => {
            this.close();
        });

        this.componentRef.instance.selected.subscribe(() => {
            if (config['closeOnSelected']) this.close();
        });

        return this.componentRef.instance;
    }

    public close() {
        this.overlayRef && this.overlayRef.dispose();

        if ( ! this.componentRef) return;

        if (this.componentRef.instance.closed) {
            this.componentRef.instance.closed.observers.forEach(observer => {
                observer.unsubscribe();
            });
        }

        if (this.componentRef.instance.selected) {
            this.componentRef.instance.selected.observers.forEach(observer => {
                observer.unsubscribe();
            });
        }
    }

    private getDefaultConfig() {
        return {
            closeOnSelected: true,
        };
    }
}
