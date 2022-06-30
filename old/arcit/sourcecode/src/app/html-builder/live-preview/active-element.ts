import {BuilderElement} from '../elements/builder-element';

export class ActiveElement {
    public element: BuilderElement;
    public node: HTMLElement;
    public previous: HTMLElement;
    public path: {node: HTMLElement, name: string}[];
    public parent: HTMLElement;
    public locked?: boolean;
    public isImage = false;
}
