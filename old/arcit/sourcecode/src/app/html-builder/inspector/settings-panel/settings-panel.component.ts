import {Component, OnInit, ViewEncapsulation} from '@angular/core';
import {Overlay} from '@angular/cdk/overlay';
import {Inspector} from '../inspector.service';
import {ActiveProject} from '../../projects/active-project';
import {InspectorDrawer} from '../inspector-drawer.service';
import {LivePreviewLoader} from '../../live-preview/live-preview-loader.service';
import {LocalStorage} from 'common/core/services/local-storage.service';

@Component({
    selector: 'settings-panel',
    templateUrl: './settings-panel.component.html',
    styleUrls: ['./settings-panel.component.scss'],
    encapsulation: ViewEncapsulation.None
})
export class SettingsPanelComponent implements OnInit {
    public selectedFramework: string;

    public settings: {
        selectedBoxEnabled: boolean,
        hoverBoxEnabled: boolean,
        autoSave: boolean,
    };

    constructor(
        private overlay: Overlay,
        private inspector: Inspector,
        public activeProject: ActiveProject,
        private inspectorDrawer: InspectorDrawer,
        public loader: LivePreviewLoader,
        private localStorage: LocalStorage,
    ) {}

    ngOnInit() {
        this.hydrateModels();

        this.activeProject.templateChanged$.subscribe(() => {
            this.selectedFramework = this.activeProject.get().model.framework;
        });
    }

    /**
     * Change project's framework.
     */
    public changeFramework(name: string) {
        this.loader.show();

        this.activeProject.changeFramework(name).then(() => {
            this.loader.hide();
        });
    }

    /**
     * Open panel for selecting a template.
     */
    public openTemplatesPanel() {
        this.inspectorDrawer.toggle('templates');
    }

    /**
     * Open panel for selecting a theme.
     */
    public openThemesPanel() {
        this.inspectorDrawer.toggle('themes');
    }

    /**
     * Update builder settings in local storage.
     */
    public updateSettings() {
        for (const key in this.settings) {
            this.localStorage.set('settings.' + key, this.settings[key]);
        }
    }

    /**
     * Hydrate settings panel models.
     */
    private hydrateModels() {
        this.selectedFramework = this.activeProject.get().model.framework;

        this.settings = {
            hoverBoxEnabled: this.localStorage.get('settings.hoverBoxEnabled', true),
            selectedBoxEnabled: this.localStorage.get('settings.selectedBoxEnabled', true),
            autoSave: this.localStorage.get('settings.autoSave', false),
        };
    }
}
