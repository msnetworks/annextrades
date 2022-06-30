import {Component, OnInit, ViewEncapsulation} from '@angular/core';
import {ActiveProject} from '../../projects/active-project';
import {Toast} from 'common/core/ui/toast.service';
import {BuilderDocument} from '../../builder-document.service';
import {Projects} from '../../../shared/projects/projects.service';
import {BuilderPage} from '../../../shared/builder-types';
import {PageDocument} from '../../../shared/page-document';

@Component({
    selector: 'pages-panel',
    templateUrl: './pages-panel.component.html',
    styleUrls: ['./pages-panel.component.scss'],
    encapsulation: ViewEncapsulation.None
})
export class PagesPanelComponent implements OnInit {
    public loading = false;
    public selectedPage: BuilderPage;

    public updateModel: {
        name: string,
        title?: string,
        description?: string,
        keywords?: string,
    } = {name: null};

    public errors: {name?: string, title?: string, keywords?: string, description?: string} = {};

    constructor(
        public activeProject: ActiveProject,
        private projects: Projects,
        private toast: Toast,
        private builderDocument: BuilderDocument,
    ) {}

    ngOnInit() {
        this.selectedPage = this.activeProject.getActivePage();
        this.builderDocument.loaded.subscribe(() => {
            this.hydrateUpdateModel();
        });

        this.activeProject.templateChanged$.subscribe(() => {
            this.selectedPage = this.activeProject.getActivePage();
            this.hydrateUpdateModel();
        });
    }

    public createNewPage() {
        this.loading = true;

        let name = 'Page ' + (this.activeProject.getPages().length + 1);

        // make sure we don't duplicate page names
        if (this.activeProject.getPages().find(page => page.name === name)) {
            name += ' Copy';
        }

        const html = new PageDocument()
            .setBaseUrl(this.activeProject.getBaseUrl())
            .generate('', null, this.activeProject.get().model.framework)
            .getOuterHtml();

        this.activeProject.addPage({name: name, html: html})
            .then(page => {
                this.selectedPage = page;
                this.hydrateUpdateModel();
                this.activeProject.save().subscribe(() => {
                    this.loading = false;
                    this.toast.open('Page created');
                });
            });
    }

    public canDeleteSelectedPage() {
        return this.selectedPage && this.selectedPage.name.toLowerCase() !== 'index' && this.activeProject.getPages().length > 1;
    }

    public onPageSelected() {
        this.activeProject
            .setActivePage(this.selectedPage)
            .updateBuilderDocument()
            .then(() => {
                this.hydrateUpdateModel();
            });
    }

    public updateSelectedPage() {
        this.loading = true;

        this.builderDocument.setMetaTagValue('keywords', this.updateModel.keywords);
        this.builderDocument.setTitleValue(this.updateModel.title);
        this.builderDocument.setMetaTagValue('description', this.updateModel.description);
        this.builderDocument.contentChanged.next('builder');

        const newPage = {...this.updateModel, html: this.builderDocument.getOuterHtml()};

        this.activeProject.updatePage(this.selectedPage.name, newPage)
            .save({thumbnail: false})
            .subscribe(() => {
                this.selectedPage = newPage;
                this.loading = false;
                this.toast.open('Page updated');
            });
    }

    public deleteSelectedPage() {
        this.loading = true;

        this.activeProject.removePage(this.selectedPage.name);
        this.selectedPage = this.activeProject.getActivePage();
        this.hydrateUpdateModel();

        this.activeProject.save({thumbnail: false}).subscribe(() => {
            this.loading = false;
            this.toast.open('Page deleted');
        });
    }

    public duplicateSelectedPage() {
        this.loading = true;

        this.activeProject.addPage({
            name: this.selectedPage.name + ' Copy',
            html: this.selectedPage.html,
        });

        this.selectedPage = this.activeProject.getActivePage();
        this.hydrateUpdateModel();

        this.activeProject.save({thumbnail: false}).subscribe(() => {
            this.loading = false;
            this.toast.open('Page duplicated');
        });
    }

    private hydrateUpdateModel() {
        this.updateModel = {
            name: this.selectedPage.name,
            title: this.builderDocument.getTitleValue(),
            description: this.builderDocument.getMetaTagValue('description'),
            keywords: this.builderDocument.getMetaTagValue('keywords'),
        };
    }
}
