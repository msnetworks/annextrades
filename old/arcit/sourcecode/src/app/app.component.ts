import {Component, ElementRef, OnInit, ViewChild, ViewContainerRef, ViewEncapsulation} from '@angular/core';
import {ContextMenu} from 'common/core/ui/context-menu/context-menu.service';
import {Settings} from 'common/core/config/settings.service';
import {AppHttpClient} from 'common/core/http/app-http-client.service';
import {NavigationEnd, Router} from '@angular/router';
import {filter} from 'rxjs/operators';
import {CustomHomepage} from '@common/core/pages/shared/custom-homepage.service';
import {CookieNoticeService} from '@common/gdpr/cookie-notice/cookie-notice.service';
import cssVars from 'css-vars-ponyfill';

@Component({
    selector: 'app-root',
    templateUrl: './app.component.html',
    styleUrls: ['./app.component.scss'],
    encapsulation: ViewEncapsulation.None
})
export class AppComponent implements OnInit {
    @ViewChild('contextMenuViewRef', {read: ViewContainerRef, static: true}) contextMenuViewRef;
    @ViewChild('contextMenuOrigin', {static: true}) contextMenuOrigin: ElementRef;

    constructor(
        private contextMenu: ContextMenu,
        private customHomepage: CustomHomepage,
        private settings: Settings,
        private httpClient: AppHttpClient,
        private router: Router,
        private cookieNotice: CookieNoticeService,
    ) {}

    ngOnInit() {
        this.settings.setHttpClient(this.httpClient);

        // google analytics
        if (this.settings.get('analytics.tracking_code')) {
            this.triggerAnalyticsPageView();
        }

        this.customHomepage.select();
        this.loadCssVariablesPolyfill();
        this.cookieNotice.maybeShow();
    }

    private triggerAnalyticsPageView() {
        this.router.events
            .pipe(filter(e => e instanceof NavigationEnd))
            .subscribe((event: NavigationEnd) => {
                if ( ! window['ga']) return;
                window['ga']('set', 'page', event.urlAfterRedirects);
                window['ga']('send', 'pageview');
            });
    }

    private loadCssVariablesPolyfill() {
        const isNativeSupport = typeof window !== 'undefined' &&
            window['CSS'] &&
            window['CSS'].supports &&
            window['CSS'].supports('(--a: 0)');
        if ( ! isNativeSupport) {
            cssVars();
        }
    }
}
