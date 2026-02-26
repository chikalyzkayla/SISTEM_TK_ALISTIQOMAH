<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\Admin\BackupController;

// Halaman utama
Route::get('/', function () {
    return view('welcome');
});

// Dashboard Breeze default
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Auth routes (login, register, dll)
require __DIR__.'/auth.php';

// ADMIN ROUTES
Route::middleware(['auth', 'role:Admin'])->prefix('admin')->group(function () {
    
    // Dashboard Admin
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('admin.dashboard');
    
    // Kelola Pengguna
    Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('admin.users.create');
    Route::post('/users', [UserController::class, 'store'])->name('admin.users.store');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');
    
    // Kelola Siswa
    Route::get('/siswa', [SiswaController::class, 'index'])->name('admin.siswa.index');
    Route::get('/siswa/create', [SiswaController::class, 'create'])->name('admin.siswa.create');
    Route::post('/siswa', [SiswaController::class, 'store'])->name('admin.siswa.store');
    Route::get('/siswa/{siswa}/edit', [SiswaController::class, 'edit'])->name('admin.siswa.edit');
    Route::put('/siswa/{siswa}', [SiswaController::class, 'update'])->name('admin.siswa.update');
    Route::delete('/siswa/{siswa}', [SiswaController::class, 'destroy'])->name('admin.siswa.destroy');
    
    // Backup Database
    Route::get('/backup', [App\Http\Controllers\Admin\BackupController::class, 'index'])
    ->name('admin.backup.index');
Route::post('/backup/create', [App\Http\Controllers\Admin\BackupController::class, 'create'])
    ->name('admin.backup.create');
Route::get('/backup/download/{filename}', [App\Http\Controllers\Admin\BackupController::class, 'download'])
    ->name('admin.backup.download');
Route::delete('/backup/delete/{filename}', [App\Http\Controllers\Admin\BackupController::class, 'delete'])
    ->name('admin.backup.delete');
});