<?php
session_start();

include("../connection.php");
include("../functions.php");


$user_data = check_login($con);

if(isset($_POST['submit']))
{
    $test = $user_data['UserId'];
    $check = "SELECT SubmissionId FROM submission WHERE UserId = '$test' AND (SubmissionStatus = 'Ongoing' OR SubmissionStatus = 'Submitted') AND QuarterId = (SELECT QuarterId FROM quarter WHERE QuarterProgress='Ongoing')";
    $result = mysqli_query($con, $check);
    $row = mysqli_fetch_assoc($result);
    $id = $row['SubmissionId'];
    
    $title = $_FILES["file"]["name"];
    $pname = rand(1000,10000)."-".$_FILES["file"]["name"];
    $tname = $_FILES["file"]["tmp_name"];
    $uploads_dir = '../uploads/'.$pname;
    move_uploaded_file($tname, $uploads_dir);
    
    $award = $_POST['award'];
    $class = $_POST['Classification'];
    $body = $_POST['body'];
    $level = $_POST['level'];
    $venue = $_POST['venue'];
    $datefrom = $_POST['datefrom'];
    $dateto = $_POST['dateto'];
    $change = $_POST['change'];

    if($change!=null)
    {
        $check = ("SELECT AwardsId FROM awards WHERE AwardsId = '$change'");
        $result = mysqli_query($con,$check);
        if($result->num_rows == 0)
        {
            $sql = "INSERT INTO awards (SubmissionId,AwAward,AwClass,AwBody,AwLevel,AwVenue,AwDateFrom,AwDateTo,AwFilename,AwTempName) VALUES ('$id','$award','$class','$body','$level','$venue','$datefrom','$dateto','$title','$pname');";
            mysqli_query($con,$sql);
            $stat = ("UPDATE addstat SET stat = 0 WHERE id = 1");
            mysqli_query($con,$stat);
            header("Location: ../OutstandingB.php?insert=success");
        }
        else
        {
            if($title==null)
            {
                $sql = ("UPDATE awards SET SubmissionId ='$id',AwAward = '$award',AwClass = '$class',AwBody = '$body',AwLevel = '$level',AwVenue = '$venue',AwDateFrom = '$datefrom',AwDateTo = '$dateto' WHERE AwardsId = '$change';");
                mysqli_query($con,$sql);
                header("Location: ../OutstandingB.php?Record=$change");
            }
            else
            {
                $checkfile = ("SELECT AwTempName FROM awards WHERE AwardsId = '$change'");
                $resultfile = mysqli_query($con,$checkfile);
                $updatefile = mysqli_fetch_assoc($resultfile);
                unlink("../uploads/".$updatefile);
                $sql = ("UPDATE awards SET SubmissionId ='$id',AwAward = '$award',AwClass = '$class',AwBody = '$body',AwLevel = '$level',AwVenue = '$venue',AwDateFrom = '$datefrom',AwDateTo = '$dateto', AwFileName = '$title', AwTempName = '$pname' WHERE AwardsId = '$change';");
                mysqli_query($con,$sql);
                header("Location: ../OutstandingB.php?Record=$change");
            }

        }
    }

    else
    {
        $sql = "INSERT INTO awards (SubmissionId,AwAward,AwClass,AwBody,AwLevel,AwVenue,AwDateFrom,AwDateTo,AwFilename,AwTempName) VALUES ('$id','$award','$class','$body','$level','$venue','$datefrom','$dateto','$title','$pname');";
        mysqli_query($con,$sql);
        $stat = ("UPDATE addstat SET stat = 0 WHERE id = 1");
        mysqli_query($con,$stat);
        header("Location: ../OutstandingB.php");
    }

}

if(isset($_POST['reseter']))
{
    $change = $_POST['change'];
    if($change!=null)
    {
        $sql = "DELETE FROM awards WHERE AwardsId = $change";
        mysqli_query($con,$sql);
        header("Location: ../OutstandingB.php");
    }
}

if(isset($_POST['add']))
{
    $stat = ("UPDATE addstat SET stat = 1 WHERE id = 1");
    mysqli_query($con,$stat);
    header("Location: ../OutstandingB.php");
}
?>

