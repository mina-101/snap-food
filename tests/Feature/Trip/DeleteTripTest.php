<?php

namespace Tests\Feature\Trip;

use App\Models\Trip;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeleteTripTest extends TestCase
{
    use RefreshDatabase;

    protected $uri = 'api/v1/trips/';

    public function test_trip_deletes_successfully(): void
    {
        $trip = Trip::factory()->create();
        $this->delete($this->uri.$trip->id)->assertOk();
        $this->assertDatabaseMissing('trips', $trip->toArray());
        $this->assertModelMissing($trip);
    }
}
