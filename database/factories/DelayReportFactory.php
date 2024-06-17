<?php

namespace Database\Factories;

use App\Enums\DelayReportResult;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DelayReport>
 */
class DelayReportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_id' => Order::factory(),
            'status' => DelayReportResult::DELAYED,
        ];
    }

    public function newDeliveryTime(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => DelayReportResult::NEW_DELIVERY_TIME,
                'delay' => fake()->randomNumber(),
            ];
        });
    }
}
