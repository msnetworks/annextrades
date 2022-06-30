import { ChangeDetectionStrategy, Component, EventEmitter, Input, Output } from '@angular/core';
import { SubscriptionStepperState } from '../../subscriptions/subscription-stepper-state.service';
import { Plan } from '@common/core/types/models/Plan';

@Component({
    selector: 'select-plan-period-panel',
    templateUrl: './select-plan-period-panel.component.html',
    styleUrls: ['./select-plan-period-panel.component.scss'],
    changeDetection: ChangeDetectionStrategy.OnPush,
})
export class SelectPlanPeriodPanelComponent {
    @Input() showSidebar = false;
    @Output() selected = new EventEmitter();

    constructor(
        public state: SubscriptionStepperState,
    ) {}

    public getPlanSavings(base: Plan, parent: Plan): number {
        const amount = this.getPlanPerMonthAmount(parent);
        const savings = (base.amount - amount) / base.amount * 100;
        return Math.ceil(savings);
    }

    public getPlanPerMonthAmount(plan: Plan) {
        return plan.amount / plan.interval_count;
    }
}
