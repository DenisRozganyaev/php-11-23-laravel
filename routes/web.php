<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', \App\Http\Controllers\HomeController::class)->name('home');

Route::resource('products', \App\Http\Controllers\ProductsController::class)->only(['index', 'show']);
Route::resource('categories', \App\Http\Controllers\CategoriesController::class)->only(['index', 'show']);

Auth::routes();

Route::name('ajax.')->prefix('ajax')->middleware('auth')->group(function() {
   Route::group(['role:admin|moderator'], function() {
       Route::post('products/{product}/images', [\App\Http\Controllers\Ajax\Products\ImagesController::class, 'store'])->name('products.images.store');
       Route::delete('images/{image}', \App\Http\Controllers\Ajax\RemoveImagesController::class)->name('images.destroy');
   });
});

Route::name('admin.')->prefix('admin')->middleware(['role:admin|moderator'])->group(function() {
    Route::get('dashboard', \App\Http\Controllers\Admin\DashboardController::class)->name('dashboard'); // admin.dashboard
    Route::resource('categories', \App\Http\Controllers\Admin\CategoriesController::class)
        ->except(['show']);
    Route::resource('products', \App\Http\Controllers\Admin\ProductsController::class)
        ->except(['show']);
});

Route::name('cart.')->prefix('cart')->group(function() {
   Route::get('/', [\App\Http\Controllers\CartController::class, 'index'])->name('index');
   Route::post('{product}', [\App\Http\Controllers\CartController::class, 'add'])->name('add');
   Route::delete('/', [\App\Http\Controllers\CartController::class, 'remove'])->name('remove');
   Route::post('{product}/count', [\App\Http\Controllers\CartController::class, 'countUpdate'])->name('count.update');
});
