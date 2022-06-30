import {UndoCommandsList} from './undo-commands-list';
import commandParams from './undo-manager-types';

export class UndoCommand {
    constructor(private name: string, private params: commandParams) {
        const actions = UndoCommandsList[name](params);
        this.undo = actions.undo.bind(this);
        this.redo = actions.redo.bind(this);
    }

    /**
     * Will be implemented by command list.
     */
    public undo() {}

    /**
     * Will be implemented by command list.
     */
    public redo() {}
}
