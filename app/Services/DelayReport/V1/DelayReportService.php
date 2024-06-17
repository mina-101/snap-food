<?php

namespace App\Services\DelayReport\V1;

use App\Enums\DelayReportResult;
use App\Enums\TripStatus;
use App\Events\OrderDelayed;
use App\Models\Order;
use App\Models\Trip;
use App\Services\Client\Interface\DeliveryTimeClientInterface;
use Illuminate\Support\Carbon;

class DelayReportService
{
    public function __construct(public DeliveryTimeClientInterface $deliveryTimeClient)
    {
    }

    public function store(Order $order): array
    {
        $trip = $order->trip;
        if ($trip && $this->isNotDelivered($trip)) {
            if (Carbon::now() < $order->delivery_time) {
                return [
                    'status' => 422,
                    'message' => __('delivery time is not expired'),
                ];
            }
            $delay = $this->getNewDeliveryTime();
            $newDeliveryTime = $this->calculateNewDeliveryTime($delay);
            $this->updateDeliveryTime($order, $newDeliveryTime);
            $reportData = [
                'status' => DelayReportResult::NEW_DELIVERY_TIME,
                'delay' => $delay,
                'new_delivery_time' => $newDeliveryTime,
            ];
        } else {
            $this->orderIsDelayed($order);
            $reportData = [
                'status' => DelayReportResult::DELAYED,
            ];
        }

        $this->saveDelayReport($order, $reportData);

        return ['status' => 200];
    }

    protected function isNotDelivered(Trip $trip): bool
    {
        return $trip->status != TripStatus::DELIVERED;
    }

    protected function updateDeliveryTime(Order $order, Carbon $newDeliveryTime): void
    {
        $order->update(['delivery_time' => $newDeliveryTime]);
    }

    protected function getNewDeliveryTime(): int
    {
        return $this->deliveryTimeClient->getNewDeliveryTime()['delivery_time'];
    }

    protected function orderIsDelayed(Order $order): void
    {
        OrderDelayed::dispatch($order);

    }

    protected function saveDelayReport(Order $order, array $reportData): void
    {
        $order->delayReports()->create($reportData);
    }

    protected function calculateNewDeliveryTime(int $delay): Carbon
    {
        return Carbon::now()->addMinutes($delay);
    }
}
