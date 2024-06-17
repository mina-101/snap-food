<?php

namespace App\Http\Controllers\Api\DelayReport\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\DelayReport\V1\StoreDelayReportRequest;
use App\Http\Requests\DelayReport\V1\UpdateDelayReportRequest;
use App\Http\Resources\AgentResource;
use App\Http\Resources\DelayReportResource;
use App\Models\DelayReport;
use App\Models\Order;
use App\Services\DelayReport\V1\DelayReportService;

class DelayReportController extends Controller
{
    public function __construct(public DelayReportService $delayReportService)
    {
    }

    public function index()
    {
        //
    }


    public function store(Order $order)
    {
        return $this->created(new DelayReportResource($this->delayReportService->store($order)));
    }


    public function show(DelayReport $delayReport)
    {
        //
    }
}
