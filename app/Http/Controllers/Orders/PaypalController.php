<?php

namespace App\Http\Controllers\Orders;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Gloudemans\Shoppingcart\Facades\Cart;

class PaypalController extends Controller
{
    public function __invoke(Order $order)
    {
        $this->authorize('view', $order);

        $order->loadMissing(['user', 'transaction', 'products']);

        Cart::instance('cart')->destroy();

        return view('payments/paypal-thankyou', compact('order'));
    }
}
