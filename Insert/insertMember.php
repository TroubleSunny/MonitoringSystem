<?php
session_start();

include("../connection.php");
include("../functions.php");


$user_data = check_login($con);

if(isset($_POST['submit']))
{
    $place = $_POST['change'];
    $username = $_POST['username'];
    $fullname = $_POST['fullname'];
    $userlevel = $_POST['userlevel'];
    $password = $_POST['password'];
    $section = $_POST['section'];

    $sql = "INSERT INTO user (UserName,UserPassword,UserLevel,RealName,College) VALUES ('$username','$password','$userlevel','$fullname','$section')"; 
    mysqli_query($con,$sql);
    if($place == 1)
    {
        header("Location: ../Dean.php");
    }
    else
    {
        header("Location: ../Higher.php");
    }
   

}

?>