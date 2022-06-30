import commandParams from './undo-manager-types';

export class UndoCommandsList {

    public static generic(params: commandParams) {
        return {
            undo: params.undo,
            redo: params.redo,
        };
    }

    public static domChanges(params: commandParams) {
        return {
            undo: () => {
                if ( ! params.node || ! params.node.parentElement) return;

                while (params.node.hasChildNodes()) params.node.removeChild(params.node.firstChild);

                const cloned = params.oldNode.cloneNode(true);
                while (cloned.hasChildNodes()) params.node.appendChild(cloned.firstChild);

                // copy inline styles and classes from old node, as parent node will not be replaced
                params.node.style.cssText = params.oldNode.style.cssText;
                params.node.className = params.oldNode.className;
            },
            redo: () => {
                if ( ! params.node || ! params.node.parentElement) return;

                while (params.node.hasChildNodes()) params.node.removeChild(params.node.firstChild);

                const cloned = params.newNode.cloneNode(true);
                while (cloned.hasChildNodes()) params.node.appendChild(cloned.firstChild);

                // copy inline styles and classes from old node, as parent node will not be replaced
                params.node.style.cssText = params.newNode.style.cssText;
                params.node.className = params.newNode.className;
            },
        };
    }
}
