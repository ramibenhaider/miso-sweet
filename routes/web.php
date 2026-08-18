<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\loginController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;

Route::get('/', function () {return view('login');})->name('login');
Route::get('/register', function () {return view('register');})->name('register');
Route::post('/login', [loginController::class, 'doLogin'])->name('doLogin');
Route::post('/logout', [loginController::class, 'logout'])->name('logout');
Route::get('/home', function () {return view('user.home');})->name('home');

Route::post('/register', [RegistrationController::class, 'store'])->name('register');

Route::middleware('auth')->group(function () {

    Route::get('/email/verify', [EmailVerificationController::class, 'notice'])
         ->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])
        ->middleware('signed')
        ->name('verification.verify');

    Route::post('/email/verification-notification', [EmailVerificationController::class, 'resend'])
        ->middleware('throttle:4,3')
        ->name('verification.send');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/categories-contacts', [DashboardController::class, 'index'])->name('categories-contacts');
    Route::resource('category', CategoryController::class)->only('update', 'store', 'destroy');
    Route::resource('contact', ContactController::class)->only('update');
    Route::resource('messages', MessageController::class);
    Route::resource('users', UserController::class);
    Route::patch('users/{user}/toggle-status', [UserController::class, 'toggleStatus'])->name('users.toggle-status');
    Route::resource('product', ProductController::class);
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