import {Directive, ElementRef, EventEmitter, Input, NgZone, Output} from '@angular/core';
import { InfiniteScroll } from 'common/core/ui/infinite-scroll/infinite.scroll';
import {BuilderTemplate} from '../../shared/builder-types';
import {Templates} from '../../shared/templates/templates.service';
import {PaginationResponse} from '@common/core/types/pagination/pagination-response';

@Directive({
    selector: '[templatesInfiniteScroll]'
})
export class TemplatesInfiniteScrollDirective extends InfiniteScroll {
    @Input() templatePagination: PaginationResponse<BuilderTemplate>;
    @Output() loadedTemplates = new EventEmitter();
    private loading = false;

    constructor(
        protected el: ElementRef,
        protected templates: Templates,
        protected zone: NgZone,
    ) {
        super();
    }

    protected loadMoreItems() {
        this.templates.all({page: this.templatePagination.current_page + 1, per_page: 25})
            .subscribe(response => {
                this.templatePagination = response.pagination;
                this.loadedTemplates.emit(response);
            });
    }

    protected isLoading(): boolean {
        return this.loading;
    }

    protected canLoadMore(): boolean {
        return this.templatePagination.current_page < this.templatePagination.last_page;
    }
}
