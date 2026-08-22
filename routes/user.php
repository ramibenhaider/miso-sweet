<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginAndLogoutController;
use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\ProductsController;
use App\Http\Controllers\User\AboutUsController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\ProfileController;


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/products', [ProductsController::class, 'index'])->name('products');
Route::get('/product/search', [ProductsController::class, 'index'])->name('product.search');
Route::get('/product/{product}', [ProductController::class, 'show'])->name('product.show');
Route::get('/about-us', [AboutUsController::class, 'index'])->name('about-us');
Route::post('/message/store', [MessageController::class, 'store'])->name('messages.store');


Route::get('/login', fn () => view('login'))->name('login');
Route::post('/login', [LoginAndLogoutController::class, 'doLogin'])->name('doLogin');

Route::get('/register', fn () => view('register'))->name('register');
Route::post('/register', [RegistrationController::class, 'store'])->name('register');

Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])
    ->middleware('throttle:4,3')
    ->name('password.email');

Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetPasswordForm'])->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');

Route::get('/email/verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])
    ->middleware('signed')
    ->name('verification.verify');


Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginAndLogoutController::class, 'logout'])->name('logout');

    Route::get('/profile/{user}', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/{user}', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/email/verify', [EmailVerificationController::class, 'notice'])->name('verification.notice');
    Route::post('/email/verification-notification', [EmailVerificationController::class, 'resend'])
        ->middleware('throttle:4,3')
        ->name('verification.send');
});
