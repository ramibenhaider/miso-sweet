<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\ProductController;
use App\Http\Controllers\User\AboutUsController;
use App\Http\Controllers\User\MessageController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/products', [ProductController::class, 'index'])->name('products');
Route::get('/product/search', [ProductController::class, 'index'])->name('product.search');
Route::get('/product/{product}', [ProductController::class, 'show'])->name('product.show');
Route::get('/user/about-us', [AboutUsController::class, 'index'])->name('user.about-us');
Route::post('/message/store', [MessageController::class, 'store'])->name('messages.store');