import {NgModule} from '@angular/core';
import {CommonModule} from '@angular/common';
import {HtmlBuilderComponent} from './html-builder/html-builder.component';
import {HtmlBuilderRoutingModule} from './html-builder-routing.module';
import {InspectorComponent} from './inspector/inspector.component';
import {LivePreviewComponent} from './live-preview/live-preview.component';
import {PreviewDragAndDropDirective} from './live-preview/drag-and-drop/preview-drag-and-drop.directive';
import {ElementsPanelComponent} from './inspector/elements-panel/elements-panel.component';
import {InspectorPanelComponent} from './inspector/inspector-panel/inspector-panel.component';
import {AttributesPanelComponent} from './inspector/inspector-panel/attributes-panel/attributes-panel.component';
import {SpacingPanelComponent} from './inspector/inspector-panel/spacing-panel/spacing-panel.component';
import {BorderStyleControlsComponent} from './inspector/inspector-panel/border-style-controls/border-style-controls.component';
import {SideControlBorderComponent} from './inspector/inspector-panel/spacing-panel/side-control-border/side-control-border.component';
import {TextStylePanelComponent} from './inspector/inspector-panel/text-style-panel/text-style-panel.component';
import {BackgroundPanelComponent} from './inspector/inspector-panel/background-panel/background-panel.component';
import {GradientBackgroundPanelComponent} from './inspector/inspector-panel/background-panel/gradient-background-panel/gradient-background-panel.component';
import {GoogleFontsPanelComponent} from './inspector/inspector-panel/text-style-panel/google-fonts-panel/google-fonts-panel.component';
import {ImageBackgroundPanelComponent} from './inspector/inspector-panel/background-panel/image-background-panel/image-background-panel.component';
import {ShadowsPanelComponent} from './inspector/inspector-panel/shadows-panel/shadows-panel.component';
import {DragVisualHelperComponent} from './live-preview/drag-and-drop/drag-visual-helper/drag-visual-helper.component';
import {LayoutPanelComponent} from './inspector/layout-panel/layout-panel.component';
import {ColumnPresetsComponent} from './inspector/layout-panel/column-presets/column-presets.component';
import {DragElementsDirective} from './live-preview/drag-and-drop/drag-elements.directive';
import {InlineTextEditorComponent} from './live-preview/inline-text-editor/inline-text-editor.component';
import {CodeEditorComponent} from './live-preview/code-editor/code-editor.component';
import {LivePreviewContextMenuComponent} from './live-preview/live-preview-context-menu/live-preview-context-menu.component';
import {PagesPanelComponent} from './inspector/pages-panel/pages-panel.component';
import {SettingsPanelComponent} from './inspector/settings-panel/settings-panel.component';
import {TemplatesPanelComponent} from './inspector/settings-panel/templates-panel/templates-panel.component';
import {ThemesPanelComponent} from './inspector/settings-panel/themes-panel/themes-panel.component';
import {ContextBoxComponent} from './live-preview/context-box/context-box.component';
import {LinkEditorComponent} from './live-preview/link-editor/link-editor.component';
import {DeviceSwitcherComponent} from './inspector/device-switcher/device-switcher.component';
import {MaterialModule} from '../material.module';
import {SharedModule} from '../shared/shared.module';
import {MatChipsModule} from '@angular/material/chips';
import {MatDialogModule} from '@angular/material/dialog';
import {MatExpansionModule} from '@angular/material/expansion';
import {MatRadioModule} from '@angular/material/radio';
import {MatSidenavModule} from '@angular/material/sidenav';
import {MatSliderModule} from '@angular/material/slider';
import {MatTabsModule} from '@angular/material/tabs';
import {PortalModule} from '@angular/cdk/portal';
import {OverlayModule} from '@angular/cdk/overlay';
import {DragDropModule} from '@angular/cdk/drag-drop';
import {ReorderLayoutItemsDirective} from './inspector/layout-panel/reorder-layout-items.directive';
import {ElementResizerDirective} from './live-preview/drag-and-drop/element-resizer.directive';
import {MatButtonModule} from '@angular/material/button';
import {MatIconModule} from '@angular/material/icon';
import {TranslationsModule} from '@common/core/translations/translations.module';
import {LoadingIndicatorModule} from '@common/core/ui/loading-indicator/loading-indicator.module';
import {NoResultsMessageModule} from '@common/core/ui/no-results-message/no-results-message.module';
import {FormsModule, ReactiveFormsModule} from '@angular/forms';

@NgModule({
    imports: [
        CommonModule,
        SharedModule,
        MaterialModule,
        HtmlBuilderRoutingModule,
        TranslationsModule,
        LoadingIndicatorModule,
        NoResultsMessageModule,
        FormsModule,
        ReactiveFormsModule,

        // material
        MatSidenavModule,
        MatExpansionModule,
        MatSliderModule,
        MatChipsModule,
        PortalModule,
        OverlayModule,
        MatTabsModule,
        MatRadioModule,
        DragDropModule,
        MatDialogModule,
        MatButtonModule,
        MatIconModule,
    ],
    declarations: [
        HtmlBuilderComponent,
        InspectorComponent,
        LivePreviewComponent,
        PreviewDragAndDropDirective,
        ElementsPanelComponent,
        InspectorPanelComponent,
        AttributesPanelComponent,
        SpacingPanelComponent,
        BorderStyleControlsComponent,
        SideControlBorderComponent,
        TextStylePanelComponent,
        BackgroundPanelComponent,
        GradientBackgroundPanelComponent,
        GoogleFontsPanelComponent,
        ImageBackgroundPanelComponent,
        ShadowsPanelComponent,
        DragVisualHelperComponent,
        LayoutPanelComponent,
        ColumnPresetsComponent,
        DragElementsDirective,
        InlineTextEditorComponent,
        CodeEditorComponent,
        LivePreviewContextMenuComponent,
        PagesPanelComponent,
        SettingsPanelComponent,
        TemplatesPanelComponent,
        ThemesPanelComponent,
        ContextBoxComponent,
        LinkEditorComponent,
        DeviceSwitcherComponent,
        ReorderLayoutItemsDirective,
        ElementResizerDirective,
    ]
})
export class HtmlBuilderModule {
}
