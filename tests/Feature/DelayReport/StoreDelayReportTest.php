<?php

namespace Tests\Feature\DelayReport;

use App\Enums\TripStatus;
use App\Events\OrderDelayed;
use App\Models\Order;
use App\Models\Trip;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class StoreDelayReportTest extends TestCase
{
    use RefreshDatabase;

    protected $uri = 'api/v1/orders/';

    protected function setUp(): void
    {
        parent::setUp();
        $this->order = Order::factory()->create();
    }

    public function test_delayReport_stores_successfully_when_order_has_trip_which_is_at_vendor(): void
    {
        Trip::factory()->for($this->order)->create(['status' => TripStatus::AT_VENDOR]);
        $this->postJson($this->uri.$this->order->id.'/delayReports')
            ->assertCreated();
        $report = $this->order->delayReports()->first();
        $this->assertModelExists($report);
    }

    public function test_delayReport_stores_successfully_when_order_has_trip_which_is_picked(): void
    {
        Trip::factory()->for($this->order)->create(['status' => TripStatus::PICKED]);
        $this->postJson($this->uri.$this->order->id.'/delayReports')
            ->assertCreated();
        $report = $this->order->delayReports()->first();
        $this->assertModelExists($report);
    }

    public function test_delayReport_stores_successfully_when_order_has_trip_which_is_assigned(): void
    {
        Trip::factory()->for($this->order)->create(['status' => TripStatus::ASSIGNED]);
        $this->postJson($this->uri.$this->order->id.'/delayReports')
            ->assertCreated();
        $report = $this->order->delayReports()->first();
        $this->assertModelExists($report);
    }

    public function test_delayReport_doesnt_store_when_delivery_time_is_not_met(): void
    {
        $order = Order::factory()->create([
            'delivery_time' => Carbon::now()->addMinutes(50),
            'created_at' => Carbon::now(),
        ]);
        Trip::factory()->for($order)->create(['status' => TripStatus::ASSIGNED]);
        $this->postJson($this->uri.$order->id.'/delayReports')->assertUnprocessable();
    }

    public function test_new_delivery_time_sets_for_order_when_it_has_no_trip(): void
    {
        $delivery_time = $this->order->delivery_time;
        $this->postJson($this->uri.$this->order->id.'/delayReports')->assertCreated();
        $this->assertNotEquals($this->order->refresh()->delivery_time, $delivery_time);
    }

    public function test_order_delayed_event_dispatches_when_order_has_no_trip(): void
    {
        Event::fake();
        $this->postJson($this->uri.$this->order->id.'/delayReports')->assertCreated();
        Event::assertDispatched(OrderDelayed::class);
    }
}
