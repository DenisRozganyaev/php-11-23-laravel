<?php

namespace App\Repositories\Contracts;

use App\Http\Requests\Products\CreateProductRequest;
use App\Models\Product;

interface ProductsRepositoryContract
{
    public function create(CreateProductRequest $request): Product|false;
}
