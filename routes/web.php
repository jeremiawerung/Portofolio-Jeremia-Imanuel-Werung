<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\BelajarController;
use App\Http\Controllers\ChatRoomController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SmartTalkController;
use App\Http\Middleware\TrackPageView;
use Illuminate\Support\Facades\Route;

// ===== Halaman portofolio (kunjungan dicatat buat dashboard) =====
Route::middleware(TrackPageView::class)->group(function () {
    Route::view('/', 'pages.home')->name('home');
    Route::view('/about', 'pages.about')->name('about');
    Route::view('/achievements', 'pages.achievements')->name('achievements');
    Route::view('/projects', 'pages.projects')->name('projects');
    Route::view('/case-studies', 'pages.case-studies')->name('case-studies');
    Route::view('/insights', 'pages.insights')->name('insights');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/chat-room', [ChatRoomController::class, 'index'])->name('chat');
    Route::view('/contact', 'pages.contact')->name('contact');
    Route::get('/smart-talk', [SmartTalkController::class, 'index'])->name('smart-talk');
});

// ===== Data dashboard (dipanggil JS) =====
Route::prefix('dashboard/data')->name('dashboard.')->middleware('throttle:60,1')->group(function () {
    Route::get('/github', [DashboardController::class, 'github'])->name('github');
    Route::get('/wakatime', [DashboardController::class, 'wakatime'])->name('wakatime');
    Route::get('/analytics', [DashboardController::class, 'analytics'])->name('analytics');
});

// ===== Chat Room =====
Route::get('/chat-room/messages', [ChatRoomController::class, 'messages'])
    ->middleware('throttle:120,1')->name('chat.messages');
Route::post('/chat-room/messages', [ChatRoomController::class, 'store'])
    ->middleware('throttle:chat-send')->name('chat.store');
Route::delete('/chat-room/messages/{message}', [ChatRoomController::class, 'destroy'])
    ->middleware(['auth', 'can:admin'])->name('chat.destroy');

// ===== Smart Talk =====
Route::post('/smart-talk/ask', [SmartTalkController::class, 'ask'])
    ->middleware('throttle:smart-talk')->name('smart-talk.ask');

// ===== Admin (gak ada link dari menu) =====
Route::get('/admin/login', [AuthController::class, 'create'])->middleware('guest')->name('login');
Route::post('/admin/login', [AuthController::class, 'store'])->middleware(['guest', 'throttle:5,1']);
Route::post('/admin/logout', [AuthController::class, 'destroy'])->middleware('auth')->name('logout');

// Personal QA-learning tracker. Cuma nyala di laptop (APP_ENV=local),
// jadi gak ikut kebuka pas di-deploy ke server.
if (app()->environment('local')) {
    Route::prefix('belajar')->name('belajar.')->group(function () {
        Route::get('/', [BelajarController::class, 'index'])->name('index');
        Route::get('/api-tester', [BelajarController::class, 'apiTester'])->name('api-tester');
        Route::get('/materi/{id}', [BelajarController::class, 'materi'])->whereNumber('id')->name('materi');
        Route::get('/materi/{id}/quiz', [BelajarController::class, 'quizLevels'])->whereNumber('id')->name('quiz.levels');
        Route::get('/materi/{id}/quiz/{level}', [BelajarController::class, 'quiz'])->whereNumber('id')->whereAlpha('level')->name('quiz');
        Route::post('/materi/{id}/quiz/{level}', [BelajarController::class, 'submitQuiz'])->whereNumber('id')->whereAlpha('level')->name('quiz.submit');
    });
}
