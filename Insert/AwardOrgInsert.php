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

    $aname = $_POST['aname'];
    $body = $_POST['body'];
    $place = $_POST['place'];
    $level = $_POST['level'];

    $dateto = $_POST['dateto'];

    
    
    $change = $_POST['change'];

    if($change!=null)
    {
        $check = ("SELECT AoId FROM awardorg WHERE AoId = '$change'");
        $result = mysqli_query($con,$check);
        if($result->num_rows == 0)
        {
            $sql = "INSERT INTO awardorg (SubmissionId,AoName,AoBody,AoPlace,AoDate,AoLevel,AoFilename,AoTempName) VALUES ('$id','$aname','$body','$place','$dateto','$level','$title','$pname');";
            mysqli_query($con,$sql);
            $stat = ("UPDATE addstat SET stat = 0 WHERE id = 1");
            mysqli_query($con,$stat);
            header("Location: ../AwardsOrganization.php?insert=success");
        }
        else
        {
            if($title==null)
            {
                $sql = ("UPDATE awardorg SET SubmissionId ='$id',AoName='$aname',AoBody='$body',AoPlace='$place',AoDate='$dateto',AoLevel='$level' WHERE AoId = '$change';");
                mysqli_query($con,$sql);
                header("Location: ../AwardsOrganization.php?Record=$change");
            }
            else
            {
                $checkfile = ("SELECT AoTempName FROM awardorg WHERE AoId = '$change'");
                $resultfile = mysqli_query($con,$checkfile);
                $updatefile = mysqli_fetch_assoc($resultfile);
                unlink("../uploads/".$updatefile);
                $sql = ("UPDATE awardorg SET SubmissionId ='$id',AoName='$aname',AoBody='$body',AoPlace='$place',AoDate='$dateto',AoLevel='$level',AoFilename='$title',AoTempName='$pname' WHERE AoId = '$change';");
                mysqli_query($con,$sql);
                header("Location: ../AwardsOrganization.php?Record=$change");
            }

        }
    }

    else
    {
        $sql = "INSERT INTO awardorg (SubmissionId,AoName,AoBody,AoPlace,AoDate,AoLevel,AoFilename,AoTempName) VALUES ('$id','$aname','$body','$place','$dateto','$level','$title','$pname');";
        mysqli_query($con,$sql);
        $stat = ("UPDATE addstat SET stat = 0 WHERE id = 1");
        mysqli_query($con,$stat);
        header("Location: ../AwardsOrganization.php?insert=success");
    }

}
if(isset($_POST['reseter']))
{
    $change = $_POST['change'];
    if($change!=null)
    {
        $sql = "DELETE FROM awardorg WHERE AoId = $change";
        mysqli_query($con,$sql);
        header("Location: ../AwardsOrganization.php");
    }
}

if(isset($_POST['add']))
{
    $stat = ("UPDATE addstat SET stat = 1 WHERE id = 1");
    mysqli_query($con,$stat);
    header("Location: ../AwardsOrganization.php");
}

?>