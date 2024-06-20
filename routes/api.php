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
Route::post('/order/buy/{product}', [\App\Http\Controllers\Api\OrdersController::class, 'buy'])->name('api.order.buy');
Route::post('/order/confirm/{order}', [\App\Http\Controllers\Api\OrdersController::class, 'confirm'])->name('api.order.confirm');
