<?php

namespace App\Http\Controllers\Api\Order\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\V1\StoreOrderRequest;
use App\Http\Requests\Order\V1\UpdateOrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Services\Order\V1\OrderService;
use Illuminate\Http\JsonResponse;

class OrderController extends Controller
{
    public function __construct(public OrderService $orderService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return $this->ok(OrderResource::collection($this->orderService->getList()));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request): JsonResponse
    {
        return $this->created(new OrderResource($this->orderService->store($request->validated())));
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order): JsonResponse
    {
        return $this->ok(new OrderResource($order));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, Order $order): JsonResponse
    {
        return $this->ok(new OrderResource($this->orderService->update($order, $request->validated())));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order): JsonResponse
    {
        $this->orderService->delete($order);

        return $this->ok();
    }
}
