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
use App\Http\Controllers\LiveClassController;
use App\Http\Controllers\DiscussionController;
use App\Http\Controllers\MidtransController;

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

    Route::get('/kelas', [CourseController::class, 'show'])->name('kelas.show');
    Route::get('/kelas/detail/{kelasId}', [CourseController::class,'showkelas'])->name('kelas.detail');
    Route::post('kelas/{id}/toggle-status', [CourseController::class, 'toggleStatus'])->name('kelas.toggleStatus');
    Route::post('kelas/modul/liveclass',[CourseController::class,'liveClassStore'])->name('kelas.live.store');
    Route::post('komunitas/{id}/liveclass/store/event', [CourseController::class, 'liveCommunityStore'])->name('events.store');


    Route::get('/live/{room}/{kelasId}/{jenisLive}', [LiveClassController::class, 'show'])->name('live.show');

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
    Route::get('/sosial', [SocialController::class, 'index'])->name('sosial');

    Route::get('/sosial/detail/{id}', [SocialController::class, 'showdetail'])->name('sosial.show');

    // ➕ Buat komunitas baru
    Route::get('/sosial/create', [SocialController::class, 'create'])->name('sosial.create');

    // 📬 Form kirim postingan umum (jika ada halaman khusus)
    Route::get('/sosial/detail/post', [SocialController::class, 'showpost'])->name('sosial.post');

    // ✅ Gabung komunitas
    Route::post('/sosial/{id}/join', [SocialController::class, 'join'])->name('sosial.join');

    // ❌ Keluar komunitas
    Route::post('/sosial/{id}/leave', [SocialController::class, 'leave'])->name('sosial.leave');

    // 📝 Kirim post baru di dalam komunitas
    Route::post('/sosial/{id}/post', [SocialController::class, 'storePost'])->name('sosial.post.store');

    // 📄 Lihat 1 postingan dan semua reply-nya
    Route::get('/sosial/post/{id}', [SocialController::class, 'showSinglePost'])->name('sosial.post.detail');

    // 💬 Balas postingan
    Route::post('/sosial/post/{id}/reply', [SocialController::class, 'reply'])->name('sosial.post.reply');

    Route::post('/communities', [CommunityController::class,'store'])->name('communities.store');
    Route::post('/communities/{community_id}/join', [CommunityController::class,'join'])->name('communities.join');
    Route::post('/communities/{chat}/leave', [CommunityController::class,'leave'])->name('communities.leave');
    Route::post('/communities/{chat}/send', [CommunityController::class,'sendMessage'])->name('communities.send');

    Route::get('/kredit',[KreditController::class,'index'])->name('skill-credit');
    Route::get('/kredit/history',[KreditController::class,'history'])->name('skill-credit.history');

    route::get('/live-class', [CourseController::class, 'liveClass'])->name('kelas.live');
    Route::post('/midtrans/create', [MidtransController::class, 'create'])->name('midtrans.create');
    Route::post('/user/add-coin', [MidtransController   ::class, 'addCoin'])->name('user.add-coin');

});
