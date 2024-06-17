<?php

namespace App\Services\Client;

use App\Services\Client\Interface\DeliveryTimeClientInterface;
use Random\RandomException;

class FakeDeliveryTimeClientClient implements DeliveryTimeClientInterface
{

    /**
     * @throws RandomException
     */
    public function getNewDeliveryTime(): array
    {
        return [
            "delivery_time" => random_int(50, 100)
        ];
    }
}
