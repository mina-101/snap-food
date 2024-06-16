<?php

namespace App\Http\Controllers\Api\Trip\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Trip\V1\StoreTripRequest;
use App\Http\Requests\Trip\V1\UpdateTripRequest;
use App\Http\Resources\TripResource;
use App\Models\Order;
use App\Models\Trip;
use App\Services\Trip\V1\TripService;
use Illuminate\Http\JsonResponse;

class TripController extends Controller
{
    public function __construct(public TripService $tripService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Order $order): JsonResponse
    {
        return $this->ok(new TripResource($this->tripService->getList($order)));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTripRequest $request, Order $order): JsonResponse
    {
        return $this->created(new TripResource($this->tripService->store($order, $request->validated())));
    }

    /**
     * Display the specified resource.
     */
    public function show(Trip $trip): JsonResponse
    {
        return $this->ok(new TripResource($trip));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Trip $trip): JsonResponse
    {
        $this->tripService->delete($trip);

        return $this->ok();
    }
}
