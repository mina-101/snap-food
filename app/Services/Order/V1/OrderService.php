<?php

namespace App\Services\Order\V1;

use App\Models\Order;
use Illuminate\Support\Carbon;

class OrderService
{
    public function getList(): mixed
    {
        return Order::latest()->paginate(Order::PAGE_LIMIT);
    }

    public function store(array $orderData): mixed
    {
        $orderData['delivery_time'] = $this->calculateDeliveryTime();

        return Order::create($orderData);
    }

    public function update(Order $order, array $orderData): Order
    {
        $order->update($orderData);

        return $order->refresh();
    }

    public function delete(Order $order): void
    {
        $order->delete();
    }

    protected function calculateDeliveryTime()
    {
        return Carbon::now()->addMinutes(env('DELIVERY_TIME', 50));
    }

}
