export default interface commandParams {
    node?: HTMLElement;
    oldNode?: HTMLElement;
    newNode?: HTMLElement;
    undoParent?: Node;
    redoParent?: Node;
    undoIndex?: number;
    redoIndex?: number;
    undo?: Function;
    redo?: Function;
}
