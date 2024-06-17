<?php

namespace Tests\Feature\DelayReport;

use App\Models\DelayReport;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DelayReportsReportTest extends TestCase
{
    use RefreshDatabase;

    protected $uri = '/api/v1/delayReports/report';

    public function test_vendor_list(): void
    {
        DelayReport::factory()->newDeliveryTime()->count(10)->create(['created_at' => Carbon::now()->subDays(-3)]);

        $response = $this->getJson($this->uri)->assertOk();

        $reports = $response->json();
        $this->assertGreaterThan($reports[1]['total'], $reports[0]['total']);
        $this->assertGreaterThan($reports[2]['total'], $reports[1]['total']);
        $this->assertGreaterThan($reports[9]['total'], $reports[8]['total']);
    }
}
