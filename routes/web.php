<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Profile\ProfileController;
use App\Http\Controllers\Campaign\CampaignController;
use App\Http\Controllers\Area\AreaController;
use App\Http\Controllers\Interaction\InteractionController;
use App\Http\Controllers\Lead\LeadController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Auth\VerificationController;


Route::get('/storage-link', function () {
    Artisan::call('storage:link');
    return "Storage link created successfully!";
});

Route::get('/generate-key', function () {
    Artisan::call('key:generate');
    return "App key generated successfully!";
});

Route::get('/log-file', function () {
    $file = File::get(storage_path() . '/logs/laravel.log');
    return "<div style='white-space: pre;'>$file</div>";
})->name('logFile');

Route::get('/clear-log-file', function () {
    $file = File::put(storage_path() . '/logs/laravel.log', '');
    return $file;
})->name('clearlogFile');

Route::get('/clear-cache', function () {
    Artisan::call('view:clear');
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    Artisan::call('config:clear');
    return "clear view,cache,config ";
});

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes(['register' => false]);

Route::get('email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify');

Route::group(['middleware' => ['auth', 'preventBackHistory', 'setLanguage']], function () {
    Route::prefix('{lang?}')->group(function () {
        Route::get('/home', [HomeController::class, 'index'])->name('home');
        Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
        Route::post('/updateProfile', [ProfileController::class, 'updateProfile'])->name('updateProfile');

        Route::get('/areas', [AreaController::class, 'index'])->name('areas');
        Route::get('/campaigns', [CampaignController::class, 'index'])->name('campaigns');
        Route::get('/users', [UserController::class, 'index'])->name('users');

        // Route::get('/interactions', [InteractionController::class, 'index'])->name('interactions');
        // Route::get('/leads', [LeadController::class, 'index'])->name('leads');
        Route::resource('leads',LeadController::class);
        Route::resource('/interactions',InteractionController::class);
        Route::get('/campaign/areas/list/{campaignId}', [CampaignController::class, 'getAreas'])->name('campaign.areaList');

    });

    // areas route
    Route::post('/areas/store', [AreaController::class, 'store'])->name('areas_store');
    Route::delete('/areas/delete', [AreaController::class, 'destroy'])->name('areas_delete');
    Route::get('/areas/edit', [AreaController::class, 'edit'])->name('areas_edit');
    Route::put('/areas/update', [AreaController::class, 'update'])->name('areas_update');

    // user routes
    Route::post('/users/store', [UserController::class, 'store'])->name('users_store');
    Route::delete('/users/delete', [UserController::class, 'destroy'])->name('users_delete');
    Route::get('/users/edit', [UserController::class, 'edit'])->name('users_edit');
    Route::post('/users/update', [UserController::class, 'update'])->name('users_update');

    /* For Campaign */
    Route::delete('/campaign/delete', [CampaignController::class, 'delete'])->name('campaign_delete');
    Route::post('/campaign-store', [CampaignController::class, 'store'])->name('getCampaignStore');
    Route::get('/campaign-edit', [CampaignController::class, 'edit'])->name('getCampaignEdit');
    Route::post('/campaign-update', [CampaignController::class, 'update'])->name('getCampaignUpdate');

    Route::post('/update-language', [HomeController::class, 'updateLanguage'])->name('updateLanguage');
    Route::post('/upload-profile-image', 'ProfileController@uploadProfileImage')->name('upload.profile.image');

    Route::get('/check-campaign', [HomeController::class, 'checkCampaign'])->name('checkCampaign');


    // lead routes
    // Route::post('/leads/store', [UserController::class, 'store'])->name('leads_store');
    // Route::delete('/leads/delete', [UserController::class, 'destroy'])->name('leads_delete');
    // Route::get('/leads/edit', [UserController::class, 'edit'])->name('leads_edit');
    // Route::post('/leads/update', [UserController::class, 'update'])->name('leads_update');



    // Route::group(['as' => 'user.', 'prefix' => 'user'], function () {

    //     Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // });

});
