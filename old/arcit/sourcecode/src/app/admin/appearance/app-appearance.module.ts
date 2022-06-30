import {NgModule} from '@angular/core';
import {CommonModule} from '@angular/common';
import {BaseAppearanceModule} from '@common/admin/appearance/base-appearance.module';
import {MatIconModule} from '@angular/material/icon';
import {MatButtonModule} from '@angular/material/button';
import {TranslationsModule} from '@common/core/translations/translations.module';
import {ReactiveFormsModule} from '@angular/forms';
import {MatSliderModule} from '@angular/material/slider';
import {ColorPickerInputModule} from '@common/core/ui/color-picker/color-picker-input/color-picker-input.module';
import {HomepageAppearancePanelComponent} from './homepage-appearance-panel/homepage-appearance-panel.component';


@NgModule({
    declarations: [
        HomepageAppearancePanelComponent,
    ],
    imports: [
        CommonModule,
        BaseAppearanceModule,
        ReactiveFormsModule,
        ColorPickerInputModule,
        TranslationsModule,

        // material
        MatIconModule,
        MatButtonModule,
        TranslationsModule,
        MatSliderModule,
    ]
})
export class AppAppearanceModule {
}
