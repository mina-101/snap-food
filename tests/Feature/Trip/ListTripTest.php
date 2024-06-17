<?php

namespace Tests\Feature\Trip;

use App\Models\Order;
use App\Models\Trip;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ListTripTest extends TestCase
{
    use RefreshDatabase;

    protected $uri = 'api/v1/orders/';

    protected $sub_uri = '/trips';

    public function test_trip_list(): void
    {
        $order = Order::factory()->create();
        $trip = Trip::factory()->for($order)->create();
        $this->getJson($this->uri.$order->id.$this->sub_uri)->assertOk()
            ->assertJsonPath('data.status', $trip->status->value)
            ->assertJsonPath('data.order_id', $trip->order_id);
    }
}
