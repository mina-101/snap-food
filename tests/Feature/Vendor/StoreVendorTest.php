<?php

namespace Tests\Feature\Vendor;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StoreVendorTest extends TestCase
{
    use RefreshDatabase;
    protected $uri = "/api/v1/vendors/";

    public function test_vendor_stores_successfully(): void
    {
        $data = [
            'name' =>fake()->company
        ];
        $this->postJson($this->uri, $data)
            ->assertCreated()
            ->assertJsonPath('data.name', $data['name']);
        $this->assertDatabaseHas('vendors', $data);
    }

    public function test_vendor_doesnt_create_with_wrong_data(): void
    {
        $this->postJson($this->uri, [])
            ->assertStatus(422);
    }
}
