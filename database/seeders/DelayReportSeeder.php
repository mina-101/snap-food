<?php

namespace Database\Seeders;

use App\Models\DelayReport;
use Illuminate\Database\Seeder;

class DelayReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DelayReport::factory()->count(10)->create();
    }
}
