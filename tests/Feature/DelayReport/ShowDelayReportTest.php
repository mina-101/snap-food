<?php

namespace Tests\Feature\DelayReport;

use App\Models\DelayReport;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShowDelayReportTest extends TestCase
{
    use RefreshDatabase;
    protected $uri = "/api/v1/delayReports/";

    public function test_delayReport_list(): void
    {
        $delayReports = DelayReport::factory()->count(5)->create();
        $this->getJson($this->uri.$delayReports[3]->id)->assertOk()
            ->assertJsonPath('data.first_name', $delayReports[3]['first_name'])
            ->assertJsonPath('data.last_name', $delayReports[3]['last_name']);
    }
}
