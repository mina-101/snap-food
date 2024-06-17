<?php

namespace Tests\Feature\Agent;

use App\Models\Agent;
use App\Models\Delay;
use Database\Seeders\DelaySeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AssignDelayedOrderAgentTest extends TestCase
{
    use RefreshDatabase;

    protected $uri = 'api/v1/agents/assign';

    protected function setUp(): void
    {
        parent::setUp();

    }

    public function test_agent_can_get_delayed_order(): void
    {
        $this->seed(DelaySeeder::class);
        $agent = Agent::factory()->create();
        $data = [
            'agent_id' => $agent->id,
        ];
        $this->postJson($this->uri, $data)
            ->assertCreated();
        $delay = $agent->delays()->first();
        $this->assertModelExists($delay);
    }

    public function test_agent_cant_get_multiple_delayed_orders(): void
    {
        $agent = Agent::factory()->has(Delay::factory())->create();
        $this->postJson($this->uri, ['agent_id' => $agent->id])
            ->assertStatus(422);
    }
}
