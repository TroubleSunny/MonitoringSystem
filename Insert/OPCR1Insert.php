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
        $check = ("SELECT OpId FROM opcr WHERE OpId = '$change'");
        $result = mysqli_query($con,$check);
        if($result->num_rows == 0)
        {
            $sql = "INSERT INTO opcr (SubmissionId,OpOutput,OpTargetDate,OpActualADate,OpDesc,OpStatus,OpRemarks,OpFilename,OpTempName) VALUES ('$id','$output','$datefrom','$dateto','$desc','$status','$remarks','$title','$pname');";
            mysqli_query($con,$sql);
            $stat = ("UPDATE addstat SET stat = 0 WHERE id = 1");
            mysqli_query($con,$stat);
            header("Location: ../AccomplishmetOPCR1.php?insert=success");
        }
        else
        {
            if($title==null)
            {
                $sql = ("UPDATE opcr SET SubmissionId ='$id',OpOutput = '$output',OpTargetDate = '$datefrom',OpActualDate = '$dateto',OpDesc = '$desc',OpStatus = '$status',OpRemarks='$remarks' WHERE OpId = '$change';");
                mysqli_query($con,$sql);
                header("Location: ../AccomplishmentOPCR1.php?Record=$change");
            }
            else
            {
                $checkfile = ("SELECT OpTempName FROM opcr WHERE OpId = '$change'");
                $resultfile = mysqli_query($con,$checkfile);
                $updatefile = mysqli_fetch_assoc($resultfile);
                unlink("../uploads/".$updatefile);
                $sql = ("UPDATE opcr SET SubmissionId ='$id',OpOutput = '$output',OpTargetDate = '$datefrom',OpActualDate = '$dateto',OpDesc = '$desc',OpStatus = '$status',OpRemarks='$remarks', OpFilename = '$title', OpTempName='$pname' WHERE OpId = '$change';");
                mysqli_query($con,$sql);
                header("Location: ../AccomplishmentOPCR1.php?Record=$change");
            }

        }
    }

    else
    {
        $sql = "INSERT INTO opcr (SubmissionId,OpOutput,OpTargetDate,OpActualDate,OpDesc,OpStatus,OpRemarks,OpFilename,OpTempName) VALUES ('$id','$output','$datefrom','$dateto','$desc','$status','$remarks','$title','$pname');";
        mysqli_query($con,$sql);
        $stat = ("UPDATE addstat SET stat = 0 WHERE id = 1");
        mysqli_query($con,$stat);
        header("Location: ../AccomplishmentOPCR1.php?insert=success");
    }

}
if(isset($_POST['reseter']))
{
    $change = $_POST['change'];
    if($change!=null)
    {
        $sql = "DELETE FROM opcr WHERE OpId = $change";
        mysqli_query($con,$sql);
        header("Location: ../AccomplishmentOPCR1.php");
    }
}

if(isset($_POST['add']))
{
    $stat = ("UPDATE addstat SET stat = 1 WHERE id = 1");
    mysqli_query($con,$stat);
    header("Location: ../AccomplishmentOPCR1.php");
}

?>