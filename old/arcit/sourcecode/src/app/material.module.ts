import { MatButtonModule } from '@angular/material/button';
import { MatCheckboxModule } from '@angular/material/checkbox';
import { MatDialogModule } from '@angular/material/dialog';
import { MatListModule } from '@angular/material/list';
import { MatMenuModule } from '@angular/material/menu';
import { MatProgressBarModule } from '@angular/material/progress-bar';
import { MatSlideToggleModule } from '@angular/material/slide-toggle';
import { MatTooltipModule } from '@angular/material/tooltip';
import {NgModule} from '@angular/core';
import {MatIconModule} from '@angular/material/icon';

@NgModule({
    imports: [
        MatButtonModule,
        MatCheckboxModule,
        MatTooltipModule,
        MatDialogModule,
        MatMenuModule,
        MatListModule,
        MatSlideToggleModule,
        MatProgressBarModule,
        MatIconModule,
    ],
    exports: [
        MatButtonModule,
        MatCheckboxModule,
        MatTooltipModule,
        MatDialogModule,
        MatMenuModule,
        MatListModule,
        MatProgressBarModule,
        MatSlideToggleModule,
        MatIconModule,
    ],
})
export class MaterialModule { }
