import {NgModule} from '@angular/core';
import {RouterModule, Routes} from '@angular/router';
import {DashboardComponent} from './dashboard.component';
import {NewProjectPageComponent} from './new-project-page/new-project-page.component';
import {TemplatesResolver} from './new-project-page/templates-resolver.service';
import {DashboardResolver} from './dashboard-resolver.server';
import {NOT_FOUND_ROUTES} from '@common/core/pages/not-found-routes';
import {AuthGuard} from '@common/guards/auth-guard.service';
import {CheckPermissionsGuard} from '@common/guards/check-permissions-guard.service';

const routes: Routes = [
    {path: 'dashboard', canActivate: [AuthGuard, CheckPermissionsGuard], children: [
        {path: '', component: DashboardComponent, resolve: {api: DashboardResolver}, data: {permissions: ['projects.view']}},
        {path: 'projects', redirectTo: '', pathMatch: 'full'},
        {path: 'projects/new', component: NewProjectPageComponent, resolve: {templates: TemplatesResolver}, data: {permissions: ['projects.create', 'templates.view']}},
    ]},
    ...NOT_FOUND_ROUTES,
];

@NgModule({
    imports: [RouterModule.forRoot(routes)],
    exports: [RouterModule]
})
export class DashboardRoutingModule {
}
