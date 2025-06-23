<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('title');
});

Route::get('/register', [RegisterController::class,'view']);

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
