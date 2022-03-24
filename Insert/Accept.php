<?php
session_start();
include("../connection.php");
include("../functions.php");



if(isset($_POST['change']))
{   
    $val = $_POST['change'];
    $checksql = "SELECT RevStat FROM submission WHERE SubmissionId = '$val'";
    $row1 = mysqli_query($con,$checksql);
    $row = mysqli_fetch_assoc($row1);
    $r = $row['RevStat'];

    if($r == 1)
    {
        $_SESSION['suc'] = 1;
        header("Location: ../Dean.php");
    }

    else
    {
        $sql = "UPDATE submission SET ValidationStatus = 'Accepted' WHERE SubmissionId = '$val'";
        mysqli_query($con,$sql);
        $_SESSION['suc'] = 2;
        header("Location: ../Dean.php");
        
    }
    

    
}
?>