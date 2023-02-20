<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="Include/style.css">
</head>
<body>
    <form action="login.php" method="POST">
        <h1>Login Form</h1>
        UserName: <input type="text" name="username"><br><br>
        Password: &nbsp;&nbsp;<input type="password" name="password"><br>
        Remember Me<input type="checkbox" name="remember" value="1"><br><br>
        <input type="submit" value="Login" name="login">
        <p>&nbsp;&nbsp;not a registered user?
        <button class="RegisterBtn"><a href="register.php">Register Now</a></button></p><br>
    </form>


</body>
</html>

<?php 
    if(isset($_COOKIE['username']) and isset($_COOKIE['pass']))
    {
        $username = $_COOKIE['username'];
        $pass = $_COOKIE['pass'];
        echo "<script>
        document.getElementById('username').value = '$username';
        document.getElementById('pass').value = '$pass';
        </script>";
    }
    ?>