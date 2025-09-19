<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('homepage');
});

Route::name('auth.')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('view.login');
    Route::post('/login', [AuthController::class, 'login'])->name('login');

    Route::get('/register', [AuthController::class, 'showRegister'])->name('view.register');
    Route::post('/register', [AuthController::class, 'register'])->name('register');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

});

Route::middleware(['auth'])->name('dashboard.')->group(function () {
    Route::get('/dashboard',[DashboardController::class,'index']);
});
