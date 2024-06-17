<?php

namespace App\Services\DelayReport\V1;

use App\Enums\TripStatus;
use App\Events\OrderDelayed;
use App\Models\Order;
use App\Models\Trip;

class DelayReportService
{
    public function getList(Order $order): mixed
    {
        return $order->trip;
    }

    public function store(Order $order)
    {
        $trip = $order->trip;
        if ($trip && $this->isNotDelivered($trip)) {
            //TODO get new stimate
        } else {
            OrderDelayed::dispatch($order);
        }
    }

    protected function isNotDelivered(Trip $trip): bool
    {
        return $trip->status != TripStatus::DELIVERED;
    }

}
