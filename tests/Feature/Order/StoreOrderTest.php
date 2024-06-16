<?php

namespace Tests\Feature\Order;

use App\Models\Order;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StoreOrderTest extends TestCase
{
    use RefreshDatabase;

    protected $uri = "/api/v1/orders/";


    protected function setUp(): void
    {
        parent::setUp();
        
        $this->data = [
            'description' => fake()->text,
            'user_id' => User::factory()->create()->id,
            'vendor_id' => Vendor::factory()->create()->id,
        ];
    }

    public function test_order_stores_successfully(): void
    {
        $this->postJson($this->uri, $this->data)
            ->assertCreated()
            ->assertJsonPath('data.description', $this->data['description'])
            ->assertJsonPath('data.user_id', $this->data['user_id'])
            ->assertJsonPath('data.vendor_id', $this->data['vendor_id']);
        $this->assertDatabaseHas('orders', $this->data);

    }

    public function test_order_delivery_time_calculation_works_correctly(): void
    {
        $this->postJson($this->uri, $this->data)
            ->assertCreated();

        $order = Order::first();
        $this->assertEquals($order->delivery_time, $order->created_at->addMinutes(50));
    }


    public function test_order_doesnt_create_with_wrong_data(): void
    {
        $this->postJson($this->uri, [])
            ->assertStatus(422);
    }
}
