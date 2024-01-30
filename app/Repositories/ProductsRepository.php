<?php

namespace App\Repositories;

use App\Http\Requests\Products\CreateProductRequest;
use App\Http\Requests\Products\EditProductRequest;
use App\Models\Product;
use App\Repositories\Contracts\ImageRepositoryContract;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductsRepository implements Contracts\ProductsRepositoryContract
{
    public function __construct(protected ImageRepositoryContract $imageRepo)
    {
    }

    public function create(CreateProductRequest $request): Product|false
    {
        try {
            DB::beginTransaction();

            $data = $this->formRequestData($request);
            $data['attributes'] = $this->addSlugToAttributes($data['attributes']);
            $product = Product::create($data['attributes']);

            $this->setProductData($product, $data);

            DB::commit();

            return $product;
        } catch (\Exception $exception) {
            DB::rollBack();
            logs()->warning($exception);
            return false;
        }
    }

    public function update(Product $product, EditProductRequest $request): bool
    {
        try {
            DB::beginTransaction();

            $data = $this->formRequestData($request);

            if ($data['attributes']['title'] && $data['attributes']['title'] !== $product->title) {
                $data['attributes'] = $this->addSlugToAttributes($data['attributes']);
            }

            $product->update($data['attributes']);

            $this->setProductData($product, $data);

            DB::commit();

            return true;
        } catch (\Exception $exception) {
            DB::rollBack();
            logs()->warning($exception);
            return false;
        }
    }

    protected function setProductData(Product $product, array $data): void
    {
        if ($product->categories()->exists()) {
            $product->categories()->detach();
        }

        if (!empty($data['categories'])) {
            $product->categories()->attach($data['categories']);
        }

        if (!empty($data['attributes']['images'])) {
            $this->imageRepo->attach(
                $product,
                'images',
                $data['attributes']['images'],
                $product->slug
            );
        }
    }

    protected function formRequestData(CreateProductRequest|EditProductRequest $request): array
    {
        return [
            'attributes' => collect($request->validated())->except(['categories'])->toArray(),
            'categories' => $request->get('categories', [])
        ];
    }

    protected function addSlugToAttributes(array $attributes): array
    {
        return array_merge(
            ['slug' => Str::of($attributes['title'])->slug()->value()],
            $attributes
        );
    }
}
