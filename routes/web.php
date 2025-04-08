<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\AuthUser;
use Illuminate\Support\Facades\Route;

Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home');
});

Route::middleware('redirectIfAuthenticated')->controller(AccountController::class)->name('account.')->group(function () {
    Route::get('account/register', 'register')->name('register');
    Route::post('account/register', 'registerPost')->name('register.post');
    Route::get('account/login', 'login')->name('login');
    Route::post('account/login', 'loginPost')->name('login.post');
});


Route::prefix('account')->middleware('authUser')
    ->controller(AccountController::class)->name('account.')->group(function () {
        Route::get('profile', 'profile')->name('profile');
        Route::get('logout', 'logout')->name('logout');
    });
