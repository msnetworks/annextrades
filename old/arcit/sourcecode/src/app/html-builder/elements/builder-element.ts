export interface BuilderElement {
    name: string;
    frameworks: string[];
    nodes: string[];
    html: string;
    css: string;
    types: string[];
    validChildren: string[];
    category: string;
    icon: string;
    class?: string;
    hiddenClasses?: string[];
    canModify: string[];
    canDrag: boolean;
    showWysiwyg: boolean;
    attributes: object;
    config: string;
    previewScale?: number;
    scaleDragPreview?: boolean;
    resizable?: boolean;
}
