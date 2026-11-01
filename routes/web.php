<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\DocumentationController;

// ---------- Public pages ----------
Route::get('/', [AnnouncementController::class, 'index'])->name('home');
Route::get('/announcements', [AnnouncementController::class, 'index'])->name('announcements.index');
Route::get('/announcements/{announcement}', [AnnouncementController::class, 'show'])->name('announcements.show');
Route::get('/docs', [DocumentationController::class, 'index'])->name('docs.index');
Route::view('/documentation', 'documentation')->name('documentation');

// ---------- Authentication ----------
Route::get('/login', [AuthController::class, 'showLogin'])->name('login.show');
Route::post('/login', [AuthController::class, 'login'])->name('login.perform');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register.show');
Route::post('/register', [AuthController::class, 'register'])->name('register.perform');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout.perform');

// ---------- Logged-in users ----------
Route::middleware('auth.simple')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Feedback (users manage their own)
    Route::post('/announcements/{announcement}/feedback', [FeedbackController::class, 'store'])->name('feedback.store');
    Route::get('/feedback/{feedback}/edit', [FeedbackController::class, 'edit'])->name('feedback.edit');
    Route::put('/feedback/{feedback}', [FeedbackController::class, 'update'])->name('feedback.update');
    Route::delete('/feedback/{feedback}', [FeedbackController::class, 'destroy'])->name('feedback.destroy');

    // ---------- Admin only ----------
    Route::middleware('admin.only')->prefix('admin')->group(function () {
        Route::resource('announcements', AnnouncementController::class)->except(['index', 'show']);
        Route::resource('categories', CategoryController::class)->except(['show']);
    });
});