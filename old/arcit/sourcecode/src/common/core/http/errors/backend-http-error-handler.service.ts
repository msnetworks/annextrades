import {Injectable, NgZone} from '@angular/core';
import {Router} from '@angular/router';
import {HttpErrorHandler} from '@common/core/http/errors/http-error-handler.service';
import {Translations} from '@common/core/translations/translations.service';
import {CurrentUser} from '@common/auth/current-user';
import {Toast, ToastConfig} from '@common/core/ui/toast.service';
import {BackendErrorResponse} from '@common/core/types/backend-error-response';
import {Settings} from '@common/core/config/settings.service';
import {Modal} from '@common/core/ui/dialogs/modal.service';
import {CommonMessages} from '@common/core/ui/common-messages.enum';

interface Backend403Response extends BackendErrorResponse {
    showUpgradeButton: boolean;
}

@Injectable({
    providedIn: 'root'
})
export class BackendHttpErrorHandler extends HttpErrorHandler {
    constructor(
        protected i18n: Translations,
        protected currentUser: CurrentUser,
        protected router: Router,
        protected toast: Toast,
        protected zone: NgZone,
        protected settings: Settings,
        private modal: Modal,
    ) {
        super(i18n, toast);
    }

    /**
     * Redirect user to login page or show toast informing
     * user that he does not have required permissions.
     */
    protected handle403Error(response: Backend403Response) {
        // if user doesn't have access, navigate to login page
        if (this.currentUser.isLoggedIn()) {
            this.showToast(response);
        } else {
            this.router.navigate(['/login']);
        }
    }

    protected showToast(response: Backend403Response) {
        const config: ToastConfig = {};
        if (this.settings.get('billing.enable') && response.showUpgradeButton) {
            config.action = 'Upgrade';
            config.duration = 15000;
        }
        this.toast.open(response.messages.general || CommonMessages.NoPermissions, config)
            .onAction()
            .subscribe(() => {
                this.router.navigateByUrl('/billing/upgrade');
                this.modal.closeAll();
            });
    }
}
