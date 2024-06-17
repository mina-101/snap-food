<?php

namespace Tests\Feature\Agent;

use App\Models\Agent;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShowAgentTest extends TestCase
{
    use RefreshDatabase;

    protected $uri = '/api/v1/agents/';

    public function test_agent_list(): void
    {
        $agents = Agent::factory()->count(5)->create();
        $this->getJson($this->uri.$agents[3]->id)->assertOk()
            ->assertJsonPath('data.first_name', $agents[3]['first_name'])
            ->assertJsonPath('data.last_name', $agents[3]['last_name']);
    }
}
