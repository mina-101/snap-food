<?php

namespace Tests\Feature\DelayReport;

use App\Models\DelayReport;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ListDelayReportTest extends TestCase
{
    use RefreshDatabase;

    protected $uri = "/api/v1/delayReports/";

    public function test_delayReport_list(): void
    {
        $delayReports = DelayReport::factory()->count(5)->create();
        $this->getJson($this->uri)->assertOk()
            ->assertJsonCount(5, 'data')
            ->assertJsonPath('data.0.first_name', $delayReports[0]['first_name'])
            ->assertJsonPath('data.0.last_name', $delayReports[0]['last_name'])
            ->assertJsonPath('data.4.first_name', $delayReports[4]['first_name'])
            ->assertJsonPath('data.4.last_name', $delayReports[4]['last_name']);
    }

    public function test_delayReport_list_pagination(): void
    {
        DelayReport::factory()->count(20)->create();
        $this->getJson($this->uri)->assertOk()
            ->assertJsonCount(DelayReport::PAGE_LIMIT, 'data');
    }
}
