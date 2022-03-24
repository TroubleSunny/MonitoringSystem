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
    
    $researchtitle = $_POST['title'];
    $class = $_POST['class'];
    $namecount = count($_POST['name']);
    $fundingtype = $_POST['fundingtype'];
    $agency = $_POST['agency'];
    $datestart = $_POST['datestart'];
    $datetarget = $_POST['datetarget'];
    $nature = $_POST['nature'];
    $status = $_POST['status'];
    $fundingamount = $_POST['fundingamount'];
    $level = $_POST['level'];

    
    $change = $_POST['change'];

    if($change!=null)
    {
        $check = ("SELECT iicwId FROM iicw WHERE iicwId = '$change'");
        $result = mysqli_query($con,$check);
        if($result->num_rows == 0)
        {
            $sql = "INSERT INTO iicw (SubmissionId,ITitle,IClass,IDurationFrom,IDurationTo,INature,IStatus,IAgency,IFundingType,IFundingAmount,IFilename,ITempName) VALUES ('$id','$researchtitle','$class','$datestart','$datetarget','$nature','$status','$agency','$fundingtype','$fundingamount','$title','$pname');";
            mysqli_query($con,$sql);
            $rowid = mysqli_insert_id($con);
            if($namecount>=1)
            {
                for($i=0; $i<=$namecount; $i++)
                {
                    if(trim($_POST["name"][$i]) !='')
                    {
                        $anothersql = "INSERT INTO collaborators (iicwId,collaborator) VALUES ('$rowid','".mysqli_real_escape_string($con,$_POST["name"]["$i"])."')";
                        mysqli_query($con,$anothersql);
                    }
                }
            }
            $stat = ("UPDATE addstat SET stat = 0 WHERE id = 1");
            mysqli_query($con,$stat);
            header("Location: ../InventionsB.php?insert=suceess");
        }
        else
        {
            if($title==null)
            {
                $sql = ("UPDATE iicw SET SubmissionId ='$id',ITitle='$researchtitle',IClass='$class',IDurationFrom='$datestart',IDurationTo='$datetarget',INature='$nature',IStatus='$status',IAgency='$agency',IFundingType='$fundingtype',IFundingAmount='$fundingamount' WHERE iicwId = '$change';");
                mysqli_query($con,$sql);
                $rowid = mysqli_insert_id($con);

                $removename = ("DELETE FROM collaborators WHERE iicwId = $change");
                mysqli_query($con,$removename);
                if($namecount>=1)
                {
                    for($i=0; $i<=$namecount; $i++)
                    {
                        if(trim($_POST["name"][$i]) !='')
                        {
                            $anothersql = "INSERT INTO collaborators (iicwId,collaborator) VALUES ('$change','".mysqli_real_escape_string($con,$_POST["name"]["$i"])."')";
                            mysqli_query($con,$anothersql);
                        }
                    }
                }
                header("Location: ../InventionsB.php?Record=$change");
            }
            else
            {
                $checkfile = ("SELECT ITempName FROM iicw WHERE iicwId ='$change'");
                $resultfile = mysqli_query($con,$checkfile);
                $updatefile = mysqli_fetch_assoc($resultfile);
                unlink("../uploads/".$updatefile);

                $sql = ("UPDATE iicw SET SubmissionId ='$id',ITitle='$researchtitle',IClass='$class',IDurationFrom='$datestart',IDurationTo='$datetarget',INature='$nature',IStatus='$status',IAgency='$agency',IFundingType='$fundingtype',IFundingAmount='$fundingamount',IFilename='$title',ITempName='$pname' WHERE iicwId = '$change';");
                mysqli_query($con,$sql);
                $rowid = mysqli_insert_id($con);

                $removename = ("DELETE FROM collaborators WHERE iicwId = $change");
                mysqli_query($con,$removename);
                if($namecount>=1)
                {
                    for($i=0; $i<=$namecount; $i++)
                    {
                        if(trim($_POST["name"][$i]) !='')
                        {
                            $anothersql = "INSERT INTO collaborators (iicwId,collaborator) VALUES ('$change','".mysqli_real_escape_string($con,$_POST["name"]["$i"])."')";
                            mysqli_query($con,$anothersql);
                        }
                    }
                }
                header("Location: ../InventionsB.php?Record=$change");
            }
        }
    }

    else
    {
        $sql = "INSERT INTO iicw (SubmissionId,ITitle,IClass,IDurationFrom,IDurationTo,INature,IStatus,IAgency,IFundingType,IFundingAmount,IFilename,ITempName) VALUES ('$id','$researchtitle','$class','$datestart','$datetarget','$nature','$status','$agency','$fundingtype','$fundingamount','$title','$pname');";
        mysqli_query($con,$sql);
        $rowid = mysqli_insert_id($con);
        if($namecount>=1)
        {
            for($i=0; $i<=$namecount; $i++)
            {
                if(trim($_POST["name"][$i]) !='')
                {
                    $anothersql = "INSERT INTO collaborators (iicwId,collaborator) VALUES ('$rowid','".mysqli_real_escape_string($con,$_POST["name"]["$i"])."')";
                    mysqli_query($con,$anothersql);
                }
            }
        }
        $stat = ("UPDATE addstat SET stat = 0 WHERE id = 1");
        mysqli_query($con,$stat);
        header("Location: ../InventionsB.php?insert=suceess");
    }

}

if(isset($_POST['reseter']))
{
    $change = $_POST['change'];
    if($change!=null)
    {
        $sql = "DELETE FROM iicw WHERE iicwId = $change";
        mysqli_query($con,$sql);
        $sqler = "DELETE FROM collaborators WHERE iicwId = $change";
        mysqli_query($sqler,$sql);
        header("Location: ../InventionsB.php");
       
    }
}

if(isset($_POST['add']))
{
    $stat = ("UPDATE addstat SET stat = 1 WHERE id = 1");
    mysqli_query($con,$stat);
    header("Location: ../InventionsB.php");
}

?>