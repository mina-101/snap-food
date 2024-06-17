<?php

use App\Http\Controllers\Api\Agent\V1\AgentController;
use App\Http\Controllers\Api\Agent\V1\AssignDelayedOrderController;
use App\Http\Controllers\Api\DelayReport\V1\DelayReportController;
use App\Http\Controllers\Api\Order\V1\OrderController;
use App\Http\Controllers\Api\Trip\V1\TripController;
use App\Http\Controllers\Api\Vendor\V1\VendorController;
use Illuminate\Support\Facades\Route;

Route::prefix('/v1/')->group(function () {
    Route::apiResource('vendors', VendorController::class);
    Route::post('agents/assign', AssignDelayedOrderController::class);
    Route::apiResource('agents', AgentController::class);
    Route::apiResource('orders', OrderController::class);
    Route::apiResource('orders.trips', TripController::class)->except(['update'])->shallow();
    Route::apiResource('orders.delayReports', DelayReportController::class)->only(['store'])->shallow();
    Route::get('delayReports/report', [DelayReportController::class, 'report']);
});
