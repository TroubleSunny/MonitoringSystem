<?php

include("connection.php");
include("functions.php");

if(isset($_POST['revId']))
{
    $revId = $_POST['revId'];
    $revdata = $_POST['revdata'];
    $qarpart = $_POST['qarpart'];
    $userId = $_POST['userId'];

    if($qarpart == 1)
    {   
        $stat = ("UPDATE ongoingstudy SET RevStat = '$revdata' WHERE OngoingId = '$revId'");
        mysqli_query($con,$stat);
    }
    if($qarpart == 2)
    {
        $stat = ("UPDATE awards SET RevStat = '$revdata' WHERE AwardsId = '$revId'");
        mysqli_query($con,$stat);

    }
    if($qarpart == 3)
    {
        $stat = ("UPDATE membership SET RevStat = '$revdata' WHERE MembershipId = '$revId'");
        mysqli_query($con,$stat);

    }
    if($qarpart == 4)
    {
        $stat = ("UPDATE attendancedp SET RevStat = '$revdata' WHERE AdId = '$revId'");
        mysqli_query($con,$stat);

    }
    if($qarpart == 5)
    {
        $stat = ("UPDATE attendancet SET RevStat = '$revdata' WHERE AtId = '$revId'");
        mysqli_query($con,$stat);

    }
    if($qarpart == 6)
    {
        $stat = ("UPDATE opcr SET RevStat = '$revdata' WHERE OpId = '$revId'");
        mysqli_query($con,$stat);

    }
    if($qarpart == 7)
    {
        $stat = ("UPDATE opcre SET RevStat = '$revdata' WHERE OeId = '$revId'");
        mysqli_query($con,$stat);

    }
    if($qarpart == 8)
    {
        $stat = ("UPDATE opcrt SET RevStat = '$revdata' WHERE OtId = '$revId'");
        mysqli_query($con,$stat);

    }
    if($qarpart == 9)
    {
        $stat = ("UPDATE attendanceu SET RevStat = '$revdata' WHERE AuId = '$revId'");
        mysqli_query($con,$stat);

    }
    if($qarpart == 10)
    {
        $stat = ("UPDATE reqandque SET RevStat = '$revdata' WHERE ReqId = '$revId'");
        mysqli_query($con,$stat);

    }
    if($qarpart == 11)
    {
        $stat = ("UPDATE specialtasks SET RevStat = '$revdata' WHERE StId = '$revId'");
        mysqli_query($con,$stat);

    }
    if($qarpart == 12)
    {
        $stat = ("UPDATE researchongoing SET RevStat = '$revdata' WHERE RoId = '$revId'");
        mysqli_query($con,$stat);

    }
    if($qarpart == 13)
    {
        $stat = ("UPDATE researchpublication SET RevStat = '$revdata' WHERE RpId = '$revId'");
        mysqli_query($con,$stat);

    }
    if($qarpart == 14)
    {
        $stat = ("UPDATE researchpresentation SET RevStat = '$revdata' WHERE RpresId = '$revId'");
        mysqli_query($con,$stat);

    }
    if($qarpart == 15)
    {
        $stat = ("UPDATE researchcitation SET RevStat = '$revdata' WHERE CitationId = '$revId'");
        mysqli_query($con,$stat);

    }
    if($qarpart == 16)
    {
        $stat = ("UPDATE researchutilization SET RevStat = '$revdata' WHERE UtiId = '$revId'");
        mysqli_query($con,$stat);

    }
    if($qarpart == 17)
    {
        $stat = ("UPDATE copyrightedoutput SET RevStat = '$revdata' WHERE CoId = '$revId'");
        mysqli_query($con,$stat);

    }
    if($qarpart == 18)
    {
        $stat = ("UPDATE iicw SET RevStat = '$revdata' WHERE iicwId = '$revId'");
        mysqli_query($con,$stat);

    }
    if($qarpart == 19)
    {
        $stat = ("UPDATE eservice_consultant SET RevStat = '$revdata' WHERE EcId = '$revId'");
        mysqli_query($con,$stat);

    }
    if($qarpart == 20)
    {
        $stat = ("UPDATE eservice_conference SET RevStat = '$revdata' WHERE ConId = '$revId'");
        mysqli_query($con,$stat);

    }
    if($qarpart == 21)
    {
        $stat = ("UPDATE extension_journals SET RevStat = '$revdata' WHERE EjId = '$revId'");
        mysqli_query($con,$stat);

    }
    if($qarpart == 22)
    {
        $stat = ("UPDATE extensionprogram SET RevStat = '$revdata' WHERE EpId = '$revId'");
        mysqli_query($con,$stat);

    }
    if($qarpart == 23)
    {
        $stat = ("UPDATE partnership SET RevStat = '$revdata' WHERE PartnershipId = '$revId'");
        mysqli_query($con,$stat);

    }
    if($qarpart == 24)
    {
        $stat = ("UPDATE inolvementmobility SET RevStat = '$revdata' WHERE IMId = '$revId'");
        mysqli_query($con,$stat);

    }
    if($qarpart == 25)
    {
        $stat = ("UPDATE viabledemo SET RevStat = '$revdata' WHERE VdId = '$revId'");
        mysqli_query($con,$stat);

    }
    if($qarpart == 26)
    {
        $stat = ("UPDATE awardorg SET RevStat = '$revdata' WHERE AoId = '$revId'");
        mysqli_query($con,$stat);

    }
    if($qarpart == 27)
    {
        $stat = ("UPDATE relationprogram SET RevStat = '$revdata' WHERE RapId = '$revId'");
        mysqli_query($con,$stat);

    }
    
    if($revdata == 1)
    {
        $stat = ("UPDATE submission SET RevStat = '$revdata' WHERE SubmissionId = '$userId'");
        mysqli_query($con,$stat);
    }
    
        $check1 = "SELECT RevStat FROM ongoingstudy WHERE RevStat = 1 AND SubmissionId = '$userId'";
        $code1 = mysqli_query($con, $check1);
    
        $check2 = "SELECT RevStat FROM awards WHERE RevStat = 1 AND SubmissionId = '$userId'";
        $code2 = mysqli_query($con, $check2);
    
        $check3 = "SELECT RevStat FROM membership WHERE RevStat = 1 AND SubmissionId = '$userId'";
        $code3 = mysqli_query($con, $check3);
    
        $check4 = "SELECT RevStat FROM attendancedp WHERE RevStat = 1 AND SubmissionId = '$userId'";
        $code4 = mysqli_query($con, $check4);
    
        $check5 = "SELECT RevStat FROM attendancet WHERE RevStat = 1 AND SubmissionId = '$userId'";
        $code5 = mysqli_query($con, $check5);
    
        $check6 = "SELECT RevStat FROM opcr WHERE RevStat = 1 AND SubmissionId = '$userId'";
        $code6 = mysqli_query($con, $check6);
    
        $check7 = "SELECT RevStat FROM opcre WHERE RevStat = 1 AND SubmissionId = '$userId'";
        $code7 = mysqli_query($con, $check7);
    
        $check8 = "SELECT RevStat FROM opcrt WHERE RevStat = 1 AND SubmissionId = '$userId'";
        $code8 = mysqli_query($con, $check8);
    
        $check9 = "SELECT RevStat FROM attendanceu WHERE RevStat = 1 AND SubmissionId = '$userId'";
        $code9 = mysqli_query($con, $check9);
    
        $check10 = "SELECT RevStat FROM reqandque WHERE RevStat = 1 AND SubmissionId = '$userId'";
        $code10 = mysqli_query($con, $check10);
    
        $check11 = "SELECT RevStat FROM specialtasks WHERE RevStat = 1 AND SubmissionId = '$userId'";
        $code11 = mysqli_query($con, $check11);
    
        $check12 = "SELECT RevStat FROM researchongoing WHERE RevStat = 1 AND SubmissionId = '$userId'";
        $code12 = mysqli_query($con, $check12);
    
        $check13 = "SELECT RevStat FROM researchpublication WHERE RevStat = 1 AND SubmissionId = '$userId'";
        $code13 = mysqli_query($con, $check13);
    
        $check14 = "SELECT RevStat FROM researchpresentation WHERE RevStat = 1 AND SubmissionId = '$userId'";
        $code14 = mysqli_query($con, $check14);
    
        $check15 = "SELECT RevStat FROM researchcitation WHERE RevStat = 1 AND SubmissionId = '$userId'";
        $code15 = mysqli_query($con, $check15);
    
        $check16 = "SELECT RevStat FROM researchutilization WHERE RevStat = 1 AND SubmissionId = '$userId'";
        $code16 = mysqli_query($con, $check16);
    
        $check17 = "SELECT RevStat FROM copyrightedoutput WHERE RevStat = 1 AND SubmissionId = '$userId'";
        $code17 = mysqli_query($con, $check17);
        
        $check18 = "SELECT RevStat FROM iicw WHERE RevStat = 1 AND SubmissionId = '$userId'";
        $code18 = mysqli_query($con, $check18);
    
        $check19 = "SELECT RevStat FROM eservice_consultant WHERE RevStat = 1 AND SubmissionId = '$userId'";
        $code19 = mysqli_query($con, $check19);
    
        $check20 = "SELECT RevStat FROM eservice_conference WHERE RevStat = 1 AND SubmissionId = '$userId'";
        $code20 = mysqli_query($con, $check20);
    
        $check21 = "SELECT RevStat FROM extension_journals WHERE RevStat = 1 AND SubmissionId = '$userId'";
        $code21 = mysqli_query($con, $check21);
    
        $check22 = "SELECT RevStat FROM extensionprogram WHERE RevStat = 1 AND SubmissionId = '$userId'";
        $code22 = mysqli_query($con, $check22);
    
        $check23 = "SELECT RevStat FROM partnership WHERE RevStat = 1 AND SubmissionId = '$userId'";
        $code23 = mysqli_query($con, $check23);
    
        $check24 = "SELECT RevStat FROM inolvementmobility WHERE RevStat = 1 AND SubmissionId = '$userId'";
        $code24 = mysqli_query($con, $check24);
    
        $check25 = "SELECT RevStat FROM viabledemo WHERE RevStat = 1 AND SubmissionId = '$userId'";
        $code25 = mysqli_query($con, $check25);
    
        $check26 = "SELECT RevStat FROM awardorg WHERE RevStat = 1 AND SubmissionId = '$userId'";
        $code26 = mysqli_query($con, $check26);
    
        $check27 = "SELECT RevStat FROM relationprogram WHERE RevStat = 1 AND SubmissionId = '$userId'";
        $code27 = mysqli_query($con, $check27);
    
        
        if((mysqli_num_rows($code1) <= 0) && (mysqli_num_rows($code2) <= 0) && (mysqli_num_rows($code3) <= 0) && (mysqli_num_rows($code4) <= 0) && (mysqli_num_rows($code5) <= 0) && (mysqli_num_rows($code6) <= 0) && (mysqli_num_rows($code7) <= 0) && (mysqli_num_rows($code8) <= 0) && (mysqli_num_rows($code9) <= 0) && (mysqli_num_rows($code10) <= 0) && (mysqli_num_rows($code11) <= 0) && (mysqli_num_rows($code12) <= 0) && (mysqli_num_rows($code13) <= 0) && (mysqli_num_rows($code14) <= 0) && (mysqli_num_rows($code15) <= 0) && (mysqli_num_rows($code16) <= 0) && (mysqli_num_rows($code17) <= 0) && (mysqli_num_rows($code18) <= 0) && (mysqli_num_rows($code19) <= 0) && (mysqli_num_rows($code20) <= 0) && (mysqli_num_rows($code21) <= 0) && (mysqli_num_rows($code22) <= 0) && (mysqli_num_rows($code23) <= 0) && (mysqli_num_rows($code24) <= 0) && (mysqli_num_rows($code25) <= 0) && (mysqli_num_rows($code26) <= 0) && (mysqli_num_rows($code27) <= 0))
        {
            $stat = ("UPDATE submission SET RevStat = '$revdata' WHERE SubmissionId = '$userId'");
            mysqli_query($con,$stat);   
        }

    

   
    
}
?>