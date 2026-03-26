<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;

Route::get('/', [MenuController::class, 'index']);

Route::get('/menu', [MenuController::class, 'index']);

Route::get('/detail-menu/{id_menu}', [MenuController::class, 'detail']);

Route::get('/keranjang', [MenuController::class, 'keranjang']);