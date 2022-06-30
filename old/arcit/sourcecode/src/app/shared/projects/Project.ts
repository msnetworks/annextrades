import {User} from 'common/core/types/models/User';
import {CustomDomain} from '@common/custom-domain/custom-domain';

export class Project {
    id: number;
    name: string;
    slug: string;
    published = 1;
    public = 0;
    uuid?: string;
    framework = '';
    theme = '';
    template = '';
    users?: User[];
    domain?: CustomDomain;
    created_at?: string;

    constructor(params: Object = {}) {
        for (const name in params) {
            this[name] = params[name];
        }
    }
}
