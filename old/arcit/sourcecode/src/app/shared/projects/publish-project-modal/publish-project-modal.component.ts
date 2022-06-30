import {Component, Inject, OnInit} from '@angular/core';
import {MAT_DIALOG_DATA, MatDialogRef} from '@angular/material/dialog';
import {MatSlideToggleChange} from '@angular/material/slide-toggle';
import {Settings} from 'common/core/config/settings.service';
import {Toast} from 'common/core/ui/toast.service';
import {Project} from '../Project';
import {Projects} from '../projects.service';
import {ProjectUrl} from '../project-url.service';
import {Subscription} from 'rxjs';
import {removeProtocol} from '@common/core/utils/remove-protocol';

@Component({
    selector: 'publish-project-modal',
    templateUrl: './publish-project-modal.component.html',
    styleUrls: ['./publish-project-modal.component.scss'],
})
export class PublishProjectModalComponent implements OnInit {

    /**
     * Backend errors for last request.
     */
    public errors: FtpDetailsErrors = {};

    /**
     * Details of ftp project should be published to.
     */
    public ftpDetails: FtpDetails;

    /**
     * Whether backend request is currently in progress.
     */
    public loading = false;

    /**
     * Subscription for project state toggle
     * http request, if one is in progress.
     */
    private stateToggleRequest: Subscription;

    constructor(
        private dialogRef: MatDialogRef<PublishProjectModalComponent>,
        @Inject(MAT_DIALOG_DATA) public data: {project: Project},
        private projects: Projects,
        private projectUrl: ProjectUrl,
        public settings: Settings,
        private toast: Toast,
    ) {}

    ngOnInit() {
        this.ftpDetails = this.settings.getJson(
            'publish.default_credentials', {port: 21, ssl: false}
        );
    }

    public confirm() {
        this.loading = true;

        this.projects.publish(this.data.project.id, this.ftpDetails).subscribe(() => {
            this.loading = false;
            this.toast.open('Project published');
            this.close();
        }, response => {
            this.errors = response.messages;
            this.loading = false;
        });
    }

    /**
     * Close the modal.
     */
    public close() {
        this.dialogRef.close(this.data.project);
    }

    public getProjectUrl(noProtocol = false) {
        let url = this.projectUrl.getSiteUrl(this.data.project);
        if (noProtocol) {
            url = removeProtocol(url);
        }
        return url;
    }

    public toggleProjectState(e: MatSlideToggleChange) {
        if (this.stateToggleRequest) {
            this.stateToggleRequest.unsubscribe();
            this.stateToggleRequest = null;
        }

        this.stateToggleRequest = this.projects
            .update(this.data.project.id, {published: e.checked ? 1 : 0}).subscribe(response => {
                this.data.project.published = response.project.model.published;
            });
    }
}

export interface FtpDetailsErrors extends FtpDetails {
    general?: string;
}

export interface FtpDetails {
    host?: string;
    username?: string;
    password?: string;
    directory?: string;
    port?: number;
    ssl?: boolean;
}
