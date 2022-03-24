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

    $vname = $_POST['vname'];
    $revenue = $_POST['revenue'];
    $cost = $_POST['cost'];
    $rate = $_POST['rate'];

    $dateto = $_POST['dateto'];

    
    
    $change = $_POST['change'];

    if($change!=null)
    {
        $check = ("SELECT VdId FROM viabledemo WHERE VdId = '$change'");
        $result = mysqli_query($con,$check);
        if($result->num_rows == 0)
        {
            $sql = "INSERT INTO viabledemo (SubmissionId,VdName,VdRevenue,VdCost,VdDateStart,VdRate,VdFilename,VdTempName) VALUES ('$id','$vname','$revenue','$cost','$dateto','$rate','$title','$pname');";
            mysqli_query($con,$sql);
            $stat = ("UPDATE addstat SET stat = 0 WHERE id = 1");
            mysqli_query($con,$stat);
            header("Location: ../ViableProjects.php?insert=success");
        }
        else
        {
            if($title==null)
            {
                $sql = ("UPDATE viabledemo SET SubmissionId ='$id',VdName='$vname',VdRevenue='$revenue',VdCost='$cost',VdDateStart='$dateto',VdRate='$rate' WHERE VdId = '$change';");
                mysqli_query($con,$sql);
                header("Location: ../ViableProjects.php?Record=$change");
            }
            else
            {
                $checkfile = ("SELECT VdTempName FROM viabledemo WHERE VdId = '$change'");
                $resultfile = mysqli_query($con,$checkfile);
                $updatefile = mysqli_fetch_assoc($resultfile);
                unlink("../uploads/".$updatefile);
                $sql = ("UPDATE viabledemo SET SubmissionId ='$id',VdName='$vname',VdRevenue='$revenue',VdCost='$cost',VdDateStart='$dateto',VdRate='$rate',VdFilename='$title',VdTempName='$pname' WHERE VdId = '$change';");
                mysqli_query($con,$sql);
                header("Location: ../ViableProjects.php?Record=$change");
            }

        }
    }

    else
    {
        $sql = "INSERT INTO viabledemo (SubmissionId,VdName,VdRevenue,VdCost,VdDateStart,VdRate,VdFilename,VdTempName) VALUES ('$id','$vname','$revenue','$cost','$dateto','$rate','$title','$pname');";
        mysqli_query($con,$sql);
        $stat = ("UPDATE addstat SET stat = 0 WHERE id = 1");
        mysqli_query($con,$stat);
        header("Location: ../ViableProjects.php?insert=success");
    }

}
if(isset($_POST['reseter']))
{
    $change = $_POST['change'];
    if($change!=null)
    {
        $sql = "DELETE FROM viabledemo WHERE VdId = $change";
        mysqli_query($con,$sql);
        header("Location: ../ViableProjects.php");
    }
}

if(isset($_POST['add']))
{
    $stat = ("UPDATE addstat SET stat = 1 WHERE id = 1");
    mysqli_query($con,$stat);
    header("Location: ../ViableProjects.php");
}

?>