<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\AuthUserController;
use App\Http\Controllers\CatalogueController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\User\UserDashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/catalogue', [CatalogueController::class, 'index'])->name('catalogue');
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');

Route::get('/login', [AuthUserController::class, 'login'])->name('user.login');
Route::post('/login', [AuthUserController::class, 'authenticate'])->name('user.authenticate');
Route::get('/register', [AuthUserController::class, 'register'])->name('user.register');
Route::post('/register', [AuthUserController::class, 'storeRegister'])->name('user.registerStore');

// DASHBOARD USER
Route::middleware(['cusAuth', 'role:customer'])->prefix('user')->group(function () {
    Route::get('dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
    Route::get('logout', [AuthUserController::class, 'logout'])->name('user.logout');
});
    
    
// ADMIN ROUTES
Route::get('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'authenticate'])->name('admin.authenticate');
Route::middleware(['cusAuth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
});
