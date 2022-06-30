import {Injectable, NgZone} from '@angular/core';
import {DragVisualHelperComponent} from "./drag-visual-helper.component";

@Injectable({
    providedIn: 'root'
})
export class DragVisualHelper {

    private component: DragVisualHelperComponent;

    private element;

    /**
     * DragVisualHelper Constructor.
     */
    constructor(private zone: NgZone) {}

    public getName() {
        return this.element && this.element.name;
    }

    public reposition(y: number, x: number) {
        //offset drag helper a bit, so it's in top right corner of cursor
        this.component.renderer.setStyle(this.component.el.nativeElement, 'top', y - 20 + 'px');
        this.component.renderer.setStyle(this.component.el.nativeElement, 'left', x + 21 + 'px');
    }

    public show(element: any) {
        this.zone.run(() => this.element = element);
        this.component.renderer.removeClass(this.component.el.nativeElement, 'hidden');
    }

    public hide() {
        this.component.renderer.addClass(this.component.el.nativeElement, 'hidden');
    }

    public setComponent(component: DragVisualHelperComponent) {
        this.component = component;
    }
}
