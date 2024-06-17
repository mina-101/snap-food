<?php

namespace App\Services\Agent\V1;

use App\Enums\DelayStatus;
use App\Models\Agent;
use App\Models\Delay;

class AssignDelayedOrderService
{

    public function assignDelayedOrderToAgent(array $agentData): mixed
    {
        //we don't have authentication,so we get agent from request
        $agent = Agent::with('delays')->find($agentData['agent_id']);

        if (count($agent->delays) > 0) {
            return ['status' => 422];
        }

        $delayedOrder = $this->getDelayedOrder();
        if ($delayedOrder) {
            $agent->delays()->attach($delayedOrder);
        }

        return ['status' => 200];
    }

    protected function getDelayedOrder()
    {
        return Delay::whereDoesntHave('agents')->orWhere('status', DelayStatus::TRACK)->oldest()->first();
    }

}
