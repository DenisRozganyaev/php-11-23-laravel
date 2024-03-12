<?php

namespace App\Listeners;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Auth\Events\Logout;

class UserLogoutListener
{
    /**
     * Handle the event.
     */
    public function handle(Logout $event): void
    {
        if (Cart::instance('cart')->count() > 0) {
            Cart::instance('cart')->store($event->user->id.'_cart');
        }
    }
}
