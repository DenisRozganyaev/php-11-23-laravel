<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class WishListController extends Controller
{
    public function add(Product $product, Request $request)
    {
        $data = $this->validateRequest($request);
        auth()->user()->addToWish($product, $data['type']);

        notify()->success('Product was added to you wish list', position: 'topRight');

        return redirect()->back();
    }

    public function remove(Product $product, Request $request)
    {
        $data = $this->validateRequest($request);
        auth()->user()->removeFromWish($product, $data['type']);

        notify()->success('Product was removed from your wish list', position: 'topRight');
        return redirect()->back();
    }

    protected function validateRequest(Request $request): array
    {
        return $request->validate([
            'type' => ['required', Rule::In(['price', 'exist'])]
        ]);
    }
}
