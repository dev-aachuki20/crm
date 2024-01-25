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

// Route::get('/login', function () {
//     return view('auth.login');
// });

Auth::routes(['register' => false]);

Route::group(['middleware' => ['auth', 'preventBackHistory']], function () {

    Route::get('{lang?}/home', [HomeController::class, 'index'])->name('home');
    Route::get('/{lang?}/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/{lang?}/profile', [ProfileController::class, 'index'])->name('profile');

    Route::post('/{lang?}/updateProfile', [ProfileController::class, 'updateProfile'])->name('updateProfile');

    Route::get('/{lang?}/channels', [ChannelController::class, 'index'])->name('channels');

    Route::get('/{lang?}/campaigns', [CampaignController::class, 'index'])->name('campaigns');
    Route::get('/{lang?}/interactions', [InteractionController::class, 'index'])->name('interactions');
    Route::get('/{lang?}/users', [UserController::class, 'index'])->name('users');
    Route::get('/{lang?}/leads', [LeadController::class, 'index'])->name('leads');
    Route::delete('/users/delete/{id}', [UserController::class, 'delete'])->name('users.delete');

    Route::resource('users', UserController::class);

    // Route::group(['as' => 'user.', 'prefix' => 'user'], function () {

    //     Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // });
});
