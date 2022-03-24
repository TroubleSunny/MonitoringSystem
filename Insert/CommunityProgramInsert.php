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

    $rtitle = $_POST['rtitle'];
    $place = $_POST['place'];
    $level = $_POST['level'];

    $dateto = $_POST['dateto'];

    
    
    $change = $_POST['change'];

    if($change!=null)
    {
        $check = ("SELECT RapId FROM relationprogram WHERE RapId = '$change'");
        $result = mysqli_query($con,$check);
        if($result->num_rows == 0)
        {
            $sql = "INSERT INTO relationprogram (SubmissionId,RapTitle,RapPlace,RapDate,RapLevel,RapFilename,RapTempName) VALUES ('$id','$rtitle','$place','$dateto','$level','$title','$pname');";
            mysqli_query($con,$sql);
            $stat = ("UPDATE addstat SET stat = 0 WHERE id = 1");
            mysqli_query($con,$stat);
            header("Location: ../CommunityProgram.php?insert=success");
        }
        else
        {
            if($title==null)
            {
                $sql = ("UPDATE relationprogram SET SubmissionId ='$id',RapTitle='$rtitle',RapPlace='$place',RapDate='$dateto',RapLevel='$level' WHERE RapId = '$change';");
                mysqli_query($con,$sql);
                header("Location: ../CommunityProgram.php?Record=$change");
            }
            else
            {
                $checkfile = ("SELECT RapTempName FROM relationprogram WHERE RapId = '$change'");
                $resultfile = mysqli_query($con,$checkfile);
                $updatefile = mysqli_fetch_assoc($resultfile);
                unlink("../uploads/".$updatefile);
                $sql = ("UPDATE relationprogram SET SubmissionId ='$id',RapTitle='$rtitle',RapPlace='$place',RapDate='$dateto',RapLevel='$level',RapFilename='$title',RapTempName='$pname' WHERE RapId = '$change';");
                mysqli_query($con,$sql);
                header("Location: ../CommunityProgram.php?Record=$change");
            }

        }
    }

    else
    {
        $sql = "INSERT INTO relationprogram (SubmissionId,RapTitle,RapPlace,RapDate,RapLevel,RapFilename,RapTempName) VALUES ('$id','$rtitle','$place','$dateto','$level','$title','$pname');";
        mysqli_query($con,$sql);
        $stat = ("UPDATE addstat SET stat = 0 WHERE id = 1");
        mysqli_query($con,$stat);
        header("Location: ../CommunityProgram.php?insert=success");
    }

}
if(isset($_POST['reseter']))
{
    $change = $_POST['change'];
    if($change!=null)
    {
        $sql = "DELETE FROM relationprogram WHERE RapId = $change";
        mysqli_query($con,$sql);
        header("Location: ../CommunityProgram.php");
    }
}

if(isset($_POST['add']))
{
    $stat = ("UPDATE addstat SET stat = 1 WHERE id = 1");
    mysqli_query($con,$stat);
    header("Location: ../CommunityProgram.php");
}

if(isset($_POST['submitqar']))
{
    $date = date('Y-m-d');
    $test = $user_data['UserId'];
    $stat = ("UPDATE submission SET SubmissionStatus ='Submitted',DateSubmitted='$date' WHERE UserId = $test");
    mysqli_query($con,$stat);
    header("Location: ../CommunityProgram.php?success=1");
}

?>