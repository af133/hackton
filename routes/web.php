<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LandingpageController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\CommunityController;
use App\Http\Controllers\KreditController;
use App\Http\Controllers\DiscussionController;

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
    Route::get('/profile/mission', [ProfileController::class,'mission'])->name('profile.mission');

    // Halaman Kelas & Pelajaran
    Route::get('/kelas', [CourseController::class, 'show'])->name('kelas.show');
    Route::get('/kelas/detail/{kelasId}', [CourseController::class,'showkelas'])->name('kelas.detail');
    Route::post('kelas/{id}/toggle-status', [CourseController::class, 'toggleStatus'])->name('kelas.toggleStatus');

    Route::get('/kelas/create', [CourseController::class,'showcreate'])->name('kelas.create');
    Route::post('/kelas/create', [CourseController::class,'store'])->name('kelas.store');
    
    Route::get('/kelas/{kelasId}/mulai', [CourseController::class,'mulai'])->name('kelas.mulai');
    Route::get('/kelas/{kelas}/modul/{modul}/lesson/{lesson}', [LessonController::class, 'show'])->name('lesson.show');
    Route::post('/lesson/{lesson}/discussion', [DiscussionController::class, 'store'])->name('discussion.store');
    Route::post('/kelas/{id}/beli', [CourseController::class, 'beli'])->name('kelas.beli');
    Route::get('/kelas-saya', [CourseController::class, 'kelasSaya'])->name('kelas.saya');

   Route::post('/kelas/{id}/rating', [CourseController::class, 'beriRating'])->name('kelas.beriRating');


    Route::get('/kelas/detail/manajemen',[CourseController::class,'showdetail']);
    Route::get('/kelas/modul/{id}', [LessonController::class, 'index'])->name('modul.show');

    Route::get('/kelas/modul/create/{kelasId}', [LessonController::class, 'showcreate'])->name('modul.create');
    Route::post('/modul/store', [LessonController::class, 'store'])->name('modul.store');
    Route::get('/lessons/{lesson}/{action}', [LessonController::class, 'handleFile'])
    ->where('action', 'preview|download')
    ->name('lessons.file');

    Route::get('/sosial',[SocialController::class,'index'])->name('sosial');
    Route::get('/sosial/detail',[SocialController::class,'showdetail'])->name('sosial.show');
    Route::get('/sosial/detail/post',[SocialController::class,'showpost'])->name('sosial.post');

    Route::post('/communities', [CommunityController::class,'store'])->name('communities.store');
    Route::post('/communities/{chat}/join', [CommunityController::class,'join'])->name('communities.join');
    Route::post('/communities/{chat}/leave', [CommunityController::class,'leave'])->name('communities.leave');
    Route::post('/communities/{chat}/send', [CommunityController::class,'sendMessage'])->name('communities.send');

    Route::get('/kredit',[KreditController::class,'index'])->name('skill-credit');
    Route::get('/kredit/history',[KreditController::class,'history'])->name('skill-credit.history');
});
