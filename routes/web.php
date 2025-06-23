<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegistorController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LoginController::class, 'view']);


Route::get('/registor', [RegistorController::class,'view']);

Route::get('/login', [LoginController::class,'view']);

Route::get('/result', function () {
    return view('result');
});

Route::get('/mypage', function () {
    return view('mypage');
});

Route::get('/settings', function () {
    return view('settings');
});

Route::get('/battle', function () {
    return view('battle');
});

Route::get('/main', function () {
    return view('main');
});
