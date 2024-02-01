<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /* For Overide the Toastr Function */
    public function sendResetLinkEmail(Request $request)
    {
        if ($request['email'] === null) {
            toastr()->error('Email is required!', 'Error');
            return redirect()->back();
        }
        $this->validateEmail($request);

        $response = $this->broker()->sendResetLink(
            $this->credentials($request)
        );

        $response == \Password::RESET_LINK_SENT
                    ? $this->sendResetLinkResponse($request, $response)
                    : $this->sendResetLinkFailedResponse($request, $response);
                    \Log::info($response);
        if($response == 'passwords.sent'){
            toastr()->success('Reset password mail successfully sent in your mail!', 'Sccuess');
        }elseif($response == 'passwords.user'){
            toastr()->error('Email not found from our record!', 'Error');
        }
        return redirect()->back();
    }
}
