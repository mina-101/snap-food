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
            "order_id" => Order::factory(),
            "status" => fake()->randomElement(array_column(DelayReportResult::cases(), 'value'))
        ];
    }
}
