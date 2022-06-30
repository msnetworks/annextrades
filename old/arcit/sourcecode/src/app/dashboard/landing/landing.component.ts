import {ChangeDetectionStrategy, ChangeDetectorRef, Component, OnInit} from '@angular/core';
import {ReplaySubject} from 'rxjs';
import {Settings} from '@common/core/config/settings.service';
import {Translations} from '@common/core/translations/translations.service';
import {HomepageContent} from './homepage-content';
import {MetaTagsService} from '@common/core/meta/meta-tags.service';
import {Router} from '@angular/router';
import {DomSanitizer} from '@angular/platform-browser';
import {BuilderTemplate} from '../../shared/builder-types';

@Component({
    selector: 'landing',
    templateUrl: './landing.component.html',
    styleUrls: ['./landing.component.scss'],
    changeDetection: ChangeDetectionStrategy.OnPush,
})
export class LandingComponent implements OnInit {
    public channels$ = new ReplaySubject<BuilderTemplate[]>(1);
    public content: HomepageContent;
    public overlayBackground;

    constructor(
        public settings: Settings,
        private i18n: Translations,
        private metaTags: MetaTagsService,
        private router: Router,
        private cd: ChangeDetectorRef,
        private sanitizer: DomSanitizer,
    ) {}

    ngOnInit() {
        this.settings.all$().subscribe(() => {
            this.content = this.settings.getJson('homepage.appearance');
            this.overlayBackground = this.sanitizer.bypassSecurityTrustStyle(
                `linear-gradient(45deg, ${this.content.headerOverlayColor1} 0%, ${this.content.headerOverlayColor2} 100%)`
            );
            this.cd.markForCheck();
        });
    }

    public scrollToFeatures() {
        document.querySelector('.first-secondary-feature')
            .scrollIntoView({block: 'center', inline: 'center', behavior: 'smooth'});
    }

    public copyrightText() {
        const year = (new Date()).getFullYear();
        return this.i18n.t('Copyright © :year, All Rights Reserved', {year});
    }
}
