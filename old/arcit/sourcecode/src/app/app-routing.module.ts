import {NgModule} from '@angular/core';
import {RouterModule, Routes} from '@angular/router';
import {GuestGuard} from 'common/guards/guest-guard.service';
import {ContactComponent} from '@common/contact/contact.component';
import {LandingComponent} from './dashboard/landing/landing.component';
import {AuthGuard} from '@common/guards/auth-guard.service';

const routes: Routes = [
    {path: '', component: LandingComponent, canActivate: [GuestGuard]},
    {path: 'builder', canLoad: [AuthGuard], loadChildren: () => import('app/html-builder/html-builder.module').then(m => m.HtmlBuilderModule)},
    {path: 'admin', loadChildren: () => import('app/admin/app-admin.module').then(m => m.AppAdminModule)},
    {path: 'billing', loadChildren: () => import('common/billing/billing.module').then(m => m.BillingModule)},
    {path: 'notifications', loadChildren: () => import('common/notifications/notifications.module').then(m => m.NotificationsModule)},
    {path: 'contact', component: ContactComponent},
];

@NgModule({
    imports: [RouterModule.forRoot(routes)],
    exports: [RouterModule]
})
export class AppRoutingModule {
}
