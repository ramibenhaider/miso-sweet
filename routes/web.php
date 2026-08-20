<?php

use App\Http\Controllers\User\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\LoginAndLogoutController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProductPhotoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\AboutUsController;
use App\Http\Controllers\User\ProductsController;

Route::get('/login', function() { return view('login'); })->name('login');
Route::get('/register', function () { return view('register'); })->name('register');
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/products', [ProductsController::class, 'index'])->name('products');
Route::get('/about-us', [AboutUsController::class, 'index'])->name('about-us');
Route::post('/login', [loginAndLogoutController::class, 'doLogin'])->name('doLogin');
Route::post('/logout', [loginAndLogoutController::class, 'logout'])->name('logout');
Route::get('/profile/{user}', [ProfileController::class, 'edit'])->name('profile.edit');
Route::put('/profile/{user}', [ProfileController::class, 'update'])->name('profile.update');


Route::post('/register', [RegistrationController::class, 'store'])->name('register');

Route::get('/email/verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])
    ->middleware('signed')
    ->name('verification.verify');

Route::middleware('auth')->group(function () {

    Route::get('/email/verify', [EmailVerificationController::class, 'notice'])
        ->name('verification.notice');

    Route::post('/email/verification-notification', [EmailVerificationController::class, 'resend'])
        ->middleware('throttle:4,3')
        ->name('verification.send');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/categories-contacts', [DashboardController::class, 'index'])->name('categories-contacts');
    Route::patch('users/{user}/toggle-status', [UserController::class, 'toggleStatus'])->name('users.toggle-status');
    Route::resource('category', CategoryController::class)->only('update', 'store', 'destroy');
    Route::resource('contact', ContactController::class)->only('update');
    Route::resource('messages', MessageController::class);
    Route::resource('users', UserController::class);
    Route::resource('product', ProductController::class);
    Route::resource('product-photo', ProductPhotoController::class);
});


// Route::middleware('guest')->group(function () {

Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])
    ->name('password.request');

Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])
    ->middleware('throttle:4,3')
    ->name('password.email');

Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetPasswordForm'])
    ->name('password.reset');

Route::post('/reset-password', [ResetPasswordController::class, 'reset'])
    ->name('password.update');
// });