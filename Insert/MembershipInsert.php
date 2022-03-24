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
    
    $name = $_POST['name'];
    $class = $_POST['classification'];
    $position = $_POST['position'];
    $level = $_POST['level'];
    $address = $_POST['address'];
    $datefrom = $_POST['datefrom'];
    $dateto = $_POST['dateto'];
    $change = $_POST['change'];

    if($change!=null)
    {
        $check = ("SELECT MembershipId FROM membership WHERE MembershipId = '$change'");
        $result = mysqli_query($con,$check);
        if($result->num_rows == 0)
        {
            $sql = "INSERT INTO membership (SubmissionId,MName,MClass,MPosition,MLevel,MAddress,MDateFrom,MDateTo,MFileName,MTempName) VALUES ('$id','$name','$class','$position','$level','$address','$datefrom','$dateto','$title','$pname');";
            mysqli_query($con,$sql);
            $stat = ("UPDATE addstat SET stat = 0 WHERE id = 1");
            mysqli_query($con,$stat);
            header("Location: ../OutstandingB2.php?insert=success");
        }
        else
        {
            if($title==null)
            {
                $sql = ("UPDATE membership SET SubmissionId ='$id',MName = '$name',MClass = '$class',MPosition = '$position',MLevel = '$level',MAddress = '$address',MDateFrom = '$datefrom',MDateTo = '$dateto' WHERE MembershipId = '$change';");
                mysqli_query($con,$sql);
                header("Location: ../OutstandingB2.php?Record=$change");
            }
            else
            {
                $checkfile = ("SELECT MTempName FROM membership WHERE MembershipId = '$change'");
                $resultfile = mysqli_query($con,$checkfile);
                $updatefile = mysqli_fetch_assoc($resultfile);
                unlink("../uploads/".$updatefile);
                $sql = ("UPDATE membership SET SubmissionId ='$id',MName = '$name',MClass = '$class',MPosition = '$position',MLevel = '$level',MAddress = '$address',MDateFrom = '$datefrom',MDateTo = '$dateto',MFilename='$title', MTempName='$pname' WHERE MembershipId = '$change';");
                mysqli_query($con,$sql);
                header("Location: ../OutstandingB2.php?Record=$change");
            }

        }
    }

    else
    {
        $sql = "INSERT INTO membership (SubmissionId,MName,MClass,MPosition,MLevel,MAddress,MDateFrom,MDateTo,MFileName,MTempName) VALUES ('$id','$name','$class','$position','$level','$address','$datefrom','$dateto','$title','$pname');";
        mysqli_query($con,$sql);
        $stat = ("UPDATE addstat SET stat = 0 WHERE id = 1");
        mysqli_query($con,$stat);
        header("Location: ../OutstandingB2.php?insert=success");
    }

}
if(isset($_POST['reseter']))
{
    $change = $_POST['change'];
    if($change!=null)
    {
        $sql = "DELETE FROM membership WHERE MembershipId = $change";
        mysqli_query($con,$sql);
        header("Location: ../OutstandingB2.php");
    }
}

if(isset($_POST['add']))
{
    $stat = ("UPDATE addstat SET stat = 1 WHERE id = 1");
    mysqli_query($con,$stat);
    header("Location: ../OutstandingB2.php");
}
?>


