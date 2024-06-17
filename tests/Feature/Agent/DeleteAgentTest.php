<?php

namespace Tests\Feature\Agent;

use App\Models\Agent;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeleteAgentTest extends TestCase
{
    use RefreshDatabase;

    protected $uri = '/api/v1/agents/';

    public function test_agent_deletes_successfully(): void
    {
        $agent = Agent::factory()->create();
        $this->delete($this->uri.$agent->id)->assertOk();
        $this->assertDatabaseMissing('agents', $agent->toArray());
        $this->assertModelMissing($agent);
    }
}
