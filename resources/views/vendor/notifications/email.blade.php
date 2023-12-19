<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
</head>
<body>
    <p>You are receiving this email because we received a password reset request for your ActivEvent account.</p>
    <p><a href="{{$actionUrl}}">{{$actionUrl}}</a></p>
    <p>This password reset link will expire in {{config('auth.passwords.'.config('auth.defaults.passwords').'.expire')}} minutes.</p>
    <p>If you did not request a password reset, no further action is required.</p>
    <p>Thank you for using our service, From ActivEvent team.</p>
</body>
</html>