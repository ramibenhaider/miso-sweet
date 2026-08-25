<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductPhotoController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\AboutUsController;


Route::get('/categories-contacts', [DashboardController::class, 'index'])->name('categories-contacts');

Route::resource('category', CategoryController::class)->only('update', 'store', 'destroy');
Route::resource('contact', ContactController::class)->only('update');
Route::resource('product', ProductController::class)->except(['show', 'create', 'edit']);

Route::delete('product-photo/{productPhoto}', [ProductPhotoController::class, 'destroy'])->name('product-photo.destroy');

Route::resource('users', UserController::class)->only('index', 'destroy');
Route::patch('users/{user}/toggle-status', [UserController::class, 'toggleStatus'])->name('users.toggle-status');

Route::resource('messages', MessageController::class)->only(['index', 'destroy']);
Route::patch('messages/{message}/toggle-show', [MessageController::class, 'toggleShow'])->name('messages.toggle-show');

Route::get('about-us', [AboutUsController::class, 'index'])->name('about-us.index');
Route::put('about-us', [AboutUsController::class, 'update'])->name('about-us.update');