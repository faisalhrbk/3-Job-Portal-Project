<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('contact', 'contact')->name('contact');
});

Route::prefix('account')->controller(AccountController::class)->name('account.')->group(function () {
    Route::get('register', 'register')->name('register');
    Route::post('register', 'registerPost')->name('register.post');
    Route::get('login', 'login')->name('login');
    Route::post('login', 'loginPost')->name('login.post');
    Route::get('profile', 'profile')->name('profile');

});
