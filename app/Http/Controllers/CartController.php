<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $content = Cart::instance('cart')->content();
        $subTotal = Cart::instance('cart')->subtotal();
        $tax = Cart::instance('cart')->tax();
        $total = Cart::instance('cart')->total();

        return view('cart/index', compact('content', 'subTotal', 'total', 'tax'));
    }

    public function add(Product $product)
    {
        Cart::instance('cart')
            ->add($product->id, $product->title, 1, $product->price)
            ->associate(Product::class);

        notify()->success("Product was added to the cart");

        return redirect()->back();
    }

    public function remove(Request $request)
    {
        $data = $request->validate([
            'rowId' => ['required', 'string']
        ]);

        Cart::instance('cart')->remove($data['rowId']);

        notify()->success("Product was removed from the cart");

        return redirect()->back();
    }

    public function countUpdate(Request $request, Product $product)
    {
        $data = $request->validate([
            'rowId' => ['required', 'string'],
            'count' => ['required', 'numeric', 'min:1']
        ]);

        if ($product->quantity < $data['count']) {
            notify()->warning("We do not have this quantity of product");

            return redirect()->back();
        }

        Cart::instance('cart')->update($data['rowId'], $data['count']);

        notify()->success("Product count was updated");

        return redirect()->back();
    }
}
