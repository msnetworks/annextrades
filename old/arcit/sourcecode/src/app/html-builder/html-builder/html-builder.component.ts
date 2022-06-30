import {Component, ElementRef, OnDestroy, OnInit, ViewChild, ViewEncapsulation} from '@angular/core';
import {Elements} from '../elements/elements.service';
import {ActivatedRoute} from '@angular/router';
import {ActiveProject} from '../projects/active-project';
import { MatDrawer } from '@angular/material/sidenav';
import {InspectorDrawer} from '../inspector/inspector-drawer.service';
import {DragVisualHelperComponent} from '../live-preview/drag-and-drop/drag-visual-helper/drag-visual-helper.component';
import {DragVisualHelper} from '../live-preview/drag-and-drop/drag-visual-helper/drag-visual-helper.service';
import {LivePreviewLoader} from '../live-preview/live-preview-loader.service';
import {CodeEditor} from '../live-preview/code-editor/code-editor.service';
import {Inspector} from '../inspector/inspector.service';
import {InlineTextEditor} from '../live-preview/inline-text-editor/inline-text-editor.service';
import {animate, state, style, transition, trigger} from '@angular/animations';
import {BreakpointsService} from '@common/core/ui/breakpoints.service';

@Component({
    selector: 'html-builder',
    templateUrl: './html-builder.component.html',
    styleUrls: ['./html-builder.component.scss'],
    encapsulation: ViewEncapsulation.None,
    animations: [
        trigger('bodyExpansion', [
            state('false', style({height: '0px', visibility: 'hidden'})),
            state('true', style({height: '*', visibility: 'visible'})),
            transition('true <=> false',
                animate('225ms cubic-bezier(0.4,0.0,0.2,1)')),
        ])
    ]
})
export class HtmlBuilderComponent implements OnInit, OnDestroy {
    @ViewChild('inspectorDrawer', {static: true}) drawer: MatDrawer;
    @ViewChild('dragHelper', {static: true}) dragHelper: DragVisualHelperComponent;
    @ViewChild('loaderEl', {static: true}) loaderEl: ElementRef;
    public inspectorHidden = false;

    constructor(
        private elements: Elements,
        private route: ActivatedRoute,
        private activeProject: ActiveProject,
        public inspectorDrawer: InspectorDrawer,
        private dragVisualHelper: DragVisualHelper,
        public loader: LivePreviewLoader,
        private codeEditor: CodeEditor,
        private inspector: Inspector,
        private inlineTextEditor: InlineTextEditor,
        private breakpoints: BreakpointsService,
    ) {}

    ngOnInit() {
        this.loader.setLoader(this.loaderEl);
        this.inspectorHidden = this.breakpoints.isMobile$.value;

        this.route.data.subscribe(data => {
            this.activeProject.setProject(data.project);
            this.elements.init(data.customElements);
            this.inspectorDrawer.setDrawer(this.drawer);
            this.dragVisualHelper.setComponent(this.dragHelper);
        });
    }

    ngOnDestroy() {
        this.codeEditor.close();
        this.inspector.reset();
        this.activeProject.reset();
        this.inlineTextEditor.close();
    }

    public getInspectorDrawerPanel(): string {
        return this.inspectorDrawer.activePanel;
    }

    public toggleInspector() {
        this.inspectorHidden = !this.inspectorHidden;
    }
}
