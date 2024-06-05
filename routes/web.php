<?php

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
Route::get('/register', [AuthUserController::class, 'register'])->name('user.register');
Route::post('/register', [AuthUserController::class, 'storeRegister'])->name('user.registerStore');
// DASHBOARD USER
Route::get('/user/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
