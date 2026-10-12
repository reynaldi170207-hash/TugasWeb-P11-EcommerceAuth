<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EagerLoadingDemoController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProductController::class, 'index'])->name('home');
Route::get('/products/{product:slug}', [ProductController::class, 'show'])->name('products.show');

Route::middleware('auth')->group(function () {
    Route::view('/dashboard', 'dashboard')->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::post('/products/{product:slug}/orders', [OrderController::class, 'store'])->name('orders.store');

    Route::resource('posts', PostController::class)->except('show');
});

Route::middleware(['auth', 'admin'])
    ->prefix('manage')
    ->name('manage.')
    ->group(function () {
        Route::get('/', DashboardController::class)->name('dashboard');
        Route::get('/eager-loading', EagerLoadingDemoController::class)->name('eager');
    });

require __DIR__.'/auth.php';
