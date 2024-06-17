<?php

namespace Tests\Feature\Order;

use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeleteOrderTest extends TestCase
{
    use RefreshDatabase;

    protected $uri = '/api/v1/orders/';

    public function test_order_deletes_successfully(): void
    {
        $order = Order::factory()->create();
        $this->delete($this->uri.$order->id)->assertOk();
        $this->assertDatabaseMissing('orders', $order->toArray());
        $this->assertModelMissing($order);
    }
}
