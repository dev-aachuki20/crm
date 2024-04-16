<?php

namespace App\Providers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Validator::extend('multiple_size', function ($attribute, $value, $parameters, $validator) {
            $sizes = array_map('intval', $parameters);
            return in_array(strlen($value), $sizes);
        });
    }


}
