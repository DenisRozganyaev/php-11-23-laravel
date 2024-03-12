<?php

namespace App\Observers;

use App\Jobs\Products\ExistsJob;
use App\Jobs\Products\PriceDownJob;
use App\Models\Product;
use App\Services\Contract\FileStorageServiceContract;
use Illuminate\Support\Facades\Storage;

class ProductObserver
{
    public function updated(Product $product): void
    {
        if ($product->finalPrice < $product->getOriginal('finalPrice')) {
            PriceDownJob::dispatch($product);
        }
        if ($product->quantity > 0 && $product->getOriginal('quantity') < 1) {
            ExistsJob::dispatch($product);
        }
    }

    public function deleted(Product $product): void
    {
        if ($product->images) {
            $product->images->each->delete();
        }

        app(FileStorageServiceContract::class)->remove($product->thumbnail);
        Storage::deleteDirectory("public/$product->slug");
    }
}
