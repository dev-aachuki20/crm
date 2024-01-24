<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Language;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if ($user) {
            $languageCode = Language::where('id', $user->language_id)->value('code');
            $userLanguage = $languageCode ?? 'en';
            \Log::info($userLanguage);
            app()->setLocale($userLanguage);
        }

        return $next($request);
    }
}
