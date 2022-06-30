import {Component, HostBinding, ViewChild, ViewEncapsulation} from '@angular/core';
import {state, style, animate, transition, trigger} from '@angular/animations';
import { MatTabChangeEvent, MatTabGroup } from '@angular/material/tabs';
import {LivePreview} from '../../live-preview.service';
import {ContextBoxes} from '../../live-preview/context-boxes.service';

@Component({
    selector: 'device-switcher',
    templateUrl: './device-switcher.component.html',
    styleUrls: ['./device-switcher.component.scss'],
    encapsulation: ViewEncapsulation.None,
    animations: [
        trigger('toggleAnimation', [
            state('false', style({height: '0px', visibility: 'hidden'})),
            state('true', style({height: '*', visibility: 'visible'})),
            transition('true <=> false',
                animate('225ms cubic-bezier(0.4,0.0,0.2,1)')),
        ])
    ]
})
export class DeviceSwitcherComponent {
    @ViewChild('tabs', {static: true}) tabs: MatTabGroup;
    @HostBinding('@toggleAnimation') private visible = false;

    public selectedIndex = 3;

    constructor(
        private livePreview: LivePreview,
        private contextBoxes: ContextBoxes,
    ) {}

    /**
     * Toggle visibility of device switcher.
     */
    public toggleVisibility() {
        this.visible = !this.visible;
    }

    /**
     * Change live preview width based on selected tab.
     */
    public switchDevice(e: MatTabChangeEvent) {
        this.selectedIndex = e.index;
        this.livePreview.setWidth(this.getWidthFromIndex(e.index));
        this.contextBoxes.hideBoxes();
    }

    /**
     * Get width for live preview from specified tab index.
     */
    private getWidthFromIndex(index: number): any {
        switch (index) {
            case 0: return 'phone';
            case 1: return 'tablet';
            case 2: return 'laptop';
            case 3: return 'desktop';
        }
    }
}
