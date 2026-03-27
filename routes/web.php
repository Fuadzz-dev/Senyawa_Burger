<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;

Route::get('/', [MenuController::class, 'index']);

Route::get('/menu', [MenuController::class, 'index']);

Route::get('/detail-menu/{id_menu}', [MenuController::class, 'detail']);

Route::get('/keranjang', [MenuController::class, 'keranjang']);

Route::get('/pembayaran', [MenuController::class, 'pembayaran']);

use App\Http\Controllers\PaymentController;
Route::post('/api/pembayaran/qris', [PaymentController::class, 'createQris']);
Route::get('/api/pembayaran/status/{reference}', [PaymentController::class, 'checkStatus']);