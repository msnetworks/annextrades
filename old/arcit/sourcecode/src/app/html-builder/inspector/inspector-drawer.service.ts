import {Injectable} from '@angular/core';
import { MatDrawer } from "@angular/material/sidenav";

@Injectable({
    providedIn: 'root'
})
export class InspectorDrawer {

    /**
     * Inspector drawer component instance.
     */
    private drawer: MatDrawer;

    /**
     * Currently active drawer panel.
     */
    public activePanel: 'templates' | 'themes' = null;

    /**
     * Toggle inspector drawer state.
     */
    public toggle(name: 'templates' | 'themes') {
        this.activePanel = name;
        this.drawer.toggle();
    }

    /**
     * Close inspector drawer.
     */
    public close() {
        this.activePanel = null;
        return this.drawer.close();
    }

    public setDrawer(drawer: MatDrawer) {
        this.drawer = drawer;
    }
}
