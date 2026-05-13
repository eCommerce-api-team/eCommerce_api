<?php

use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminVariantController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckOutController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\VariantController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('register', [RegisterController::class, 'store']);
Route::post('login', [LoginController::class, 'store']);

Route::resource('category', CategoryController::class);
Route::resource('product', ProductController::class);
Route::resource('variant', VariantController::class);

Route::middleware('auth:sanctum')->group(function () {
    Route::resource('checkout', CheckOutController::class)->only('store');
});
Route::resource('cart', CartController::class)->only('index');

// Admin Panel Api ------------------------------------
Route::prefix('admin')->middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('/users', AdminUserController::class);
    Route::apiResource('/categories', AdminCategoryController::class);
    Route::apiResource('/products', AdminProductController::class);
    Route::apiResource('/variants', AdminVariantController::class);
    Route::apiResource('/orders', AdminOrderController::class);
});
