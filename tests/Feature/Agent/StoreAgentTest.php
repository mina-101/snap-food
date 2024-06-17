<?php

namespace Tests\Feature\Agent;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StoreAgentTest extends TestCase
{
    use RefreshDatabase;

    protected $uri = '/api/v1/agents/';

    public function test_agent_stores_successfully(): void
    {
        $data = [
            'first_name' => fake()->firstName,
            'last_name' => fake()->lastName,
        ];
        $this->postJson($this->uri, $data)
            ->assertCreated()
            ->assertJsonPath('data.first_name', $data['first_name'])
            ->assertJsonPath('data.last_name', $data['last_name']);
        $this->assertDatabaseHas('agents', $data);
    }

    public function test_agent_doesnt_create_with_wrong_data(): void
    {
        $this->postJson($this->uri, [])
            ->assertStatus(422);
    }
}
