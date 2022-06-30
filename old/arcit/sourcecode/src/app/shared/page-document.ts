import {DomHelpers} from './dom-helpers.service';
import {BuilderTemplate} from './builder-types';
import {randomString} from '@common/core/utils/random-string';
import {ucFirst} from '@common/core/utils/uc-first';

export class PageDocument {
    protected pageDocument: Document;
    protected baseUrl: string;
    protected tempBaseUrl: string;

    constructor(baseUrl: string = null) {
        this.baseUrl = baseUrl;
        this.tempBaseUrl = `https://${randomString()}.com`;
    }

    /**
     * Ids of dom elements that are created by the builder and are not part of the project.
     */
    protected internalIds = [
        '#base', '#jquery', '#custom-css', '#custom-js', '#template-js', '[id^=library]', '#theme-css',
        '#template-css', '#framework-css', '#framework-js', '#preview-css', '#font-awesome', '#custom-elements-css'
    ];

    public getOuterHtml(): string {
        return this.replaceTempBaseUrl('<!DOCTYPE html>' + this.pageDocument.documentElement.outerHTML, '/');
    }

    public getInnerHtml(): string {
        return this.replaceTempBaseUrl(this.pageDocument.documentElement.innerHTML);
    }

    public setBaseUrl(url: string): PageDocument {
        this.baseUrl = url;
        return this;
    }

    /**
     * Generate page document from specified markup.
     */
    public generate(html: string = '', template?: BuilderTemplate, framework?: string, baseUrl?: string): PageDocument {
        this.pageDocument = new DOMParser().parseFromString(this.trim(html), 'text/html');

        // remove old link/script nodes to frameworks, icons, templates etc.
        this.internalIds.forEach(id => {
            const els = this.pageDocument.querySelectorAll(id);
            for (let i = 0; i < els.length; i++) {
                els[i].parentElement.removeChild(els[i]);
            }
        });

        this.addBaseElement(baseUrl);
        this.useFramework(framework || (template && template.config.framework));
        this.addIconsLink();

        // theme
        this.createLink('link', 'css/theme.css', 'theme-css');

        // custom elements css
        this.createLink('link', 'css/custom_elements.css', 'custom-elements-css');

        if (template) {
            this.addTemplate(template);
        }

        this.createLink('link', 'css/styles.css', 'custom-css');
        this.createLink('script', 'js/scripts.js', 'custom-js');

        return this;
    }

    /**
     * Add specified template to page.
     */
    private addTemplate(template: BuilderTemplate) {
        // legacy libraries
        if (template.config.libraries) {
            template.config.libraries.forEach(library => {
                this.createLink('script', `js/${library}.js`, `library-${library}`);
            });
        }

        this.createLink('link', 'css/template.css', 'template-css');
        this.createLink('script', 'js/template.js', 'template-js');
    }

    /**
     * Add base html element to document.
     */
    protected addBaseElement(baseUrl?: string) {
        const base = this.pageDocument.createElement('base') as HTMLBaseElement;
        base.id = 'base';
        base.href = baseUrl || this.tempBaseUrl;
        this.pageDocument.head.insertBefore(base, this.pageDocument.head.firstChild);
    }

    /**
     * Add needed links and scripts of specified css framework to document.
     */
    protected useFramework(name: string) {
        if ( ! name || name === 'none') return;
        this.createLink('link', 'css/framework.css', 'framework-css');
        this.createLink('script', 'js/jquery.min.js', 'jquery');
        this.createLink('script', 'js/framework.js', 'framework-js');
    }

    /**
     * Create a stylesheet or scripts link from specified uri.
     */
    private createLink(type: 'link'|'script', uri: string, id: string) {
        const query  = randomString(8),
            parent = type === 'link' ? this.pageDocument.head : this.pageDocument.body;

        type = ucFirst(type);
        const link = DomHelpers['create' + type]((this.baseUrl || '') + uri + '?=' + query, id);

        parent.appendChild(link);
    }

    /**
     * Add font awesome icons link to the document.
     */
    protected addIconsLink() {
        this.createLink('link', 'css/font-awesome.css', 'font-awesome');
    }

    protected replaceTempBaseUrl(html: string, replacement?: string) {
        // Use invalid base url to prevent execution of template js,
        // and modification of original template html via js, for example,
        // loader elements might be set to "display: none" via js
        // which will modify original template html and cause issues in the project
        return html.replace(this.tempBaseUrl, replacement || this.baseUrl);
    }

    /**
     * Trim whitespace from specified markup string.
     */
    protected trim(string: string) {
        return (string || '').trim();
    }
}
