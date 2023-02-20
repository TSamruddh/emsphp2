<?php
    // $myuser = "admin";
    // $mypass = "admin";
    include('db_conn.php');
    $myuser=$_POST['username'];
    $mypass=md5($_POST['password']);
    $query=mysqli_query($conn,"SELECT * FROM `users` WHERE `user_name`='$myuser' AND `password`='$mypass'");
    if (mysqli_num_rows($query) == 0){
        $_SESSION['message']="Login Failed. User not Found!";
        echo "no user found";
        header('location: login.php');
       }
       else
       {
            if(isset($_POST['login'])){
                $username = $_POST['username'];
                $pass = md5($_POST['password']);

                if($username == $myuser and $pass == $mypass){
                    if(isset($_POST['remember'])){
                        setcookie('username',$username,time()+60*60*7);
                        setcookie('pass',$pass,time()+60*60*7);
                    }
                    session_start();
                    $_SESSION['username'] = $username;
                    header("location: View_From_Database.php");
                }else{
                    echo "User Name or Password is Invalid.<br> click here to <a href='login.php'>try again</a>";
                }

            }
            else
            {
                header("location: login.php");
            }
        }
?>