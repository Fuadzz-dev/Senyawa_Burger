<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\StokBahanController;
use App\Http\Controllers\OwnerMenuController;


Route::get('/', [MenuController::class, 'index']);

Route::get('/menu', [MenuController::class, 'index']);

Route::get('/detail-menu/{id_menu}', [MenuController::class, 'detail']);

Route::get('/keranjang', [MenuController::class, 'keranjang']);

Route::get('/pembayaran', [MenuController::class, 'pembayaran']);


Route::post('/api/pembayaran/checkout', [PaymentController::class, 'processCheckout']);
Route::get('/api/pembayaran/status/{reference}', [PaymentController::class, 'checkStatus']);
Route::get('/menunggu-kasir', [PaymentController::class, 'menungguKasir']);
Route::get('/api/pesanan/status/{id}', [PaymentController::class, 'checkLocalStatus']);
Route::post('/api/duitku/callback', [PaymentController::class, 'callback']);
Route::post('/api/pembayaran/simulate-success/{reference}', [PaymentController::class, 'simulateSuccess']);

// Kasir
Route::get('/kasir/antrian', [KasirController::class, 'antrian']);
Route::get('/kasir/detail/{id}', [KasirController::class, 'detail']);
Route::post('/kasir/detail/{id}/selesai', [KasirController::class, 'selesai']);
Route::post('/kasir/detail/{id}/lunas', [KasirController::class, 'lunas']);
Route::post('/kasir/detail/{id}/unlunas', [KasirController::class, 'unlunas']);

// Owner
Route::get('/owner/bahan', [StokBahanController::class, 'index']);
Route::post('/owner/bahan', [StokBahanController::class, 'store']);
Route::put('/owner/bahan/{id}', [StokBahanController::class, 'update']);
Route::delete('/owner/bahan/{id}', [StokBahanController::class, 'destroy']);

Route::get('/owner/menu', [OwnerMenuController::class, 'index']);
Route::delete('/owner/menu/{id}', [OwnerMenuController::class, 'destroy']);

