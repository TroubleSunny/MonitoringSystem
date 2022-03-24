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
    $journal = $_POST['journal'];
    $pagenum = $_POST['pagenum'];
    $volno = $_POST['volno'];
    $issueno = $_POST['issueno'];
    $indexing = $_POST['indexing'];
    $publisher = $_POST['publisher'];
    $editor = $_POST['editor'];
    $issn = $_POST['issn'];
    $level = $_POST['level'];

    $namecount = count($_POST['name']);
    $keywordcount = count($_POST['keyword']);
    $fundtype = $_POST['fundtype'];
    $fundamount = $_POST['fundamount'];
    $fundagency = $_POST['fundagency'];
    $datestart = $_POST['datestart'];
    $datetarget = $_POST['datetarget'];
    $datecomplete = $_POST['datecomplete'];
    $datepublish = $_POST['datepublish'];

    $change = $_POST['change'];

    if($change!=null)
    {
        $check = ("SELECT RpId FROM researchpublication WHERE RpId = '$change'");
        $result = mysqli_query($con,$check);
        if($result->num_rows == 0)
        {
            $sql = "INSERT INTO researchpublication (SubmissionId,RpClass,RpCategory,RpAgenda,RpTitle,RpInvolve,RpType,RpFundType,RpFundAmount,RpFundAgency,RpDateStart,RpDateTarget,RpDateCompleted,RpJournalName,RpPageNumber,RpVolumeNo,RpIssueNo,RpIndexingPlatform,RpDatePublished,RpPublisher,RpEditor,RpISSN,RpLevel,RpFilename,RpTempName) VALUES ('$id','$class','$category','$agenda','$researchtitle','$involve','$type','$fundtype','$fundamount','$fundagency','$datestart','$datetarget','$datecomplete','$journal','$pagenum','$volno','$issueno','$indexing','$datepublish','$publisher','$editor','$issn','$level','$title','$pname');";
            mysqli_query($con,$sql);
            $rowid = mysqli_insert_id($con);
            if($namecount>=1)
            {
                for($i=0; $i<=$namecount; $i++)
                {
                    if(trim($_POST["name"][$i]) !='')
                    {
                        $anothersql = "INSERT INTO rp_name (RpId,RpName) VALUES ('$rowid','".mysqli_real_escape_string($con,$_POST["name"]["$i"])."')";
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
                        $alsoansql = "INSERT INTO rp_keywords (RpId,RpKeyword) VALUES ('$rowid','".mysqli_real_escape_string($con,$_POST["keyword"]["$t"])."')";
                        mysqli_query($con,$alsoansql);
                    }
                }
            }
            $stat = ("UPDATE addstat SET stat = 0 WHERE id = 1");
            mysqli_query($con,$stat);
            header("Location: ../ResearchPublication.php?insert=suceessss");
        }

        else
        {
            if($title==null)
            {
                $sql = ("UPDATE researchpublication SET SubmissionId ='$id',RpClass = '$class',RpCategory = '$category',RpAgenda = '$agenda',RpTitle = '$researchtitle',RpInvolve='$involve', RpType='$type',RpFundType='$fundtype',RpFundAmount='$fundamount',RpFundAgency='$fundagency',RpDateStart='$datestart',RpDateTarget='$datetarget',RpDateCompleted='$datecomplete',RpJournalName='$journal',RpPageNumber='$pagenum',RpVolumeNo='$volno',RpIssueNo='$issueno',RpIndexingPlatform='$indexing',RpDatePublished='$datepublish',RpPublisher='$publisher',RpEditor='$editor',RpISSN='$issn',RpLevel='$level' WHERE RpId = '$change';");
                mysqli_query($con,$sql);
                $rowid = mysqli_insert_id($con);
                $removename = ("DELETE FROM rp_name WHERE RpId = $change");
                mysqli_query($con,$removename);
                $removekeyword = ("DELETE FROM rp_keywords WHERE RpId = $change");
                mysqli_query($con,$removekeyword);
                if($namecount>=1)
                {
                    for($i=0; $i<$namecount; $i++)
                    {
                        if(trim($_POST["name"][$i]) !='')
                        {
                            $anothersql = "INSERT INTO rp_name (RpId,RpName) VALUES ('$change','".mysqli_real_escape_string($con,$_POST["name"]["$i"])."')";
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
                            $alsoansql = "INSERT INTO rp_keywords (RpId,RpKeyword) VALUES ('$change','".mysqli_real_escape_string($con,$_POST["keyword"]["$t"])."')";
                            mysqli_query($con,$alsoansql);
                        }
                    }
                }
                header("Location: ../ResearchPublication.php?Record=$change");
            }
            else
            {
                $checkfile = ("SELECT RpTempName FROM researchpublication WHERE RpId ='$change'");
                $resultfile = mysqli_query($con,$checkfile);
                $updatefile = mysqli_fetch_assoc($resultfile);
                unlink("../uploads/".$updatefile);

                $sql = ("UPDATE researchpublication SET SubmissionId ='$id',RpClass = '$class',RpCategory = '$category',RpAgenda = '$agenda',RpTitle = '$researchtitle',RpInvolve='$involve', RpType='$type',RpFundType='$fundtype',RpFundAmount='$fundamount',RpFundAgency='$fundagency',RpDateStart='$datestart',RpDateTarget='$datetarget',RpDateCompleted='$datecomplete',RpJournalName='$journal',RpPageNumber='$pagenum',RpVolumeNo='$volno',RpIssueNo='$issueno',RpIndexingPlatform='$indexing',RpDatePublished='$datepublish',RpPublisher='$publisher',RpEditor='$editor',RpISSN='$issn',RpLevel='$level', RpFilename='$title', RpTempName='$pname' WHERE RpId = '$change';");
                mysqli_query($con,$sql);
                $rowid = mysqli_insert_id($con);

                $removename = ("DELETE FROM rp_name WHERE RpId = $change");
                mysqli_query($con,$removename);
                $removekeyword = ("DELETE FROM rp_keywords WHERE RpId = $change");
                mysqli_query($con,$removekeyword);
                if($namecount>=1)
                {
                    for($i=0; $i<$namecount; $i++)
                    {
                        if(trim($_POST["name"][$i]) !='')
                        {
                            $anothersql = "INSERT INTO rp_name (RpId,RpName) VALUES ('$change','".mysqli_real_escape_string($con,$_POST["name"]["$i"])."')";
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
                            $alsoansql = "INSERT INTO rp_keywords (RpId,RpKeyword) VALUES ('$change','".mysqli_real_escape_string($con,$_POST["keyword"]["$t"])."')";
                            mysqli_query($con,$alsoansql);
                        }
                    }
                }
                
                header("Location: ../ResearchPublication.php?Record=$change");
            }
        }
    }

    else
    {
        $sql = "INSERT INTO researchpublication (SubmissionId,RpClass,RpCategory,RpAgenda,RpTitle,RpInvolve,RpType,RpFundType,RpFundAmount,RpFundAgency,RpDateStart,RpDateTarget,RpDateCompleted,RpJournalName,RpPageNumber,RpVolumeNo,RpIssueNo,RpIndexingPlatform,RpDatePublished,RpPublisher,RpEditor,RpISSN,RpLevel,RpFilename,RpTempName) VALUES ('$id','$class','$category','$agenda','$researchtitle','$involve','$type','$fundtype','$fundamount','$fundagency','$datestart','$datetarget','$datecomplete','$journal','$pagenum','$volno','$issueno','$indexing','$datepublish','$publisher','$editor','$issn','$level','$title','$pname');";
        mysqli_query($con,$sql);
        $rowid = mysqli_insert_id($con);
        if($namecount>=1)
        {
            for($i=0; $i<=$namecount; $i++)
            {
                if(trim($_POST["name"][$i]) !='')
                {
                    $anothersql = "INSERT INTO rp_name (RpId,RpName) VALUES ('$rowid','".mysqli_real_escape_string($con,$_POST["name"]["$i"])."')";
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
                    $alsoansql = "INSERT INTO rp_keywords (RpId,RpKeyword) VALUES ('$rowid','".mysqli_real_escape_string($con,$_POST["keyword"]["$t"])."')";
                    mysqli_query($con,$alsoansql);
                }
            }
        }
        $stat = ("UPDATE addstat SET stat = 0 WHERE id = 1");
        mysqli_query($con,$stat);
        header("Location: ../ResearchPublication.php?insert=suceessss");
    }

}
if(isset($_POST['reseter']))
{
    $change = $_POST['change'];
    if($change!=null)
    {
        $sql = "DELETE FROM researchpublication WHERE RpId = $change";
        mysqli_query($con,$sql);
        header("Location: ../ResearchPublication.php");
        $sqle = "DELETE FROM rp_keywords WHERE RpId = $change";
        $sqler = "DELETE FROM rp_name WHERE RpId = $change";
        mysqli_query($sqle,$sql);
        mysqli_query($sqler,$sql);
    }
}

if(isset($_POST['add']))
{
    $stat = ("UPDATE addstat SET stat = 1 WHERE id = 1");
    mysqli_query($con,$stat);
    header("Location: ../ResearchPublication.php");
}


?>