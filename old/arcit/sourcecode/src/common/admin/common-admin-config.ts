import {AppConfig} from '@common/core/config/app-config';

export const COMMON_ADMIN_CONFIG: AppConfig = {
    admin: {
        pages: [],
        appearance: {
            navigationRoutes: [],
            menus: {
                availableRoutes: [
                    'login',
                    'register',
                    'contact',
                    'billing/pricing',
                    'account-settings',
                    'admin/appearance',
                    'admin/users',
                    'admin/settings/authentication',
                    'admin/settings/branding',
                    'admin/settings/cache',
                    'admin/settings/providers',
                    'admin/roles',
                ],
                positions: [
                    'admin-navbar',
                    'custom-page-navbar',
                ]
            },
            sections: [
                {name: 'general', position: 1},
                {name: 'themes', position: 2},
                {name: 'menus', position: 3},
                {name: 'custom-code', position: 4},
                {name: 'seo-settings', position: 5}
            ]
        }
    }
};
