<?php

use App\Http\Controllers\Admin\AdminAccountController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminGalleryController;
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
Route::middleware('role:customer')->prefix('user')->group(function () {
    Route::get('dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
    Route::get('logout', [AuthUserController::class, 'logout'])->name('user.logout');
});
    
    
// ADMIN ROUTES
Route::get('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'authenticate'])->name('admin.authenticate');
Route::middleware('role:admin')->prefix('admin')->group(function () {
    Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    Route::get('gallery', [AdminGalleryController::class, 'index'])->name('admin.gallery');
    Route::get('gallery/create', [AdminGalleryController::class, 'create'])->name('admin.gallery.create');
    Route::post('gallery/create', [AdminGalleryController::class, 'store'])->name('admin.gallery.store');
    Route::delete('gallery/{id}', [AdminGalleryController::class, 'destroy'])->name('admin.gallery.destroy');

    Route::get('account', [AdminAccountController::class, 'index'])->name('admin.account.index');
    Route::get('account/create', [AdminAccountController::class, 'create'])->name('admin.account.create');
    Route::post('account/create', [AdminAccountController::class, 'store'])->name('admin.account.store');
    Route::get('account/edit/{id}', [AdminAccountController::class, 'edit'])->name('admin.account.edit');
});
