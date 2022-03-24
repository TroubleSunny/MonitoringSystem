<?php
session_start();

include("../connection.php");
include("../functions.php");


$user_data = check_login($con);

if(isset($_POST['submit']))
{
    $userid = $_POST['change'];
    $password = $_POST['password'];
    $username = $_POST['username'];
    $name = $_POST['name'];
    $email = $_POST['email'];

    $title = $_FILES["file"]["name"];
    $pname = rand(1000,10000)."-".$_FILES["file"]["name"];
    $tname = $_FILES["file"]["tmp_name"];
    $uploads_dir = '../uploads/'.$pname;
    move_uploaded_file($tname, $uploads_dir);

    
    $stat = ("UPDATE user SET UserName = '$username', RealName='$name', UserPassword='$password', UserEmail='$email', UserPhoto = '$pname' WHERE UserId = '$userid'");
    mysqli_query($con,$stat);
    header("Location: ../FacultyAccount.php?update=suceess");
}