import {Injectable} from '@angular/core';
import {HttpCacheClient} from 'common/core/http/http-cache-client';
import {Theme} from '../shared/themes/Theme';
import {Observable} from 'rxjs';

@Injectable({
    providedIn: 'root'
})
export class Themes {

    /**
     * Themes API service constructor.
     */
    constructor(private http: HttpCacheClient) {}

    /**
     * Get all available themes.
     */
    public all(): Observable<{themes: Theme[]}> {
        return this.http.get('themes');
    }
}
