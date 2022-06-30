import {Component, OnInit, ViewEncapsulation} from '@angular/core';
import {ActiveProject} from "../../../projects/active-project";
import {ConfirmModalComponent} from "common/core/ui/confirm-modal/confirm-modal.component";
import {Toast} from "common/core/ui/toast.service";
import {InspectorDrawer} from "../../inspector-drawer.service";
import {LivePreviewLoader} from "../../../live-preview/live-preview-loader.service";
import {BuilderTemplate} from '../../../../shared/builder-types';
import {Templates} from "../../../../shared/templates/templates.service";
import {Settings} from '../../../../../common/core/config/settings.service';
import {Modal} from '../../../../../common/core/ui/dialogs/modal.service';
import {finalize} from 'rxjs/operators';

@Component({
    selector: 'templates-panel',
    templateUrl: './templates-panel.component.html',
    styleUrls: ['./templates-panel.component.scss'],
    encapsulation: ViewEncapsulation.None,
})
export class TemplatesPanelComponent implements OnInit {

    public templates: BuilderTemplate[] = [];

    /**
     * Whether new template is being applied to project currently.
     */
    public loading =  false;

    /**
     * TemplatesPanelComponent Constructor.
     */
    constructor(
        private templatesApi: Templates,
        private settings: Settings,
        private activeProject: ActiveProject,
        private modal: Modal,
        private toast: Toast,
        private inspectorDrawer: InspectorDrawer,
        private loader: LivePreviewLoader,
    ) {}

    ngOnInit() {
        this.templatesApi.all({per_page: 25}).subscribe(response => {
            this.templates = response.pagination.data;
        });
    }

    public applyTemplate(template: BuilderTemplate) {
        this.modal.open(ConfirmModalComponent, {
            title: 'Apply Template',
            body: 'Are you sure you want to apply this template?',
            bodyBold: 'This will erase all the current contents of your project.',
            ok: 'Apply'
        }).afterClosed().subscribe(result => {
            if ( ! result) return;

            this.loading = true;
            this.loader.show();

            this.inspectorDrawer.close();

            this.activeProject.applyTemplate(template.name)
                .subscribe(() => {
                    this.loading = false;
                    this.loader.hide();
                    this.toast.open('Template applied');
                }, () => {
                    this.loading = false;
                    this.loader.hide();
                });
        });
    }

    /**
     * Get absolute url for specified template's thumbnail.
     */
    public getThumbnailUrl(template: BuilderTemplate) {
        return this.settings.getBaseUrl(true) + template.thumbnail;
    }
}
