<?php

namespace App\Http\Controllers\Ajax\Payments;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateOrderRequest;
use App\Services\Contract\PaypalServiceContract;
use Illuminate\Http\Request;

class PaypalController extends Controller
{
    public function create(CreateOrderRequest $request)
    {
        return app(PaypalServiceContract::class)->create($request);
    }

    public function capture(string $vendorOrderId)
    {
        return app(PaypalServiceContract::class)->capture($vendorOrderId);
    }
}
