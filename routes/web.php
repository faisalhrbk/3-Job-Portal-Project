<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home');
});

//todo Guest Routes
Route::middleware('redirectIfAuthenticated')->controller(AccountController::class)->name('account.')->group(function () {
    Route::get('account/register', 'register')->name('register');
    Route::post('account/register', 'registerPost')->name('register.post');
    Route::get('account/login', 'login')->name('login');
    Route::post('account/login', 'loginPost')->name('login.post');
});



//todo User Authenticated Routes
Route::prefix('account')->middleware('authUser')
    ->controller(AccountController::class)->name('account.')->group(function () {

        Route::get('profile', 'profile')->name('profile');
        Route::post('update-profile', 'updateProfile')->name('update.profile');
        Route::get('logout', 'logout')->name('logout');
        Route::post('update/profile-pic', 'updateProfilePic')->name('update.profilePic');
        Route::get('create-job', 'createJob')->name('createJob');
        Route::post('create-job', 'createJobPost')->name('createJobPost');
        Route::get('my-jobs', 'myJobs')->name('myJobs');
    Route::get('edit-job/{id}', 'editJob')->name('editJob');
    });
