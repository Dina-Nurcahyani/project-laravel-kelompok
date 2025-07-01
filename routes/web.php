<?php

use App\Http\Controllers\PasienController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/login', function () {
    return view('login');
});

Route::get('/register', [UserController::class, 'showRegister'])->middleware('guest');
Route::post('/register', [UserController::class, 'register']);

Route::middleware('auth')->group(function () {
    Route::get('/', [UserController::class, 'home'])->name('home');

    Route::get('/pegawai/data', [UserController::class, 'data'])->name('pegawai.data');
    Route::resource('pegawai', UserController::class);

    Route::get('/pasien/data', [PasienController::class, 'data'])->name('pasien.data');
    Route::resource('pasien', PasienController::class);
});

Route::get('/login', [UserController::class, 'showLogin'])
    ->middleware('guest')
    ->name('login');
Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout']);

Route::post('/logout', [UserController::class, 'logout'])->name('logout');
