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
    
    
    $class = $_POST['class'];
    $consulttitle = $_POST['title'];
    $category = $_POST['category'];
    $agency = $_POST['agency'];
    $venue = $_POST['venue'];
    $level = $_POST['level'];
  
    $datefrom = $_POST['datefrom'];
    $dateto = $_POST['dateto'];
    $change = $_POST['change'];

    if($change!=null)
    {
        $check = ("SELECT EcId FROM eservice_consultant WHERE EcId = '$change'");
        $result = mysqli_query($con,$check);
        if($result->num_rows == 0)
        {
            $sql = "INSERT INTO eservice_consultant (SubmissionId,EConsultantClass,EConsultantTitle,EConsultantCategory,EConsultantAgency,EConsultantVenue,EConsultantDateFrom,EConsultantDateTo,EConsultantLevel,EFilename,ETempName) VALUES ('$id','$class','$consulttitle','$category','$agency','$venue','$datefrom','$dateto','$level','$title','$pname');";
            mysqli_query($con,$sql);
            $stat = ("UPDATE addstat SET stat = 0 WHERE id = 1");
            mysqli_query($con,$stat);
            header("Location: ../ExtensionRendered.php?insert=success");
        }
        else
        {
            if($title==null)
            {
                $sql = ("UPDATE eservice_consultant SET SubmissionId ='$id',EConsultantClass='$class',EConsultantTitle='$consulttitle',EConsultantCategory='$category',EConsultantAgency='$agency',EConsultantVenue='$venue',EConsultantDateFrom='$datefrom',EConsultantDateTo='$dateto',EConsultantLevel='$level' WHERE EcId = '$change';");
                mysqli_query($con,$sql);
                header("Location: ../ExtensionRendered.php?Record=$change");
            }
            else
            {
                $checkfile = ("SELECT ETempName FROM eservice_consultant WHERE EcId = '$change'");
                $resultfile = mysqli_query($con,$checkfile);
                $updatefile = mysqli_fetch_assoc($resultfile);
                unlink("../uploads/".$updatefile);
                $sql = ("UPDATE eservice_consultant SET SubmissionId ='$id',EConsultantClass='$class',EConsultantTitle='$consulttitle',EConsultantCategory='$category',EConsultantAgency='$agency',EConsultantVenue='$venue',EConsultantDateFrom='$datefrom',EConsultantDateTo='$dateto',EConsultantLevel='$level',EFilename='$title',ETempName='$pname' WHERE EcId = '$change';");
                mysqli_query($con,$sql);
                header("Location: ../ExtensionRendered.php?Record=$change");
            }

        }
    }

    else 
    {
        $sql = "INSERT INTO eservice_consultant (SubmissionId,EConsultantClass,EConsultantTitle,EConsultantCategory,EConsultantAgency,EConsultantVenue,EConsultantDateFrom,EConsultantDateTo,EConsultantLevel,EFilename,ETempName) VALUES ('$id','$class','$consulttitle','$category','$agency','$venue','$datefrom','$dateto','$level','$title','$pname');";
        mysqli_query($con,$sql);
        $stat = ("UPDATE addstat SET stat = 0 WHERE id = 1");
        mysqli_query($con,$stat);
        header("Location: ../ExtensionRendered.php?insert=success");
    }

}
if(isset($_POST['reseter']))
{
    $change = $_POST['change'];
    if($change!=null)
    {
        $sql = "DELETE FROM eservice_consultant WHERE EcId = $change";
        mysqli_query($con,$sql);
        header("Location: ../ExtensionRendered.php");
    }
}

if(isset($_POST['add']))
{
    $stat = ("UPDATE addstat SET stat = 1 WHERE id = 1");
    mysqli_query($con,$stat);
    header("Location: ../ExtensionRendered.php");
}

?>