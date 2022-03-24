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
        $check = ("SELECT AtId FROM attendancet WHERE AtId = '$change'");
        $result = mysqli_query($con,$check);
        if($result->num_rows == 0)
        {
            $sql = "INSERT INTO attendancet (SubmissionId,AtTitle,AtClass,AtNature,AtBudget,AtSource,AtOrganizer,AtLevel,AtVenue,AtDateFrom,AtDateTo,AtHours,AtFileName,AtTempName) VALUES ('$id','$atitle','$class','$nature','$budget','$source','$organizer','$level','$venue','$datefrom','$dateto','$hours','$title','$pname');";
            mysqli_query($con,$sql);
            $stat = ("UPDATE addstat SET stat = 0 WHERE id = 1");
            mysqli_query($con,$stat);
            header("Location: ../OutstandingB4.php?");
        }
        else
        {
            if($title==null)
            {
                $sql = ("UPDATE attendancet SET SubmissionId ='$id',AtTitle = '$atitle',AtClass = '$class',AtNature = '$nature',AtBudget = '$budget',AtSource = '$source',AtOrganizer='$organizer',AtLevel='$level',AtVenue='$venue',AtDateFrom = '$datefrom',AtDateTo = '$dateto', AtHours='$hours' WHERE AtId = '$change';");
                mysqli_query($con,$sql);
                header("Location: ../OutstandingB4.php?Record=$change");
            }
            else
            {
                $checkfile = ("SELECT AtTempName FROM attendancet WHERE AtId = '$change'");
                $resultfile = mysqli_query($con,$checkfile);
                $updatefile = mysqli_fetch_assoc($resultfile);
                unlink("../uploads/".$updatefile);
                $sql = ("UPDATE attendancet SET SubmissionId ='$id',AtTitle = '$atitle',AtClass = '$class',AtNature = '$nature',AtBudget = '$budget',AtSource = '$source',AtOrganizer='$organizer',AtLevel='$level',AtVenue='$venue',AtDateFrom = '$datefrom',AtDateTo = '$dateto', AtHours='$hours', AtFilename='$title', AtTempName='$pname' WHERE AtId = '$change';");
                mysqli_query($con,$sql);
                header("Location: ../OutstandingB4.php?Record=$change");
            }

        }
    }

    else
    {
        $sql = "INSERT INTO attendancet (SubmissionId,AtTitle,AtClass,AtNature,AtBudget,AtSource,AtOrganizer,AtLevel,AtVenue,AtDateFrom,AtDateTo,AtHours,AtFileName,AtTempName) VALUES ('$id','$atitle','$class','$nature','$budget','$source','$organizer','$level','$venue','$datefrom','$dateto','$hours','$title','$pname');";
        mysqli_query($con,$sql);
        $stat = ("UPDATE addstat SET stat = 0 WHERE id = 1");
        mysqli_query($con,$stat);
        header("Location: ../OutstandingB4.php?insert=success");
    }

}
if(isset($_POST['reseter']))
{
    $change = $_POST['change'];
    if($change!=null)
    {
        $sql = "DELETE FROM attendancet WHERE AtId = $change";
        mysqli_query($con,$sql);
        header("Location: ../OutstandingB4.php");
    }
}

if(isset($_POST['add']))
{
    $stat = ("UPDATE addstat SET stat = 1 WHERE id = 1");
    mysqli_query($con,$stat);
    header("Location: ../OutstandingB4.php");
}


?>