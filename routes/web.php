<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;

Route::get('/', [MenuController::class, 'index']);

Route::get('/menu', [MenuController::class, 'index']);

Route::get('/detail-menu', function () {
    return view('Detail_Menu');
});