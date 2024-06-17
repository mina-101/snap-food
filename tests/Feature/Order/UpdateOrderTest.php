<?php

namespace Tests\Feature\Order;

use App\Models\Order;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateOrderTest extends TestCase
{
    use RefreshDatabase;

    protected $uri = '/api/v1/orders/';

    public function test_order_updates_successfully(): void
    {
        $order = Order::factory()->create();

        $data = [
            'description' => fake()->text,
            'user_id' => User::factory()->create()->id,
            'vendor_id' => Vendor::factory()->create()->id,
        ];

        $this->putJson($this->uri.$order->id, $data)
            ->assertOk()
            ->assertJsonPath('data.description', $data['description'])
            ->assertJsonPath('data.user_id', $data['user_id'])
            ->assertJsonPath('data.vendor_id', $data['vendor_id']);
        $this->assertDatabaseHas('orders', $data);

        $this->assertModelExists($order->refresh());
    }

    public function test_order_doesnt_update_with_wrong_data(): void
    {
        $order = Order::factory()->create();
        $this->putJson($this->uri.$order->id, [])
            ->assertStatus(422);
    }
}
