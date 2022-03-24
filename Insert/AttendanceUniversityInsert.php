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
    
    $desc = $_POST['desc'];
    $datefrom = $_POST['datefrom'];
    $dateto = $_POST['dateto'];
    $status = $_POST['status'];
    $change = $_POST['change'];

    if($change!=null)
    {
        $check = ("SELECT AuId FROM attendanceu WHERE AuId = '$change'");
        $result = mysqli_query($con,$check);
        if($result->num_rows == 0)
        {
            $sql = "INSERT INTO attendanceu (SubmissionId,AuDesc,AuDateStart,AuDateComp,AuStatus,AuFilename,AuTempName) VALUES ('$id','$desc','$datefrom','$dateto','$status','$title','$pname');";
            mysqli_query($con,$sql);
            $stat = ("UPDATE addstat SET stat = 0 WHERE id = 1");
            mysqli_query($con,$stat);
            header("Location: ../AttendanceUniversity.php?insert=success");
        }
        else
        {
            if($title==null)
            {
                $sql = ("UPDATE attendanceu SET SubmissionId ='$id',AuDesc = '$desc',AuDateStart = '$datefrom',AuDateComp = '$dateto',AuStatus = '$status' WHERE AuId = '$change';");
                mysqli_query($con,$sql);
                header("Location: ../AttendanceUniversity.php?Record=$change");
            }
            else
            {
                $checkfile = ("SELECT AuTempName FROM attendanceu WHERE AuId = '$change'");
                $resultfile = mysqli_query($con,$checkfile);
                $updatefile = mysqli_fetch_assoc($resultfile);
                unlink("../uploads/".$updatefile);
                $sql = ("UPDATE attendanceu SET SubmissionId ='$id',AuDesc = '$desc',AuDateStart = '$datefrom',AuDateComp = '$dateto',AuStatus = '$status', AuFilename = '$title', AuTempName='$pname' WHERE AuId = '$change';");
                mysqli_query($con,$sql);
                header("Location: ../AttendanceUniversity.php?Record=$change");
            }

        }
    }

    else 
    {
        $sql = "INSERT INTO attendanceu (SubmissionId,AuDesc,AuDateStart,AuDateComp,AuStatus,AuFilename,AuTempName) VALUES ('$id','$desc','$datefrom','$dateto','$status','$title','$pname');";
        mysqli_query($con,$sql);
        $stat = ("UPDATE addstat SET stat = 0 WHERE id = 1");
        mysqli_query($con,$stat);
        header("Location: ../AttendanceUniversity.php?insert=success");
    }

}
if(isset($_POST['reseter']))
{
    $change = $_POST['change'];
    if($change!=null)
    {
        $sql = "DELETE FROM attendanceu WHERE AuId = $change";
        mysqli_query($con,$sql);
        header("Location: ../AttendanceUniversity.php");
    }
}

if(isset($_POST['add']))
{
    $stat = ("UPDATE addstat SET stat = 1 WHERE id = 1");
    mysqli_query($con,$stat);
    header("Location: ../AttendanceUniversity.php");
}

?>