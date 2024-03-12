<?php

namespace App\Listeners;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Auth\Events\Login;

class UserLoginListener
{
    public function handle(Login $event): void
    {
        Cart::instance('cart')->restore($event->user->id . "_cart");
    }
}
