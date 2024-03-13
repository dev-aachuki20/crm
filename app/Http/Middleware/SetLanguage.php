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
                    'updateLanguage',
                    'logout',
                    'areas_store',
                    'getCampaignStore',
                    'areas_delete',
                    'areas_edit',
                    'areas_update',

                    'users_store',
                    'users_delete',
                    'users_edit',
                    'users_update',
                    'getCampaignUpdate',
                    'getCampaignEdit',
                    'campaign_delete',
                    'logFile',
                    'clearlogFile',
                    'checkCampaign',

                    /* For Lead*/
                    'createLead',
                    'storeLead',
                    'campaignAreaList',
                    'editLead',
                    'updateLead',
                    'deleteLead',

                    'submitSearch',

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
