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
                    'channels/store',
                    'campaign-store',
                ];

                if (!in_array($currentPath, $excludedPaths)) {
                    $updatedPath = "{$languageCode}/{$route}";

                    if ($currentPath !== $updatedPath) {
                        return redirect("/{$updatedPath}");
                    }
                }
            }
        }

        return $next($request);
    }
}
