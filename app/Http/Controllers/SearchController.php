<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        if (!$request->has('query')) {
            notify()->error('Empty search value');
            return redirect()->back();
        }

        $products = Product::search($request->get('query'))->paginate(2);

        return view('search/index', compact('products'));
    }
}
