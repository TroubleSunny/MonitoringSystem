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
    
    $journal = $_POST['journal'];
    $nature = $_POST['nature'];
    $publication = $_POST['publication'];
    $indexing = $_POST['indexing'];
    $copyright = $_POST['copyright'];
    $level = $_POST['level'];
    
    $change = $_POST['change'];

    if($change!=null)
    {
        $check = ("SELECT EjId FROM extension_journals WHERE EjId = '$change'");
        $result = mysqli_query($con,$check);
        if($result->num_rows == 0)
        {
            $sql = "INSERT INTO extension_journals (SubmissionId,EjJournals,EjNature,EjPublication,EjIndexing,EjCopyright,EjLevel,EjFilename,EjTempName) VALUES ('$id','$journal','$nature','$publication','$indexing','$copyright','$level','$title','$pname');";
            mysqli_query($con,$sql);
            $stat = ("UPDATE addstat SET stat = 0 WHERE id = 1");
            mysqli_query($con,$stat);
            header("Location: ../ExtensionRendered3.php?insert=success");
        }
        else
        {
            if($title==null)
            {
                $sql = ("UPDATE extension_journals SET SubmissionId ='$id',EjJournals='$journal',EjNature='$nature',EjPublication='$publication',EjIndexing='$indexing',EjCopyright='$copyright',EjLevel='$level' WHERE EjId = '$change';");
                mysqli_query($con,$sql);
                header("Location: ../ExtensionRendered3.php?Record=$change");
            }
            else
            {
                $checkfile = ("SELECT EjTempName FROM extension_journals WHERE EjId = '$change'");
                $resultfile = mysqli_query($con,$checkfile);
                $updatefile = mysqli_fetch_assoc($resultfile);
                unlink("../uploads/".$updatefile);
                $sql = ("UPDATE extension_journals SET SubmissionId ='$id',EjJournals='$journal',EjNature='$nature',EjPublication='$publication',EjIndexing='$indexing',EjCopyright='$copyright',EjLevel='$level',EjFilename='$title',EjTempName='$pname' WHERE EjId = '$change';");
                mysqli_query($con,$sql);
                header("Location: ../ExtensionRendered3.php?Record=$change");
            }
        }
    }

    else 
    {
        $sql = "INSERT INTO extension_journals (SubmissionId,EjJournals,EjNature,EjPublication,EjIndexing,EjCopyright,EjLevel,EjFilename,EjTempName) VALUES ('$id','$journal','$nature','$publication','$indexing','$copyright','$level','$title','$pname');";
        mysqli_query($con,$sql);
        $stat = ("UPDATE addstat SET stat = 0 WHERE id = 1");
        mysqli_query($con,$stat);
        header("Location: ../ExtensionRendered3.php?insert=success");
    }

}
if(isset($_POST['reseter']))
{
    $change = $_POST['change'];
    if($change!=null)
    {
        $sql = "DELETE FROM extension_journals WHERE EjId = $change";
        mysqli_query($con,$sql);
        header("Location: ../ExtensionRendered3.php");
    }
}

if(isset($_POST['add']))
{
    $stat = ("UPDATE addstat SET stat = 1 WHERE id = 1");
    mysqli_query($con,$stat);
    header("Location: ../ExtensionRendered3.php");
}
?>