<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobsController;
use Illuminate\Support\Facades\Route;

Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home');
});

//todo jobs controller
Route::controller(JobsController::class)->group(function () {
    Route::get('jobs', 'index')->name('jobs');
    Route::get('job/detail/{id}', 'detail')->name('job.detail');

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
        Route::post('create-job', 'saveJob')->name('createJobPost');
        Route::get('my-jobs', 'myJobs')->name('myJobs');
        Route::get('edit-job/{id}', 'editJob')->name('editJob');
        Route::post('update-job/{id}', 'updateJob')->name('updateJob');
        Route::post('delete-job', 'deleteJob')->name('deleteJob');
    });
