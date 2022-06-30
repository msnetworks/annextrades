import {ChangeDetectionStrategy, Component, OnInit} from '@angular/core';
import {ActivatedRoute, Router} from '@angular/router';
import {CurrentUser} from 'common/auth/current-user';
import {Toast} from 'common/core/ui/toast.service';
import {FormControl, FormGroup} from '@angular/forms';
import {Project} from '../shared/projects/Project';
import {Projects} from '../shared/projects/projects.service';
import {ProjectUrl} from '../shared/projects/project-url.service';
import {debounceTime, distinctUntilChanged} from 'rxjs/operators';
import {Settings} from '@common/core/config/settings.service';
import {Modal} from '@common/core/ui/dialogs/modal.service';
import {Paginator} from '@common/shared/paginator.service';
import {CrupdateCustomDomainModalComponent} from '@common/custom-domain/crupdate-custom-domain-modal/crupdate-custom-domain-modal.component';
import {BehaviorSubject} from 'rxjs';
import {CustomDomain} from '@common/custom-domain/custom-domain';
import {PublishProjectModalComponent} from '../shared/projects/publish-project-modal/publish-project-modal.component';
import {ConfirmModalComponent} from '@common/core/ui/confirm-modal/confirm-modal.component';
import {CustomDomainService} from '@common/custom-domain/custom-domain.service';
import {removeProtocol} from '@common/core/utils/remove-protocol';

declare interface ProjectFilters {
    order: string;
    status: string;
    query: string;
}

interface ProjectDomain extends CustomDomain {
    resource: Project;
}

@Component({
    selector: 'dashboard',
    templateUrl: './dashboard.component.html',
    styleUrls: ['./dashboard.component.scss'],
    providers: [Paginator],
    changeDetection: ChangeDetectionStrategy.OnPush,
})
export class DashboardComponent implements OnInit {
    public loading$ = new BehaviorSubject<boolean>(false);
    public projects$ = new BehaviorSubject<Project[]>([]);
    public domains$ = new BehaviorSubject<ProjectDomain[]>([]);

    public models = new FormGroup({
        query:  new FormControl(''),
        order: new FormControl('created_at|desc'),
        published: new FormControl('all')
    });

    constructor(
        private route: ActivatedRoute,
        private router: Router,
        public settings: Settings,
        public currentUser: CurrentUser,
        private projectsApi: Projects,
        private toast: Toast,
        private modal: Modal,
        private projectUrl: ProjectUrl,
        private paginator: Paginator<Project>,
        private customDomains: CustomDomainService,
    ) {}

    ngOnInit() {
        this.route.data.subscribe(data => {
            this.projects$.next(data.api.projects);
            this.domains$.next(data.api.domains);
        });
        this.bindToProjectFilters();
    }

    public openBuilder(project: Project) {
        this.loading$.next(true);
        this.router.navigate(['/builder', project.id]).then(() => {
            this.loading$.next(true);
        });
    }

    public getProjectImage(project: Project) {
        return this.projectUrl.getBaseUrl(project) + 'thumbnail.png';
    }

    public getProjectUrl(project: Project, removeProto = false) {
        let url = this.projectUrl.getSiteUrl(project);
        if (removeProto) {
            url = removeProtocol(url);
        }
        return url;
    }

    public openPublishProjectModal(project: Project) {
        this.modal.open(PublishProjectModalComponent, {project})
            .afterClosed()
            .subscribe(newProject => {
                if ( ! newProject || ! newProject.model) return;
                const newProjects = [...this.projects$.value];
                const i = newProjects.findIndex(curr => curr.id === newProject.model.id);
                newProjects[i] = newProject.model;
                this.projects$.next(newProjects);
            });
    }

    public deleteProjectWithConfirmation(project: Project) {
        this.modal.open(ConfirmModalComponent, {
            title: 'Delete Project',
            body: 'Are you sure you want to delete this project?',
            ok: 'Delete',
        }).afterClosed().subscribe(confirmed => {
            if ( ! confirmed) return;

            this.projectsApi.delete({ids: [project.id]}).subscribe(() => {
                this.toast.open('Project deleted');
                const newProjects = [...this.projects$.value];
                newProjects.splice(newProjects.indexOf(project), 1);
                this.projects$.next(newProjects);
            });
        });
    }

    public openConnectDomainModal() {
        this.modal.open(CrupdateCustomDomainModalComponent, {resourceName: 'projects'})
            .afterClosed()
            .subscribe(newDomain => {
                if (newDomain) {
                    this.domains$.next([...this.domains$.value, newDomain]);
                }
            });
    }

    public attachDomainToProject(project: Project, domain: ProjectDomain) {
        this.customDomains.update(domain.id, {resource_id: project.id, resource_type: 'App\\Project'})
            .subscribe(() => {
                const domains = [...this.domains$.value];
                const i = domains.findIndex(d => d.id === domain.id);
                domains[i].resource = project;
                this.domains$.next(domains);
                this.toast.open('Domain attached.');
            });
    }

    public maybeRemoveDomain(domain: ProjectDomain) {
        this.modal.show(ConfirmModalComponent, {
            title: 'Remove Domain',
            body:  'Are you sure you want to permanently remove this domain from your account?',
            ok:    'Remove'
        }).afterClosed().subscribe(confirmed => {
            if ( ! confirmed) return;
            this.removeDomain(domain);
        });
    }

    private removeDomain(domain: ProjectDomain) {
        this.customDomains.delete([domain.id]).subscribe(() => {
            const newDomains = this.domains$.value.filter(d => d.id !== domain.id);
            this.domains$.next(newDomains);
            this.toast.open('Domain removed.');
        });
    }

    private bindToProjectFilters() {
        this.paginator.dontUpdateQueryParams = true;
        this.paginator.pagination$
            .subscribe(response => {
                this.loading$.next(false);
                this.projects$.next(response.data);
            }, () => this.loading$.next(false));
        this.models.valueChanges.pipe(debounceTime(250), distinctUntilChanged())
            .subscribe((params: ProjectFilters) => {
                this.loading$.next(true);
                const merged = {...params, user_id: this.currentUser.get('id'), per_page: 20};
                this.paginator.paginate(merged, 'projects');
            });
    }
}
