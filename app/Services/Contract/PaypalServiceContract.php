<?php

namespace App\Services\Contract;

use App\Http\Requests\CreateOrderRequest;

interface PaypalServiceContract
{
    public function create(CreateOrderRequest $request);

    public function capture(string $vendorOrderId);
}
