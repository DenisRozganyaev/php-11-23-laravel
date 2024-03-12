<?php

use App\Models\Order;
use App\Models\Product;
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

Route::get('test', function() {
    $user = auth()->user();
    $product = Product::find(41);

    dd($user->wishes()->where('product_id', $product->id)->wherePivot('exist', false)->exists());
});
Route::get('/', \App\Http\Controllers\HomeController::class)->name('home');

Route::resource('products', \App\Http\Controllers\ProductsController::class)->only(['index', 'show']);
Route::resource('categories', \App\Http\Controllers\CategoriesController::class)->only(['index', 'show']);

Auth::routes();

Route::name('ajax.')->prefix('ajax')->middleware('auth')->group(function() {
   Route::group(['role:admin|moderator'], function() {
       Route::post('products/{product}/images', [\App\Http\Controllers\Ajax\Products\ImagesController::class, 'store'])->name('products.images.store');
       Route::delete('images/{image}', \App\Http\Controllers\Ajax\RemoveImagesController::class)->name('images.destroy');
   });

   Route::prefix('paypal')->name('paypal.')->group(function() {
       Route::post('order/create', [\App\Http\Controllers\Ajax\Payments\PaypalController::class, 'create'])->name('create');
       Route::post('order/{orderId}/capture', [\App\Http\Controllers\Ajax\Payments\PaypalController::class, 'capture'])->name('capture');
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

Route::middleware(['auth'])->group(function() {
    Route::get('checkout', \App\Http\Controllers\CheckoutController::class)->name('checkout');
    Route::get('orders/{order}/paypal/thank-you', \App\Http\Controllers\Orders\PaypalController::class);
    Route::get('invoices/{order}', \App\Http\Controllers\InvoiceController::class)->name('invoice');
    Route::post('wishlist/{product}', [\App\Http\Controllers\WishListController::class, 'add'])->name('wishlist.add');
    Route::delete('wishlist/{product}', [\App\Http\Controllers\WishListController::class, 'remove'])->name('wishlist.remove');
});

Route::name('callbacks.')->prefix('callback')->group(function() {
    Route::get('telegram', \App\Http\Controllers\Callbacks\JoinTelegramCallback::class)
        ->middleware(['role:admin'])
        ->name('telegram');
});
