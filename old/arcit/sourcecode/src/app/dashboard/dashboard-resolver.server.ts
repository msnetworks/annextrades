import {Injectable} from '@angular/core';
import {ActivatedRouteSnapshot, Resolve, Router, RouterStateSnapshot} from '@angular/router';
import {CurrentUser} from 'common/auth/current-user';
import {Projects} from '../shared/projects/projects.service';
import {forkJoin, Observable} from 'rxjs';
import {CustomDomainService} from '@common/custom-domain/custom-domain.service';
import {catchError, map} from 'rxjs/operators';

@Injectable({
    providedIn: 'root'
})
export class DashboardResolver implements Resolve<any> {

    constructor(
        private router: Router,
        private projects: Projects,
        private currentUser: CurrentUser,
        private domains: CustomDomainService,
    ) {}

    resolve(route: ActivatedRouteSnapshot, state: RouterStateSnapshot): Observable<any> {
        return forkJoin([
            this.projects.all({user_id: this.currentUser.get('id'), per_page: 30}),
            this.domains.index({userId: this.currentUser.get('id'), with: ['resource']}),
        ]).pipe(
            catchError(() => []),
            map(data => {
                return {projects: data[0].pagination.data, domains: data[1].pagination.data};
            })
        );
    }
}
