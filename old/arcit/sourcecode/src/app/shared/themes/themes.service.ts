import {Injectable} from '@angular/core';
import {Observable} from 'rxjs';
import {HttpCacheClient} from 'common/core/http/http-cache-client';
import {Theme} from './Theme';

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
