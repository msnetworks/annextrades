import {Injectable} from '@angular/core';
import {AppHttpClient} from 'common/core/http/app-http-client.service';
import {Observable} from 'rxjs';
import {BuilderTemplate} from '../builder-types';
import {PaginatedBackendResponse} from '@common/core/types/pagination/paginated-backend-response';

@Injectable({
    providedIn: 'root'
})
export class Templates {
    constructor(private http: AppHttpClient) {}

    /**
     * Get all available templates.
     */
    public all(params: object = {}): PaginatedBackendResponse<BuilderTemplate> {
        return this.http.get('templates', params);
    }

    /**
     * Get template by specified id.
     */
    public get(name: string): Observable<{template: BuilderTemplate}> {
        return this.http.get('templates/' + name);
    }

    /**
     * Create a new template.
     */
    public create(params: object): Observable<{template: BuilderTemplate}> {
        return this.http.post('templates', params);
    }

    /**
     * Update specified template.
     */
    public update(name: string, params: object): Observable<{template: BuilderTemplate}> {
        return this.http.put('templates/' + name, params);
    }

    /**
     * Delete specified templates.
     */
    public delete(names: string[]): Observable<any> {
        return this.http.delete('templates', {names});
    }
}
