<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\VariantController;
use App\Http\Controllers\CheckOutController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('register', [RegisterController::class ,'store']);
Route::post('login', [LoginController::class ,'store']);
Route::resource('category', CategoryController::class);
Route::resource('product', ProductController::class);
Route::resource('variant', VariantController::class);
Route::resource('checkout', CheckOutController::class)->only('store');
