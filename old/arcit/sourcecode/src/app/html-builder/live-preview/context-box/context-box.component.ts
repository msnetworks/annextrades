import {Component, ElementRef, HostBinding, Input, ViewEncapsulation} from '@angular/core';
import {ContextBoxes} from '../context-boxes.service';
import {SelectedElement} from '../selected-element.service';
import {BuilderDocumentActions} from '../../builder-document-actions.service';
import {InlineTextEditor} from '../inline-text-editor/inline-text-editor.service';
import {Modal} from 'common/core/ui/dialogs/modal.service';
import {Inspector} from '../../inspector/inspector.service';
import {ActiveProject} from '../../projects/active-project';
import {LivePreview} from '../../live-preview.service';
import {Elements} from '../../elements/elements.service';
import {LinkEditor} from '../link-editor/link-editor.service';
import {UploadQueueService} from '@common/uploads/upload-queue/upload-queue.service';
import {UploadInputTypes} from '@common/uploads/upload-input-config';
import {openUploadWindow} from '@common/uploads/utils/open-upload-window';

@Component({
    selector: 'context-box',
    templateUrl: './context-box.component.html',
    styleUrls: ['./context-box.component.scss'],
    providers: [UploadQueueService],
    encapsulation: ViewEncapsulation.None
})
export class ContextBoxComponent {

    @Input('type') type: 'selected'|'hover';

    @HostBinding('class.selected-box') get c1() {
        return this.type === 'selected';
    }

    @HostBinding('class.hover-box') get c2() {
        return this.type === 'hover';
    }

    constructor(
        public livePreview: LivePreview,
        private builderActions: BuilderDocumentActions,
        private selectedElement: SelectedElement,
        private inspector: Inspector,
        private modal: Modal,
        private activeProject: ActiveProject,
        private contextBoxes: ContextBoxes,
        private inlineTextEditor: InlineTextEditor,
        public el: ElementRef,
        private elements: Elements,
        private linkEditor: LinkEditor,
        private uploadQueue: UploadQueueService,
    ) {}

    /**
     * Get display name of specified node.
     */
    public getDisplayName() {
        const el = this.livePreview[this.type];
        return this.livePreview.getElementDisplayName(el.element, el.node);
    }

    /**
     * Delete node of specified type.
     */
    public deleteNode() {
        this.builderActions.removeNode(this.livePreview[this.type].node);
    }

    /**
     * Edit node of specified type.
     */
    public editNode() {
        const node = this.livePreview[this.type].node;

        if (this.elements.isLayout(node)) {
            this.inspector.openPanel('layout');
        } else if (this.elements.isImage(node)) {
            this.openUploadImageModal();
        } else if (this.elements.isLink(node)) {
            this.linkEditor.open(node as HTMLLinkElement);
        } else if (this.elements.isIcon(node)) {
            this.inlineTextEditor.open(node, {activePanel: 'icons'});
        } else {
            if (this.elements.canModifyText(this.elements.match(node))) {
                this.contextBoxes.hideBoxes();
                this.inlineTextEditor.open(node);
            }
        }
    }

    private openUploadImageModal() {
        const config = {uri: 'uploads/images', httpParams: {diskPrefix: this.activeProject.getBaseUrl(true) + 'images'}};
        openUploadWindow({types: [UploadInputTypes.image]}).then(files => {
            this.uploadQueue.start(files, config).subscribe(response => {
                this.livePreview[this.type].node['src'] = this.activeProject.getImageUrl(response.fileEntry);
            });
        });
    }
}
