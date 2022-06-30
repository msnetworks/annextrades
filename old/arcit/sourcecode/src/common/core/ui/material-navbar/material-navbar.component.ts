import {
    ChangeDetectionStrategy,
    Component,
    ElementRef,
    EventEmitter,
    HostBinding,
    Input,
    OnInit,
    Output,
    ViewEncapsulation
} from '@angular/core';
import {BehaviorSubject} from 'rxjs';
import {Settings} from '@common/core/config/settings.service';
import {CurrentUser} from '@common/auth/current-user';
import {BreakpointsService} from '@common/core/ui/breakpoints.service';
import {ThemeService} from '@common/core/theme.service';

@Component({
    selector: 'material-navbar',
    templateUrl: './material-navbar.component.html',
    styleUrls: ['./material-navbar.component.scss'],
    encapsulation: ViewEncapsulation.None,
    changeDetection: ChangeDetectionStrategy.OnPush,
})
export class MaterialNavbar implements OnInit {
    @Input() menuPosition: string;
    @Input() showToggleButton = false;
    @Input() hideToggleBtnOnDesktop = false;
    @Input() container = false;
    @Input() hideRightSideActions = false;
    @Input() hideRegisterButton = false;
    @Output() toggleButtonClick = new EventEmitter();
    @Input() @HostBinding('class.transparent') transparent = false;

    @Input() color: 'primary'|'accent' = this.config.get('vebto.navbar.defaultColor', 'primary');
    @HostBinding('class.primary') get isPrimary() {
        return this.themes.isDarkMode() || this.color === 'primary';
    }
    @HostBinding('class.accent') get isAccent() {
        return !this.themes.isDarkMode() && this.color === 'accent';
    }

    public mobileSearchActive$ = new BehaviorSubject(false);
    public searchInput: HTMLInputElement;
    public isMobile$ = new BehaviorSubject(false);
    
    constructor(
        public config: Settings,
        public currentUser: CurrentUser,
        public breakpoints: BreakpointsService,
        private el: ElementRef<HTMLElement>,
        private themes: ThemeService,
    ) {}

    ngOnInit() {
        this.searchInput = this.el.nativeElement.querySelector('.nav-searchbar input');
        if (this.searchInput) {
            this.searchInput.addEventListener('blur', () => {
                this.closeMobileSearch();
            });
        }

        this.breakpoints.observe('(max-width: 1000px)').subscribe(result => {
            this.isMobile$.next(result.matches);
        });
    }

    public openMobileSearch() {
        this.mobileSearchActive$.next(true);
        this.el.nativeElement.classList.add('mobile-search-active');
        setTimeout(() => this.searchInput.focus());
    }

    public closeMobileSearch() {
        this.el.nativeElement.classList.remove('mobile-search-active');
        return this.mobileSearchActive$.next(false);
    }

    public mobileOrTablet() {
        return this.breakpoints.isMobile$.value || this.breakpoints.isTablet$.value;
    }

    public isMobile(): boolean {
        return this.breakpoints.isMobile$.value;
    }

    public shouldShowToggleBtn() {
        return this.showToggleButton && (this.mobileOrTablet() || !this.hideToggleBtnOnDesktop);
    }
}
