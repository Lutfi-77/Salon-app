<?php

use App\Http\Controllers\Admin\AdminAccountController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminCatalogueController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminGalleryController;
use App\Http\Controllers\Admin\AdminManageController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\AdminTreatmentController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AuthUserController;
use App\Http\Controllers\CatalogueController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\User\UserDashboardController;
use App\Http\Controllers\User\UserProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/catalogue/{category?}', [CatalogueController::class, 'index'])->name('catalogue');
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');

Route::get('/login', [AuthUserController::class, 'login'])->name('user.login');
Route::post('/login', [AuthUserController::class, 'authenticate'])->name('user.authenticate');
Route::get('/register', [AuthUserController::class, 'register'])->name('user.register');
Route::post('/register', [AuthUserController::class, 'storeRegister'])->name('user.registerStore');

// DASHBOARD USER
Route::middleware(['role:customer', 'profileCheck'])->prefix('user')->group(function () {
    Route::get('dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
    Route::get('logout', [AuthUserController::class, 'logout'])->name('user.logout');
    Route::resource('profile', UserProfileController::class);
    Route::post('logout', [AuthUserController::class, 'logout'])->name('user.logout');

    Route::get('appointment', [AppointmentController::class, 'index'])->name('user.appointment');
    Route::post('appointment/store', [AppointmentController::class, 'store'])->name('user.appointment.store');
    Route::get('appointment/getWorker/{id}', [AppointmentController::class, 'getWorker'])->name('user.getWorker');
});
    
    
// ADMIN ROUTES
Route::get('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'authenticate'])->name('admin.authenticate');
Route::middleware('role:admin')->prefix('admin')->group(function () {
    Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('profile', [AdminProfileController::class, 'index'])->name('admin.profile');
    Route::post('profile/edit', [AdminProfileController::class, 'editProfile'])->name('admin.profile.edit');

    Route::get('gallery', [AdminGalleryController::class, 'index'])->name('admin.gallery');
    Route::get('gallery/create', [AdminGalleryController::class, 'create'])->name('admin.gallery.create');
    Route::post('gallery/create', [AdminGalleryController::class, 'store'])->name('admin.gallery.store');
    Route::delete('gallery/{id}', [AdminGalleryController::class, 'destroy'])->name('admin.gallery.destroy');

    Route::get('account', [AdminAccountController::class, 'index'])->name('admin.account.index');
    Route::get('account/create', [AdminAccountController::class, 'create'])->name('admin.account.create');
    Route::post('account/create', [AdminAccountController::class, 'store'])->name('admin.account.store');
    Route::get('account/edit/{id}', [AdminAccountController::class, 'edit'])->name('admin.account.edit');
    Route::post('account/edit/{id}', [AdminAccountController::class, 'update'])->name('admin.account.update');
    Route::delete('account/delete/{id}', [AdminAccountController::class, 'destroy'])->name('admin.account.destroy');
    
    Route::get('adminacc', [AdminManageController::class, 'index'])->name('admin.manage.index');
    Route::get('adminacc/create', [AdminManageController::class, 'create'])->name('admin.manage.create');
    Route::post('adminacc/create', [AdminManageController::class, 'store'])->name('admin.manage.store');
    Route::get('adminacc/edit/{id}', [AdminManageController::class, 'edit'])->name('admin.manage.edit');
    Route::post('adminacc/edit/{id}', [AdminManageController::class, 'update'])->name('admin.manage.update');
    Route::delete('adminacc/delete/{id}', [AdminManageController::class, 'destroy'])->name('admin.manage.destroy');

    Route::get('category', [AdminCategoryController::class, 'index'])->name('admin.category.index');
    Route::get('category/create', [AdminCategoryController::class, 'create'])->name('admin.category.create');
    Route::post('category/create', [AdminCategoryController::class, 'store'])->name('admin.category.store');
    Route::get('category/edit/{id}', [AdminCategoryController::class, 'edit'])->name('admin.category.edit');
    Route::post('category/edit/{id}', [AdminCategoryController::class, 'update'])->name('admin.category.update');
    Route::delete('category/delete/{id}', [AdminCategoryController::class, 'destroy'])->name('admin.category.destroy');

    Route::get('catalogue', [AdminCatalogueController::class, 'index'])->name('admin.catalogue.index');
    Route::get('catalogue/create', [AdminCatalogueController::class, 'create'])->name('admin.catalogue.create');
    Route::post('catalogue/create', [AdminCatalogueController::class, 'store'])->name('admin.catalogue.store');
    Route::get('catalogue/edit/{id}', [AdminCatalogueController::class, 'edit'])->name('admin.catalogue.edit');
    Route::post('catalogue/edit/{id}', [AdminCatalogueController::class, 'update'])->name('admin.catalogue.update');
    Route::delete('catalogue/delete/{id}', [AdminCatalogueController::class, 'destroy'])->name('admin.catalogue.destroy');
    
    Route::get('treatement', [AdminTreatmentController::class, 'index'])->name('admin.treatment.index');
    Route::get('treatment/create', [AdminTreatmentController::class, 'create'])->name('admin.treatment.create');
    Route::post('treatment/create', [AdminTreatmentController::class, 'store'])->name('admin.treatment.store');
    Route::get('treatment/edit/{id}', [AdminTreatmentController::class, 'edit'])->name('admin.treatment.edit');
    Route::post('treatment/edit/{id}', [AdminTreatmentController::class, 'update'])->name('admin.treatment.update');
    Route::delete('treatment/delete/{id}', [AdminTreatmentController::class, 'destroy'])->name('admin.treatment.destroy');
});
