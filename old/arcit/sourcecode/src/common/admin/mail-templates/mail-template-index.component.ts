import {ChangeDetectionStrategy, Component, ElementRef, OnInit, ViewChild} from '@angular/core';
import {BehaviorSubject, Subject} from 'rxjs';
import {MailTemplatePreviewComponent} from './mail-template-preview/mail-template-preview.component';
import {ActivatedRoute} from '@angular/router';
import {debounceTime, finalize} from 'rxjs/operators';
import {MailTemplate} from '../../core/types/models/MailTemplate';
import {Toast} from '../../core/ui/toast.service';
import {LazyLoaderService} from '../../core/utils/lazy-loader.service';
import {AppHttpClient} from '../../core/http/app-http-client.service';
import {CurrentUser} from '../../auth/current-user';
import {BreakpointsService} from '@common/core/ui/breakpoints.service';

declare let ace;

@Component({
    selector: 'mail-template-index',
    templateUrl: './mail-template-index.component.html',
    styleUrls: ['./mail-template-index.component.scss'],
    changeDetection: ChangeDetectionStrategy.OnPush,
})
export class MailTemplateIndexComponent implements OnInit {
    @ViewChild('editor') editorEl: ElementRef;
    @ViewChild(MailTemplatePreviewComponent) preview: MailTemplatePreviewComponent;

    private editor: any;
    public templates: {model: MailTemplate, html: string, plain: string}[] = [];
    public selectedTemplate = {model: new MailTemplate, html: '', plain: ''};
    public selectedLayout$ = new BehaviorSubject<'column'|'row'>('row');
    public selectedType: 'html'|'plain' = 'html';
    public errors$ = new BehaviorSubject<{subject?: string, contents?: string}>({});
    private editorChange = new Subject();
    public loading$ = new BehaviorSubject<boolean>(false);

    constructor(
        private http: AppHttpClient,
        private toast: Toast,
        private route: ActivatedRoute,
        public currentUser: CurrentUser,
        private lazyLoader: LazyLoaderService,
        private breakpoints: BreakpointsService,
    ) {}

    ngOnInit() {
        this.bindToEditorChange();

        this.breakpoints.isMobile$.subscribe(result => {
            this.setLayout(result ? 'column' : 'row');
        });

        this.route.data.subscribe(data => {
            if (data.templates.length) {
                this.templates = data.templates;
                this.selectedTemplate = this.templates[0];
            }

            this.initEditor().then(() => {
                this.setEditorValue();
            });
        });
    }

    public toggleTemplateType() {
        this.selectedType = this.selectedType === 'html' ? 'plain' : 'html';
        this.setEditorValue();
    }

    public setLayout(name: 'column'|'row') {
        this.selectedLayout$.next(name);
    }

    public isTypeActive(name: string) {
        return this.selectedType === name;
    }

    public restoreDefault() {
        this.loading$.next(true);
        const id = this.selectedTemplate.model.id;
        this.http.post('mail-templates/' + id + '/restore-default')
            .pipe(finalize(() => this.loading$.next(false)))
            .subscribe((template: any) => {
                this.selectedTemplate.html = template.html;
                this.selectedTemplate.plain = template.plain;
                this.setEditorValue();
                this.toast.open('Template default content restored');
            });
    }

    public updateSelectedTemplate() {
        this.loading$.next(true);
        const payload = {
            subject: this.selectedTemplate.model.subject,
            contents: {
                html: this.selectedTemplate.html,
                plain: this.selectedTemplate.plain,
            }
        };
        this.http.put('mail-templates/' + this.selectedTemplate.model.id, payload)
            .pipe(finalize(() => this.loading$.next(false)))
            .subscribe(() => {
                this.errors$.next({});
                this.toast.open('Mail template updated');
            }, errors => this.errors$.next(errors.messages));
    }


    public setEditorValue() {
        const text = this.selectedType === 'html'
            ? this.selectedTemplate.html
            : this.selectedTemplate.plain;

        if (this.editor) {
            this.editor.setValue(text, -1);
        }
    }

    private initEditor(language = 'html') {
        return this.lazyLoader.loadAsset('js/ace/ace.js', {type: 'js'}).then(() => {
            this.editor = ace.edit(this.editorEl.nativeElement);
            this.editor.getSession().setMode('ace/mode/' + language);
            this.editor.setTheme('ace/theme/chrome');
            this.editor.$blockScrolling = Infinity;

            // fire editor change observable, on editor content change
            this.editor.getSession().on('change', () => {
                this.editorChange.next(this.editor.getValue());
            });
        });
    }

    private bindToEditorChange() {
        this.editorChange
            .pipe(debounceTime(500))
            .subscribe(() => {
                this.selectedTemplate[this.selectedType] = this.editor.getValue();
                this.preview.update(this.selectedTemplate, this.selectedType);
            });
    }
}
