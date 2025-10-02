<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LandingpageController;
use App\Http\Controllers\SocialController;

Route::get('/', [LandingpageController::class, 'index'])->name('landing');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');


Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/mission',[ProfileController::class,'mission'])->name('profile.mission');

    // Halaman Kelas & Pelajaran
    // Menggunakan Route Model Binding dengan 'slug' untuk URL yang bersih.
    Route::get('/kelas', [CourseController::class, 'show'])->name('kelas.show');
    Route::get('/kelas/detail', [CourseController::class,'showkelas'])->name('detailkelas.show');
    Route::get('/kelas/create', [CourseController::class,'showcreate']);
    Route::get('/kelas/detail/manajemen',[CourseController::class,'showdetail']);
    Route::get('/kelas/modul', [LessonController::class, 'show'])->name('modul.show');
    Route::get('/kelas/modul/create', [LessonController::class, 'showcreate']);

    Route::get('/sosial',[SocialController::class,'index']);
    Route::get('/sosial/detail',[SocialController::class,'showdetail']);
    Route::get('/sosial/detail/post',[SocialController::class,'showpost']);


});
