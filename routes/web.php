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

<<<<<<< HEAD
Route::get('/registor', function () {
    return view('registor');
=======
Route::get('/main', function () {
    return view('main');
>>>>>>> 5a06fc95e861208c8788021a3f7ac36ec8c067ab
});
