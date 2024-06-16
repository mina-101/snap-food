<?php

namespace Tests\Feature\Trip;

use App\Models\Trip;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShowTripTest extends TestCase
{
    use RefreshDatabase;

    protected $uri = "api/v1/trips/";

    public function test_trip_list(): void
    {
        $trips = Trip::factory()->count(5)->create();

        $this->getJson($this->uri.$trips[3]->id)->assertOk()
            ->assertJsonPath('data.status', $trips[3]['status']->value)
            ->assertJsonPath('data.order_id', $trips[3]['order_id']);
    }
}
