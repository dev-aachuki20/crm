<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 6px 0 hsla(0, 0%, 0%, 0.1);
        }
        .card {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px 0 hsla(10, 0%, 0%, 0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        h2 {
            color: #007bff;
            font-size: 24px;
        }
        p {
            line-height: 1.6;
            font-size: 16px;
        }
        .button {
            display: inline-block;
            background-color: #007bff;
            color: #fff;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
            font-size: 16px;
        }
        .button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="header">
                <h2>Forgot Your Password?</h2>
            </div>
            <p>Hello {{ $fullname }},</p>
            <p>We received a request to reset your password. Click the button below to reset it:</p>
            <a href="{{$reset_url}}" class="button" style="color:#fff">Reset Password</a>
            <p>If you did not request a password reset, no further action is required.</p>
            <p>Thank you!</p>
        </div>
    </div>
</body>
</html>