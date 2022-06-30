import {Component, Input, OnInit, ViewEncapsulation} from '@angular/core';
import {LivePreview} from "../../../live-preview.service";
import {SelectedElement} from "../../../live-preview/selected-element.service";
import {BuilderDocumentActions} from "../../../builder-document-actions.service";

@Component({
    selector: 'spacing-panel',
    templateUrl: './spacing-panel.component.html',
    styleUrls: ['./spacing-panel.component.scss'],
    encapsulation: ViewEncapsulation.None,
})
export class SpacingPanelComponent implements OnInit {

    /**
     * Model for spacing slider.
     */
    public sliderValue = 0;

    /**
     * Maximum spacing value for slider.
     */
    @Input() max = 100;

    /**
     * Type of spacing that is being modified.
     */
    @Input() type: 'padding'|'margin'|'borderWidth'|'borderRadius' = 'padding';

    /**
     * All available spacing sides.
     */
    private readonly availableSides = ['top', 'right', 'bottom', 'left'];

    /**
     * Currently enabled spacing sides for slider.
     */
    public enabledSides: string[] = ['top', 'right', 'bottom', 'left'];

    /**
     * Spacing model for inputs.
     */
    public spacing = {all: 0, top: 0, left: 0, right: 0, bottom: 0};

    /**
     * SpacingPanelComponent Constructor.
     */
    constructor(private selected: SelectedElement, private builderActions: BuilderDocumentActions) {
        this.resetSpacing();
    }

    ngOnInit() {
        this.selected.changed.subscribe(() => {
            this.setSelectedElementSpacingValues();
        });
    }

    /**
     * Toggle specified spacing side state.
     */
    public toggleSide(name: string) {
        if (name === 'all') {
            if (this.enabledSides.length > 0) {
                this.enabledSides = [];
            } else {
                this.enabledSides = this.availableSides.slice();
            }
        } else {
            if (this.isSideEnabled(name)) {
                this.enabledSides.splice(this.enabledSides.indexOf(name), 1);
            } else {
                this.enabledSides.push(name);
            }
        }

        this.applySpacing();
    }

    /**
     * Check if specified spacing side is enabled.
     */
    public isSideEnabled(name: string) {
        if (name === 'all') return this.enabledSides.length === 4;
        return this.enabledSides.indexOf(name) > -1;
    }

    /**
     * Generate spacing css string and apply it to selected element.
     */
    public applySpacing(side?: string) {
        this.maybeResetAllSpacingValue();
        this.resetDisabledSideValues();

        const spacing = this.generateSpacingCssValue();
        this.builderActions.applyStyle(this.selected.node, this.type, spacing);
        this.sliderValue = side ? this.spacing[side] : 0;
    }

    /**
     * Reset "all" spacing value, if it is not equal to all side values.
     */
    private maybeResetAllSpacingValue() {
        this.availableSides.forEach(side => {
            if (this.spacing[side] !== this.spacing.all) {
                this.spacing.all = 0;
            }
        });
    }

    /**
     * Apply "spacing.all" value to all spacing sides.
     */
    public applySpacingToAllSides() {
        this.enabledSides = this.availableSides.slice();

        this.availableSides.forEach(side => {
            this.spacing[side] = this.spacing.all;
        });

        this.applySpacing('all');
    }

    /**
     * Apply specified spacing value to all enabled sides.
     */
    public applySpacingForEnabledSides(value: number) {
        this.resetSpacing();

        this.enabledSides.forEach(side => {
            this.spacing[side] = value;

            if (this.enabledSides.length === 4) {
                this.spacing.all = value;
            }
        });

        this.applySpacing();
    }

    /**
     * Set current spacing values of selected element on component.
     */
    private setSelectedElementSpacingValues() {
        this.availableSides.forEach(side => {
            this.spacing[side] = this.selected.getStyle(this.generateCssRuleName(side)).replace('px', '');
        });

        this.spacing.all = this.allSpacingValuesEqual() ? this.spacing.top : 0;
    }

    /**
     * Generate css rule name for specified spacing side.
     */
    private generateCssRuleName(side: string) {
        side = this.ucFirst(side);

        if (this.type === 'borderWidth') {
            return 'border' + side + 'Width';
        } else if (this.type === 'borderRadius') {
            return this.generateBorderRadiusRuleName(side);
        } else {
            return this.type + side;
        }
    }

    /**
     * Generate border radius rule name based on specified side.
     */
    private generateBorderRadiusRuleName(side: string) {
        side = side.toLowerCase();

        switch (side) {
            case 'top':
                return 'borderTopLeftRadius';
            case 'left':
                return 'borderTopRightRadius';
            case 'bottom':
                return 'borderBottomLeftRadius';
            case 'right':
                return 'borderBottomRightRadius';
        }
    }

    /**
     * Generate css value string for spacing.
     */
    private generateSpacingCssValue(): string {
        if (this.type === 'borderRadius') {
            return `${this.spacing.top}px ${this.spacing.left}px ${this.spacing.bottom}px ${this.spacing.right}px`;
        } else {
            return `${this.spacing.top}px ${this.spacing.right}px ${this.spacing.bottom}px ${this.spacing.left}px`;
        }
    }

    /**
     * Set spacing values of all disabled sides to zero.
     */
    private resetDisabledSideValues() {
        this.availableSides.forEach(side => {
            if (!this.isSideEnabled(side)) {
                this.spacing[side] = 0;
            }
        });
    }

    /**
     * Check if all spacing side values are equal.
     */
    private allSpacingValuesEqual() {
        return this.availableSides.filter(side => {
            return this.spacing[side] === this.spacing.top;
        }).length === 4;
    }

    /**
     * Reset spacing model to initial state.
     */
    private resetSpacing() {
        this.spacing = {top: 0, right: 0, bottom: 0, left: 0, all: 0};
    }

    /**
     * Uppercase first letter of specified string.
     */
    private ucFirst(string: string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
    }
}
