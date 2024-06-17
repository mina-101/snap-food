<?php

namespace Tests\Feature\Vendor;

use App\Models\Vendor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShowVendorTest extends TestCase
{
    use RefreshDatabase;

    protected $uri = '/api/v1/vendors/';

    public function test_vendor_list(): void
    {
        $vendors = Vendor::factory()->count(5)->create();
        $this->getJson($this->uri.$vendors[3]->id)->assertOk()
            ->assertJsonPath('data.name', $vendors[3]['name']);
    }
}
