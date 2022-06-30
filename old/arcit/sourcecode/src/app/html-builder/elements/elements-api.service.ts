import {Injectable} from '@angular/core';
import {HttpCacheClient} from 'common/core/http/http-cache-client';

@Injectable({
    providedIn: 'root'
})
export class ElementsApi {

    /**
     * ElementsApi Constructor.
     */
    constructor(private http: HttpCacheClient) {}

    /**
     * Get all custom elements.
     */
    public getCustom() {
        return this.http.getWithCache('elements/custom');
    }
}
