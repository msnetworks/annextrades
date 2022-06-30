import {Component, OnInit, ViewEncapsulation} from '@angular/core';
import {Themes} from "../../../themes.service";
import {LivePreviewLoader} from "../../../live-preview/live-preview-loader.service";
import {InspectorDrawer} from "../../inspector-drawer.service";
import {ActiveProject} from "../../../projects/active-project";
import {Theme} from '../../../../shared/themes/Theme';
import {Settings} from '../../../../../common/core/config/settings.service';
import {Toast} from '../../../../../common/core/ui/toast.service';

@Component({
    selector: 'themes-panel',
    templateUrl: './themes-panel.component.html',
    styleUrls: ['./themes-panel.component.scss'],
    encapsulation: ViewEncapsulation.None
})
export class ThemesPanelComponent implements OnInit {

    public themes: Theme[] = [];

    /**
     * ThemesPanelComponent Constructor.
     */
    constructor(
        private themesApi: Themes,
        public loader: LivePreviewLoader,
        private inspectorDrawer: InspectorDrawer,
        private activeProject: ActiveProject,
        private toast: Toast,
        private settings: Settings,
    ) {}

    ngOnInit() {
        this.themesApi.all().subscribe(response => {
            this.themes = response.themes;
        });
    }

    /**
     * Apply specified theme to the active project.
     */
    public applyTheme(theme?: Theme) {
        this.loader.show();

        this.inspectorDrawer.close();

        this.activeProject.applyTheme(theme).then(() => {
            this.toast.open('Theme applied');
            this.loader.hide();
        });
    }

    /**
     * Get absolute url for specified theme's thumbnail.
     */
    public getThumbnailUrl(theme: Theme) {
        return this.settings.getBaseUrl(true) + '/' + theme.thumbnail;
    }

    /**
     * Check if specified theme is currently active.
     */
    public themeIsActive(theme?: Theme) {
        //check if any theme is active
        if ( ! theme) return this.activeProject.get().model.theme;

        //check if specified theme is active
        return this.activeProject.get().model.theme === theme.name;
    }
}
