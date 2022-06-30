<?php

namespace Common\Billing\Plans\Actions;

use Common\Auth\Permissions\Traits\SyncsPermissions;
use Common\Billing\BillingPlan;
use Common\Billing\Gateways\Contracts\GatewayInterface;
use Common\Billing\Gateways\GatewayFactory;
use Illuminate\Support\Arr;

class CrupdateBillingPlan
{
    use SyncsPermissions;

    /**
     * @var GatewayFactory
     */
    private $factory;

    /**
     * @param GatewayFactory $factory
     */
    public function __construct(GatewayFactory $factory)
    {
        $this->factory = $factory;
    }

    /**
     * @param array $data
     * @param BillingPlan|null $plan
     * @return BillingPlan
     */
    public function execute($data, BillingPlan $plan = null)
    {
        if ( ! $plan) {
            $plan = app(BillingPlan::class)
                ->newModelInstance(['uuid' => str_random(36)]);
        }

        if ($parentId = Arr::get($data, 'parent_id')) {
            $parent = app(BillingPlan::class)->find($parentId);
        }

        $newData = [
            'name' => $data['name'],
            'parent_id' => $data['parent_id'],
            'hidden' => $data['hidden'] ?: false,
            'amount' => $data['amount'],
            'interval_count' => $data['interval_count'],
            'currency' => isset($parent) ? $parent->currency : $data['currency'],
            'currency_symbol' => isset($parent) ? $parent->currency_symbol : $data['currency_symbol'],
        ];

        if ( ! isset($parent)) {
            $newData = array_merge($newData, [
                'available_space' => Arr::get($data, 'available_space') ?: null,
                'features' => $data['features'],
                'free' => $data['free'],
                'interval' => $data['interval'],
                'position' => $data['position'],
                'recommended' => $data['recommended'],
                'show_permissions' => $data['show_permissions'],
            ]);
        }

        $plan = $plan->fill($newData);
        $plan->save();

        if ($permissions = Arr::get($data, 'permissions')) {
            $this->syncPermissions($plan, $permissions);
        }

        if ( ! $plan->free && ! $plan->exists) {
            $this->factory->getEnabledGateways()->each(function(GatewayInterface $gateway) use($plan) {
                $gateway->plans()->create($plan);
            });
        }

        return $plan;
    }
}
