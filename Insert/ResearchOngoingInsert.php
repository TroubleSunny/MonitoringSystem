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
    $category = $_POST['category'];
    $agenda = $_POST['agenda'];
    
    $involve = $_POST['involve'];
    $type = $_POST['type'];
    
    $namecount = count($_POST['name']);
    $keywordcount = count($_POST['keyword']);
    $fundtype = $_POST['fundtype'];
    $fundamount = $_POST['fundamount'];
    $fundagency = $_POST['fundagency'];
    $datestart = $_POST['datestart'];
    $datetarget = $_POST['datetarget'];
    if($_POST['datecomplete']!=null)
    {
        $datecomplete = $_POST['datecomplete'];
    }
    else
    {
        $datecomplete = null;
    }  
    $status = $_POST['status'];
    $change = $_POST['change'];

    if($change!=null)
    {
        $check = ("SELECT RoId FROM researchongoing WHERE RoId = '$change'");
        $result = mysqli_query($con,$check);
        if($result->num_rows == 0)
        {
            $sql = "INSERT INTO researchongoing (SubmissionId,RoClass,RoCategory,RoAgenda,RoTitle,RoInvolve,RoType,RoFundType,RoFundAmount,RoFundAgency,RoDateStart,RoDateTarget,RoStatus,RoDateCompleted,RoFilename,RoTempName) VALUES ('$id','$class','$category','$agenda','$researchtitle','$involve','$type','$fundtype','$fundamount','$fundagency','$datestart','$datetarget','$status','$datecomplete','$title','$pname');";
            mysqli_query($con,$sql);
            $rowid = mysqli_insert_id($con);

            if($namecount>=1)
            {
                for($i=0; $i<=$namecount; $i++)
                {
                    if(trim($_POST["name"][$i]) !='')
                    {
                        $anothersql = "INSERT INTO ro_name (RoId,RoName) VALUES ('$rowid','".mysqli_real_escape_string($con,$_POST["name"]["$i"])."')";
                        mysqli_query($con,$anothersql);
                    }
                }
            }
            if($keywordcount>1)
            {
                for($t=0; $t<$keywordcount; $t++)
                {
                    if(trim($_POST["keyword"][$t]) !='')
                    {
                        $alsoansql = "INSERT INTO ro_keywords (RoId,RoKeyword) VALUES ('$rowid','".mysqli_real_escape_string($con,$_POST["keyword"]["$t"])."')";
                        mysqli_query($con,$alsoansql);
                    }
                }
            }
            $stat = ("UPDATE addstat SET stat = 0 WHERE id = 1");
            mysqli_query($con,$stat);
            header("Location: ../ResearchOngoing.php?insert=suceess");
        }

        else
        {
            if($title==null)
            {
                $sql = ("UPDATE researchongoing SET SubmissionId ='$id',RoClass = '$class',RoCategory = '$category',RoAgenda = '$agenda',RoTitle = '$researchtitle',RoInvolve='$involve', RoType='$type',RoFundType='$fundtype',RoFundAmount='$fundamount',RoFundAgency='$fundagency',RoDateStart='$datestart',RoDateTarget='$datetarget',RoStatus='$status',RoDateCompleted='$datecomplete' WHERE RoId = '$change';");
                mysqli_query($con,$sql);
                $rowid = mysqli_insert_id($con);
                $removename = ("DELETE FROM ro_name WHERE RoId = $change");
                mysqli_query($con,$removename);
                $removekeyword = ("DELETE FROM ro_keywords WHERE RoId = $change");
                mysqli_query($con,$removekeyword);
                if($namecount>=1)
                {
                    for($i=0; $i<$namecount; $i++)
                    {
                        if(trim($_POST["name"][$i]) !='')
                        {
                            $anothersql = "INSERT INTO ro_name (RoId,RoName) VALUES ('$change','".mysqli_real_escape_string($con,$_POST["name"]["$i"])."')";
                            mysqli_query($con,$anothersql);
                        }
                    }
                }
                if($keywordcount>1)
                {
                    for($t=0; $t<$keywordcount; $t++)
                    {
                        if(trim($_POST["keyword"][$t]) !='')
                        {
                            $alsoansql = "INSERT INTO ro_keywords (RoId,RoKeyword) VALUES ('$change','".mysqli_real_escape_string($con,$_POST["keyword"]["$t"])."')";
                            mysqli_query($con,$alsoansql);
                        }
                    }
                }
                header("Location: ../researchongoing.php?Record=$change");
            }
            else
            {
                $checkfile = ("SELECT RoTempName FROM researchongoing WHERE RoId ='$change'");
                $resultfile = mysqli_query($con,$checkfile);
                $updatefile = mysqli_fetch_assoc($resultfile);
                unlink("../uploads/".$updatefile);

                $sql = ("UPDATE researchongoing SET SubmissionId ='$id',RoClass = '$class',RoCategory = '$category',RoAgenda = '$agenda',RoTitle = '$researchtitle',RoInvolve='$involve', RoType='$type',RoFundType='$fundtype',RoFundAmount='$fundamount',RoFundAgency='$fundagency',RoDateStart='$datestart',RoDateTarget='$datetarget',RoStatus='$status',RoDateCompleted='$datecomplete', RoFilename='$title', RoTempName='$pname' WHERE RoId = '$change';");
                mysqli_query($con,$sql);
                $rowid = mysqli_insert_id($con);

                $removename = ("DELETE FROM ro_name WHERE RoId = $change");
                mysqli_query($con,$removename);
                $removekeyword = ("DELETE FROM ro_keywords WHERE RoId = $change");
                mysqli_query($con,$removekeyword);
                if($namecount>=1)
                {
                    for($i=0; $i<$namecount; $i++)
                    {
                        if(trim($_POST["name"][$i]) !='')
                        {
                            $anothersql = "INSERT INTO ro_name (RoId,RoName) VALUES ('$change','".mysqli_real_escape_string($con,$_POST["name"]["$i"])."')";
                            mysqli_query($con,$anothersql);
                        }
                    }
                }

                if($keywordcount>1)
                {
                    for($t=0; $t<$keywordcount; $t++)
                    {
                        if(trim($_POST["keyword"][$t]) !='')
                        {
                            $alsoansql = "INSERT INTO ro_keywords (RoId,RoKeyword) VALUES ('$change','".mysqli_real_escape_string($con,$_POST["keyword"]["$t"])."')";
                            mysqli_query($con,$alsoansql);
                        }
                    }
                }
                header("Location: ../researchongoing.php?Record=$change");
            }
        }
    }

    else
    {
        $sql = "INSERT INTO researchongoing (SubmissionId,RoClass,RoCategory,RoAgenda,RoTitle,RoInvolve,RoType,RoFundType,RoFundAmount,RoFundAgency,RoDateStart,RoDateTarget,RoStatus,RoDateCompleted,RoFilename,RoTempName) VALUES ('$id','$class','$category','$agenda','$researchtitle','$involve','$type','$fundtype','$fundamount','$fundagency','$datestart','$datetarget','$status','$datecomplete','$title','$pname');";
        mysqli_query($con,$sql);
        $rowid = mysqli_insert_id($con);
        if($namecount>=1)
        {
            for($i=0; $i<=$namecount; $i++)
            {
                if(trim($_POST["name"][$i]) !='')
                {
                    $anothersql = "INSERT INTO ro_name (RoId,RoName) VALUES ('$rowid','".mysqli_real_escape_string($con,$_POST["name"]["$i"])."')";
                    mysqli_query($con,$anothersql);
                }
            }
        }
        if($keywordcount>1)
        {
            for($t=0; $t<=$keywordcount; $t++)
            {
                if(trim($_POST["keyword"][$t]) !='')
                {
                    $alsoansql = "INSERT INTO ro_keywords (RoId,RoKeyword) VALUES ('$rowid','".mysqli_real_escape_string($con,$_POST["keyword"]["$t"])."')";
                    mysqli_query($con,$alsoansql);
                }
            }
        }
        $stat = ("UPDATE addstat SET stat = 0 WHERE id = 1");
        mysqli_query($con,$stat);
        header("Location: ../ResearchOngoing.php?insert=suceess");
    }

}
if(isset($_POST['reseter']))
{
    $change = $_POST['change'];
    if($change!=null)
    {
        $sql = "DELETE FROM researchongoing WHERE RoId = $change";
        mysqli_query($con,$sql);
        $sqle = "DELETE FROM ro_keywords WHERE RoId = $change";
        $sqler = "DELETE FROM ro_name WHERE RoId = $change";
        mysqli_query($sqle,$sql);
        mysqli_query($sqler,$sql);
        header("Location: ../ResearchOngoing.php");
        
    }
}

if(isset($_POST['add']))
{
    $stat = ("UPDATE addstat SET stat = 1 WHERE id = 1");
    mysqli_query($con,$stat);
    header("Location: ../ResearchOngoing.php");
}

?>