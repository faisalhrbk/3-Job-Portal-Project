<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\AuthUser;
use Illuminate\Support\Facades\Route;

Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home');
});

Route::prefix('account')->middleware('authUser')->controller(AccountController::class)->name('account.')->group(function () {
    Route::get('register', 'register')->name('register')->withoutMiddleware('authUser');
    Route::post('register', 'registerPost')->name('register.post');
    Route::get('login', 'login')->name('login')->withoutMiddleware('authUser');
    Route::post('login', 'loginPost')->name('login.post');
    Route::get('profile', 'profile')->name('profile');
    Route::get('logout', 'logout')->name('logout');


});

