<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ProductRatingController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group.
|
*/

Route::middleware('auth')->group(function () {
    // Product Rating Routes
    // Route::post('/product-ratings', [ProductRatingController::class, 'store'])->name('api.product-ratings.store');
    // Route::delete('/product-ratings/{rating}', [ProductRatingController::class, 'destroy'])->name('api.product-ratings.destroy');
});

