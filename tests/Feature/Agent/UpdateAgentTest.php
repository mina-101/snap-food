<?php

namespace Tests\Feature\Agent;

use App\Models\Agent;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateAgentTest extends TestCase
{
    use RefreshDatabase;

    protected $uri = '/api/v1/agents/';

    public function test_agent_updates_successfully(): void
    {
        $agent = Agent::factory()->create();
        $data = [
            'first_name' => fake()->firstName,
            'last_name' => fake()->lastName,
        ];
        $this->putJson($this->uri.$agent->id, $data)
            ->assertOk()
            ->assertJsonPath('data.first_name', $data['first_name'])
            ->assertJsonPath('data.last_name', $data['last_name']);
        $this->assertModelExists($agent->refresh());
    }

    public function test_agent_doesnt_update_with_wrong_data(): void
    {
        $agent = Agent::factory()->create();
        $this->putJson($this->uri.$agent->id, [])
            ->assertStatus(422);
    }
}
