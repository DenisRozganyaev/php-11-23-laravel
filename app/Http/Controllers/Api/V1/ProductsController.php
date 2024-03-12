<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Products\ProductsCollection;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Product::class, 'product');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with(['categories', 'images'])
            ->orderByDesc('id')
            ->paginate(5);

        return (new ProductsCollection($products))
            ->additional([
                'meta_data' => [
                    'total' => $products->total(),
                    'per_page' => $products->perPage(),
                    'page' => $products->currentPage(),
                    'to' => $products->lastPage(),
                    'path' => $products->path(),
                    'next' => $products->nextPageUrl()
                ]
            ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        dd('test');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
