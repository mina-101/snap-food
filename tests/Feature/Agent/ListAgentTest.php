<?php

namespace Tests\Feature\Agent;

use App\Models\Agent;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ListAgentTest extends TestCase
{
    use RefreshDatabase;

    protected $uri = '/api/v1/agents/';

    public function test_agent_list(): void
    {
        $agents = Agent::factory()->count(5)->create();
        $this->getJson($this->uri)->assertOk()
            ->assertJsonCount(5, 'data')
            ->assertJsonPath('data.0.first_name', $agents[0]['first_name'])
            ->assertJsonPath('data.0.last_name', $agents[0]['last_name'])
            ->assertJsonPath('data.4.first_name', $agents[4]['first_name'])
            ->assertJsonPath('data.4.last_name', $agents[4]['last_name']);
    }

    public function test_agent_list_pagination(): void
    {
        Agent::factory()->count(20)->create();
        $this->getJson($this->uri)->assertOk()
            ->assertJsonCount(Agent::PAGE_LIMIT, 'data');
    }
}
