import {Component, EventEmitter, Input, OnChanges, Output, ViewEncapsulation} from '@angular/core';

@Component({
    selector: 'column-presets',
    templateUrl: './column-presets.component.html',
    styleUrls: ['./column-presets.component.scss'],
    encapsulation: ViewEncapsulation.None,
})
export class ColumnPresetsComponent implements OnChanges {

    /**
     * Fired when new column preset is selected.
     */
    @Output() selected = new EventEmitter();

    /**
     * Current selected row column preset.
     */
    @Input() preset: number[];

    public customPanelOpen = false;

    public customSpan: string;

    public customPresetIsValid = true;

    ngOnChanges() {
        this.customSpan = this.preset.join(' + ');
    }

    public selectPreset(preset: number[]) {
        this.selected.emit(preset);
    }

    public selectPresetFromCustomSpan() {
        const customSpan = this.customSpan.split('+');
        const spans = customSpan.map(span => parseInt(span.trim()));

        if (this.presetIsValid(spans)) {
            this.selectPreset(spans);
            this.customPresetIsValid = true;
        } else {
            this.customPresetIsValid = false;
        }
    }

    /**
     * Toggle custom preset panel visibility.
     */
    public toggleCustomPanel() {
        this.customPanelOpen = !this.customPanelOpen;
    }

    /**
     * Check if specified preset is currently active.
     */
    public presetIsActive(preset: number[]) {
        return (this.preset.length === preset.length) && this.preset.every((element, index) => {
            return element === preset[index];
        });
    }

    /**
     * Check if specified column preset is valid.
     */
    private presetIsValid(preset: number[]) {
        const validSpans = preset.filter(span => span > 0 && span <= 12);
        return validSpans.length && validSpans.reduce((sum, x) => sum + x) === 12;
    }
}
