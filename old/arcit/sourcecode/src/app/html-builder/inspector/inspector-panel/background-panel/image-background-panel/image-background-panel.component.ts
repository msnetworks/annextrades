import {Component, EventEmitter, OnInit, Output, ViewEncapsulation} from '@angular/core';
import {LivePreview} from '../../../../live-preview.service';
import {ActiveProject} from '../../../../projects/active-project';
import {BuilderDocumentActions} from '../../../../builder-document-actions.service';
import {UploadQueueService} from '@common/uploads/upload-queue/upload-queue.service';
import {UploadInputTypes} from '@common/uploads/upload-input-config';
import {openUploadWindow} from '@common/uploads/utils/open-upload-window';
import {Modal} from '@common/core/ui/dialogs/modal.service';
import {Settings} from '@common/core/config/settings.service';

@Component({
    selector: 'image-background-panel',
    templateUrl: './image-background-panel.component.html',
    styleUrls: ['./image-background-panel.component.scss'],
    providers: [UploadQueueService],
    encapsulation: ViewEncapsulation.None,
})
export class ImageBackgroundPanelComponent implements OnInit {

    /**
     * List for rendering textures panel.
     */
    public textures = new Array(28);

    /**
     * Model for "repeat" radio group.
     */
    public backgroundRepeat = 'no-repeat';

    /**
     * Model for "position" buttons.
     */
    public backgroundPosition = 'top left';

    /**
     * ImageBackgroundPanelComponent Constructor.
     */
    constructor(
        private livePreview: LivePreview,
        private modal: Modal,
        private settings: Settings,
        private activeProject: ActiveProject,
        private builderActions: BuilderDocumentActions,
        private uploadQueue: UploadQueueService,
    ) {}

    /**
     * Fired when gradient is selected.
     */
    @Output() public selected = new EventEmitter();

    /**
     * Fired when close button is clicked.
     */
    @Output() public closed = new EventEmitter();

    /**
     * Emit selected event.
     */
    public emitSelectedEvent(url: string) {
        this.selected.emit(url);
    }

    /**
     * Emit closed event.
     */
    public emitClosedEvent() {
        this.closed.emit();
    }

    ngOnInit() {
        this.backgroundRepeat = this.livePreview.selected.getStyle('backgroundRepeat');
        this.backgroundPosition = this.livePreview.selected.getStyle('backgroundPosition');
    }

    /**
     * Get absolute url for specified texture image.
     */
    public getTextureUrl(index: number): string {
        return this.settings.getAssetUrl() + 'images/textures/' + index + '.png';
    }

    /**
     * Apply specified style to selected element.
     */
    public applyStyle(name: string, value: string) {
        this[name] = value;
        this.builderActions.applyStyle(this.livePreview.selected.node, name, value);
    }

    public uploadImage() {
        const config = {uri: 'uploads/images', httpParams: {diskPrefix: this.activeProject.getBaseUrl(true) + 'images'}};
        openUploadWindow({types: [UploadInputTypes.image]}).then(files => {
            this.uploadQueue.start(files, config).subscribe(response => {
                this.emitSelectedEvent(this.activeProject.getImageUrl(response.fileEntry));
            });
        });
    }
}
