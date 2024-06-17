<?php

namespace Database\Seeders;

use App\Models\Delay;
use Illuminate\Database\Seeder;

class DelaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Delay::factory()->count(10)->create();
    }
}
