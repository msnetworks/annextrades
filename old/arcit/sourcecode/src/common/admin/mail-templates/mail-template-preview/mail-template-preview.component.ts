import {AfterViewInit, ChangeDetectionStrategy, Component, ElementRef, ViewChild} from '@angular/core';
import {BehaviorSubject, Observable, Subscription} from 'rxjs';
import {AppHttpClient} from '@common/core/http/app-http-client.service';
import {MailTemplate} from '@common/core/types/models/MailTemplate';
import {ThemeService} from '@common/core/theme.service';

@Component({
    selector: 'mail-template-preview',
    templateUrl: './mail-template-preview.component.html',
    styleUrls: ['./mail-template-preview.component.scss'],
    changeDetection: ChangeDetectionStrategy.OnPush,
})
export class MailTemplatePreviewComponent implements AfterViewInit {
    @ViewChild('iframe', { static: true }) private iframe: ElementRef<HTMLIFrameElement>;

    private doc: Document;
    private renderSub: Subscription;
    public loading$ = new BehaviorSubject<boolean>(false);
    private cache = {};

    constructor(
        private http: AppHttpClient,
        private theme: ThemeService,
    ) {}

    ngAfterViewInit() {
        this.initIframe();
    }

    public update(template: {model: MailTemplate, html: string, plain: string}, type: 'html'|'plain') {
        const contents = template[type];

        // check cache first
        if (this.cache[contents]) {
            return this.replaceIframeContents(this.cache[contents], type);
        }

        this.loading$.next(true);

        this.renderSub = this.renderMailTemplate(template.model.file_name, type, contents).subscribe(response => {
            this.replaceIframeContents(response.contents, type);
            this.cacheRenderedTemplate(contents, response.contents);
        }, () => this.replaceIframeContents(''));
    }

    private renderMailTemplate(fileName: string, type: string, contents: string): Observable<{contents: string}> {
        // cancel previous render http call, if it's still in progress
        if (this.renderSub) this.renderSub.unsubscribe();
        return this.http.post('mail-templates/render', {contents, type, file_name: fileName});
    }

    private cacheRenderedTemplate(raw: string, rendered: string) {
        const keys = Object.keys(this.cache);

        // cache a maximum of 10 rendered templates
        if (keys.length > 10) {
            delete this.cache[keys[0]];
        }

        this.cache[raw] = rendered;
    }

    private replaceIframeContents(newContents: string, type: 'html'|'plain' = 'html') {
        this.iframe.nativeElement.style.height = 'auto';
        this.doc.documentElement.innerHTML = newContents.replace(/<!DOCTYPE((.|\n|\r)*?)">/, '').trim();

        // set iframe height to its contents height
        this.iframe.nativeElement.style.height = this.doc.body.scrollHeight + 'px';
        this.doc.body.style.whiteSpace = type === 'html' ? 'initial' : 'pre';
        this.doc.body.style.color = this.theme.selectedTheme$.value && this.theme.selectedTheme$.value.is_dark ? '#fff' : '#000';
        this.loading$.next(false);
    }

    private initIframe() {
        this.doc = this.iframe.nativeElement.contentDocument;
        this.doc.body.style.overflow = 'hidden';
    }
}
