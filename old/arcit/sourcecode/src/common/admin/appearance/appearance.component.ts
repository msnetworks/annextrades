import {ChangeDetectionStrategy, Component, ElementRef, OnDestroy, OnInit, ViewChild} from '@angular/core';
import {ActivatedRoute, Router} from '@angular/router';
import {AppearanceEditor} from './appearance-editor/appearance-editor.service';
import {slugifyString} from '@common/core/utils/slugify-string';
import {Subscription} from 'rxjs';
import {ComponentPortal} from '@angular/cdk/portal';
import {map} from 'rxjs/operators';
import {BreakpointsService} from '@common/core/ui/breakpoints.service';

@Component({
    selector: 'appearance',
    templateUrl: './appearance.component.html',
    styleUrls: ['./appearance.component.scss'],
    changeDetection: ChangeDetectionStrategy.OnPush,
})
export class AppearanceComponent implements OnInit, OnDestroy {
    @ViewChild('iframe', { static: true }) iframe: ElementRef;
    private routerSub: Subscription;
    public leftColumnIsHidden = false;

    public panelPortal$ = this.editor.activePanel$.pipe(map(panel => {
        return (panel && panel.component) ? new ComponentPortal(panel.component) : null;
    }));

    constructor(
        public editor: AppearanceEditor,
        private router: Router,
        private route: ActivatedRoute,
        public breakpoints: BreakpointsService,
    ) {}

    ngOnInit() {
        this.leftColumnIsHidden = this.breakpoints.isMobile$.value;
        this.editor.init(
            this.iframe.nativeElement,
            this.route.snapshot.data.defaultSettings
        );
        this.routerSub = this.route.queryParams
            .subscribe((params: {panel?: string}) => {
                this.editor.openPanel(params.panel);
            });
    }

    ngOnDestroy() {
        this.routerSub && this.routerSub.unsubscribe();
    }

    public closeEditor() {
        this.router.navigate(['admin']);
    }

    public slugify(str: string) {
        return slugifyString(str);
    }

    public viewName(name: string) {
        return name.replace('-', ' ');
    }

    public toggleLeftSidebar() {
        this.leftColumnIsHidden = !this.leftColumnIsHidden;
    }
}
