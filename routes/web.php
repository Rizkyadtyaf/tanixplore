<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductRatingController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard Routes
    Route::get('/dashboard', [ProductController::class, 'index'])->name('dashboard');

    Route::get('/about', function () {
        return view('about.index');
    })->name('about');
    Route::get('/privacy-policy', function () {
        return view('privacy-policy.index');
    })->name('privacy.policy');
    Route::get('/terms-of-use', function () {
        return view('terms-of-use.index');
    })->name('terms.of.use');

    Route::get('/product/shop', function () {
        return view('product.shop');
    })->name('product.shop');
    Route::get('/product/create', function () {
        return view('product.create');
    })->name('product.create');

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Product Routes
    Route::post('/product', [ProductController::class, 'store'])->name('product.store');
    Route::get('/product/index', [ProductController::class, 'index'])->name('product.index');
    Route::get('/product/shop', [ProductController::class, 'shop'])->name('product.shop');
    Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');

    Route::get('/product/{id}/edit', [ProductController::class, 'edit'])->name('product.edit');
    Route::put('/product/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::delete('/product/{id}', [ProductController::class, 'destroy'])->name('product.destroy');

    // Product Rating Routes
    Route::post('/product-ratings', [ProductRatingController::class, 'store'])->name('product.ratings.store');
    Route::delete('/product-ratings/{rating}', [ProductRatingController::class, 'destroy'])->name('product.ratings.destroy');
    Route::get('/products/{product}/check-rating', [ProductRatingController::class, 'checkRating'])->name('product.ratings.check');
    Route::get('/products/{product}/ratings', [ProductRatingController::class, 'index'])->name('product.ratings.index');
});

// Email Verification Routes
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill(); // Verifikasi email
    return redirect('/dashboard');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification(); // Kirim ulang email verifikasi
    return back()->with('status', 'A verification link has been sent to your email.');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

require __DIR__ . '/auth.php';
