<?php
session_start();

include("connection.php");
include("functions.php");


$user_data = check_login($con);

    $test = $_POST['sub'];
    
    $date = date('Y-m-d');
    $stat = ("UPDATE submission SET SubmissionStatus ='Submitted',DateSubmitted='$date' WHERE SubmissionId = '$test'");
    mysqli_query($con,$stat);

?>