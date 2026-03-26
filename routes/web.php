<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;

Route::get('/', function () {
    return view('Menu');
});

Route::get('/menu', [MenuController::class, 'index']);

Route::get('/detail-menu', function () {
    return view('Detail_Menu');
});
