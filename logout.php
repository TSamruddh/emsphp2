<?php 
  session_start();
  session_unset();
  session_destroy();

    if(isset($_COOKIE['username']) and isset($_COOKIE['pass']))
    {
        $username = $_COOKIE['username'];
        $pass = $_COOKIE['pass'];
        
        setcookie('username',$username,time()-1);
        setcookie('pass',$pass,time()-1);
    }
    header("Location: index.php");
    // echo "You successfully logged out. click here to <a href='login.php'>login again</a>";


?>