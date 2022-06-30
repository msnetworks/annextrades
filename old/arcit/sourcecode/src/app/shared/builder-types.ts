import {Project} from './projects/Project';

export interface BuilderPage {
    name: string;
    html: string;
    description?: string;
    keywords?: string;
    title?: string;
}

export interface BuilderProject {
    model: Project;
    pages: BuilderPage[];
    css: string;
    js: string;
    template: BuilderTemplate;
}

export class BuilderTemplate {
    name: string;
    updated_at: string;
    js: string;
    css: string;
    thumbnail: string;
    pages: BuilderPage[];
    config: {
        libraries: string[],
        name?: string,
        color: string,
        category: string,
        theme: string,
        framework: string,
    };

    constructor(params: Object = {}) {
        for (const name in params) {
            this[name] = params[name];
        }
    }
}

export interface FtpDetails {
    host?: string;
    username?: string;
    password?: string;
    directory?: string;
    port?: number;
    ssl?: boolean;
}
