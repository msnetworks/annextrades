import {Injectable} from '@angular/core';
import {Settings} from 'common/core/config/settings.service';
import {CurrentUser} from 'common/auth/current-user';
import {Project} from './Project';
import {slugifyString} from '@common/core/utils/slugify-string';

@Injectable({
    providedIn: 'root',
})
export class ProjectUrl {
    constructor(private settings: Settings, private currentUser: CurrentUser) {}

    /**
     * Get specified project's base url for the builder.
     */
    public getBaseUrl(project: Project, relative: boolean = false): string {
        const uri = 'projects/' + this.getProjectUserId(project) + '/' + project.uuid + '/';

        // if (relative) return uri;
        if (relative) return uri;

        return this.settings.getBaseUrl() + 'storage/' + uri;
    }

    /**
     * Get ID of specified project's creator.
     */
    private getProjectUserId(project: Project): number|string {
        if ( ! project.users || ! project.users.length) {
            return this.currentUser.get('id');
        }

        return project.users[0].id;
    }

    /**
     * Get production site url for specified project.
     */
    public getSiteUrl(project: Project): string {
        const base = this.settings.getBaseUrl(true);
        const projectName = slugifyString(project.name);
        let url;

        if (project.domain) {
            return project.domain.host;
        } else if (this.settings.get('builder.enable_subdomains')) {
            // strip pathname from url if generating subdomain
            const parsed = new URL(base);
            url = `${parsed.protocol}//${projectName}.${parsed.host}`;
        } else {
            url = base + 'sites/' + projectName;
        }

        return url.replace(/\/$/, '');
    }
}
