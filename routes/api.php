<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
// use App\Http\Controllers\VariantController;
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::resource('category', CategoryController::class);
Route::resource('product', ProductController::class);
// Route::resource('variant', VariantController::class);