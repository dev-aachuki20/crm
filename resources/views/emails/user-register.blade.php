@extends('emails.admin')
@section('email-content')
    <tr>
        <td>
            <p class="mail-title" style="font-size:14px;">
                <b>Hello</b> {{ ucwords($fullname) }},
            </p>
            <div class="mail-desc">
                <p style="font-size:14px;">
                    Your account has been successfully registered. Below is your password:
                </p>

                <p><strong>{{ $password }}</strong></p>

                <p>Make sure to keep it secure. You can change your password after logging in.</p>

                <p>Thank you for registering!</p>
            </div>
        </td>

    <tr>
        <td>
            <p style="font-size:14px;">Best regards,</p>
            <p style="font-size:14px;">{{ config('app.name') }}</p>
        </td>
    </tr>
    </tr>
@endsection
