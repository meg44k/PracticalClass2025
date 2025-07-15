<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameController;

Route::post('/api/game-result', [GameController::class, 'store']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/', function () {
    return view('title');
});
Route::get('/result', function () {
    return view('result');
});

Route::get('/mypage', [GameController::class, 'showMypage'])->middleware('auth')->name('mypage');

Route::get('/settings', function () {
    return view('settings');
});

Route::get('/battle', function () {
    return view('battle');
});

Route::get('/main', function () {
    return view('main');
})->middleware(['auth', 'verified'])->name('main');
