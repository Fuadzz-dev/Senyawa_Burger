<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;

Route::get('/', [MenuController::class, 'index']);

Route::get('/menu', [MenuController::class, 'index']);

Route::get('/detail-menu/{id_menu}', [MenuController::class, 'detail']);

Route::get('/keranjang', [MenuController::class, 'keranjang']);

Route::get('/pembayaran', [MenuController::class, 'pembayaran']);

use App\Http\Controllers\PaymentController;
Route::post('/api/pembayaran/checkout', [PaymentController::class, 'processCheckout']);
Route::get('/api/pembayaran/status/{reference}', [PaymentController::class, 'checkStatus']);
Route::get('/menunggu-kasir', [PaymentController::class, 'menungguKasir']);
Route::get('/api/pesanan/status/{id}', [PaymentController::class, 'checkLocalStatus']);