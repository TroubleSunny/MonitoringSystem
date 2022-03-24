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
    
    $copyrightnum = $_POST['copyrightnum'];
    $copyrightagency = $_POST['copyrightagency'];
    $copyrightyear = $_POST['copyrightyear'];
    $level = $_POST['level'];

    
    $change = $_POST['change'];

    if($change!=null)
    {
        $check = ("SELECT CoId FROM copyrightedoutput WHERE CoId = '$change'");
        $result = mysqli_query($con,$check);
        if($result->num_rows == 0)
        {
            $sql = "INSERT INTO copyrightedoutput (SubmissionId,CoClass,CoCategory,CoAgenda,CoTitle,CoInvolve,CoType,CoFundType,CoFundAmount,CoFundAgency,CoDateStart,CoDateTarget,CoDateCompleted,CoCopyrightNum,CoCopyrightAgency,CoCopyrightYear,CoLevel,CoFilename,CoTempName) VALUES ('$id','$class','$category','$agenda','$researchtitle','$involve','$type','$fundtype','$fundamount','$fundagency','$datestart','$datetarget','$datecomplete','$copyrightnum','$copyrightagency','$copyrightyear','$level','$title','$pname');";
            mysqli_query($con,$sql);
            $rowid = mysqli_insert_id($con);
            if($namecount>=1)
            {
                for($i=0; $i<=$namecount; $i++)
                {
                    if(trim($_POST["name"][$i]) !='')
                    {
                        $anothersql = "INSERT INTO co_name (CoId,CoName) VALUES ('$rowid','".mysqli_real_escape_string($con,$_POST["name"]["$i"])."')";
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
                        $alsoansql = "INSERT INTO co_keywords (CoId,CoKeywords) VALUES ('$rowid','".mysqli_real_escape_string($con,$_POST["keyword"]["$t"])."')";
                        mysqli_query($con,$alsoansql);
                    }
                }
            }
            $stat = ("UPDATE addstat SET stat = 0 WHERE id = 1");
            mysqli_query($con,$stat);
            header("Location: ../CopyrightedOutput.php?insert=suceess");
        }
        else
        {
            if($title==null)
            {
                $sql = ("UPDATE copyrightedoutput SET SubmissionId ='$id',CoClass='$class',CoCategory='$category',CoAgenda='$agenda',CoTitle='$researchtitle',CoInvolve='$involve',CoType='$type',CoFundType='$fundtype',CoFundAmount='$fundamount',CoFundAgency='$fundagency',CoDateStart='$datestart',CoDateTarget='$datetarget',CoDateCompleted='$datecomplete',CoCopyrightNum='$copyrightnum',CoCopyrightAgency='$copyrightagency',CoCopyrightYear='$copyrightyear',CoLevel='$level' WHERE CoId = '$change';");
                mysqli_query($con,$sql);
                $rowid = mysqli_insert_id($con);

                $removename = ("DELETE FROM co_name WHERE CoId = $change");
                mysqli_query($con,$removename);
                $removekeyword = ("DELETE FROM co_keywords WHERE CoId = $change");
                mysqli_query($con,$removekeyword);
                if($namecount>=1)
                {
                    for($i=0; $i<=$namecount; $i++)
                    {
                        if(trim($_POST["name"][$i]) !='')
                        {
                            $anothersql = "INSERT INTO co_name (CoId,CoName) VALUES ('$change','".mysqli_real_escape_string($con,$_POST["name"]["$i"])."')";
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
                            $alsoansql = "INSERT INTO co_keywords (CoId,CoKeywords) VALUES ('$change','".mysqli_real_escape_string($con,$_POST["keyword"]["$t"])."')";
                            mysqli_query($con,$alsoansql);
                        }
                    }
                }
                header("Location: ../CopyrightedOutput.php?Record=$change");
            }
            else
            {
                $checkfile = ("SELECT CoTempName FROM copyrightedoutput WHERE CoId ='$change'");
                $resultfile = mysqli_query($con,$checkfile);
                $updatefile = mysqli_fetch_assoc($resultfile);
                unlink("../uploads/".$updatefile);

                $sql = ("UPDATE copyrightedoutput SET SubmissionId ='$id',CoClass='$class',CoCategory='$category',CoAgenda='$agenda',CoTitle='$researchtitle',CoInvolve='$involve',CoType='$type',CoFundType='$fundtype',CoFundAmount='$fundamount',CoFundAgency='$fundagency',CoDateStart='$datestart',CoDateTarget='$datetarget',CoDateCompleted='$datecomplete',CoCopyrightNum='$copyrightnum',CoCopyrightAgency='$copyrightagency',CoCopyrightYear='$copyrightyear',CoLevel='$level',CoFilename='$title',CoTempName='$pname' WHERE CoId = '$change';");
                mysqli_query($con,$sql);
                $rowid = mysqli_insert_id($con);

                $removename = ("DELETE FROM co_name WHERE CoId = $change");
                mysqli_query($con,$removename);
                $removekeyword = ("DELETE FROM co_keywords WHERE CoId = $change");
                mysqli_query($con,$removekeyword);

                if($namecount>=1)
                {
                    for($i=0; $i<=$namecount; $i++)
                    {
                        if(trim($_POST["name"][$i]) !='')
                        {
                            $anothersql = "INSERT INTO co_name (CoId,CoName) VALUES ('$change','".mysqli_real_escape_string($con,$_POST["name"]["$i"])."')";
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
                            $alsoansql = "INSERT INTO co_keywords (CoId,CoKeywords) VALUES ('$change','".mysqli_real_escape_string($con,$_POST["keyword"]["$t"])."')";
                            mysqli_query($con,$alsoansql);
                        }
                    }
                }
                header("Location: ../CopyrightedOutput.php?Record=$change");
            }
        }
    }

    else
    {
        $sql = "INSERT INTO copyrightedoutput (SubmissionId,CoClass,CoCategory,CoAgenda,CoTitle,CoInvolve,CoType,CoFundType,CoFundAmount,CoFundAgency,CoDateStart,CoDateTarget,CoDateCompleted,CoCopyrightNum,CoCopyrightAgency,CoCopyrightYear,CoLevel,CoFilename,CoTempName) VALUES ('$id','$class','$category','$agenda','$researchtitle','$involve','$type','$fundtype','$fundamount','$fundagency','$datestart','$datetarget','$datecomplete','$copyrightnum','$copyrightagency','$copyrightyear','$level','$title','$pname');";
        mysqli_query($con,$sql);
        $rowid = mysqli_insert_id($con);
        if($namecount>=1)
        {
            for($i=0; $i<=$namecount; $i++)
            {
                if(trim($_POST["name"][$i]) !='')
                {
                    $anothersql = "INSERT INTO co_name (CoId,CoName) VALUES ('$rowid','".mysqli_real_escape_string($con,$_POST["name"]["$i"])."')";
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
                    $alsoansql = "INSERT INTO co_keywords (CoId,CoKeywords) VALUES ('$rowid','".mysqli_real_escape_string($con,$_POST["keyword"]["$t"])."')";
                    mysqli_query($con,$alsoansql);
                }
            }
        }
        $stat = ("UPDATE addstat SET stat = 0 WHERE id = 1");
        mysqli_query($con,$stat);
        header("Location: ../CopyrightedOutput.php?insert=suceess");
    }

}

if(isset($_POST['reseter']))
{
    $change = $_POST['change'];
    if($change!=null)
    {
        $sql = "DELETE FROM copyrightedoutput WHERE CoId = $change";
        mysqli_query($con,$sql);
        $sqle = "DELETE FROM co_keywords WHERE CoId = $change";
        $sqler = "DELETE FROM co_name WHERE CoId = $change";
        mysqli_query($sqle,$sql);
        mysqli_query($sqler,$sql);
        header("Location: ../CopyrightedOutput.php");
       
    }
}
if(isset($_POST['add']))
{
    $stat = ("UPDATE addstat SET stat = 1 WHERE id = 1");
    mysqli_query($con,$stat);
    header("Location: ../CopyrightedOutput.php");
}

?>