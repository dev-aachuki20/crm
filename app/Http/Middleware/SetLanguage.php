<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLanguage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (\Auth::user()) {
            $languageCode = \Session::get('userLanguage');

            if ($languageCode) {
                $route = \Route::current()->getName() ?? 'home';
                $currentPath = $request->path();
                // dump($currentPath);
                $excludedPaths = [
                    'update-language',
                    'logout',
                    'areas/store',
                    'campaign-store',
                    'areas/delete',
                    'areas/edit',
                    'areas/update',
                    'users/store',
                    'users/delete',
                    'users/edit',
                    'users/update',
                    'campaign-update',
                    'campaign-edit',
                    'campaign/delete',
                    'log-file',
                    'clear-log-file',
                    'check-campaign',

                    /* For Lead*/
                    'lead-create',
                    'lead-store',
                    'campaign/areas/list',
                    'lead-edit',
                    'lead-update',
                    'lead-delete',

                    'search',

                    'interactions-create',
                    'interactions-store',
                    'interactions-edit',
                    'interactions-update',
                    'interactions-delete',
                ];

                if (!in_array($route, $excludedPaths)) {
                    
                    $routeArr = explode('/',$currentPath);
                    unset($routeArr[0]);

                    $routeArr = array_values($routeArr);

                    $updatedPath = $languageCode.'/' . implode('/',$routeArr);

                    if ($currentPath !== $updatedPath) {
                        return redirect("/{$updatedPath}");
                    }
                    
                }
            }
        }

        return $next($request);
    }
}
