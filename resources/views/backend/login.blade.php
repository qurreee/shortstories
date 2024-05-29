<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LOGIN BRO</title>
</head>
<body>
    <div style="background: gray; margin:10px">
        <h2>LOGIN</h2>
        @if ($errors->any())
            <h4>{{$errors->first()}}</h4>
        @endif
        <form action="/login" method="POST">
            @csrf
            username
            <input type="text" name="loginname" placeholder="username"><br>
            password
            <input type="password" name="loginpassword" placeholder="password"><br>
            <button>Login</button>
        </form>
        <form action="/register" method="get">
            dont have an account?
            <button>register</button>
        </form>
    </div>
</body>
</html>