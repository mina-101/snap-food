<?php

namespace Tests\Feature\DelayReport;

use App\Models\DelayReport;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateDelayReportTest extends TestCase
{
    use RefreshDatabase;

    protected $uri = "/api/v1/delayReports/";

    public function test_delayReport_updates_successfully(): void
    {
        $delayReport = DelayReport::factory()->create();
        $data = [
            'first_name' =>fake()->firstName,
            'last_name' =>fake()->lastName
        ];
        $this->putJson($this->uri . $delayReport->id, $data)
            ->assertOk()
            ->assertJsonPath('data.first_name', $data['first_name'])
            ->assertJsonPath('data.last_name', $data['last_name']);
        $this->assertModelExists($delayReport->refresh());
    }

    public function test_delayReport_doesnt_update_with_wrong_data(): void
    {
        $delayReport = DelayReport::factory()->create();
        $this->putJson($this->uri . $delayReport->id, [])
            ->assertStatus(422);
    }
}
