import {BuilderDocument} from "../../builder-document.service";

export class LivePreviewScroller {

    private scrollDownTimeout;
    private scrollUpTimeout;
    private previewHeight: number;

    /**
     * LivePreviewScroller Constructor.
     */
    constructor(
        private builderDocument: BuilderDocument,
        private previewContainer: HTMLElement
    ) {}

    /**
     * Scroll iframe body when given y is above or below it.
     */
    public scroll(y: number) {
        let scrollTop = this.builderDocument.getScrollTop(),
            pointY = y + this.builderDocument.getScrollTop();

        if ( ! this.previewHeight) {
            this.previewHeight = this.previewContainer.offsetHeight;
        }

        if (pointY - scrollTop <= 80) {
            this.scrollFrameUp()
        } else if (pointY > scrollTop + this.previewHeight - 80) {
            this.scrollFrameDown();
        } else {
            this.stopScrolling();
        }
    }

    /**
     * Clear all scrolling intervals.
     */
    public stopScrolling() {
        clearInterval(this.scrollDownTimeout);
        return clearInterval(this.scrollUpTimeout);
    }

    /**
     * Scroll iframe down by 40 pixels.
     */
    private scrollFrameDown() {
        clearInterval(this.scrollDownTimeout);
        return this.scrollDownTimeout = setInterval(() => {
            return this.setScrollTop(this.builderDocument.getScrollTop() + 40)
        }, 40)
    }

    /**
     * Scroll iframe up by 40 pixels.
     */
    private scrollFrameUp() {
        clearInterval(this.scrollUpTimeout);
        return this.scrollUpTimeout = setInterval(() => {
            return this.setScrollTop(this.builderDocument.getScrollTop() - 40)
        }, 40)
    }

    /**
     * Set given scroll on iframe document element.
     */
    private setScrollTop(newScrollTop: number) {
        newScrollTop = Math.max(0, newScrollTop);
        this.builderDocument.getBody().scrollTop = newScrollTop;
    }
}
