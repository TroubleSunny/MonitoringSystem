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
    
    $output = $_POST['output'];
    $datefrom = $_POST['datefrom'];
    $dateto = $_POST['dateto'];
    $desc = $_POST['desc'];
    $status = $_POST['status'];
    $remarks = $_POST['remarks'];
    $change = $_POST['change'];

    if($change!=null)
    {
        $check = ("SELECT OeId FROM opcre WHERE OeId = '$change'");
        $result = mysqli_query($con,$check);
        if($result->num_rows == 0)
        {
            $sql = "INSERT INTO opcre (SubmissionId,OeOutput,OeTargetDate,OeActualDate,OeDesc,OeStatus,OeRemarks,OeFilename,OeTempName) VALUES ('$id','$output','$datefrom','$dateto','$desc','$status','$remarks','$title','$pname');";
            mysqli_query($con,$sql);
            $stat = ("UPDATE addstat SET stat = 0 WHERE id = 1");
            mysqli_query($con,$stat);
            header("Location: ../AccomplishmentOPCR2.php?insert=success");
        }
        else
        {
            if($title==null)
            {
                $sql = ("UPDATE opcre SET SubmissionId ='$id',OeOutput = '$output',OeTargetDate = '$datefrom',OeActualDate = '$dateto',OeDesc = '$desc',OeStatus = '$status',OeRemarks='$remarks' WHERE OeId = '$change';");
                mysqli_query($con,$sql);
                header("Location: ../AccomplishmentOPCR2.php?Record=$change");
            }
            else
            {
                $checkfile = ("SELECT OeTempName FROM opcre WHERE OeId = '$change'");
                $resultfile = mysqli_query($con,$checkfile);
                $updatefile = mysqli_fetch_assoc($resultfile);
                unlink("../uploads/".$updatefile);
                $sql = ("UPDATE opcre SET SubmissionId ='$id',OeOutput = '$output',OeTargetDate = '$datefrom',OeActualDate = '$dateto',OeDesc = '$desc',OeStatus = '$status',OeRemarks='$remarks', OeFilename = '$title', OeTempName='$pname' WHERE OeId = '$change';");
                mysqli_query($con,$sql);
                header("Location: ../AccomplishmentOPCR2.php?Record=$change");
            }

        }
    }

    else
    {
        $sql = "INSERT INTO opcre (SubmissionId,OeOutput,OeTargetDate,OeActualDate,OeDesc,OeStatus,OeRemarks,OeFilename,OeTempName) VALUES ('$id','$output','$datefrom','$dateto','$desc','$status','$remarks','$title','$pname');";
        mysqli_query($con,$sql);
        $stat = ("UPDATE addstat SET stat = 0 WHERE id = 1");
        mysqli_query($con,$stat);
        header("Location: ../AccomplishmentOPCR2.php?insert=success");
    }

}

if(isset($_POST['reseter']))
{
    $change = $_POST['change'];
    if($change!=null)
    {
        $sql = "DELETE FROM opcre WHERE OeId = $change";
        mysqli_query($con,$sql);
        header("Location: ../AccomplishmentOPCR2.php");
    }
}
if(isset($_POST['add']))
{
    $stat = ("UPDATE addstat SET stat = 1 WHERE id = 1");
    mysqli_query($con,$stat);
    header("Location: ../AccomplishmentOPCR2.php");
}

?>