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
    
    $program = $_POST['program'];
    $project = $_POST['project'];
    $activity = $_POST['activity'];
    $nature = $_POST['nature'];
    $fundsource = $_POST['fundsource'];
    $fundamount = $_POST['fundamount'];
    $class = $_POST['class'];
    $partnership = $_POST['partnership'];

    $datefrom = $_POST['datefrom'];
    $dateto = $_POST['dateto'];

    $status = $_POST['status'];
    $venue = $_POST['venue'];
    $traineenum = $_POST['traineenum'];
    $traineeclass = $_POST['traineeclass'];
    $hours = $_POST['hours'];

    $qPoor = $_POST['qPoor'];
    $qFair = $_POST['qFair'];
    $qSatisfactory = $_POST['qSatisfactory'];
    $qVery = $_POST['qVery'];
    $qOutstanding = $_POST['qOutstanding'];

    $tPoor = $_POST['tPoor'];
    $tFair = $_POST['tFair'];
    $tSatisfactory = $_POST['tSatisfactory'];
    $tVery = $_POST['tVery'];
    $tOutstanding = $_POST['tOutstanding'];

    $change = $_POST['change'];

    if($change!=null)
    {
        $check = ("SELECT EpId FROM extensionprogram WHERE EpId = '$change'");
        $result = mysqli_query($con,$check);
        if($result->num_rows == 0)
        {
            $sql = "INSERT INTO extensionprogram (SubmissionId,EPProgramTitle,EPProjectTitle,EPActivityTitle,EPNature,EPFundSource,EPFundAmount,EPClass,EPPartnership,EPDateFrom,EPDateTo,EPStatus,EPVenue,EPTraineeNum,EPTraineeClass,EPHours,EPFilename,EPTempName) VALUES ('$id','$program','$project','$activity','$nature','$fundsource','$fundamount','$class','$partnership','$datefrom','$dateto','$status','$venue','$traineenum','$traineeclass','$hours','$title','$pname');";
            mysqli_query($con,$sql);
            $rowid = mysqli_insert_id($con);
            $sql1 = "INSERT INTO timeliness_rate (EpId,TRPoor,TRFair,TRSatisfactory,TRVery,TROutstanding) VALUES ('$rowid','$tPoor','$tFair','$tSatisfactory','$tVery','$tOutstanding')";
            $sql2 = "INSERT INTO quality_rate (EpId,QRPoor,QRFair,QRSatisfactory,QRVery,QROutstanding) VALUES ('$rowid','$qPoor','$qFair','$qSatisfactory','$qVery','$qOutstanding')";
            mysqli_query($con,$sql1);
            mysqli_query($con,$sql2);
            $stat = ("UPDATE addstat SET stat = 0 WHERE id = 1");
            mysqli_query($con,$stat);
            header("Location: ../ExtensionActivity.php?insert=success");
        }
        else
        {
            if($title==null)
            {
                $sql = ("UPDATE extensionprogram SET SubmissionId ='$id',EPProgramTitle='$program',EPProjectTitle='$project',EPActivityTitle='$activity',EPNature='$nature',EPFundSource='$fundsource',EPFundAmount='$fundamount',EPClass='$class',EPPartnership='$partnership',EPDateFrom='$datefrom',EPDateTo='$dateto',EPStatus='$status',EPVenue='$venue',EPTraineeNum='$traineenum',EPTraineeClass='$traineeclass',EPHours='$hours' WHERE EpId = '$change';");
                mysqli_query($con,$sql);
                $sql1 = ("UPDATE timeliness_rate SET TRPoor='$tPoor',TRFair='$tFair',TRSatisfactory='$tSatisfactory',TRVery='$tVery',TROutstanding='$tOutstanding' WHERE EpId = '$change'");
                $sql2 = ("UPDATE quality_rate SET QRPoor='$qPoor',QRFair='$qFair',QRSatisfactory='$qSatisfactory',QRVery='$qVery',QROutstanding='$qOutstanding' WHERE EpId='$change'");
                mysqli_query($con,$sql1);
                mysqli_query($con,$sql2);
                header("Location: ../ExtensionActivity.php?Record=$change");
            }
            else
            {
                $checkfile = ("SELECT EpTempName FROM extensionprogram WHERE EpId = '$change'");
                $resultfile = mysqli_query($con,$checkfile);
                $updatefile = mysqli_fetch_assoc($resultfile);
                unlink("../uploads/".$updatefile);
                $sql = ("UPDATE extensionprogram SET SubmissionId ='$id',EPProgramTitle='$program',EPProjectTitle='$project',EPActivityTitle='$activity',EPNature='$nature',EPFundSource='$fundsource',EPFundAmount='$fundamount',EPClass='$class',EPPartnership='$partnership',EPDateFrom='$datefrom',EPDateTo='$dateto',EPStatus='$status',EPVenue='$venue',EPTraineeNum='$traineenum',EPTraineeClass='$traineeclass',EPHours='$hours',EPFilename='$title',EPTempName='$pname' WHERE EpId = '$change'");
                $sql1 = ("UPDATE timeliness_rate SET TRPoor='$tPoor',TRFair='$tFair',TRSatisfactory='$tSatisfactory',TRVery='$tVery',TROutstanding='$tOutstanding' WHERE EpId = '$change'");
                $sql2 = ("UPDATE quality_rate SET QRPoor='$qPoor',QRFair='$qFair',QRSatisfactory='$qSatisfactory',QRVery='$qVery',QROutstanding='$qOutstanding' WHERE EpId='$change'");
                mysqli_query($con,$sql);
                mysqli_query($con,$sql1);
                mysqli_query($con,$sql2);
                header("Location: ../ExtensionActivity.php?Record=$change");
            }

        }
    }

    else
    {
        $sql = "INSERT INTO extensionprogram (SubmissionId,EPProgramTitle,EPProjectTitle,EPActivityTitle,EPNature,EPFundSource,EPFundAmount,EPClass,EPPartnership,EPDateFrom,EPDateTo,EPStatus,EPVenue,EPTraineeNum,EPTraineeClass,EPHours,EPFilename,EPTempName) VALUES ('$id','$program','$project','$activity','$nature','$fundsource','$fundamount','$class','$partnership','$datefrom','$dateto','$status','$venue','$traineenum','$traineeclass','$hours','$title','$pname');";
        mysqli_query($con,$sql);
        $rowid = mysqli_insert_id($con);
        $sql1 = "INSERT INTO timeliness_rate (EpId,TRPoor,TRFair,TRSatisfactory,TRVery,TROutstanding) VALUES ('$rowid','$tPoor','$tFair','$tSatisfactory','$tVery','$tOutstanding')";
        $sql2 = "INSERT INTO quality_rate (EpId,QRPoor,QRFair,QRSatisfactory,QRVery,QROutstanding) VALUES ('$rowid','$qPoor','$qFair','$qSatisfactory','$qVery','$qOutstanding')";
        mysqli_query($con,$sql1);
        mysqli_query($con,$sql2);
        $stat = ("UPDATE addstat SET stat = 0 WHERE id = 1");
        mysqli_query($con,$stat);
        header("Location: ../ExtensionActivity.php?insert=success");
    }

}

if(isset($_POST['reseter']))
{
    $change = $_POST['change'];
    if($change!=null)
    {
        $sql = "DELETE FROM extensionprogram WHERE EpId = $change";
        mysqli_query($con,$sql);
        header("Location: ../ExtensionActivity.php");
    }
}

if(isset($_POST['add']))
{
    $stat = ("UPDATE addstat SET stat = 1 WHERE id = 1");
    mysqli_query($con,$stat);
    header("Location: ../ExtensionActivity.php");
}
?>

