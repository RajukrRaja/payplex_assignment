<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Welcome to Page Management System</h1>
        <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
        <a href="{{ route('register.form') }}" class="btn btn-secondary">Register</a>
    </div>
</body>
</html>