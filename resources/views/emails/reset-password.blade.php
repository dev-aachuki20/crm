@extends('emails.admin')
{{-- @section('title', 'Forgot Your Password?') --}}
@section('email-content')
    <tr>
        <td>
            <p class="mail-title" style="font-size:14px;">
                <b>Hello</b> {{ ucwords($fullname) }},
            </p>
            <div class="mail-desc">
                <p style="font-size:14px;">
                    We have received a request to reset your password for {{ config('app.name') }}. To proceed with the password reset, please click the button below:
                </p>
                <div style="text-align: center;">
                    <a href="{{$reset_url}}" style="display: inline-block; background-color: #007bff; color: #fff; padding: 8px 16px; text-decoration: none; border-radius: 5px; font-size: 16px;">Reset Password</a>
                </div>                      
            </div>
        </td>
    
        <tr>
            <td>
                <p style="font-size:14px;">
                    If you did not request a password reset, no further action is required.
                </p>

            </td>
        </tr>

        <tr>
            <td>
                <p style="font-size:14px;">Best regards,</p>
                <p style="font-size:14px;">{{ config('app.name') }}</p>
            </td>
        </tr>
    </tr>
@endsection
