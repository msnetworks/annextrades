import {Routes} from '@angular/router';
import {TemplatesComponent} from './templates/templates.component';
import {ProjectsComponent} from './projects/projects.component';
import {BuilderSettingsComponent} from './settings/builder/builder-settings.component';

export const APP_ADMIN_ROUTES: Routes = [
    {
        path: 'templates',
        component: TemplatesComponent,
        data: {permissions: ['templates.view']}
    },
    {
        path: 'projects',
        component: ProjectsComponent,
        data: {permissions: ['projects.view']}
    },
];

export const APP_SETTING_ROUTES: Routes = [
    {
        path: 'builder',
        component: BuilderSettingsComponent,
    },
];
