<?php

namespace App\Services\Vendor\V1;

use App\Models\Vendor;

class VendorService
{
    public function getList(): mixed
    {
        return Vendor::latest()->paginate(Vendor::PAGE_LIMIT);
    }

    public function store(array $vendorData): mixed
    {
        return Vendor::create($vendorData);
    }

    public function update(Vendor $vendor, array $vendorData): Vendor
    {
        $vendor->update($vendorData);

        return $vendor->refresh();
    }

    public function delete(Vendor $vendor): void
    {
        $vendor->delete();
    }

}
