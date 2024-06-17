<?php

namespace Tests\Feature\DelayReport;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StoreDelayReportTest extends TestCase
{
    use RefreshDatabase;
    protected $uri = "/api/v1/delayReports/";

    public function test_delayReport_stores_successfully(): void
    {
        $data = [
            'first_name' =>fake()->firstName,
            'last_name' =>fake()->lastName
        ];
        $this->postJson($this->uri, $data)
            ->assertCreated()
            ->assertJsonPath('data.first_name', $data['first_name'])
            ->assertJsonPath('data.last_name', $data['last_name']);
        $this->assertDatabaseHas('delayReports', $data);
    }

    public function test_delayReport_doesnt_create_with_wrong_data(): void
    {
        $this->postJson($this->uri, [])
            ->assertStatus(422);
    }
}
