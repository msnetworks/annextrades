import {ChangeDetectionStrategy, Component, Input, OnInit, ViewEncapsulation} from '@angular/core';

@Component({
    selector: 'side-control-border',
    templateUrl: './side-control-border.component.html',
    styleUrls: ['./side-control-border.component.scss'],
    encapsulation: ViewEncapsulation.None,
    changeDetection: ChangeDetectionStrategy.OnPush,
})
export class SideControlBorderComponent implements OnInit {

    @Input() type: string;

    @Input() active: boolean = false;

    constructor() {
    }

    ngOnInit() {
    }

}
