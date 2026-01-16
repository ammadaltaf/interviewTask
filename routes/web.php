<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::middleware(['auth'])->group(function () {

    // Route::get('/dashboard', function () {
    //     return view('dashboard');
    // })->name('dashboard');

    // Products pages
    Route::Resource('products', ProductController::class)->names('products');

    // Orders pages
    Route::get('/orders', [OrderController::class, 'index'])
        ->name('orders.index');
});

Route::get('/login', function () {
    return 'Login page';
})->name('login');

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');