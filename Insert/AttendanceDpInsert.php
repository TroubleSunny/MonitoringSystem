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
    
    $atitle = $_POST['title'];
    $class = $_POST['classification'];
    $nature = $_POST['nature'];
    $budget = $_POST['budget'];
    $source = $_POST['source'];  
    $organizer = $_POST['organizer'];
    $level = $_POST['level'];
    $venue = $_POST['venue'];
    $hours = $_POST['hours'];
    $datefrom = $_POST['datefrom'];
    $dateto = $_POST['dateto'];
    $change = $_POST['change'];

    if($change!=null)
    {
        $check = ("SELECT AdId FROM attendancedp WHERE AdId = '$change'");
        $result = mysqli_query($con,$check);
        if($result->num_rows == 0)
        {
            $sql = "INSERT INTO attendancedp (SubmissionId,AdTitle,AdClass,AdNature,AdBudget,AdSource,AdOrganizer,AdLevel,AdVenue,AdDateFrom,AdDateTo,AdHours,AdFileName,AdTempName) VALUES ('$id','$atitle','$class','$nature','$budget','$source','$organizer','$level','$venue','$datefrom','$dateto','$hours','$title','$pname');";
            mysqli_query($con,$sql);
            $stat = ("UPDATE addstat SET stat = 0 WHERE id = 1");
            mysqli_query($con,$stat);
            header("Location: ../OutstandingB3.php?insert=success");
        }
        else
        {
            if($title==null)
            {
                $sql = ("UPDATE attendancedp SET SubmissionId ='$id',AdTitle = '$atitle',AdClass = '$class',AdNature = '$nature',AdBudget = '$budget',AdSource = '$source',AdOrganizer='$organizer',AdLevel='$level',AdVenue='$venue',AdDateFrom = '$datefrom',AdDateTo = '$dateto', AdHours='$hours' WHERE AdId = '$change';");
                mysqli_query($con,$sql);
                header("Location: ../OutstandingB3.php?Record=$change");
            }
            else
            {
                $checkfile = ("SELECT AdTempName FROM attendancedp WHERE AdId = '$change'");
                $resultfile = mysqli_query($con,$checkfile);
                $updatefile = mysqli_fetch_assoc($resultfile);
                unlink("../uploads/".$updatefile);
                $sql = ("UPDATE attendancedp SET SubmissionId ='$id',AdTitle = '$atitle',AdClass = '$class',AdNature = '$nature',AdBudget = '$budget',AdSource = '$source',AdOrganizer='$organizer',AdLevel='$level',AdVenue='$venue',AdDateFrom = '$datefrom',AdDateTo = '$dateto', AdHours='$hours' AdFilename='$title', AdTempName='$pname' WHERE AdId = '$change';");
                mysqli_query($con,$sql);
                header("Location: ../OutstandingB3.php?Record=$change");
            }

        }
    }

    else
    {
        $sql = "INSERT INTO attendancedp (SubmissionId,AdTitle,AdClass,AdNature,AdBudget,AdSource,AdOrganizer,AdLevel,AdVenue,AdDateFrom,AdDateTo,AdHours,AdFileName,AdTempName) VALUES ('$id','$atitle','$class','$nature','$budget','$source','$organizer','$level','$venue','$datefrom','$dateto','$hours','$title','$pname');";
        mysqli_query($con,$sql);
        $stat = ("UPDATE addstat SET stat = 0 WHERE id = 1");
        mysqli_query($con,$stat);
        header("Location: ../OutstandingB3.php?insert=success");
    }

}
if(isset($_POST['reseter']))
{
    $change = $_POST['change'];
    if($change!=null)
    {
        $sql = "DELETE FROM attendancedp WHERE AdId = $change";
        mysqli_query($con,$sql);
        header("Location: ../OutstandingB3.php");
    }
}

if(isset($_POST['add']))
{
    $stat = ("UPDATE addstat SET stat = 1 WHERE id = 1");
    mysqli_query($con,$stat);
    header("Location: ../OutstandingB3.php");
}

?>