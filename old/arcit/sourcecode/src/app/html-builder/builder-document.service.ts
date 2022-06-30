import {Injectable} from '@angular/core';
import {ReplaySubject, Subject} from 'rxjs';
import {BuilderDocumentActions} from './builder-document-actions.service';
import {Settings} from 'common/core/config/settings.service';
import {ContextBoxes} from './live-preview/context-boxes.service';
import {BuilderTemplate} from '../shared/builder-types';
import {PageDocument} from '../shared/page-document';
import {DomHelpers} from '../shared/dom-helpers.service';
import {randomString} from '@common/core/utils/random-string';

export type changeSources = 'builder' | 'codeEditor' | 'activeProject';

@Injectable({
    providedIn: 'root'
})
export class BuilderDocument {

    private document: Document;

    /**
     * Url for "base" tag of the document.
     */
    protected baseUrl: string;

    /**
     * Fired when preview iframe contents change.
     */
    public contentChanged = new Subject<changeSources>();

    /**
     * Fired when builder document is fully loaded.
     */
    public loaded = new ReplaySubject(1);

    /**
     * Template that should be applied to the document.
     */
    private template: BuilderTemplate;

    /**
     * Framework that should be applied to the document.
     */
    private framework;

    /**
     * BuilderDocument Constructor.
     */
    constructor(
        public actions: BuilderDocumentActions,
        private settings: Settings,
        private contextBoxes: ContextBoxes,
    ) {
        this.actions.setChangedSubject(this.contentChanged);
    }

    public init(document: Document) {
        this.document = document;
        this.loaded.next();
        this.loaded.complete();
    }

    public getInnerHtml(): string {
        return this.document.documentElement.innerHTML;
    }

    public getOuterHtml(): string {
        return this.document.documentElement.outerHTML;
    }

    public get(): Document {
        return this.document;
    }

    public getBody(): HTMLBodyElement {
        return this.document.body as HTMLBodyElement;
    }

    public focus() {
        const body = this.getBody();
        body && body.focus();
    }

    public getScrollTop(): number {
        if ( ! this.document.documentElement) return 0;
        return this.document.documentElement.scrollTop || this.getBody().scrollTop;
    }

    public scrollIntoView(node: HTMLElement) {
        if ( ! node) return;
        node.scrollIntoView({behavior: 'smooth', block: 'center', inline: 'center'});
    }

    public elementFromPoint(x: number, y: number): HTMLElement {
        return this.document.elementFromPoint(x, y) as HTMLElement;
    }

    /**
     * Reload css from specified stylesheet link.
     */
    public reloadCustomElementsCss() {
        const link = this.find('#custom-elements-css');
        const newHref = link.getAttribute('href').split('?')[0] + '?=' + randomString(8);
        link.setAttribute('href', newHref);
    }

    public createElement(tagName: string): HTMLElement {
        return this.document.createElement(tagName);
    }

    public setInnerHtml(html: string) {
        this.document.documentElement.innerHTML = html.trim();
    }

    public on(name: string, callback: Function, useCapture?: boolean) {
        this.document.addEventListener(name as any, callback as any, useCapture);
    }

    public find(selector: string): HTMLElement {
        return this.document.querySelector(selector) as HTMLElement;
    }

    public findAll(selector: string): NodeListOf<HTMLElement> {
        return this.document.querySelectorAll(selector) as NodeListOf<HTMLElement>;
    }

    public execCommand(name: string, value?: string) {
        return this.document.execCommand(name, null, value);
    }

    public queryCommandState(name: string): boolean {
        return this.document.queryCommandState(name);
    }

    public setHtml(html: string, source: changeSources = 'builder') {
        this.update({html, source});
    }

    /**
     * Update builder document using specified markup.
     */
    public update(options: {html: string, template?: BuilderTemplate, framework?: string, theme?: string, source?: changeSources}) {
        options = Object.assign({}, {
            template: this.template,
            framework: this.framework,
            source: 'builderDocument'
        }, options);

        this.template = options.template || this.template;
        this.framework = options.framework || this.framework;

        this.contextBoxes.hideBoxes();
        this.setInnerHtml(this.transformHtml(options.html, this.template, this.framework));
        this.addIframeCss();
        this.contentChanged.next(options.source);

        // TODO: prevent unstyled content flash, use stylesheet "load" event later
        return new Promise(resolve => {
            setTimeout(() => resolve(), 200);
        });
    }

    /**
     * Transform specified html string into production ready document html.
     */
    private transformHtml(html: string, template: BuilderTemplate, framework: string): string {
        const doc = new PageDocument();
        doc.setBaseUrl(this.baseUrl);
        return doc.generate(html, template, framework).getInnerHtml();
    }

    public reload(source: changeSources = 'builder') {
        return this.update({html: this.getInnerHtml(), source});
    }

    public getMetaTagValue(name: string) {
        const node = this.document.querySelector(`meta[name=${name}]`);
        return node && node.getAttribute('content');
    }

    public setMetaTagValue(name: string, value: string) {
        let node = this.document.querySelector(`meta[name=${name}]`);
        if ( ! node) {
            node = this.document.createElement('meta');
            this.document.head.appendChild(node);
        }

        node.setAttribute('name', name);
        node.setAttribute('content', value);
    }

    public getTitleValue() {
        const node = this.document.querySelector('title');
        return node && node.innerText;
    }

    public setTitleValue(value: string) {
        let node = this.document.querySelector('title');
        if ( ! node) {
            node = this.document.createElement('title');
            this.document.head.appendChild(node);
        }

        node.innerText = value;
    }

    /**
     * Set template that is currently applied to project.
     */
    public setTemplate(template: BuilderTemplate) {
        this.template = template;
    }

    /**
     * Set  framework that is currently applied to project.
     */
    public setFramework(framework: string) {
        this.framework = framework;
    }

    /**
     * Add html builder iframe css to the document.
     */
    private addIframeCss() {
        const url = this.settings.getAssetUrl() + 'css/iframe.css';
        const link = DomHelpers.createLink(url, 'preview-css');
        this.document.head.appendChild(link);
    }

    /**
     * Set url for document "base" tag.
     */
    public setBaseUrl(url: string) {
        this.baseUrl = url;
    }
}
