<?php

namespace App\Http\Controllers\Api\DelayReport\V1;

use App\Http\Controllers\Controller;
use App\Models\DelayReport;
use App\Models\Order;
use App\Services\DelayReport\V1\DelayReportService;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DelayReportController extends Controller
{
    public function __construct(public DelayReportService $delayReportService)
    {
    }

    public function store(Order $order)
    {
        $result = $this->delayReportService->store($order);
        if ($result['status'] == 422) {
            return $this->unprocessable();
        }

        return $this->created();
    }

    public function report()
    {
        return DelayReport::select('vendor_id', DB::raw('SUM(delay) AS total'))
            ->join('orders', 'orders.id', '=', 'delay_reports.order_id')
            ->join('vendors', 'orders.vendor_id', '=', 'vendors.id')
            ->whereDate('delay_reports.created_at', '>', Carbon::now()->subDays(7))
            ->orderByRaw('SUM(delay_reports.delay) desc')
            ->groupBy('orders.vendor_id')->get();

    }
}
