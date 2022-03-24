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
    $output = $_POST['output'];
    $outcome = $_POST['outcome'];
    $participation = $_POST['participation'];
    $special = $_POST['special'];
    $level = $_POST['level'];
    $datefrom = $_POST['datefrom'];
    $dateto = $_POST['dateto'];
    $nature = $_POST['name'];
    $change = $_POST['change'];

    if($change!=null)
    {
        $check = ("SELECT StId FROM specialtasks WHERE StId = '$change'");
        $result = mysqli_query($con,$check);
        if($result->num_rows == 0)
        {
            $sql = "INSERT INTO specialtasks (SubmissionId,StDesc,StOutput,StOutcome,StParticipation,StSpecial,StLevel,StDateFrom,StDateTo,StNature,StFileName,StTempName) VALUES ('$id','$desc','$output','$outcome','$participation','$special','$level','$datefrom','$dateto','$nature','$title','$pname');";
            mysqli_query($con,$sql);
            $stat = ("UPDATE addstat SET stat = 0 WHERE id = 1");
            mysqli_query($con,$stat);
            header("Location: ../SpecialTasks.php?insert=success");
        }
        else
        {
            if($title==null)
            {
                $sql = ("UPDATE specialtasks SET SubmissionId ='$id',StDesc = '$desc',StOutput = '$output',StOutcome = '$outcome',StParticipation = '$participation',StSpecial = '$special',StLevel = '$level',StDateFrom = '$datefrom',StDateTo = '$dateto' WHERE StId = '$change';");
                mysqli_query($con,$sql);
                header("Location: ../SpecialTasks.php?Record=$change");
            }
            else
            {
                $checkfile = ("SELECT StTempName FROM specialtasks WHERE StId = '$change'");
                $resultfile = mysqli_query($con,$checkfile);
                $updatefile = mysqli_fetch_assoc($resultfile);
                unlink("../uploads/".$updatefile);
                $sql = ("UPDATE specialtasks SET SubmissionId ='$id',StDesc = '$desc',StOutput = '$output',StOutcome = '$outcome',StParticipation = '$participation',StSpecial = '$special',StLevel = '$level',StDateFrom = '$datefrom',StDateTo = '$dateto',StFilename='$title', StTempName='$pname' WHERE StId = '$change';");
                mysqli_query($con,$sql);
                header("Location: ../SpecialTasks.php?Record=$change");
            }

        }
    }

    else
    {
        $sql = "INSERT INTO specialtasks (SubmissionId,StDesc,StOutput,StOutcome,StParticipation,StSpecial,StLevel,StDateFrom,StDateTo,StNature,StFileName,StTempName) VALUES ('$id','$desc','$output','$outcome','$participation','$special','$level','$datefrom','$dateto','$nature','$title','$pname');";
        mysqli_query($con,$sql);
        $stat = ("UPDATE addstat SET stat = 0 WHERE id = 1");
        mysqli_query($con,$stat);
        header("Location: ../SpecialTasks.php?insert=success");
    }

}
if(isset($_POST['reseter']))
{
    $change = $_POST['change'];
    if($change!=null)
    {
        $sql = "DELETE FROM specialtasks WHERE StId = $change";
        mysqli_query($con,$sql);
        header("Location: ../SpecialTasks.php");
    }
}

if(isset($_POST['add']))
{
    $stat = ("UPDATE addstat SET stat = 1 WHERE id = 1");
    mysqli_query($con,$stat);
    header("Location: ../SpecialTasks.php");
}

?>