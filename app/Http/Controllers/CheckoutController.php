<?php

namespace App\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function __invoke()
    {
        $content = Cart::instance('cart')->content();
        $subTotal = Cart::instance('cart')->subtotal();
        $tax = Cart::instance('cart')->tax();
        $total = Cart::instance('cart')->total();
        $user = auth()->user();

        return view('checkout/index', compact('user', 'content', 'subTotal', 'total', 'tax'));
    }
}
