<?php

namespace App\Services\Client;

use App\Services\Client\Interface\DeliveryTimeClientInterface;
use App\Services\Clients\DTO\Tapture\TaptureCreatePublisherResponseDTO;
use Illuminate\Support\Facades\Http;
use Random\RandomException;

class DeliveryTimeClientClient implements DeliveryTimeClientInterface
{

    /**
     * @throws RandomException
     */
    public function getNewDeliveryTime(): array
    {
        return Http::get('https://run.mocky.io/v3/122c2796-5df4-461c-ab75-87c1192b17f7');
    }
}
