import {HttpErrorResponse} from '@angular/common/http';
import {Observable, throwError} from 'rxjs';
import {Translations} from '../../translations/translations.service';
import { BackendErrorResponse } from '../../types/backend-error-response';
import {Injectable} from '@angular/core';
import {Toast} from '@common/core/ui/toast.service';

export interface HttpError {
    uri: string;
    messages: {[key: string]: string};
    type: 'http';
    status: number;
    originalError: Error;
}

@Injectable({
    providedIn: 'root'
})
export abstract class HttpErrorHandler {
    protected constructor(
        protected i18n: Translations,
        protected toast: Toast,
    ) {}

    /**
     * Handle http request error.
     */
    public handle(response: HttpErrorResponse, uri?: string, options: {[key: string]: any} = {}): Observable<never> {
        const body = this.parseJson(response.error);
        const error = {
            uri,
            messages: body.messages,
            type: 'http',
            status: response.status,
            originalError: new Error(response.message)
        };
        if (!options.suppressAuthToast && (error.status === 403 || error.status === 401)) {
            this.handle403Error(body);
        }

        if (error.status === 422 && error.messages['*']) {
            this.toast.open(error.messages['*']);
        }

        return throwError(error as HttpError);
    }

    /**
     * Redirect user to login page or show toast informing
     * user that he does not have required permissions.
     */
    protected abstract handle403Error(response: BackendErrorResponse);

    /**
     * Parse JSON without throwing errors.
     */
    protected parseJson(json: string|BackendErrorResponse): BackendErrorResponse {
        let original: BackendErrorResponse;

        if (typeof json !== 'string') {
            original = json;
        } else {
            try {
                original = JSON.parse(json);
            } catch (e) {
                original = this.getEmptyErrorBody() as any;
            }
        }

        if ( ! original || ! original.messages) {
            return this.getEmptyErrorBody();
        }

        Object.keys(original.messages).forEach(key => {
            const message = original.messages[key];
            original.messages[key] = Array.isArray(message) ? message[0] : message;
        });

        return original;
    }

    protected getEmptyErrorBody(): BackendErrorResponse {
        return {status: 'error', messages: {}};
    }
}
