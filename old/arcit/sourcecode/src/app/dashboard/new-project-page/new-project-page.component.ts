import {Component, NgZone, OnInit, ViewEncapsulation} from '@angular/core';
import {ActivatedRoute, Router} from '@angular/router';
import {Settings} from 'common/core/config/settings.service';
import {Modal} from 'common/core/ui/dialogs/modal.service';
import {BuilderProject, BuilderTemplate} from '../../shared/builder-types';
import {CrupdateProjectModalComponent} from '../../shared/crupdate-project-modal/crupdate-project-modal.component';
import {FormControl, FormGroup} from '@angular/forms';
import {PaginationResponse} from '@common/core/types/pagination/pagination-response';
import {InfiniteScroll} from '@common/core/ui/infinite-scroll/infinite.scroll';
import {Templates} from '../../shared/templates/templates.service';
import {finalize} from 'rxjs/operators';

interface FilterFormValue {
    search: string;
    category: string;
}

@Component({
    selector: 'new-project-page',
    templateUrl: './new-project-page.component.html',
    styleUrls: ['./new-project-page.component.scss'],
    encapsulation: ViewEncapsulation.None
})
export class NewProjectPageComponent extends InfiniteScroll implements OnInit {
    public allCategories: string[] = [];
    public templatePagination: PaginationResponse<BuilderTemplate>;
    public filteredTemplates: BuilderTemplate[] = [];
    public loading = false;

    public filterForm = new FormGroup({
        search: new FormControl(),
        category: new FormControl(null),
    });

    constructor(
        private route: ActivatedRoute,
        private settings: Settings,
        private modal: Modal,
        private router: Router,
        protected zone: NgZone,
        protected templates: Templates,
    ) {
        super();
    }

    ngOnInit() {
        this.allCategories = this.settings.getJson('builder.template_categories', []);

        this.filterForm.valueChanges.subscribe((value: FilterFormValue) => {
            this.applyFilters(value);
        });

        this.route.data.subscribe(resolve => {
            this.templatePagination = resolve.templates;
            this.filteredTemplates = resolve.templates.data;
        });

        super.ngOnInit();
    }

    public openNewProjectModal(templateName?: string) {
        this.modal.open(CrupdateProjectModalComponent, {templateName})
            .afterClosed().subscribe((project: BuilderProject) => {
                if ( ! project) return;
                this.router.navigate(['/builder', project.model.id]);
            });
    }

    public getTemplateThumbnail(template: BuilderTemplate) {
        return this.settings.getBaseUrl(true) + template.thumbnail;
    }

    public applyFilters(value: FilterFormValue) {
        this.filteredTemplates = this.templatePagination.data.filter(template => {
            const templateName = template.name || template.config.name || '';
            const matchesCategory = !value.category || template.config.category === value.category;
            const matchesSearch = !value.search || templateName.toLowerCase().indexOf(value.search.toLowerCase()) > -1;
            return matchesCategory && matchesSearch;
        });
    }

    protected canLoadMore(): boolean {
        return this.templatePagination.current_page < this.templatePagination.last_page;
    }

    protected isLoading(): boolean {
        return this.loading;
    }

    protected loadMoreItems() {
        this.loading = true;
        this.templates.all({page: this.templatePagination.current_page + 1, per_page: 25})
            .pipe(finalize(() => this.loading = false))
            .subscribe(response => {
                const data = [
                    ...this.templatePagination.data,
                    ...response.pagination.data,
                ];
                this.templatePagination = {...response.pagination, data};
                this.filteredTemplates = data;
            });
    }
}
