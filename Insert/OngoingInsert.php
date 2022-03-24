<?php
session_start();

include("../connection.php");
include("../functions.php");


$user_data = check_login($con);

if(isset($_POST['submit']))
{
    $test = $user_data['UserId'];
    $check = "SELECT SubmissionId FROM submission WHERE UserId = '$test' AND (SubmissionStatus = 'Ongoing' OR SubmissionStatus = 'Submitted') AND QuarterId = (SELECT QuarterId FROM quarter WHERE QuarterProgress = 'Ongoing')";
    $result = mysqli_query($con, $check);
    $row = mysqli_fetch_assoc($result);
    $id = $row['SubmissionId'];
    
    $title = $_FILES["file"]["name"];
    $pname = rand(1000,10000)."-".$_FILES["file"]["name"];
    $tname = $_FILES["file"]["tmp_name"];
    $uploads_dir = '../uploads/'.$pname;
    move_uploaded_file($tname, $uploads_dir);
    
    $degree = $_POST['Degree'];
    $schoolname = $_POST['schoolname'];
    $level = $_POST['level'];
    $typesupport = $_POST['typesupport'];
    $sponsor = $_POST['sponsor'];
    $amount = $_POST['amount'];
    $datefrom = $_POST['datefrom'];
    $dateto = $_POST['dateto'];
    $studystatus = $_POST['studystatus'];
    $numunits = $_POST['numunits'];
    $numcurrent = $_POST['numcurrent'];
    $change = $_POST['change'];

    if($change!=null)
    {
        $check = ("SELECT OngoingId FROM ongoingstudy WHERE OngoingId = '$change'");
        $result = mysqli_query($con,$check);
        if($result->num_rows == 0)
        {
            $sql = "INSERT INTO ongoingstudy (SubmissionId,Deg,SchoolName,SchoolLevel,SupportType,SponsorName,Amount,OngoingFrom,OngoingTo,OngoingStatus,NumUnits,NumEnrolled,OngoingFilename,OngoingTempName) VALUES ('$id','$degree','$schoolname','$level','$typesupport','$sponsor','$amount','$datefrom','$dateto','$studystatus','$numunits','$numcurrent','$title','$pname');";
            mysqli_query($con,$sql);
            header("Location: ../AccomplishmentReportA.php?insert=success");
        }
        else
        {
            if($title==null)
            {
                $sql = ("UPDATE ongoingstudy SET SubmissionId ='$id',Deg = '$degree',SchoolName = '$schoolname',SchoolLevel = '$level',SupportType = '$typesupport',SponsorName = '$sponsor',Amount = '$amount',OngoingFrom = '$datefrom',OngoingTo = '$dateto',OngoingStatus = '$studystatus',NumUnits = '$numunits',NumEnrolled = '$numcurrent' WHERE OngoingId = '$change';");
                mysqli_query($con,$sql);
                header("Location: ../AccomplishmentReportA.php?insert=success");
            }
            else
            {
                $checkfile = ("SELECT OngoingTempName FROM ongoingstudy WHERE OngoingId = '$change'");
                $resultfile = mysqli_query($con,$checkfile);
                $updatefile = mysqli_fetch_assoc($resultfile);
                unlink("../uploads/".$updatefile);
                $sql = ("UPDATE ongoingstudy SET SubmissionId ='$id',Deg = '$degree',SchoolName = '$schoolname',SchoolLevel = '$level',SupportType = '$typesupport',SponsorName = '$sponsor',Amount = '$amount',OngoingFrom = '$datefrom',OngoingTo = '$dateto',OngoingStatus = '$studystatus',NumUnits = '$numunits',NumEnrolled = '$numcurrent', OngoingFilename='$title', OngoingTempName='$pname' WHERE OngoingId = '$change';");
                mysqli_query($con,$sql);
                header("Location: ../AccomplishmentReportA.php?insert=success");
            }

        }
    }

    else
    {
        $sql = "INSERT INTO ongoingstudy (SubmissionId,Deg,SchoolName,SchoolLevel,SupportType,SponsorName,Amount,OngoingFrom,OngoingTo,OngoingStatus,NumUnits,NumEnrolled,OngoingFilename,OngoingTempName) VALUES ('$id','$degree','$schoolname','$level','$typesupport','$sponsor','$amount','$datefrom','$dateto','$studystatus','$numunits','$numcurrent','$title','$pname');";
        mysqli_query($con,$sql);
        header("Location: ../AccomplishmentReportA.php?insert=success");
    }

}
if(isset($_POST['reseter']))
{
    $change = $_POST['change'];
    if($change!=null)
    {
        $sql = "DELETE FROM ongoingstudy WHERE OngoingId = $change";
        mysqli_query($con,$sql);
        header("Location: ../AccomplishmentReportA.php");
    }
}


?>