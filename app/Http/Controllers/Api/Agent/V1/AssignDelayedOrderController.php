<?php

namespace App\Http\Controllers\Api\Agent\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Agent\V1\AssignDelayedOrderRequest;
use App\Services\Agent\V1\AssignDelayedOrderService;
use Illuminate\Http\JsonResponse;

class AssignDelayedOrderController extends Controller
{
    public function __construct(public AssignDelayedOrderService $service)
    {
    }

    public function __invoke(AssignDelayedOrderRequest $request): JsonResponse
    {
        $result = $this->service->assignDelayedOrderToAgent($request->validated());
        if ($result['status'] == 422) {
            return $this->unprocessable($result);
        }

        return $this->created();
    }
}
