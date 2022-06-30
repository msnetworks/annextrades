import {Component, EventEmitter, Output, ViewEncapsulation} from '@angular/core';
import {baseGradients} from "../../../../gradient-values";

@Component({
    selector: 'gradient-background-panel',
    templateUrl: './gradient-background-panel.component.html',
    styleUrls: ['./gradient-background-panel.component.scss'],
    encapsulation: ViewEncapsulation.None,
})
export class GradientBackgroundPanelComponent {

    /**
     * List of default gradient backgrounds.
     */
    public gradients = baseGradients.slice();

    /**
     * Fired when gradient is selected.
     */
    @Output() public selected = new EventEmitter();

    /**
     * Fired when close button is clicked.
     */
    @Output() public closed = new EventEmitter();

    /**
     * Emit selected event.
     */
    public emitSelectedEvent(gradient: string) {
        this.selected.emit(gradient);
    }

    /**
     * Emit closed event.
     */
    public emitClosedEvent() {
        this.closed.emit();
    }
}
