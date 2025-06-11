<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\EditorController;
// use App\Http\Controllers\PublikBeritaController;

Route::get('/', function () {
    return redirect('/login');
});


// ============================
// AUTH ROUTES
// ============================

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// Password Reset
Route::get('/forgot-password', [PasswordController::class, 'showForgotForm'])->name('password.request');
Route::post('/forgot-password', [PasswordController::class, 'sendResetLink'])->name('password.email');
Route::get('/reset-password/{token}', [PasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [PasswordController::class, 'resetPassword'])->name('password.update');

// ============================
// PROFILE (auth protected)
// ============================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/berita-preview/{id}', [BeritaController::class, 'preview'])->name('berita.preview');
    // Tampilkan semua berita published
    // Route::get('/berita-published', [PublikBeritaController::class, 'index'])->name('berita.published');

    // Tambahkan ini:
    // Route::get('/berita-preview/{id}', [BeritaController::class, 'preview'])->name('berita.preview');
});


// ============================
// ADMIN ROUTES
// ============================
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        $beritas = \App\Models\Berita::where('status', 'published')->latest()->get();
        return view('admin.dashboard', compact('beritas'));
    })->name('dashboard');

    // Manajemen user
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/users/{user}/role', [UserController::class, 'updateRole'])->name('users.updateRole');
});


// ============================
// EDITOR ROUTES
// ============================
Route::middleware(['auth', 'role:editor'])->prefix('editor')->name('editor.')->group(function () {
    Route::get('/', function () {
        $beritas = \App\Models\Berita::where('status', 'published')->latest()->get();
        return view('editor.dashboard', compact('beritas'));
    })->name('dashboard');

    Route::get('/berita', [EditorController::class, 'index'])->name('berita.index');
    Route::get('/berita/{id}', [EditorController::class, 'show'])->name('berita.show');
    // Route::get('/berita-preview/{id}', [BeritaController::class, 'preview'])->name('berita.preview');
    Route::put('/berita/{id}/publish', [EditorController::class, 'publish'])->name('berita.publish');
    Route::put('/berita/{id}/reject', [EditorController::class, 'reject'])->name('berita.reject');
    Route::put('/berita/{id}/return', [EditorController::class, 'returnToWartawan'])->name('berita.return');
});


// ============================
// WARTAWAN ROUTES
// ============================
Route::middleware(['auth', 'role:wartawan'])->group(function () {
    Route::get('/wartawan', function () {
        $beritas = \App\Models\Berita::where('status', 'published')->latest()->get();
        return view('wartawan.dashboard', compact('beritas'));
    })->name('wartawan.dashboard');

    Route::resource('/berita', BeritaController::class);
    // Route::get('/berita-preview/{id}', [BeritaController::class, 'preview'])->name('berita.preview');
});

