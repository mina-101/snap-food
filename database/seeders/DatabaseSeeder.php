<?php

namespace Database\Seeders;

use App\Models\Agent;
use App\Models\Delay;
use App\Models\DelayReport;
use App\Models\Order;
use App\Models\Trip;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Vendor;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        Agent::factory(10)->create();
        Delay::factory(10)->create();
        DelayReport::factory(10)->create();
        Order::factory(10)->create();
        Trip::factory(10)->create();
        Vendor::factory(10)->create();
    }
}
