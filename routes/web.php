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

Route::get('/', [\App\Http\Controllers\CatalogController::class, 'index'])->name('catalog');
Route::get('/basket', [\App\Http\Controllers\BasketController::class, 'index'])->name('basket');
Route::get('/orders', [\App\Http\Controllers\OrdersController::class, 'index'])->name('orders');
