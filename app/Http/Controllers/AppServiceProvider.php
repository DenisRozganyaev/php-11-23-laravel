<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\ImageRepositoryContract;
use App\Repositories\Contracts\ProductsRepositoryContract;
use App\Repositories\ImageRepository;
use App\Repositories\ProductsRepository;
use App\Services\Contract\FileStorageServiceContract;
use App\Services\FileStorageService;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public array $bindings = [
        FileStorageServiceContract::class => FileStorageService::class,
        ProductsRepositoryContract::class => ProductsRepository::class,
        ImageRepositoryContract::class => ImageRepository::class,
    ];

    /**
     * Register any application services.
     */
    public function register(): void
    {

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
    }
}
