<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Language;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    
    // public const HOME = '/home';
    public const HOME = 'en/home';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });

        /* Language Dynamic check and Pass for HOME */
        /* $user = Auth::user();
        if ($user && $user->language_id) {
            $languageCode = Language::where('id', $user->language_id)->value('code');
            $userLanguage = $languageCode ?? 'en';
            $homePath = "/{$userLanguage}/home";
        } else {
            $homePath = $this->defaultHomePath;
        } */

        /* $user = Auth::user();
        if ($user) {
            $languageCode = \Session::get('userLanguage');
            $userLanguage = $languageCode ?? 'en';
            $homePath = "/{$userLanguage}/home";
        } else {
            $homePath = $this->defaultHomePath;
        }

        

        $this->app->bind('path.home', function () use ($homePath) {
            return $homePath;
        }); */
    }
}
