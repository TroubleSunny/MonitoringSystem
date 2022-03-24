<?php
session_start();

include("../connection.php");
include("../functions.php");


$user_data = check_login($con);


if(isset($_POST['change']))
{
    $updatefeed = $_POST['feed'];
    $val = $_POST['change'];
    $takeid = "SELECT UserId FROM user WHERE UserId=(SELECT UserId FROM submission WHERE SubmissionId = '$val')";
    $taid = mysqli_query($con,$takeid);
    $getid = mysqli_fetch_assoc($taid);
    $id = $getid['UserId'];
    $feedback = $_POST['feedback'];
    if($updatefeed == 0)
    {
        mysqli_query($con,"INSERT INTO feedback (SubmissionId,UserId,FeedbackDetails) VALUES ('$val','$id','$feedback')");
        header("Location: ../Dean.php?=1");
    }
    else
    {
        mysqli_query($con,"UPDATE feedback SET FeedbackDetails='$feedback' WHERE FeedbackId = '$updatefeed'");
        header("Location: ../Dean.php?=2");
    }
    
}
