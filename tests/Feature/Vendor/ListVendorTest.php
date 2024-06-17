<?php

namespace Tests\Feature\Vendor;

use App\Models\Vendor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ListVendorTest extends TestCase
{
    use RefreshDatabase;

    protected $uri = '/api/v1/vendors/';

    public function test_vendor_list(): void
    {
        $vendors = Vendor::factory()->count(5)->create();
        $this->getJson($this->uri)->assertOk()
            ->assertJsonCount(5, 'data')
            ->assertJsonPath('data.0.name', $vendors[0]['name'])
            ->assertJsonPath('data.4.name', $vendors[4]['name']);
    }

    public function test_vendor_list_pagination(): void
    {
        Vendor::factory()->count(20)->create();
        $this->getJson($this->uri)->assertOk()
            ->assertJsonCount(Vendor::PAGE_LIMIT, 'data');
    }
}
