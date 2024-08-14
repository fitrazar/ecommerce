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
use App\Http\Controllers\BannerController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\User\ProductUserController;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Route::prefix('/product')->group(function () {
//     Route::get('/', )
// });

Route::resource('/products', ProductUserController::class);


Route::prefix('/admin')->middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('/brand', BrandController::class)->except('show');
    Route::resource('/category', CategoryController::class)->except('show');
    Route::resource('/material', MaterialController::class)->except('show');
    Route::resource('/unit', UnitController::class)->except('show');
    Route::resource('/product', ProductController::class);
    Route::resource('/color', ColorController::class);
    Route::resource('/size', SizeController::class);
    Route::resource('/banner', BannerController::class);

    // Setting Page
    Route::resource('/setting', SettingController::class);


    // integrasi filepond
    Route::post('upload_logo', [SettingController::class, 'uploadLogo'])->name('upload_logo');
    Route::post('revert_logo', [SettingController::class, 'revertLogo'])->name('revert_logo');
    Route::post('upload_banner', [BannerController::class, 'uploadBanner'])->name('upload_banner');
    Route::delete('revert_banner', [BannerController::class, 'revertBanner'])->name('revert_banner');
    Route::post('upload_cover', [ProductController::class, 'uploadCover'])->name('upload_cover');
    Route::delete('revert_cover', [ProductController::class, 'revertCover'])->name('revert_cover');
    Route::post('upload_category', [CategoryController::class, 'uploadCategory'])->name('upload_category');
    Route::delete('revert_category', [CategoryController::class, 'revertCategory'])->name('revert_category');
    Route::post('upload_color', [ColorController::class, 'uploadColor'])->name('upload_color');
    Route::delete('revert_color', [ColorController::class, 'reverColor'])->name('revert_color');
    Route::post('upload_product_images', [ProductImageController::class, 'uploadProductImages'])->name('upload_product_images');
    Route::delete('revert_product_images', [ProductImageController::class, 'revertProductImages'])->name('revert_product_images');
});


require __DIR__ . '/auth.php';
