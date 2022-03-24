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
    
    $article = $_POST['article'];
    $research = $_POST['research'];
    $authors = $_POST['authors'];
    $journals = $_POST['journals'];
    $issue = $_POST['issue'];
    $volno = $_POST['volno'];
    $journalpage = $_POST['journalpage'];
    $journalyear = $_POST['journalyear'];
    $journalpublisher = $_POST['journalpublisher'];
    $journalindexing = $_POST['journalindexing'];

    $change = $_POST['change'];

    if($change!=null)
    {
        $check = ("SELECT CitationId FROM researchcitation WHERE CitationId = '$change'");
        $result = mysqli_query($con,$check);
        if($result->num_rows == 0)
        {
            $sql = "INSERT INTO researchcitation (SubmissionId,RpresClass,RpresCategory,RpresAgenda,RpresTitle,RpresInvolve,RpresType,RpresFundType,RpresFundAmount,RpresFundAgency,RpresDateStart,RpresDateTarget,RpresDateCompleted,RpresConTitle,RpresOrganizer,RpresVenue,RpresDatePresent,RpresLevel,RpresFilename,RpresTempName) VALUES ('$id','$class','$category','$agenda','$researchtitle','$involve','$type','$fundtype','$fundamount','$fundagency','$datestart','$datetarget','$datecomplete','$contitle','$organizer','$venue','$datepresent','$level','$title','$pname');";
            mysqli_query($con,$sql);
            $rowid = mysqli_insert_id($con);
            if($namecount>=1)
            {
                for($i=0; $i<=$namecount; $i++)
                {
                    if(trim($_POST["name"][$i]) !='')
                    {
                        $anothersql = "INSERT INTO rc_name (RcId,RpcName) VALUES ('$rowid','".mysqli_real_escape_string($con,$_POST["name"]["$i"])."')";
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
                        $alsoansql = "INSERT INTO rc_keywords (RcId,RcKeyword) VALUES ('$rowid','".mysqli_real_escape_string($con,$_POST["keyword"]["$t"])."')";
                        mysqli_query($con,$alsoansql);
                    }
                }
            }
            $stat = ("UPDATE addstat SET stat = 0 WHERE id = 1");
            mysqli_query($con,$stat);
            header("Location: ../ResearchCitation.php?insert=suceess");
        }

        else
        {
            if($title==null)
            {
                $sql = ("UPDATE researchcitation SET SubmissionId ='$id',RcClass='$class',RcCategory='$category',RcAgenda='$agenda',RcTitle='$researchtitle',RcInvolve='$involve',RcType='$type',RcFundType='$fundtype',RcFundAmount='$fundamount',RcFundAgency='$fundagency',RcDateStart='$datestart',RcDateTarget='$datetarget',RcDateCompleted='$datecomplete',RcArticleCited='$article',RcResearchCitedBy='$research',RcAuthorsCitedBy='$authors',RcJournalsCitedBy='$journals',RcVolNo='$volno',RcJournalIssue='$issue',RcJournalPage='$journalpage',RcJournalYear='$journalyear',RcJournalPublisher='$journalpublisher',RcJournalIndexing='$journalindexing' WHERE CitationId = '$change';");
                mysqli_query($con,$sql);
                $rowid = mysqli_insert_id($con);

                $removename = ("DELETE FROM rc_name WHERE CitationId = $change");
                mysqli_query($con,$removename);
                $removekeyword = ("DELETE FROM rc_keywords WHERE CitationId = $change");
                mysqli_query($con,$removekeyword);
                if($namecount>=1)
                {
                    for($i=0; $i<$namecount; $i++)
                    {
                        if(trim($_POST["name"][$i]) !='')
                        {
                            $anothersql = "INSERT INTO rc_name (CitationId,RcName) VALUES ('$change','".mysqli_real_escape_string($con,$_POST["name"]["$i"])."')";
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
                            $alsoansql = "INSERT INTO rc_keywords (CitationId,RcKeyword) VALUES ('$change','".mysqli_real_escape_string($con,$_POST["keyword"]["$t"])."')";
                            mysqli_query($con,$alsoansql);
                        }
                    }
                }
                header("Location: ../ResearchCitation.php?Record=$change");
            }
            else
            {
                $checkfile = ("SELECT RcTempName FROM researchcitation WHERE CitationId ='$change'");
                $resultfile = mysqli_query($con,$checkfile);
                $updatefile = mysqli_fetch_assoc($resultfile);
                unlink("../uploads/".$updatefile);

                $sql = ("UPDATE researchcitation SET SubmissionId ='$id',RcClass='$class',RcCategory='$category',RcAgenda='$agenda',RcTitle='$researchtitle',RcInvolve='$involve',RcType='$type',RcFundType='$fundtype',RcFundAmount='$fundamount',RcFundAgency='$fundagency',RcDateStart='$datestart',RcDateTarget='$datetarget',RcDateCompleted='$datecomplete',RcArticleCited='$article',RcResearchCitedBy='$research',RcAuthorsCitedBy='$authors',RcJournalsCitedBy='$journals',RcVolNo='$volno',RcJournalIssue='$issue',RcJournalPage='$journalpage',RcJournalYear='$journalyear',RcJournalPublisher='$journalpublisher',RcJournalIndexing='$journalindexing',RcFilename='$title',RcTempName='$pname' WHERE CitationId = '$change';");
                mysqli_query($con,$sql);
                $rowid = mysqli_insert_id($con);

                $removename = ("DELETE FROM rc_name WHERE CitationId = $change");
                mysqli_query($con,$removename);
                $removekeyword = ("DELETE FROM rc_keywords WHERE CitationId = $change");
                mysqli_query($con,$removekeyword);
                if($namecount>=1)
                {
                    for($i=0; $i<$namecount; $i++)
                    {
                        if(trim($_POST["name"][$i]) !='')
                        {
                            $anothersql = "INSERT INTO rc_name (CitationId,RcName) VALUES ('$change','".mysqli_real_escape_string($con,$_POST["name"]["$i"])."')";
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
                            $alsoansql = "INSERT INTO rc_keywords (CitationId,RcKeyword) VALUES ('$change','".mysqli_real_escape_string($con,$_POST["keyword"]["$t"])."')";
                            mysqli_query($con,$alsoansql);
                        }
                    }
                }
                header("Location: ../ResearchCitation.php?Record=$change");
            }
        }
    }

    else
    {
        $sql = "INSERT INTO researchcitation (SubmissionId,RcClass,RcCategory,RcAgenda,RcTitle,RcInvolve,RcType,RcFundType,RcFundAmount,RcFundAgency,RcDateStart,RcDateTarget,RcDateCompleted,RcArticleCited,RcResearchCitedBy,RcAuthorsCitedBy,RcJournalsCitedBy,RcVolNo,RcJournalIssue,RcJournalPage,RcJournalYear,RcJournalPublisher,RcJournalIndexing,RcFilename,RcTempName) VALUES ('$id','$class','$category','$agenda','$researchtitle','$involve','$type','$fundtype','$fundamount','$fundagency','$datestart','$datetarget','$datecomplete','$article','$research','$authors','$journals','$volno','$issue','$journalpage','$journalyear','$journalpublisher','$journalindexing','$title','$pname');";
        mysqli_query($con,$sql);
        $rowid = mysqli_insert_id($con);
        if($namecount>=1)
        {
            for($i=0; $i<=$namecount; $i++)
            {
                if(trim($_POST["name"][$i]) !='')
                {
                    $anothersql = "INSERT INTO rc_name (CitationId,RcName) VALUES ('$rowid','".mysqli_real_escape_string($con,$_POST["name"]["$i"])."')";
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
                    $alsoansql = "INSERT INTO rc_keywords (CitationId,RcKeyword) VALUES ('$rowid','".mysqli_real_escape_string($con,$_POST["keyword"]["$t"])."')";
                    mysqli_query($con,$alsoansql);
                }
            }
        }
        $stat = ("UPDATE addstat SET stat = 0 WHERE id = 1");
        mysqli_query($con,$stat);
        header("Location: ../ResearchCitation.php?insert=suceess");
    }

}

if(isset($_POST['reseter']))
{
    $change = $_POST['change'];
    if($change!=null)
    {
        $sql = "DELETE FROM researchcitation WHERE CitationId = $change";
        mysqli_query($con,$sql);
        
        $sqle = "DELETE FROM rc_keywords WHERE CitationId = $change";
        $sqler = "DELETE FROM rc_name WHERE CitationId = $change";
        mysqli_query($sqle,$sql);
        mysqli_query($sqler,$sql);
        header("Location: ../ResearchCitation.php");
    }
}

if(isset($_POST['add']))
{
    $stat = ("UPDATE addstat SET stat = 1 WHERE id = 1");
    mysqli_query($con,$stat);
    header("Location: ../ResearchCitation.php");
}

?>