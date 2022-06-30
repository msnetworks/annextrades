import {BrowserModule} from '@angular/platform-browser';
import {NgModule} from '@angular/core';
import {AppComponent} from './app.component';
import {AppRoutingModule} from './app-routing.module';
import {AuthModule} from 'common/auth/auth.module';
import {AccountSettingsModule} from 'common/account-settings/account-settings.module';
import {SharedModule} from './shared/shared.module';
import {DashboardModule} from './dashboard/dashboard.module';
import {RouterModule} from '@angular/router';
import {ARCHITECT_CONFIG} from './architect-config';
import {BrowserAnimationsModule} from '@angular/platform-browser/animations';
import {PagesModule} from '@common/core/pages/shared/pages.module';
import {APP_CONFIG} from '@common/core/config/app-config';
import {CommonModule} from '@angular/common';
import {HttpClientModule} from '@angular/common/http';
import {CookieNoticeModule} from '@common/gdpr/cookie-notice/cookie-notice.module';
import {CORE_PROVIDERS} from '@common/core/core-providers';
import {MatSnackBarModule} from '@angular/material/snack-bar';
import {MaterialNavbarModule} from '@common/core/ui/material-navbar/material-navbar.module';
import {ContactPageModule} from '@common/contact/contact-page.module';

@NgModule({
    declarations: [
        AppComponent
    ],
    imports: [
        CommonModule,
        BrowserModule,
        BrowserAnimationsModule,
        HttpClientModule,
        RouterModule,
        AuthModule,
        AccountSettingsModule,
        AppRoutingModule,
        PagesModule,
        DashboardModule,
        SharedModule,
        CookieNoticeModule,
        MaterialNavbarModule,
        ContactPageModule,

        // material
        MatSnackBarModule,
    ],
    providers: [
        ...CORE_PROVIDERS,
        {
            provide: APP_CONFIG,
            useValue: ARCHITECT_CONFIG,
            multi: true,
        },
    ],
    bootstrap: [AppComponent]
})
export class AppModule {
}
