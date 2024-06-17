<?php

namespace Tests\Feature\Order;

use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShowOrderTest extends TestCase
{
    use RefreshDatabase;

    protected $uri = '/api/v1/orders/';

    public function test_order_list(): void
    {
        $orders = Order::factory()->count(5)->create();

        $this->getJson($this->uri.$orders[3]->id)->assertOk()
            ->assertJsonPath('data.description', $orders[3]['description'])
            ->assertJsonPath('data.user_id', $orders[3]['user_id'])
            ->assertJsonPath('data.vendor_id', $orders[3]['vendor_id']);
    }
}
