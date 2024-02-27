<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function __invoke()
    {
        return view('account/wishlist', ['products' => auth()->user()->wishes()->paginate(5)]);
    }
}
