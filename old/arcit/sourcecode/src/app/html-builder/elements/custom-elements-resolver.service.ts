import {Injectable} from '@angular/core';
import {Resolve, RouterStateSnapshot, ActivatedRouteSnapshot} from '@angular/router';
import {ElementsApi} from "./elements-api.service";

@Injectable({
    providedIn: 'root'
})
export class CustomElementsResolver implements Resolve<any[]> {

    constructor(private elementsApi: ElementsApi) {}

    resolve(route: ActivatedRouteSnapshot, state: RouterStateSnapshot): Promise<any[]> {
        return this.elementsApi.getCustom().toPromise() as any;
    }
}

