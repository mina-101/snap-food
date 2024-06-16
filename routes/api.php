<?php

use App\Http\Controllers\Api\Agent\V1\AgentController;
use App\Http\Controllers\Api\Order\V1\OrderController;
use App\Http\Controllers\Api\Vendor\V1\VendorController;
use Illuminate\Support\Facades\Route;

Route::prefix('/v1/')->group(function () {
    Route::apiResource('vendors', VendorController::class);
    Route::apiResource('agents', AgentController::class);
    Route::apiResource('orders', OrderController::class);
});

