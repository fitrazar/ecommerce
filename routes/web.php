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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('/admin')->middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('/brand', BrandController::class)->except('show');
    Route::resource('/category', CategoryController::class)->except('show');
    Route::resource('/material', MaterialController::class)->except('show');
    Route::resource('/unit', UnitController::class)->except('show');
    Route::resource('/product', ProductController::class);
    Route::resource('/color', ColorController::class);
});


require __DIR__ . '/auth.php';
