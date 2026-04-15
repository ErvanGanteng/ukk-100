<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PengaduanController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Student Routes
Route::middleware(['auth'])->prefix('student')->name('student.')->group(function () {
    Route::get('/dashboard', [PengaduanController::class, 'create'])->name('dashboard');
    Route::post('/pengaduan', [PengaduanController::class, 'store'])->name('store');
    Route::get('/history', [PengaduanController::class, 'index'])->name('history');
    Route::get('/pengaduan/{pengaduan}', [PengaduanController::class, 'show'])->name('show');
});

// Admin Routes
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/pengaduan/{pengaduan}', [AdminController::class, 'show'])->name('show');
    Route::patch('/pengaduan/{pengaduan}/status', [AdminController::class, 'updateStatus'])->name('status.update');
    Route::post('/pengaduan/{pengaduan}/feedback', [AdminController::class, 'storeFeedback'])->name('feedback.store');
});
