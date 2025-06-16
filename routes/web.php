<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('title');
});

Route::get('/registor', function () {
    return view('registor');
});

Route::get('/login', function () {
    return view('login');
});

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

Route::get('/registor', function () {
    return view('registor');
});
