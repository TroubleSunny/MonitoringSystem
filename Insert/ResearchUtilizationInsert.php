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
    $datecomplete = $_POST['datecomplete'];
    
    $agency = $_POST['agency'];
    $desc = $_POST['desc'];
    $level = $_POST['level'];

    
    $change = $_POST['change'];

    if($change!=null)
    {
        $check = ("SELECT UtiId FROM researchutilization WHERE UtiId = '$change'");
        $result = mysqli_query($con,$check);
        if($result->num_rows == 0)
        {
            $sql = "INSERT INTO researchutilization (SubmissionId,RuClass,RuCategory,RuAgenda,RuTitle,RuInvolve,RuType,RuFundType,RuFundAmount,RuFundAgency,RuDateStart,RuDateTarget,RuDateCompleted,RuAgency,RuDesc,RuLevel,RuFilename,RuTempName) VALUES ('$id','$class','$category','$agenda','$researchtitle','$involve','$type','$fundtype','$fundamount','$fundagency','$datestart','$datetarget','$datecomplete','$agency','$desc','$level','$title','$pname');";
            mysqli_query($con,$sql);
            $rowid = mysqli_insert_id($con);
            if($namecount>=1)
            {
                for($i=0; $i<=$namecount; $i++)
                {
                    if(trim($_POST["name"][$i]) !='')
                    {
                        $anothersql = "INSERT INTO ru_name (UtiId,RuName) VALUES ('$rowid','".mysqli_real_escape_string($con,$_POST["name"]["$i"])."')";
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
                        $alsoansql = "INSERT INTO ru_keywords (UtiId,RuKeyword) VALUES ('$rowid','".mysqli_real_escape_string($con,$_POST["keyword"]["$t"])."')";
                        mysqli_query($con,$alsoansql);
                    }
                }
            }
            $stat = ("UPDATE addstat SET stat = 0 WHERE id = 1");
            mysqli_query($con,$stat);
            header("Location: ../ResearchUtilization.php?insert=suceess");
        }
        else
        {
            if($title==null)
            {
                $sql = ("UPDATE researchutilization SET SubmissionId ='$id',RuClass='$class',RuCategory='$category',RuAgenda='$agenda',RuTitle='$researchtitle',RuInvolve='$involve',RuType='$type',RuFundType='$fundtype',RuFundAmount='$fundamount',RuFundAgency='$fundagency',RuDateStart='$datestart',RuDateTarget='$datetarget',RuDateCompleted='$datecomplete',RuAgency='$agency',RuDesc='$desc',RuLevel='$level' WHERE UtiId = '$change';");
                mysqli_query($con,$sql);
                $rowid = mysqli_insert_id($con);

                $removename = ("DELETE FROM ru_name WHERE UtiId = $change");
                mysqli_query($con,$removename);
                $removekeyword = ("DELETE FROM ru_keywords WHERE UtiId = $change");
                mysqli_query($con,$removekeyword);
                if($namecount>=1)
                {
                    for($i=0; $i<$namecount; $i++)
                    {
                        if(trim($_POST["name"][$i]) !='')
                        {
                            $anothersql = "INSERT INTO ru_name (UtiId,RuName) VALUES ('$change','".mysqli_real_escape_string($con,$_POST["name"]["$i"])."')";
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
                            $alsoansql = "INSERT INTO ru_keywords (UtiId,RuKeyword) VALUES ('$change','".mysqli_real_escape_string($con,$_POST["keyword"]["$t"])."')";
                            mysqli_query($con,$alsoansql);
                        }
                    }
                }
                header("Location: ../ResearchUtilization.php?Record=$change");
            }
            else
            {
                $checkfile = ("SELECT RuTempName FROM researchutilization WHERE UtiId ='$change'");
                $resultfile = mysqli_query($con,$checkfile);
                $updatefile = mysqli_fetch_assoc($resultfile);
                unlink("../uploads/".$updatefile);

                $sql = ("UPDATE researchutilization SET SubmissionId ='$id',RuClass='$class',RuCategory='$category',RuAgenda='$agenda',RuTitle='$researchtitle',RuInvolve='$involve',RuType='$type',RuFundType='$fundtype',RuFundAmount='$fundamount',RuFundAgency='$fundagency',RuDateStart='$datestart',RuDateTarget='$datetarget',RuDateCompleted='$datecomplete',RuAgency='$agency',RuDesc='$desc',RuLevel='$level',RuFilename='$title',RuTempName='$pname' WHERE UtiId = '$change';");
                mysqli_query($con,$sql);
                $rowid = mysqli_insert_id($con);

                $removename = ("DELETE FROM ru_name WHERE UtiId = $change");
                mysqli_query($con,$removename);
                $removekeyword = ("DELETE FROM ru_keywords WHERE UtiId = $change");
                mysqli_query($con,$removekeyword);
                if($namecount>=1)
                {
                    for($i=0; $i<$namecount; $i++)
                    {
                        if(trim($_POST["name"][$i]) !='')
                        {
                            $anothersql = "INSERT INTO ru_name (UtiId,RuName) VALUES ('$change','".mysqli_real_escape_string($con,$_POST["name"]["$i"])."')";
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
                            $alsoansql = "INSERT INTO ru_keywords (UtiId,RuKeyword) VALUES ('$change','".mysqli_real_escape_string($con,$_POST["keyword"]["$t"])."')";
                            mysqli_query($con,$alsoansql);
                        }
                    }
                }
                header("Location: ../ResearchUtilization.php?Record=$change");
            }
        }
    }

    else
    {
        $sql = "INSERT INTO researchutilization (SubmissionId,RuClass,RuCategory,RuAgenda,RuTitle,RuInvolve,RuType,RuFundType,RuFundAmount,RuFundAgency,RuDateStart,RuDateTarget,RuDateCompleted,RuAgency,RuDesc,RuLevel,RuFilename,RuTempName) VALUES ('$id','$class','$category','$agenda','$researchtitle','$involve','$type','$fundtype','$fundamount','$fundagency','$datestart','$datetarget','$datecomplete','$agency','$desc','$level','$title','$pname');";
        mysqli_query($con,$sql);
        $rowid = mysqli_insert_id($con);
        if($namecount>=1)
        {
            for($i=0; $i<=$namecount; $i++)
            {
                if(trim($_POST["name"][$i]) !='')
                {
                    $anothersql = "INSERT INTO ru_name (UtiId,RuName) VALUES ('$rowid','".mysqli_real_escape_string($con,$_POST["name"]["$i"])."')";
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
                    $alsoansql = "INSERT INTO ru_keywords (UtiId,RuKeyword) VALUES ('$rowid','".mysqli_real_escape_string($con,$_POST["keyword"]["$t"])."')";
                    mysqli_query($con,$alsoansql);
                }
            }
        }
        $stat = ("UPDATE addstat SET stat = 0 WHERE id = 1");
        mysqli_query($con,$stat);
        header("Location: ../ResearchUtilization.php?insert=suceess");
    }

}

if(isset($_POST['reseter']))
{
    $change = $_POST['change'];
    if($change!=null)
    {
        $sql = "DELETE FROM researchutilization WHERE UtiId = $change";
        mysqli_query($con,$sql);
        $sqle = "DELETE FROM ru_keywords WHERE UtiId = $change";
        $sqler = "DELETE FROM ru_name WHERE UtiId = $change";
        mysqli_query($sqle,$sql);
        mysqli_query($sqler,$sql);
        header("Location: ../ResearchUtilization.php");
       
    }
}

if(isset($_POST['add']))
{
    $stat = ("UPDATE addstat SET stat = 1 WHERE id = 1");
    mysqli_query($con,$stat);
    header("Location: ../ResearchUtilization.php");
}

?>