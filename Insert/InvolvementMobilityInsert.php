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
    $type = $_POST['type'];
    $host = $_POST['host'];
    $address = $_POST['address'];

    $datefrom = $_POST['datefrom'];
    $dateto = $_POST['dateto'];

    
    
    $change = $_POST['change'];

    if($change!=null)
    {
        $check = ("SELECT IMId FROM inolvementmobility WHERE IMId = '$change'");
        $result = mysqli_query($con,$check);
        if($result->num_rows == 0)
        {
            $sql = "INSERT INTO inolvementmobility (SubmissionId,IMNature,IMType,IMHost,IMAddress,IMDateFrom,IMDateTo,IMFilename,IMTempName) VALUES ('$id','$nature','$type','$host','$address','$datefrom','$dateto','$title','$pname');";
            mysqli_query($con,$sql);
            $stat = ("UPDATE addstat SET stat = 0 WHERE id = 1");
            mysqli_query($con,$stat);
            header("Location: ../InvolvementMobility.php?insert=success");
        }
        else
        {
            if($title==null)
            {
                $sql = ("UPDATE inolvementmobility SET SubmissionId ='$id',IMNature='$nature',IMType='$type',IMHost='$host',IMAddress='$address',IMDateFrom='$datefrom',IMDateTo='$dateto' WHERE IMId = '$change';");
                mysqli_query($con,$sql);
                header("Location: ../InvolvementMobility.php?Record=$change");
            }
            else
            {
                $checkfile = ("SELECT IMTempName FROM inolvementmobility WHERE IMId = '$change'");
                $resultfile = mysqli_query($con,$checkfile);
                $updatefile = mysqli_fetch_assoc($resultfile);
                unlink("../uploads/".$updatefile);
                $sql = ("UPDATE inolvementmobility SET SubmissionId ='$id',IMNature='$nature',IMType='$type',IMHost='$host',IMAddress='$address',IMDateFrom='$datefrom',IMDateTo='$dateto',IMFilename='$title',IMTempName='$pname' WHERE IMId = '$change';");
                mysqli_query($con,$sql);
                header("Location: ../InvolvementMobility.php?Record=$change");
            }

        }
    }

    else
    {
        $sql = "INSERT INTO inolvementmobility (SubmissionId,IMNature,IMType,IMHost,IMAddress,IMDateFrom,IMDateTo,IMFilename,IMTempName) VALUES ('$id','$nature','$type','$host','$address','$datefrom','$dateto','$title','$pname');";
        mysqli_query($con,$sql);
        $stat = ("UPDATE addstat SET stat = 0 WHERE id = 1");
        mysqli_query($con,$stat);
        header("Location: ../InvolvementMobility.php?insert=success");
    }

}
if(isset($_POST['reseter']))
{
    $change = $_POST['change'];
    if($change!=null)
    {
        $sql = "DELETE FROM inolvementmobility WHERE IMId = $change";
        mysqli_query($con,$sql);
        header("Location: ../InvolvementMobility.php");
    }
}

if(isset($_POST['add']))
{
    $stat = ("UPDATE addstat SET stat = 1 WHERE id = 1");
    mysqli_query($con,$stat);
    header("Location: ../InvolvementMobility.php");
}

?>