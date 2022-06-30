import {ElementRef, Injectable} from '@angular/core';
import {SelectedElement} from "../live-preview/selected-element.service";
import {Subject} from "rxjs";

type PanelNames = 'elements'|'inspector'|'pages'|'themes'|'settings'|'layout';

@Injectable({
    providedIn: 'root'
})
export class Inspector {

    private activePanel: PanelNames = 'elements';

    /**
     * Inspector sidebar host element.
     */
    public elementRef: ElementRef;

    public panelChanged: Subject<string> = new Subject();

    constructor(private selectedElement: SelectedElement) {
        this.selectedElement.changed.subscribe(() => {
            if ( ! this.selectedElement.node) return;

            if (this.selectedElement.isLayout()) {
                this.openPanel('layout');
            } else {
                this.openPanel('inspector');
            }
        });
    }

    public togglePanel(name: PanelNames) {
        this.activePanel = name;
        this.panelChanged.next(name);
    }

    public openPanel(name: PanelNames) {
        if (this.activePanelIs(name)) return;
        this.activePanel = name;
        this.panelChanged.next(name);
    }

    public activePanelIs(name: PanelNames) {
        return this.activePanel === name;
    }

    public reset() {
        this.activePanel = 'elements';
    }
}
