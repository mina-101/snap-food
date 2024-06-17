<?php

namespace App\Listeners;

use App\Enums\DelayStatus;
use App\Events\OrderDelayed;

class addOrderToDelayQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(OrderDelayed $event): void
    {
        $event->order->delays()->create([
            'status' => DelayStatus::DELAYED
        ]);
    }
}
