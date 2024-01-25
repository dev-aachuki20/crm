<?php

// use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\CampaignController;
use App\Http\Controllers\User\ChannelController;
use App\Http\Controllers\User\InteractionController;
use App\Http\Controllers\User\LeadController;
use App\Http\Controllers\User\UserController;

Route::get('/storage-link', function () {
    Artisan::call('storage:link');
    return "Storage link created successfully!";
});

Route::get('/generate-key', function () {
    Artisan::call('key:generate');
    return "App key generated successfully!";
});

Route::get('/clear-cache', function () {
    Artisan::call('view:clear');
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    Artisan::call('config:clear');
    return "clear view,cache,config ";
});

Route::get('/', function () {
    // return view('auth.login');
    return redirect()->route('login');
});

Auth::routes(['register' => false]);

Route::group(['middleware' => ['auth', 'preventBackHistory', 'setLanguage']], function () {
    Route::prefix('{lang?}')->group(function () {
        Route::get('/home', [HomeController::class, 'index'])->name('home');
        Route::get('/profile', [ProfileController::class, 'index'])->name('profile');

        Route::post('/updateProfile', [ProfileController::class, 'updateProfile'])->name('updateProfile');

        Route::get('/channels', [ChannelController::class, 'index'])->name('channels');

        Route::get('/campaigns', [CampaignController::class, 'index'])->name('campaigns');
        Route::get('/interactions', [InteractionController::class, 'index'])->name('interactions');
        Route::get('/users', [UserController::class, 'index'])->name('users');
        Route::get('/leads', [LeadController::class, 'index'])->name('leads');
    });
    Route::delete('/users/delete/{id}', [UserController::class, 'delete'])->name('users.delete');
    Route::resource('users', UserController::class);

    Route::post('/update-language', [HomeController::class, 'updateLanguage'])->name('updateLanguage');
    Route::post('/upload-profile-image', 'ProfileController@uploadProfileImage')->name('upload.profile.image');

    // Route::group(['as' => 'user.', 'prefix' => 'user'], function () {

    //     Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // });

});
