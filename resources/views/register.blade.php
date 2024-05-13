<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
</head>
<body>
    <div style="background: gray; margin:10px">
        <h2>REGISTER</h2>
        <form action="/register" method="POST">
            @csrf
            username
            <input type="text" name="name" placeholder="username"><br>
            email
            <input type="text" name="email" placeholder="Email"><br>
            password
            <input type="password" name="password" placeholder="password"><br>
            <button>register</button>
        </form>
        <form action="/">
            Already have an account?
            <button>Login</button>
        </form>
    </div>
</body>
</html>