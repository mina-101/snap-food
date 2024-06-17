<?php

namespace App\Providers;

use App\Services\Client\FakeDeliveryTimeClientClient;
use App\Services\Client\Interface\DeliveryTimeClientInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(DeliveryTimeClientInterface::class, FakeDeliveryTimeClientClient::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
