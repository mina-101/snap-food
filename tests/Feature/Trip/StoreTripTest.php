<?php

namespace Tests\Feature\Trip;

use App\Enums\TripStatus;
use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StoreTripTest extends TestCase
{
    use RefreshDatabase;


    protected $uri = "api/v1/orders/";
    protected $sub_uri = "/trips";


    protected function setUp(): void
    {
        parent::setUp();
        $this->order = Order::factory()->create();
        $this->data = [
            'status' => fake()->randomElement(array_column(TripStatus::cases(), 'value'))
        ];
    }

    public function test_trip_stores_successfully(): void
    {
        $this->postJson($this->uri . $this->order->id . $this->sub_uri, $this->data)
            ->assertCreated()
            ->assertJsonPath('data.status', $this->data['status'])
            ->assertJsonPath('data.order_id', $this->order->id);
        $this->assertDatabaseHas('trips', $this->data);
    }


}
