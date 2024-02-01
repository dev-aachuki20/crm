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
        $this->middleware('guest')->except('logout');
    }


    public function login(Request $request)
    {
        if ($request['email'] === null || $request['password'] === null) {
            // \Session()->put('userLoginRequest', $request);
            toastr()->error('Email and password are required', 'Error');
            return redirect()->back()->with('message', 'IT WORKS!');

        }

        $this->validateLogin($request);

        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            if ($request->hasSession()) {
                $request->session()->put('auth.password_confirmed_at', time());
            }

            return $this->sendLoginResponse($request);
        }

        $this->incrementLoginAttempts($request);

        toastr()->error('Invalid email or password', 'Error');
        $this->sendFailedLoginResponse($request);
        return back();
    }


    
    protected function authenticated(Request $request, $user)
    {
        $language = \Session::get('userLanguage');
        $lang = $language ? $language : 'en';
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
