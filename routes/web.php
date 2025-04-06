<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('contact', 'contact')->name('contact');
});

Route::controller(AccountController::class)->group(function () {
    Route::get('account/register', 'register')->name('account.register');
});
