<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('auth', \App\Http\Controllers\Api\AuthController::class)->name('auth');

Route::prefix('v1')->name('v1.')->middleware('auth:sanctum')->group(function() {
    require_once __DIR__ . '/versions/v1.php';
});
