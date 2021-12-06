<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Start</title>
</head>

<body>

<div class="message-box">

    <div class="buttons-con">
        <div class="action-link-wrap">
            <h2>Không có tài khoản google</h2>
            <a href="{{route('admin.login')}}" class="link-button">LOGIN</a>
            <a href="{{route('admin.register')}}" class="link-button">SIGN UP</a>
        </div>
        <div class="action-link-wrap">
            <h2>Có tài khoản google</h2>
            <a href="{{ url('/auth/redirect/google') }}" class="link-button">LOGIN</a>
            <a href="{{ url('/auth/redirect/google') }}" class="link-button">SIGN UP</a>
        </div>
    </div>
</div>
</body>
</html>
