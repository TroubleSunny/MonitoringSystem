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
    
    $acted = $_POST['acted'];
    $desc = $_POST['desc'];
    $average = $_POST['average'];
    $category = $_POST['category'];
    $change = $_POST['change'];

    if($change!=null)
    {
        $check = ("SELECT ReqId FROM reqandque WHERE ReqId = '$change'");
        $result = mysqli_query($con,$check);
        if($result->num_rows == 0)
        {
            $sql = "INSERT INTO reqandque (SubmissionId,ReqActed,ReqDesc,ReqAverageTime,ReqCategory,ReqFilename,ReqTempName) VALUES ('$id','$acted','$desc','$average','$category','$title','$pname');";
            mysqli_query($con,$sql);
            $stat = ("UPDATE addstat SET stat = 0 WHERE id = 1");
            mysqli_query($con,$stat);
            header("Location: ../RequestsQueries.php?insert=success");
        }
        else
        {
            if($title==null)
            {
                $sql = ("UPDATE reqandque SET SubmissionId ='$id',ReqActed = '$acted',ReqDesc = '$desc',ReqAverageTime = '$average',ReqCategory = '$category' WHERE ReqId = '$change';");
                mysqli_query($con,$sql);
                header("Location: ../RequestsQueries.php?Record=$change");
            }
            else
            {
                $checkfile = ("SELECT AuTempName FROM attendanceu WHERE AuId = '$change'");
                $resultfile = mysqli_query($con,$checkfile);
                $updatefile = mysqli_fetch_assoc($resultfile);
                unlink("../uploads/".$updatefile);
                $sql = ("UPDATE reqandque SET SubmissionId ='$id',ReqActed = '$acted',ReqDesc = '$desc',ReqAverageTime = '$average',ReqCategory = '$category', ReqFilename = '$title', ReqTempName='$pname' WHERE ReqId = '$change';");
                mysqli_query($con,$sql);
                header("Location: ../RequestsQueries.php?Record=$change");
            }

        }
    }

    else 
    {
        $sql = "INSERT INTO reqandque (SubmissionId,ReqActed,ReqDesc,ReqAverageTime,ReqCategory,ReqFilename,ReqTempName) VALUES ('$id','$acted','$desc','$average','$category','$title','$pname');";
        mysqli_query($con,$sql);
        $stat = ("UPDATE addstat SET stat = 0 WHERE id = 1");
        mysqli_query($con,$stat);
        header("Location: ../RequestsQueries.php?insert=success");
    }

}
if(isset($_POST['reseter']))
{
    $change = $_POST['change'];
    if($change!=null)
    {
        $sql = "DELETE FROM reqandque WHERE ReqId = $change";
        mysqli_query($con,$sql);
        header("Location: ../RequestsQueries.php");
    }
}
if(isset($_POST['add']))
{
    $stat = ("UPDATE addstat SET stat = 1 WHERE id = 1");
    mysqli_query($con,$stat);
    header("Location: ../RequestsQueries.php");
}

?>