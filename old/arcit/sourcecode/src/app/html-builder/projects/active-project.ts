import {Injectable} from '@angular/core';
import {BuilderDocument} from '../builder-document.service';
import * as html2canvas from 'html2canvas';
import {Toast} from 'common/core/ui/toast.service';
import {LocalStorage} from 'common/core/services/local-storage.service';
import {ProjectUrl} from '../../shared/projects/project-url.service';
import {Projects} from '../../shared/projects/projects.service';
import {Theme} from '../../shared/themes/Theme';
import {BuilderPage, BuilderProject, BuilderTemplate} from '../../shared/builder-types';
import {PageDocument} from '../../shared/page-document';
import {Templates} from '../../shared/templates/templates.service';
import {Observable, Subject} from 'rxjs';
import {debounceTime, share} from 'rxjs/operators';
import {DomHelpers} from '../../shared/dom-helpers.service';
import {Settings} from '@common/core/config/settings.service';
import {FileEntry} from '@common/uploads/types/file-entry';
import {isAbsoluteUrl} from '@common/core/utils/is-absolute-url';

@Injectable({
    providedIn: 'root'
})
export class ActiveProject {
    private activeTemplate: BuilderTemplate;
    public templateChanged$ = new Subject();

    private pages: BuilderPage[] = [];
    public activePage = 0;

    private project: BuilderProject;
    public saving = false;

    constructor(
        private settings: Settings,
        private builderDocument: BuilderDocument,
        public projectUrl: ProjectUrl,
        private projects: Projects,
        private templates: Templates,
        private toast: Toast,
        private localStorage: LocalStorage,
    ) {
        this.bindToBuilderDocumentChangeEvent();
    }

    /**
     * Get project model.
     */
    public get(): BuilderProject {
        return this.project;
    }

    /**
     * Get all project pages.
     */
    public getPages() {
        return this.pages;
    }

    /**
     * Get active project page.
     */
    public getActivePage(): BuilderPage {
        return this.pages[this.activePage];
    }

    /**
     * Save project to the backend.
     */
    public save(options: {thumbnail?: boolean, params?: object} = {thumbnail: true}): Observable<{project: BuilderProject}> {
        this.saving = true;

        if (options.thumbnail) {
            (html2canvas as any)(this.builderDocument.getBody(), {svgRendering: true, height: 1000, logging: false}).then(canvas => {
                this.projects.generateThumbnail(this.project.model.id, canvas.toDataURL('image/png'))
                    .subscribe(() => {}, () => {});
            });
        }

        if ( ! options.params) options.params = {};

        // update html of active page, so it's synced with the builder
        this.pages[this.activePage].html = DomHelpers.removeBaseUrl(this.builderDocument.getOuterHtml(), this.getBaseUrl());

        const payload = Object.assign({}, options.params, {
            name: this.project.model.name,
            css: this.project.css,
            js: this.project.js,
            theme: this.project.model.theme,
            template: this.project.model.template,
            framework: this.project.model.framework,
            pages: this.pages.map(page => {
                return {name: page.name, html: page.html};
            })
        });

        const request = this.projects.update(this.project.model.id, payload).pipe(share());

        request.subscribe(response => {
            this.project = response.project;
            this.saving = false;
        }, () => {
            this.saving = false;
            this.toast.open('Could not save project');
        });

        return request;
    }

    public addPage(page: BuilderPage): Promise<BuilderPage> {
        this.pages.push(page);
        return this.setActivePage(page)
            .updateBuilderDocument()
            .then(() => page);
    }

    public updatePage(pageName: string, newPage: BuilderPage): ActiveProject {
        const i = this.pages.findIndex(page => page.name === pageName);
        this.pages[i] = newPage;
        return this;
    }

    public setActivePage(page: BuilderPage|string): this {
        const pageName = typeof page === 'string' ? page : page.name,
            index = this.pages.findIndex(curr => curr.name.toLowerCase() === pageName.toLowerCase());

        this.activePage = index > -1 ? index : 0;

        return this;
    }

    public removePage(name: string) {
        const i = this.pages.findIndex(page => page.name === name);
        this.pages.splice(i, 1);
        this.activePage = i - 1;

        this.updateBuilderDocument();
    }

    public setProject(project: BuilderProject) {
        this.project = project;
        this.pages = project.pages;
        this.setActivePage('index');
        this.activeTemplate = project.template;
        this.builderDocument.setTemplate(this.activeTemplate);
        this.builderDocument.setFramework(project.model.framework);
    }

    public applyTemplate(name: string) {
        const sub = new Subject();
        this.project.model.template = name;

        this.templates.get(name).subscribe(response => {
            this.activeTemplate = response.template;
            this.project.model.framework = response.template.config.framework;
            this.pages = response.template.pages.map(page => {
                return {
                    name: page.name,
                    html: (new PageDocument(this.getBaseUrl())).generate(page.html, this.activeTemplate).getOuterHtml(),
                };
            });

            this.setActivePage('index');

            this.save({thumbnail: true}).subscribe(() => {
                this.getActivePage().html = this.activeTemplate.pages[this.activePage].html;
                this.updateBuilderDocument().then(() => {
                    sub.next();
                    sub.complete();
                    this.templateChanged$.next();
                });
            }, errResponse => {
                sub.error(errResponse);
                sub.complete();
            });
        }, errResponse => {
            sub.error(errResponse);
            sub.complete();
        });

        return sub;
    }

    /**
     * Change project's css framework.
     */
    public changeFramework(name: string) {
        this.project.model.framework = name;

        return new Promise(resolve => {
            this.save({thumbnail: false}).subscribe(() => {
                this.updateBuilderDocument().then(() => resolve());
            });
        });
    }

    public applyTheme(theme?: Theme) {
        this.project.model.theme = theme ? theme.name : null;

        return new Promise(resolve => {
            this.save({thumbnail: false}).subscribe(() => {
                this.updateBuilderDocument().then(() => resolve());
            });
        });
    }

    /**
     * Get project's base static files url.
     */
    public getBaseUrl(relative = false): string {
        if ( ! this.project) return '';
        return this.projectUrl.getBaseUrl(this.project.model, relative);
    }

    public getSiteUrl() {
        return this.projectUrl.getSiteUrl(this.project.model);
    }

    public getImageUrl(entry: FileEntry) {
        if (isAbsoluteUrl(entry.url)) {
            return entry.url;
        } else {
            const path = this.getBaseUrl(true) + 'images';
            // project will already have full project path as "base url", only need relative path from "images" folder
            return entry.url.replace(`storage/${path}`, 'images');
        }
    }

    public getContactFormUrl() {
        return `${this.settings.getBaseUrl(true)}${this.project.model.id}/contact`;
    }

    public updateBuilderDocument() {
        return this.builderDocument.update({
            html: this.getActivePage().html,
            template: this.activeTemplate,
            source: 'activeProject',
            framework: this.project.model.framework,
            theme: this.project.model.theme,
        });
    }

    /**
     * Get a template used by current project.
     */
    public getTemplate(): BuilderTemplate {
        return this.activeTemplate;
    }

    /**
     * Check if current project is using a template.
     */
    public hasTemplate(): boolean {
        return this.activeTemplate !== undefined;
    }

    public reset() {
        this.activeTemplate = null;
        this.pages = [];
        this.activePage = 0;
        this.project = null;
        this.saving = false;
    }

    /**
     * Auto save and update project pages on builder document change event.
     */
    private bindToBuilderDocumentChangeEvent() {
        this.builderDocument.contentChanged.pipe(debounceTime(1000)).subscribe(source => {
            if (source === 'activeProject') return;

           if (this.pages[this.activePage]) {
               this.pages[this.activePage].html = this.builderDocument.getOuterHtml();
           }

            if (this.localStorage.get('settings.autoSave')) {
                this.save({thumbnail: false});
            }
        });
    }
}
