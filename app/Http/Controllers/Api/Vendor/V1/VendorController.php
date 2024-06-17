<?php

namespace App\Http\Controllers\Api\Vendor\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Vendor\V1\StoreVendorRequest;
use App\Http\Requests\Vendor\V1\UpdateVendorRequest;
use App\Http\Resources\VendorResource;
use App\Models\Vendor;
use App\Services\Vendor\V1\VendorService;

class VendorController extends Controller
{
    public function __construct(public VendorService $vendorService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->ok(VendorResource::collection($this->vendorService->getList()));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVendorRequest $request)
    {
        return $this->created(new VendorResource($this->vendorService->store($request->validated())));
    }

    /**
     * Display the specified resource.
     */
    public function show(Vendor $vendor)
    {
        return $this->ok(new VendorResource($vendor));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVendorRequest $request, Vendor $vendor)
    {
        return $this->ok(new VendorResource($this->vendorService->update($vendor, $request->validated())));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vendor $vendor)
    {
        $this->vendorService->delete($vendor);

        return $this->ok();
    }
}
