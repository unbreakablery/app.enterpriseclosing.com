<!DOCTYPE html>
<html>
<head>
    <title>{{ env('APP_NAME') }}</title>
</head>
<body>
    <h1>{{ env('APP_NAME') }}</h1>
    <p>Hi, {{ $name }}</p>
    <p>Welcome to our app!</p>
    <p>Your account was registered successfully!</p>
    <p>
        <strong>Your password: <span style="color: #3500D3">{{ $password }}</span></strong>
    </P>
    <p>
        <em>You can change your password after sign into our app.</em>
    </p>
    <p>Thank you!</p>
</body>
</html>