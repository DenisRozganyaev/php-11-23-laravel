<?php

namespace App\Providers;

use App\Repositories\Contracts\ImageRepositoryContract;
use App\Repositories\Contracts\OrderRepositoryContract;
use App\Repositories\Contracts\ProductsRepositoryContract;
use App\Repositories\ImageRepository;
use App\Repositories\OrderRepository;
use App\Repositories\ProductsRepository;
use App\Services\Contract\FileStorageServiceContract;
use App\Services\Contract\InvoicesServiceContract;
use App\Services\Contract\PaypalServiceContract;
use App\Services\FileStorageService;
use App\Services\InvoicesService;
use App\Services\PaypalService;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public array $bindings = [
        FileStorageServiceContract::class => FileStorageService::class,
        ProductsRepositoryContract::class => ProductsRepository::class,
        ImageRepositoryContract::class => ImageRepository::class,
        PaypalServiceContract::class => PaypalService::class,
        OrderRepositoryContract::class => OrderRepository::class,
        InvoicesServiceContract::class => InvoicesService::class,
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
