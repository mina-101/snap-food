<?php

namespace App\Services\Trip\V1;

use App\Models\Order;
use App\Models\Trip;

class TripService
{
    public function getList(Order $order): mixed
    {
        return $order->trip;
    }

    public function store(Order $order, array $tripData): mixed
    {
        return $order->trip()->updateOrCreate(
            ['order_id' => $order->id],
            ['status' => $tripData['status']]
        );
    }

    public function delete(Trip $trip): void
    {
        $trip->delete();
    }
}
