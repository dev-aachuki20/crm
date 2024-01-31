<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($lang)
    {
        $currentLocale = app()->getLocale();
        return view('home');
    }

    public function updateLanguage(Request $request)
    {
        try {
            $language = $request->input('language') ?? 'en';
            app()->setLocale($language);
            $request->session()->put('userLanguage', $language);
            return response()->json(['success' => true]);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'error' => $th->getMessage()]);
        }
    }
}
