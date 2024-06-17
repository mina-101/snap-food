<?php

namespace App\Services\Agent\V1;

use App\Models\Agent;

class AgentService
{
    public function getList(): mixed
    {
        return Agent::latest()->paginate(Agent::PAGE_LIMIT);
    }

    public function store(array $agentData): mixed
    {
        return Agent::create($agentData);
    }

    public function update(Agent $agent, array $agentData): Agent
    {
        $agent->update($agentData);

        return $agent->refresh();
    }

    public function delete(Agent $agent): void
    {
        $agent->delete();
    }
}
