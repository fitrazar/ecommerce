<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\UnitController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\MaterialController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductImageController;
use App\Http\Controllers\Admin\SizeController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('/admin')->middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('/brand', BrandController::class)->except('show');
    Route::resource('/category', CategoryController::class)->except('show');
    Route::resource('/material', MaterialController::class)->except('show');
    Route::resource('/unit', UnitController::class)->except('show');
    Route::resource('/product', ProductController::class);
    Route::resource('/color', ColorController::class);
    Route::resource('/size', SizeController::class);
    Route::resource('/product_image', ProductImageController::class);

    // integrasi filepond
    Route::post('upload_cover', [ProductController::class, 'uploadCover'])->name('upload_cover');
    Route::delete('revert_cover', [ProductController::class, 'revertCover'])->name('revert_cover');
    Route::post('upload_product_images', [ProductImageController::class, 'uploadProductImages'])->name('upload_product_images');
    Route::delete('revert_product_images', [ProductImageController::class, 'revertProductImages'])->name('revert_product_images');
});


require __DIR__ . '/auth.php';
