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
    
    
    $nature = $_POST['nature'];
    $conferencetitle = $_POST['title'];
    $agency = $_POST['agency'];
    $venue = $_POST['venue'];
    $level = $_POST['level'];
  
    $datefrom = $_POST['datefrom'];
    $dateto = $_POST['dateto'];
    $change = $_POST['change'];

    if($change!=null)
    {
        $check = ("SELECT ConId FROM eservice_conference WHERE ConId = '$change'");
        $result = mysqli_query($con,$check);
        if($result->num_rows == 0)
        {
            $sql = "INSERT INTO eservice_conference (SubmissionId,EConferenceNature,EConferenceTitle,EConferenceAgency,EConferenceVenue,EConferenceDateFrom,EConferenceDateTo,EConferenceLevel,EConferenceFilename,EConferenceTempName) VALUES ('$id','$nature','$conferencetitle','$agency','$venue','$datefrom','$dateto','$level','$title','$pname');";
            mysqli_query($con,$sql);
            $stat = ("UPDATE addstat SET stat = 0 WHERE id = 1");
            mysqli_query($con,$stat);
            header("Location: ../ExtensionRendered2.php?insert=success");
        }
        else
        {
            if($title==null)
            {
                $sql = ("UPDATE eservice_conference SET SubmissionId ='$id', EConferenceNature='$nature',EConferenceTitle='$conferencetitle',EConferenceAgency='$agency',EConferenceVenue='$venue',EConferenceDateFrom='$datefrom',EConferenceDateTo='$dateto',EConferenceLevel='$level' WHERE ConId = '$change';");
                mysqli_query($con,$sql);
                header("Location: ../ExtensionRendered2.php?Record=$change");
            }
            else
            {
                $checkfile = ("SELECT EConferenceTempName FROM eservice_conference WHERE ConId = '$change'");
                $resultfile = mysqli_query($con,$checkfile);
                $updatefile = mysqli_fetch_assoc($resultfile);
                unlink("../uploads/".$updatefile);
                $sql = ("UPDATE eservice_conference SET SubmissionId ='$id', EConferenceNature='$nature',EConferenceTitle='$conferencetitle',EConferenceAgency='$agency',EConferenceVenue='$venue',EConferenceDateFrom='$datefrom',EConferenceDateTo='$dateto',EConferenceLevel='$level',EConferenceFilename='$title',EConferenceTempName='$pname' WHERE ConId = '$change';");
                mysqli_query($con,$sql);
                header("Location: ../ExtensionRendered2.php?Record=$change");
            }
        }
    }

    else 
    {
        $sql = "INSERT INTO eservice_conference (SubmissionId,EConferenceNature,EConferenceTitle,EConferenceAgency,EConferenceVenue,EConferenceDateFrom,EConferenceDateTo,EConferenceLevel,EConferenceFilename,EConferenceTempName) VALUES ('$id','$nature','$conferencetitle','$agency','$venue','$datefrom','$dateto','$level','$title','$pname');";
        mysqli_query($con,$sql);
        $stat = ("UPDATE addstat SET stat = 0 WHERE id = 1");
        mysqli_query($con,$stat);
        header("Location: ../ExtensionRendered2.php?insert=success");
    }

}
if(isset($_POST['reseter']))
{
    $change = $_POST['change'];
    if($change!=null)
    {
        $sql = "DELETE FROM eservice_consultant WHERE EcId = $change";
        mysqli_query($con,$sql);
        header("Location: ../ExtensionRendered2.php");
    }
}
if(isset($_POST['add']))
{
    $stat = ("UPDATE addstat SET stat = 1 WHERE id = 1");
    mysqli_query($con,$stat);
    header("Location: ../ExtensionRendered2.php");
}

?>