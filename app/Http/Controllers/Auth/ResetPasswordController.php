<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Validation\Rules;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;
    protected function rules()
    {
        return [
            'token' => 'required',
            'email' => 'required|email',
            'password' => ['required', Rules\Password::defaults()],
        ];
    }

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */

    // protected $redirectTo = '/';
    protected $redirectTo = '/';

    public function reset(Request $request)
    {
        $request->validate($this->rules(), $this->validationErrorMessages());
        $response = $this->broker()->reset(
            $this->credentials($request), function ($user, $password) {
                $this->resetPassword($user, $password);
            }
        );

        $response == \Password::PASSWORD_RESET
                    ? $this->sendResetResponse($request, $response)
                    : $this->sendResetFailedResponse($request, $response);

        if($response == 'passwords.reset'){
            if (\Auth::check()) {
                \Auth::logout();
            }
            toastr()->success('Password Reset Successfully');
            return redirect()->route('login');
        }elseif($response == 'passwords.token'){
            toastr()->error('Password reset token has expired or is invalid');
            return redirect()->back();
        }else{
            toastr()->error('Oops! Something went wrong.');
            return redirect()->back();
        }
    }


    /* protected function redirectTo()
    {
        if (\Auth::check()) {
            \Auth::logout();
        }
        toastr()->success('Password Reset Successfully');
        return '/login';
    } */
}
