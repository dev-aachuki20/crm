<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/login', function () {
    return view('auth.login');
});

Auth::routes(['register' => false]);


Route::group(['middleware' => ['auth', 'preventBackHistory']], function () {

    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');

    Route::post('/updateProfile', [ProfileController::class, 'updateProfile'])->name('updateProfile');

    Route::group(['as' => 'user.', 'prefix' => 'user'], function () {

        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    });
});
