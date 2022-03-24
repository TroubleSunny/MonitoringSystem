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
    $contitle = $_POST['contitle'];
    $organizer = $_POST['organizer'];
    $venue = $_POST['venue'];
    $level = $_POST['level'];
    $namecount = count($_POST['name']);
    $keywordcount = count($_POST['keyword']);
    $fundtype = $_POST['fundtype'];
    $fundamount = $_POST['fundamount'];
    $fundagency = $_POST['fundagency'];
    $datestart = $_POST['datestart'];
    $datetarget = $_POST['datetarget'];
    $datepresent = $_POST['datepresent'];
    if($_POST['datecomplete']!=null)
    {
        $datecomplete = $_POST['datecomplete'];
    }
    else
    {
        $datecomplete = null;
    }  
    $change = $_POST['change'];

    if($change!=null)
    {
        $check = ("SELECT RpresId FROM researchpresentation WHERE RpresId = '$change'");
        $result = mysqli_query($con,$check);
        if($result->num_rows == 0)
        {
            $sql = "INSERT INTO researchpresentation (SubmissionId,RpresClass,RpresCategory,RpresAgenda,RpresTitle,RpresInvolve,RpresType,RpresFundType,RpresFundAmount,RpresFundAgency,RpresDateStart,RpresDateTarget,RpresDateCompleted,RpresConTitle,RpresOrganizer,RpresVenue,RpresDatePresent,RpresLevel,RpresFilename,RpresTempName) VALUES ('$id','$class','$category','$agenda','$researchtitle','$involve','$type','$fundtype','$fundamount','$fundagency','$datestart','$datetarget','$datecomplete','$contitle','$organizer','$venue','$datepresent','$level','$title','$pname');";
            mysqli_query($con,$sql);
            $rowid = mysqli_insert_id($con);
            if($namecount>=1)
            {
                for($i=0; $i<=$namecount; $i++)
                {
                    if(trim($_POST["name"][$i]) !='')
                    {
                        $anothersql = "INSERT INTO rpres_name (RpresId,RpresName) VALUES ('$rowid','".mysqli_real_escape_string($con,$_POST["name"]["$i"])."')";
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
                        $alsoansql = "INSERT INTO rpres_keywords (RpresId,RpresKeyword) VALUES ('$rowid','".mysqli_real_escape_string($con,$_POST["keyword"]["$t"])."')";
                        mysqli_query($con,$alsoansql);
                    }
                }
            }
            $stat = ("UPDATE addstat SET stat = 0 WHERE id = 1");
            mysqli_query($con,$stat);
            header("Location: ../ResearchPresentation.php?insert=suceess");
        }

        else
        {
            if($title==null)
            {
                $sql = ("UPDATE researchpresentation SET SubmissionId ='$id', RpresClass='$class',RpresCategory='$category',RpresAgenda='$agenda',RpresTitle='$researchtitle',RpresInvolve='$involve',RpresType='$type',RpresFundType='$fundtype',RpresFundAmount='$fundamount',RpresFundAgency='$fundagency',RpresDateStart='$datestart',RpresDateTarget='$datetarget',RpresDateCompleted='$datecomplete',RpresConTitle='$contitle',RpresOrganizer='$organizer',RpresVenue='$venue',RpresDatePresent='$datepresent',RpresLevel='$level' WHERE RpresId = '$change';");
                mysqli_query($con,$sql);
                $rowid = mysqli_insert_id($con);

                $removename = ("DELETE FROM rpres_name WHERE RpresId = $change");
                mysqli_query($con,$removename);
                $removekeyword = ("DELETE FROM rpres_keywords WHERE RpresId = $change");
                mysqli_query($con,$removekeyword);
                if($namecount>=1)
                {
                    for($i=0; $i<$namecount; $i++)
                    {
                        if(trim($_POST["name"][$i]) !='')
                        {
                            $anothersql = "INSERT INTO rpres_name (RpresId,RpresName) VALUES ('$change','".mysqli_real_escape_string($con,$_POST["name"]["$i"])."')";
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
                            $alsoansql = "INSERT INTO rpres_keywords (RpresId,RpresKeyword) VALUES ('$change','".mysqli_real_escape_string($con,$_POST["keyword"]["$t"])."')";
                            mysqli_query($con,$alsoansql);
                        }
                    }
                }
                header("Location: ../ResearchPresentation.php?Record=$change");
            }
            else
            {
                $checkfile = ("SELECT RpresTempName FROM researchpresentation WHERE RpresId ='$change'");
                $resultfile = mysqli_query($con,$checkfile);
                $updatefile = mysqli_fetch_assoc($resultfile);
                unlink("../uploads/".$updatefile);

                $sql = ("UPDATE researchpresentation SET SubmissionId ='$id', RpresClass='$class',RpresCategory='$category',RpresAgenda='$agenda',RpresTitle='$researchtitle',RpresInvolve='$involve',RpresType='$type',RpresFundType='$fundtype',RpresFundAmount='$fundamount',RpresFundAgency='$fundagency',RpresDateStart='$datestart',RpresDateTarget='$datetarget',RpresDateCompleted='$datecomplete',RpresConTitle='$contitle',RpresOrganizer='$organizer',RpresVenue='$venue',RpresDatePresent='$datepresent',RpresLevel='$level',RpresFilename='$title',RpresTempName='$pname' WHERE RpresId = '$change';");
                mysqli_query($con,$sql);
                $rowid = mysqli_insert_id($con);

                $removename = ("DELETE FROM rpres_name WHERE RpresId = $change");
                mysqli_query($con,$removename);
                $removekeyword = ("DELETE FROM rpres_keywords WHERE RpresId = $change");
                mysqli_query($con,$removekeyword);
                if($namecount>=1)
                {
                    for($i=0; $i<$namecount; $i++)
                    {
                        if(trim($_POST["name"][$i]) !='')
                        {
                            $anothersql = "INSERT INTO rpres_name (RpresId,RpresName) VALUES ('$change','".mysqli_real_escape_string($con,$_POST["name"]["$i"])."')";
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
                            $alsoansql = "INSERT INTO rpres_keywords (RpresId,RpresKeyword) VALUES ('$change','".mysqli_real_escape_string($con,$_POST["keyword"]["$t"])."')";
                            mysqli_query($con,$alsoansql);
                        }
                    }
                }
                header("Location: ../ResearchPresentation.php?Record=$change");
            }
        }
    }

    else
    {
        $sql = "INSERT INTO researchpresentation (SubmissionId,RpresClass,RpresCategory,RpresAgenda,RpresTitle,RpresInvolve,RpresType,RpresFundType,RpresFundAmount,RpresFundAgency,RpresDateStart,RpresDateTarget,RpresDateCompleted,RpresConTitle,RpresOrganizer,RpresVenue,RpresDatePresent,RpresLevel,RpresFilename,RpresTempName) VALUES ('$id','$class','$category','$agenda','$researchtitle','$involve','$type','$fundtype','$fundamount','$fundagency','$datestart','$datetarget','$datecomplete','$contitle','$organizer','$venue','$datepresent','$level','$title','$pname');";
        mysqli_query($con,$sql);
        $rowid = mysqli_insert_id($con);
        if($namecount>=1)
        {
            for($i=0; $i<=$namecount; $i++)
            {
                if(trim($_POST["name"][$i]) !='')
                {
                    $anothersql = "INSERT INTO rpres_name (RpresId,RpresName) VALUES ('$rowid','".mysqli_real_escape_string($con,$_POST["name"]["$i"])."')";
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
                    $alsoansql = "INSERT INTO rpres_keywords (RpresId,RpresKeyword) VALUES ('$rowid','".mysqli_real_escape_string($con,$_POST["keyword"]["$t"])."')";
                    mysqli_query($con,$alsoansql);
                }
            }
        }
        $stat = ("UPDATE addstat SET stat = 0 WHERE id = 1");
        mysqli_query($con,$stat);
        header("Location: ../ResearchPresentation.php?insert=suceess");
    }

}
if(isset($_POST['reseter']))
{
    $change = $_POST['change'];
    if($change!=null)
    {
        $sql = "DELETE FROM researchpresentation WHERE RpresId = $change";
        mysqli_query($con,$sql);
        
        $sqle = "DELETE FROM rpres_keywords WHERE RpresId = $change";
        $sqler = "DELETE FROM rpres_name WHERE RpresId = $change";
        mysqli_query($sqle,$sql);
        mysqli_query($sqler,$sql);
        header("Location: ../ResearchPresentation.php");
    }
}
if(isset($_POST['add']))
{
    $stat = ("UPDATE addstat SET stat = 1 WHERE id = 1");
    mysqli_query($con,$stat);
    header("Location: ../ResearchPresentation.php");
}

?>