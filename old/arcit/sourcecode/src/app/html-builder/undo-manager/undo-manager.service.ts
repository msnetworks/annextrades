import {EventEmitter, Injectable} from '@angular/core';
import {UndoCommand} from "./undo-command";
import commandParams from "./undo-manager-types";

@Injectable({
    providedIn: 'root'
})
export class UndoManager {

    /**
     * Stack of undo/redo commands.
     */
    private commands: UndoCommand[] = [];

    /**
     * Current position of pointer in undo/redo stack.
     */
    private pointer = -1;

    public executedCommand = new EventEmitter();

    /**
     * Whether or not there's any undos left in the stack.
     */
    public canUndo() {
        return this.pointer !== -1;
    }

    /**
     * Whether or not there's any redos left in the stack.
     *
     * @return {Boolean}
     */
    public canRedo() {
        return this.pointer < (this.commands.length - 1);
    }

    /**
     * Execute undo function of command at current pointers position in stack.
     */
    public undo() {
        const command = this.commands[this.pointer];

        if (command) {
            command.undo();
            this.pointer -= 1;
            this.executedCommand.emit('undo');
        }
    }

    /**
     * Execute redo function of command at current pointers position in stack.
     */
    public redo() {
        const command = this.commands[this.pointer + 1];

        if (command) {
            command.redo();
            this.pointer += 1;
            this.executedCommand.emit('redo');
        }
    }

    /**
     * Add a new undo/redo command to the stack.
     */
    public add(name: string, params: commandParams) {
        // limit number of commands to 100
        if (this.commands.length > 100) {
            this.commands.splice(this.commands.length - 1, 1);
        }

        // make a new command
        const command = new UndoCommand(name, params);

        // push it onto the stack
        this.commands.push(command);

        // update pointer position
        this.pointer = this.commands.length - 1;

        return command;
    }

    /**
     * Wrap specified changes to dom in undo command.
     */
    public wrapDomChanges(parent: HTMLElement, callback: Function|null, options: {before?: HTMLElement, after?: HTMLElement} = {}) {
        if ( ! parent) return;

        const before = options.before || parent.cloneNode(true);

        callback && callback();

        const after = options.after || parent.cloneNode(true);

        this.add('domChanges', {
            oldNode: (before as HTMLElement),
            newNode: (after as HTMLElement),
            node: (parent as HTMLElement),
        });
    }
}
