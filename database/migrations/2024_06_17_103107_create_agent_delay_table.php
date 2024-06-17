<?php

use App\Models\Agent;
use App\Models\Delay;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('agent_delay', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Agent::class);
            $table->foreignIdFor(Delay::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agent_delay');
    }
};
