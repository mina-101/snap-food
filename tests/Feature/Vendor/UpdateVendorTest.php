<?php

namespace Tests\Feature\Vendor;

use App\Models\Vendor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateVendorTest extends TestCase
{
    use RefreshDatabase;

    protected $uri = '/api/v1/vendors/';

    public function test_vendor_updates_successfully(): void
    {
        $vendor = Vendor::factory()->create();
        $data = [
            'name' => fake()->company,
        ];
        $this->putJson($this->uri.$vendor->id, $data)
            ->assertOk()
            ->assertJsonPath('data.name', $data['name']);
        $this->assertDatabaseHas('vendors', $data);
        $this->assertModelExists($vendor->refresh());
    }

    public function test_vendor_doesnt_update_with_wrong_data(): void
    {
        $vendor = Vendor::factory()->create();
        $this->putJson($this->uri.$vendor->id, [])
            ->assertStatus(422);
    }
}
