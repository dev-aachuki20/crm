@extends('emails.admin')
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
                <p style="font-size:14px;">
                    Upon successful password reset, you will receive this email as a confirmation.
                </p>
                <div class="mail-desc">
                    <ul style="list-style-type: none; padding: 0;">
                        <li style="font-size: 14px;">
                            Email: <a href="mailto:{{$email}}" target="_blank" style="text-decoration: none; color: #007bff;">{{$email}}</a>
                        </li>
                    </ul>                        
                </div>
            </div>
        </td>
    
        <tr>
            <td>
                <p style="font-size:14px;">
                    If you have any questions or need further assistance, please don't hesitate to contact our support team.
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
