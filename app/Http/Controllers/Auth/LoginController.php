<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Language;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /* protected function redirectTo()
    {
        return redirect()->url('/en/home');
    } */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated(Request $request, $user)
    {
        /* $language = Language::where('id', $user->language_id)->value('code');

        // Get the authenticated user's preferred language
        $userLanguage = $user->$language ?? 'en';

        // Redirect to the home page in the user's preferred language
        return redirect()->route('home', ['lang' => $userLanguage]); */

        $language = \Session::get('userLanguage');
        $lang = $language ? $language : 'en';

        // return redirect()->route('home', ['lang' => $lang])->with('success', trans('messages.you_are_successfully_login'));
        toastr()->success(trans('messages.you_are_successfully_login'));
        return redirect()->route('home', ['lang' => $lang]);
    }



    public function logout(Request $request)
    {
        toastr()->success(trans('messages.you_are_successfully_logout'));
        Auth::logout();
        return redirect('/login');
    }
}
