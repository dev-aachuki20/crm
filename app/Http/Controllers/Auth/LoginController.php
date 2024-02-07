<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
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
        // $this->middleware('check-email-verified');

        $this->middleware('guest')->except('logout');
    }
    protected function validateLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email|regex:/(.+)@(.+)\.(.+)/i',
            'password' => 'required|string',
        ]);
    }

    protected function authenticated(Request $request, $user)
    {
        $language = \Session::get('userLanguage');
        $lang = $language ? $language : 'en';

        $user = auth()->user();

        if(is_null($user->email_verified_at)){

            $user->NotificationSendToVerifyEmail();
            
            Auth::logout();
            toastr()->success(trans('messages.check_email_verification'),trans('messages.success'));
            return redirect('/login');
        }

        app()->setLocale($lang);
        toastr()->success(trans('messages.you_are_successfully_login'),trans('messages.success'));
        return redirect()->route('home', ['lang' => $lang]);
    }

    public function logout(Request $request)
    {
        toastr()->success(trans('messages.you_are_successfully_logout'), trans('messages.success'));
        Auth::logout();
        return redirect('/login');
    }
}
