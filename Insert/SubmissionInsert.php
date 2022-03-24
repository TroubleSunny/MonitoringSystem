<?php
session_start();

include("../connection.php");
include("../functions.php");


$user_data = check_login($con);

$id = $user_data['UserId'];
$checksub = ("SELECT QuarterId FROM quarter WHERE QuarterProgress = 'Ongoing' limit 1");
$quarterstat = mysqli_query($con,$checksub);
$quarter = mysqli_fetch_assoc($quarterstat);
$take = $quarter['QuarterId'];
$check = ("SELECT SubmissionId FROM submission WHERE UserId = '$id' AND QuarterId='$take'");
$result = mysqli_query($con,$check);



if(mysqli_num_rows($result)==0)
{
  $sqler = "INSERT INTO submission (QuarterId,UserId,SubmissionStatus) VALUES ((SELECT QuarterId FROM quarter WHERE QuarterProgress = 'Ongoing'),'$id','Ongoing');";
  mysqli_query($con,$sqler);
  header("Location: ../AccomplishmentReportA.php");
}

else
{
  header("Location: ../AccomplishmentReportA.php");
}

?> 

