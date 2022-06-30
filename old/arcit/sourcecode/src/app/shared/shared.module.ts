import {NgModule} from '@angular/core';
import {PublishProjectModalComponent} from './projects/publish-project-modal/publish-project-modal.component';
import {MaterialModule} from '../material.module';
import {CommonModule} from '@angular/common';
import {FormsModule, ReactiveFormsModule} from '@angular/forms';
import {CrupdateProjectModalComponent} from './crupdate-project-modal/crupdate-project-modal.component';
import {TranslationsModule} from '@common/core/translations/translations.module';
import {SelectUserInputModule} from '@common/core/ui/select-user-input/select-user-input.module';

@NgModule({
    imports: [
        CommonModule,
        FormsModule,
        MaterialModule,
        TranslationsModule,
        SelectUserInputModule,
        ReactiveFormsModule,
    ],
    declarations: [
        PublishProjectModalComponent,
        CrupdateProjectModalComponent,
    ]
})
export class SharedModule {
}
