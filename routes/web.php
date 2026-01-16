<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::view('/login','auth.login')->name('login');
Route::view('/products/create','products.create')->middleware('auth:sanctum');

Route::get('/login', function () {
    return 'Login page';
})->name('login');

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
