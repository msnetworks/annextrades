import {Injectable} from '@angular/core';
import {Resolve, RouterStateSnapshot, ActivatedRouteSnapshot, Router} from '@angular/router';
import {BuilderTemplate} from '../../shared/builder-types';
import {Templates} from '../../shared/templates/templates.service';
import {catchError, mergeMap} from 'rxjs/operators';
import {EMPTY, Observable, of} from 'rxjs';
import {PaginationResponse} from '@common/core/types/pagination/pagination-response';

@Injectable({
    providedIn: 'root',
})
export class TemplatesResolver implements Resolve<PaginationResponse<BuilderTemplate>> {

    constructor(
        private router: Router,
        private templates: Templates,
    ) {}

    resolve(route: ActivatedRouteSnapshot, state: RouterStateSnapshot): Observable<PaginationResponse<BuilderTemplate>> {
        return this.templates.all({per_page: 25}).pipe(
            catchError(() => {
                this.router.navigate(['/dashboard']);
                return EMPTY;
            }),
            mergeMap(response => {
                if ( ! response) {
                    this.router.navigate(['/dashboard']);
                    return EMPTY;
                } else {
                    return of(response.pagination);
                }
            })
        );
    }
}
