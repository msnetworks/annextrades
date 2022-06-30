import {Injectable} from '@angular/core';
import {Resolve, RouterStateSnapshot, ActivatedRouteSnapshot, Router} from '@angular/router';
import {Projects} from '../shared/projects/projects.service';
import {BuilderProject} from '../shared/builder-types';
import {CurrentUser} from 'common/auth/current-user';
import {catchError} from 'rxjs/operators';
import {EMPTY, Observable, of} from 'rxjs';
import {mergeMap} from 'rxjs/internal/operators/mergeMap';

@Injectable({
    providedIn: 'root'
})
export class ProjectResolver implements Resolve<Observable<BuilderProject>> {

    constructor(
        private router: Router,
        private projects: Projects,
        private currentUser: CurrentUser,
    ) {}

    resolve(route: ActivatedRouteSnapshot, state: RouterStateSnapshot): Observable<BuilderProject> {
        return this.projects.get(+route.params.id).pipe(
            catchError(() => {
                this.router.navigate(['/dashboard']);
                return EMPTY;
            }),
            mergeMap(response => {
                if ( ! this.userCanOpenProjectInBuilder(response.project) || ! response.project) {
                    this.router.navigate(['/dashboard']);
                    return EMPTY;
                } else {
                    return of(response.project);
                }
            })
        );
    }

    private userCanOpenProjectInBuilder(project: BuilderProject): boolean {
        const isOwner = project.model.users.find(user => user.id === this.currentUser.get('id')) !== undefined;
        return this.currentUser.hasPermission('projects.update') || isOwner;
    }
}
