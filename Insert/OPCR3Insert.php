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
        $check = ("SELECT OtId FROM opcrt WHERE OtId = '$change'");
        $result = mysqli_query($con,$check);
        if($result->num_rows == 0)
        {
            $sql = "INSERT INTO opcrt (SubmissionId,OtOutput,OtTargetDate,OtActualDate,OtDesc,OtStatus,OtRemarks,OtFilename,OtTempName) VALUES ('$id','$output','$datefrom','$dateto','$desc','$status','$remarks','$title','$pname');";
            mysqli_query($con,$sql);
            $stat = ("UPDATE addstat SET stat = 0 WHERE id = 1");
            mysqli_query($con,$stat);
            header("Location: ../AccomplishmentOPCR3.php?insert=success");
        }
        else
        {
            if($title==null)
            {
                $sql = ("UPDATE opcrt SET SubmissionId ='$id',OtOutput = '$output',OtTargetDate = '$datefrom',OtActualDate = '$dateto',OtDesc = '$desc',OtStatus = '$status',OtRemarks='$remarks' WHERE OtId = '$change';");
                mysqli_query($con,$sql);
                header("Location: ../AccomplishmentOPCR3.php?Record=$change");
            }
            else
            {
                $checkfile = ("SELECT OtTempName FROM opcrt WHERE OtId = '$change'");
                $resultfile = mysqli_query($con,$checkfile);
                $updatefile = mysqli_fetch_assoc($resultfile);
                unlink("../uploads/".$updatefile);
                $sql = ("UPDATE opcrt SET SubmissionId ='$id',OtOutput = '$output',OtTargetDate = '$datefrom',OtActualDate = '$dateto',OtDesc = '$desc',OtStatus = '$status',OtRemarks='$remarks', OtFilename = '$title', OtTempName='$pname' WHERE OtId = '$change';");
                mysqli_query($con,$sql);
                header("Location: ../AccomplishmentOPCR3.php?Record=$change");
            }

        }
    }

    else
    {
        $sql = "INSERT INTO opcrt (SubmissionId,OtOutput,OtTargetDate,OtActualDate,OtDesc,OtStatus,OtRemarks,OtFilename,OtTempName) VALUES ('$id','$output','$datefrom','$dateto','$desc','$status','$remarks','$title','$pname');";
        mysqli_query($con,$sql);
        $stat = ("UPDATE addstat SET stat = 0 WHERE id = 1");
        mysqli_query($con,$stat);
        header("Location: ../AccomplishmentOPCR3.php?insert=success");
    }

}
if(isset($_POST['reseter']))
{
    $change = $_POST['change'];
    if($change!=null)
    {
        $sql = "DELETE FROM opcrt WHERE OtId = $change";
        mysqli_query($con,$sql);
        header("Location: ../AccomplishmentOPCR3.php");
    }
}

if(isset($_POST['add']))
{
    $stat = ("UPDATE addstat SET stat = 1 WHERE id = 1");
    mysqli_query($con,$stat);
    header("Location: ../AccomplishmentOPCR3.php");
}

?>