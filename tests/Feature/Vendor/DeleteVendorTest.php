<?php

namespace Tests\Feature\Vendor;

use App\Models\Vendor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeleteVendorTest extends TestCase
{
    use RefreshDatabase;

    protected $uri = "/api/v1/vendors/";

    public function test_vendor_deletes_successfully(): void
    {
        $vendor = Vendor::factory()->create();
        $this->delete($this->uri . $vendor->id)->assertOk();
        $this->assertDatabaseMissing('vendors', $vendor->toArray());
        $this->assertModelMissing($vendor);
    }
}
