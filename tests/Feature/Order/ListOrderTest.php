<?php

namespace Tests\Feature\Order;

use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ListOrderTest extends TestCase
{
    use RefreshDatabase;

    protected $uri = "/api/v1/orders/";

    public function test_order_list(): void
    {
        $orders = Order::factory()->count(5)->create();
        $this->getJson($this->uri)->assertOk()
            ->assertJsonCount(5, 'data')
            ->assertJsonPath('data.0.description', $orders[0]['description'])
            ->assertJsonPath('data.0.vendor_id', $orders[0]['vendor_id'])
            ->assertJsonPath('data.4.vendor_id', $orders[4]['vendor_id'])
            ->assertJsonPath('data.4.description', $orders[4]['description']);
    }

    public function test_order_list_pagination(): void
    {
        Order::factory()->count(20)->create();
        $this->getJson($this->uri)->assertOk()
            ->assertJsonCount(Order::PAGE_LIMIT, 'data');
    }
}
