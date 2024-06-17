<?php

namespace Tests\Feature\DelayReport;

use App\Models\DelayReport;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeleteDelayReportTest extends TestCase
{
    use RefreshDatabase;

    protected $uri = "/api/v1/delayReports/";

    public function test_delayReport_deletes_successfully(): void
    {
        $delayReport = DelayReport::factory()->create();
        $this->delete($this->uri . $delayReport->id)->assertOk();
        $this->assertDatabaseMissing('delayReports', $delayReport->toArray());
        $this->assertModelMissing($delayReport);
    }
}
