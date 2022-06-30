import {Component, OnInit, ViewChild, ViewEncapsulation} from '@angular/core';
import { MatSort } from '@angular/material/sort';
import {Modal} from 'common/core/ui/dialogs/modal.service';
import {ConfirmModalComponent} from 'common/core/ui/confirm-modal/confirm-modal.component';
import {CurrentUser} from 'common/auth/current-user';
import {CrupdateTemplateModalComponent} from './crupdate-template-modal/crupdate-template-modal.component';
import {BuilderTemplate} from '../../shared/builder-types';
import {Templates} from '../../shared/templates/templates.service';
import {Settings} from 'common/core/config/settings.service';
import {Paginator} from '@common/shared/paginator.service';
import {PaginatedDataTableSource} from '@common/shared/data-table/data/paginated-data-table-source';

@Component({
    selector: 'templates',
    templateUrl: './templates.component.html',
    styleUrls: ['./templates.component.scss'],
    providers: [Paginator],
    encapsulation: ViewEncapsulation.None
})
export class TemplatesComponent implements OnInit {
    @ViewChild(MatSort, {static: true}) matSort: MatSort;

    public dataSource: PaginatedDataTableSource<BuilderTemplate>;

    constructor(
        public paginator: Paginator<BuilderTemplate>,
        private templates: Templates,
        private modal: Modal,
        public currentUser: CurrentUser,
        private settings: Settings,
    ) {}

    ngOnInit() {
        this.dataSource = new PaginatedDataTableSource<BuilderTemplate>({
            uri: 'templates',
            dataPaginator: this.paginator,
            matSort: this.matSort
        });
    }

    /**
     * Ask user to confirm deletion of selected templates
     * and delete selected templates if user confirms.
     */
    public maybeDeleteSelectedTemplates() {
        this.modal.show(ConfirmModalComponent, {
            title: 'Delete Templates',
            body:  'Are you sure you want to delete selected templates?',
            ok:    'Delete'
        }).afterClosed().subscribe(confirmed => {
            if ( ! confirmed) return;
            this.deleteSelectedTemplates();
        });
    }

    /**
     * Delete currently selected templates.
     */
    public deleteSelectedTemplates() {
        const ids = this.dataSource.selectedRows.selected.map(template => template.name);

        this.templates.delete(ids).subscribe(() => {
            this.dataSource.reset();
        });
    }

    /**
     * Show modal for editing template if template is specified
     * or for creating a new template otherwise.
     */
    public showCrupdateTemplateModal(template?: BuilderTemplate) {
        this.modal.show(CrupdateTemplateModalComponent, {template}).afterClosed().subscribe(data => {
            if ( ! data) return;
            this.dataSource.reset();
        });
    }

    /**
     * Get relative url for specified template's thumbnail.
     */
    public getTemplateThumbnail(template: BuilderTemplate) {
        return this.settings.getBaseUrl(true) + template.thumbnail;
    }
}
