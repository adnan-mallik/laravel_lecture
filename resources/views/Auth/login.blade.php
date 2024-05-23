<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    

    <form action="{{ route('auth.login') }}" method="POST">
        @csrf
        <div>
            <label for="email">Email</label>
            <input type="email" name="useremail" id="email">
        </div>
        <div>
            <label for="password">Password</label>
            <input type="password" name="userpassword" id="password">
        </div>
        <div>
            <button type="submit">Login</button>
        </div>
    </form>
</body>
</html>