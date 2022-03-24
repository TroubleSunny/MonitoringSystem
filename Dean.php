<?php
session_start();

include("connection.php");
include("functions.php");

$user_data = check_login($con);
$usercollege = $user_data['College'];
$querycol = "SELECT CollegeName FROM college WHERE College = '$usercollege'";
$resultcol = mysqli_query($con,$querycol);
$collegename = mysqli_fetch_assoc($resultcol);
$usercol = $collegename['CollegeName'];
$deanname = $user_data['UserName'];
$change = 1;



$quarterdis = "SELECT * FROM quarter WHERE QuarterProgress = 'Ongoing'";
$quarterdisp = mysqli_query($con,$quarterdis);
$qu = mysqli_fetch_assoc($quarterdisp);
$displayquarter = $qu['QuarterPart'];
$fetchyear = $qu['YearId'];
$open = $qu['QuarterStart'];
$close = $qu['QuarterEnd'];

$quarterdis = "SELECT SchoolYear FROM schoolyear WHERE YearId = '$fetchyear'";
$quarterdisp = mysqli_query($con,$quarterdis);
$qu = mysqli_fetch_assoc($quarterdisp);
$displayyear = $qu['SchoolYear'];


$i = 0;
$char_data_completed = '';
$char_data_all = '';
$char_data_ongoing = '';
$char_data_publication = '';
$char_data_presentation = '';
$char_data_citation = '';
$char_data_copyright = '';
$char_data_deferred = '';
$char_data_utilization = '';
$yearquery = ("SELECT SchoolYear FROM schoolyear ORDER BY SchoolYear ASC");
$yearresult = mysqli_query($con,$yearquery);
while($row = mysqli_fetch_assoc($yearresult))
{
    $school = $row['SchoolYear'];
    
    
    $complete_query = ("SELECT RoId FROM researchongoing WHERE RoStatus = 'Completed' AND SubmissionId IN (SELECT SubmissionId FROM submission WHERE ValidationStatus = 'Accepted' AND UserId IN(SELECT UserId FROM user WHERE College = '$usercollege') AND QuarterId IN (SELECT QuarterId FROM quarter WHERE YearId IN (SELECT YearId FROM schoolyear WHERE SchoolYear = '$school')))");
    $complete_result = mysqli_query($con,$complete_query);
    $complete_count = mysqli_num_rows($complete_result);

    $ongoing_query = ("SELECT RoId FROM researchongoing WHERE RoStatus = 'Ongoing' AND SubmissionId IN (SELECT SubmissionId FROM submission WHERE ValidationStatus = 'Accepted' AND UserId IN(SELECT UserId FROM user WHERE College = '$usercollege') AND QuarterId IN (SELECT QuarterId FROM quarter WHERE YearId IN (SELECT YearId FROM schoolyear WHERE SchoolYear = '$school')))");
    $ongoing_result = mysqli_query($con,$ongoing_query);
    $ongoing_count = mysqli_num_rows($ongoing_result);

    $deffered_query = ("SELECT RoId FROM researchongoing WHERE RoStatus = 'Deferred' AND SubmissionId IN (SELECT SubmissionId FROM submission WHERE ValidationStatus = 'Accepted' AND UserId IN(SELECT UserId FROM user WHERE College = '$usercollege') AND QuarterId IN (SELECT QuarterId FROM quarter WHERE YearId IN (SELECT YearId FROM schoolyear WHERE SchoolYear = '$school')))");
    $deferred_result = mysqli_query($con,$deffered_query);
    $deferred_count = mysqli_num_rows($deferred_result);

    $publication_query = ("SELECT RpId FROM researchpublication WHERE SubmissionId IN (SELECT SubmissionId FROM submission WHERE ValidationStatus = 'Accepted' AND UserId IN(SELECT UserId FROM user WHERE College = '$usercollege') AND QuarterId IN (SELECT QuarterId FROM quarter WHERE YearId IN (SELECT YearId FROM schoolyear WHERE SchoolYear = '$school')))");
    $publication_result = mysqli_query($con,$publication_query);
    $publication_count = mysqli_num_rows($publication_result);

    $presentation_query = ("SELECT RpresId FROM researchpresentation WHERE SubmissionId IN (SELECT SubmissionId FROM submission WHERE ValidationStatus = 'Accepted' AND UserId IN(SELECT UserId FROM user WHERE College = '$usercollege') AND QuarterId IN (SELECT QuarterId FROM quarter WHERE YearId IN (SELECT YearId FROM schoolyear WHERE SchoolYear = '$school')))");
    $presentation_result = mysqli_query($con,$presentation_query);
    $presentation_count = mysqli_num_rows($presentation_result);

    $citation_query = ("SELECT CitationId FROM researchcitation WHERE SubmissionId IN (SELECT SubmissionId FROM submission WHERE ValidationStatus = 'Accepted' AND UserId IN(SELECT UserId FROM user WHERE College = '$usercollege') AND QuarterId IN (SELECT QuarterId FROM quarter WHERE YearId IN (SELECT YearId FROM schoolyear WHERE SchoolYear = '$school')))");
    $citation_result = mysqli_query($con,$citation_query);
    $citation_count = mysqli_num_rows($citation_result);

    $citation_scopus_query = ("SELECT CitationId FROM researchcitation WHERE RcJournalIndexing = 'Scopus' AND SubmissionId IN (SELECT SubmissionId FROM submission WHERE ValidationStatus = 'Accepted' AND UserId IN(SELECT UserId FROM user WHERE College = '$usercollege') AND QuarterId IN (SELECT QuarterId FROM quarter WHERE YearId IN (SELECT YearId FROM schoolyear WHERE SchoolYear = '$school')))");
    $citation_scopus_result = mysqli_query($con,$citation_scopus_query);
    $citation_scopus_count = mysqli_num_rows($citation_scopus_result);

    $citation_web_query = ("SELECT CitationId FROM researchcitation WHERE RcJournalIndexing = 'Web of Science' AND SubmissionId IN (SELECT SubmissionId FROM submission WHERE ValidationStatus = 'Accepted' AND UserId IN(SELECT UserId FROM user WHERE College = '$usercollege') AND QuarterId IN (SELECT QuarterId FROM quarter WHERE YearId IN (SELECT YearId FROM schoolyear WHERE SchoolYear = '$school')))");
    $citation_web_result = mysqli_query($con,$citation_web_query);
    $citation_web_count = mysqli_num_rows($citation_web_result);

    $citation_oasuc_query = ("SELECT CitationId FROM researchcitation WHERE RcJournalIndexing = 'OASUC Accredited Journals' AND SubmissionId IN (SELECT SubmissionId FROM submission WHERE ValidationStatus = 'Accepted' AND UserId IN(SELECT UserId FROM user WHERE College = '$usercollege') AND QuarterId IN (SELECT QuarterId FROM quarter WHERE YearId IN (SELECT YearId FROM schoolyear WHERE SchoolYear = '$school')))");
    $citation_oasuc_result = mysqli_query($con,$citation_oasuc_query);
    $citation_oasuc_count = mysqli_num_rows($citation_oasuc_result);

    $citation_ched_query = ("SELECT CitationId FROM researchcitation WHERE RcJournalIndexing = 'CHED Recognized Journals' AND SubmissionId IN (SELECT SubmissionId FROM submission WHERE ValidationStatus = 'Accepted' AND UserId IN(SELECT UserId FROM user WHERE College = '$usercollege') AND QuarterId IN (SELECT QuarterId FROM quarter WHERE YearId IN (SELECT YearId FROM schoolyear WHERE SchoolYear = '$school')))");
    $citation_ched_result = mysqli_query($con,$citation_ched_query);
    $citation_ched_count = mysqli_num_rows($citation_ched_result);

    $citation_inter_query = ("SELECT CitationId FROM researchcitation WHERE RcJournalIndexing = 'International Refereed Journals' AND SubmissionId IN (SELECT SubmissionId FROM submission WHERE ValidationStatus = 'Accepted' AND UserId IN(SELECT UserId FROM user WHERE College = '$usercollege') AND QuarterId IN (SELECT QuarterId FROM quarter WHERE YearId IN (SELECT YearId FROM schoolyear WHERE SchoolYear = '$school')))");
    $citation_inter_result = mysqli_query($con,$citation_inter_query);
    $citation_inter_count = mysqli_num_rows($citation_inter_result);

    $citation_exe_query = ("SELECT CitationId FROM researchcitation WHERE RcJournalIndexing = 'Excellence in Research for Australia' AND SubmissionId IN (SELECT SubmissionId FROM submission WHERE ValidationStatus = 'Accepted' AND UserId IN(SELECT UserId FROM user WHERE College = '$usercollege') AND QuarterId IN (SELECT QuarterId FROM quarter WHERE YearId IN (SELECT YearId FROM schoolyear WHERE SchoolYear = '$school')))");
    $citation_exe_result = mysqli_query($con,$citation_exe_query);
    $citation_exe_count = mysqli_num_rows($citation_exe_result);

    $citation_asean_query = ("SELECT CitationId FROM researchcitation WHERE RcJournalIndexing = 'ASEAN Citation Index' AND SubmissionId IN (SELECT SubmissionId FROM submission WHERE ValidationStatus = 'Accepted' AND UserId IN(SELECT UserId FROM user WHERE College = '$usercollege') AND QuarterId IN (SELECT QuarterId FROM quarter WHERE YearId IN (SELECT YearId FROM schoolyear WHERE SchoolYear = '$school')))");
    $citation_asean_result = mysqli_query($con,$citation_asean_query);
    $citation_asean_count = mysqli_num_rows($citation_asean_result);

    $utilization_query = ("SELECT UtiId FROM researchutilization WHERE SubmissionId IN (SELECT SubmissionId FROM submission WHERE ValidationStatus = 'Accepted' AND UserId IN(SELECT UserId FROM user WHERE College = '$usercollege') AND QuarterId IN (SELECT QuarterId FROM quarter WHERE YearId IN (SELECT YearId FROM schoolyear WHERE SchoolYear = '$school')))");
    $utilization_result = mysqli_query($con,$utilization_query);
    $utilization_count = mysqli_num_rows($utilization_result);

    $copyright_query = ("SELECT CoId FROM copyrightedoutput WHERE SubmissionId IN (SELECT SubmissionId FROM submission WHERE ValidationStatus = 'Accepted' AND UserId IN(SELECT UserId FROM user WHERE College = '$usercollege') AND QuarterId IN (SELECT QuarterId FROM quarter WHERE YearId IN (SELECT YearId FROM schoolyear WHERE SchoolYear = '$school')))");
    $copyright_result = mysqli_query($con,$copyright_query);
    $copyright_count = mysqli_num_rows($copyright_result);
    
    
    $char_data_all .= "{Ongoing:'".$complete_count."', Publication:'".$publication_count."', Presentation:'".$presentation_count."', Citation:'".$citation_count."', Utilization:'".$utilization_count."', Copyright:'".$copyright_count."', year:".$row['SchoolYear']."},";
    $char_data_completed .= "{Titles:'".$complete_count."',year:".$row['SchoolYear']."},";
    $char_data_deferred .= "{Titles:'".$deferred_count."',year:".$row['SchoolYear']."},";
    $char_data_ongoing .= "{Titles:'".$ongoing_count."',year:".$row['SchoolYear']."},";
    $char_data_publication .= "{Titles:'".$publication_count."',year:".$row['SchoolYear']."},";
    $char_data_presentation .= "{Titles:'".$presentation_count."',year:".$row['SchoolYear']."},";
    $char_data_citation .= "{Scopus:'".$citation_scopus_count."', Web:'".$citation_web_count."', Oasuc:'".$citation_oasuc_count."', Ched:'".$citation_ched_count."', International:'".$citation_inter_count."', Exellence:'".$citation_exe_count."', Asean:'".$citation_asean_count."', year:".$row['SchoolYear']."},";
    $char_data_utilization .= "{Titles:'".$utilization_count."',year:".$row['SchoolYear']."},";
    $char_data_copyright .= "{Titles:'".$copyright_count."',year:".$row['SchoolYear']."},";
    
}
if ($_SESSION['suc'] == 2 )
{    
 echo "<script type='text/javascript'>alert('Accepted');</script>";
 $_SESSION['suc']=0;
}
if ($_SESSION['suc'] == 1 )
{    
 echo "<script type='text/javascript'>alert('Submission still has revisions');</script>";
 $_SESSION['suc']=0;
}
?>
<head>
    <meta charset="UTF-8">
    <title>Submissions Monitoring</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/html2canvas@1.0.0-rc.1/dist/html2canvas.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/html2canvas@1.0.0-rc.1/dist/html2canvas.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="style.css"> 
    
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>


<body class="main-level">
    <div class="wrapper">
    
        <div class="sidebar">
            
            <header>Welcome <?php echo $deanname; ?></header>
            <ul>
                <li><a class="choice" href=# onclick="openTab('Submissions')"><i class="fas fa-scroll"></i><span>QAR Submissions</span></a></li>
                <li><a class="choice" href=# onclick="openTab('Members')"><i class="fas fa-user-friends"></i><span>Faculty members</span></a></li>
                <li id="ResearchTab"><a class="choice" href=# onclick="openTab('Research')"><i class="fas fa-search"></i><span>College Research</span></a></li>
                <li><a class="choice" href="FacultyAccount.php"><i class="fa fa-arrow-circle-left"></i><span>Return</span></a></li>
                <li><a class="choice" href="Login.php"><i class="fas fa-sign-out-alt"></i><span>Logout</a></span></li>
            </ul>
        </div>
    </div>
    <div id="Submissions" class="Contents tab">
    
        <div class="stuff-banner">
            <section id="inner-headline">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <h2 class="pageTitle" style="font-size:28px; margin-top:0;"><?php echo $usercol; ?> QAR Submissions <?php echo "$displayquarter ($displayyear)";  ?></h2>
                            <h3 class="pageTitle" style="color:white; font-size:20px; margin-top:0;">From: <?php echo $open; ?> To: <?php echo $close; ?></h3>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div class="stuff">
        

            <div class="input-group rounded"style="margin-bottom:20px; ">
                <label class="labeler" for="Status">Sort Submissions By:</label>
            
                <select class="form-controler" name="quarterval" id="quarterval">
                    <?php
                        
                        $yeartake = "SELECT * FROM schoolyear ORDER BY SchoolYear DESC";
                        $yearval = mysqli_query($con,$yeartake);
                        if(mysqli_num_rows($yearval)>0)
                        {
                            while($yearpart = $yearval->fetch_assoc())
                            {
                                $yearpart = $yearpart['YearId'];
                                $y = "SELECT SchoolYear FROM schoolyear WHERE YearId = '$yearpart'";
                                $ye = mysqli_query($con,$y);
                                foreach($ye as $yea)
                                {
                                    $yeah = $yea['SchoolYear'];
                                }
                                $quarter = "SELECT QuarterPart,QuarterId FROM quarter WHERE YearId = '$yearpart' ORDER BY QuarterId DESC";
                                $quarterval = mysqli_query($con,$quarter);
                                while($quarterpart = $quarterval->fetch_assoc())
                                {
                                    $quarterdata = $quarterpart['QuarterId'];
                                    $quarterpart = $quarterpart['QuarterPart'];
                                    echo " <option value='$quarterdata'>$quarterpart($yeah)</option>";
                                }
                                
                            }                            
                        } 
                    ?> 
                </select>     
            </div>
            <div class="input-group rounded" style="float:right; padding:5px;">
                <input type="search" class="form-control rounded" placeholder="Member Name" aria-label="Search"aria-describedby="search-addon" />
            </div>
            <div class="subcon1">
            <table class="table-main">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Member Name</th>
                        <th scope="col">Date Submitted</th>
                        <th scope="col">Validation Status</th>
                        <th style="text-align:center;"scope="col">Validation</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $query = "SELECT * FROM submission WHERE SubmissionStatus = 'Submitted' AND UserId In(SELECT UserId FROM user WHERE College='$usercollege') AND QuarterId IN (SELECT QuarterId FROM quarter WHERE QuarterProgress = 'Ongoing')";
                    $r = mysqli_query($con,$query);
                    $i = 1;
                    while($row = mysqli_fetch_assoc($r)){
                        
                        ?>
                    <tr>
                        <th scope="row"><?php echo $i; ?></th>
                        <td><?php
                            if($row['ValidationStatus']==null)
                            {
                                $valstatus = 'Pending';
                            }
                            else
                            {
                                $valstatus = $row['ValidationStatus'];
                            }
                            
                            
                            $take = $row['UserId'];
                            $name = "SELECT RealName FROM user WHERE UserId = $take";
                            $fetchname = mysqli_query($con,$name);
                            $membername = mysqli_fetch_assoc($fetchname);
                            echo $membername['RealName']?>
                        </td>
                        <td><?php echo $row['DateSubmitted']?></td>
                        <td><?php echo $valstatus?></td>
                        <form action="" method="post">
                            <td style="text-align:center; ">
                             
                                <input type="button" name="Accept" id="<?php echo $row['SubmissionId'];?>" class="btn btn-success accept" value="Accept">
                                <input type="button" name="remove" id="<?php echo $row['SubmissionId'];?>" class="btn btn-warning send_feedback" value="Send Feedback">
                                <input type="button" name="View" value="view" id="<?php echo $row['SubmissionId'];?>" class="btn btn-info view_data">
                            </td>
                        </form>
                    </tr>
                    <?php
                        $i++;
                    }
                    ?>
                </tbody>
            </table>
                </div>
            <button id="viewallbtn" class="btn btn-primarys viewallbtn" style="padding: 10px; font-size: 16px;">View Accepted QAR</button>
        </div>
        <div id ="dataModal" class="modal fade" style="background-color: rgba(0,0,0,0.3); height:100%; Width:100%">
            <div class="modal-dialog "style="width:100%; max-width:1600; height:100%; margin:0 auto;margin-top:50px;">
                <div class="modal-content" style="width:100%; max-width:1500px; margin:0 auto; padding:40px; margin-top:30px; top:0;left0; bottom:0; height:900px; ">
                    <div class="modal-header" style="margin-top:100px;">                            
                        <h4 class="modal-title">Quarterly Accomplishment Report</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body" id="submission_detail" style="overflow-x:auto;bottom:0; top:0;">

                    </div>
                    <div class="modal-footer">
                       <form action="export.php" class="mr-auto" method="POST">
                            <input name="num" id="num" type="hidden">
                            <input name="thisuser" id="thisuser" type="hidden">
                            <input name="thiscollege" id="thiscollege" type="hidden">
                            <input name= "thisquarter" id="thisquarter" type="hidden">
                            <button id="printresearchbtn" name="export_excel" class="btn btn-primarys mr-auto" style="paddin:15px; font-size: 16px; ">Print QAR Submissions</button>
                        </form>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <div id ="dataModalfeedback" class="modal fade" style="background-color: rgba(0,0,0,0.3); width:100%;">
            <div class="modal-dialog " style="position: absolute; float: left; left: 50%;top: 50%; transform: translate(-50%, -50%); max-width:1600; height:auto;">
                <div class="modal-content" style=" max-width:1600;" >
                    <div class="modal-header" >                            
                        <h4 class="modal-title">Quarterly Accomplishment Report</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body" id="feedback_detail" >

                    </div>
                    <div class="modal-footer">
                       
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <div id ="dataModalaccept" class="modal fade" style="background-color: rgba(0,0,0,0.3); width:100%;">
            <div class="modal-dialog " style="position: absolute; float: left; left: 50%;top: 50%; transform: translate(-50%, -50%);height:auto;">
                <div class="modal-content" >
                    <div class="modal-header" >                            
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body" id="accept_detail" >

                    </div>
                    <div class="modal-footer">
                        
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div> 
    <div id="Members" class="Contents tab" style="display:none">
        <div class="stuff-banner">
            <section id="inner-headline">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <h2 class="pageTitle" style="font-size:35px; " ><?php echo $usercol; ?> Faculty Members</h2>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div class="stuff">
        
            <div class="input-group rounded" style="float:right; padding:5px;">
                <input type="search" class="form-controler" placeholder="Member Name" aria-label="Search"aria-describedby="search-addon" />
            </div>
            <table class="table-main">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Member ID</th>
                        <th scope="col">Member Name</th>
                        <th scope="col">Last Submitted QAR Date</th>
                        <th style="text-align:center;" scope="col">Remove Member</th>
                        </tr>
                </thead>
                <tbody>
                    <?php
                   
                    $query = "SELECT * FROM user WHERE College = '$usercollege' AND UserLevel='Faculty Member'";
                    $r = mysqli_query($con,$query);
                    $i = 1;
                    while($row = mysqli_fetch_assoc($r)){
                        $userid=$row['UserId'];
                        $sub = $con->query("SELECT DateSubmitted FROM submission WHERE SubmissionId = (SELECT SubmissionId FROM submission WHERE UserId = '$userid' AND (SubmissionStatus='Submitted' OR SubmissionStatus= 'Conculded') ORDER BY SubmissionId DESC LIMIT 1)");
                        $submi = $sub->fetch_assoc();
                        if($submi==null)
                        {
                            $submissiondate = 'None';
                        }
                        else
                        {
                            $submissiondate = $submi['DateSubmitted'];
                        }
                        
                        ?>
                    <tr>
                        <th scope="row"><?php echo $i; ?></th>
                        <td><?php echo $userid; ?></td>
                        <td><?php echo $row['RealName']; ?></td>
                        <td><?php echo $submissiondate; ?>
                    </td>
                        <form action="" method="post">
                            <th style="text-align:center;"><input type="submit" name="remove" class="btn btn-danger" value="Remove"></th>
                        </form>
                    </tr>
                    <?php
                        $i++;}
                    ?>
                </tbody>
            </table>
            
            
            <div class="containerz" id="modalz_containerz">
                <div class="row">
                    <div class="moz">
                        <div class="col-sm-11">
                            <form action="Insert/insertMember.php" method="POST">
                                <h1>Add Member</h1>
                                <p>Enter Member Details</p>
                                <hr class ="mb-3">
                                <label for="username">User Name<b></label>
                                <input class="form-control" type="text" name="username" required>

                                <label for="fullname">Full Name<b></label>
                                <input class="form-control" type="text" name="fullname" required>

                                <label class="labeler" for="userlevel">User Level<b></label>
                        
                                <select class="form-control input-sm" style="height:30px" name="userlevel" id="userlevel" required>
                                    <option value=""></option>
                                    <option value="Dean" >Dean</option>
                                    <option value="Faculty Member">Faculty Member</option>

                                </select> 

                                <label for="password">Password<b></label>
                                <input class="form-control" type="password" name="password" required>

                                <label for="section">Section<b></label>
                                <input class="form-control" type="text" name="section" value="<?php echo $usercollege; ?>" readonly>
                                <input name="change" type="hidden" value="<?php echo $change; ?>">
                                <div class="Formbtn">
                                    <button class="btn btn-success" name="submit" value="submit" type="submit" style="font-weight: bold;" onclick="return confirm('Save submission for this segment?');">Add</span></button>
                                    <button class="btn btn-warning" type="button" id="closez">Close</button>
                                </div>
                            </form>                          
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="Research" class="Contents tab" style="display:none">
        <div class="stuff-banner">
            <section id="inner-headline">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <h2 class="pageTitle" style="font-size:35px; " ><?php echo $usercol; ?> Research Titles</h2>
                            
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div class="stuff">
            <div class=" navbar nav navbar-light bg-faded" role style="background:white; margin-bottom:30px;">
                <a href="#All" data-toggle="tab"><button  class="ProgressTabItems" onclick="openTab2('All')">All Research Titles</button></a>
                <a href="#Ongoing" data-toggle="tab" role="tab"><button class="ProgressTabItems" onclick="openTab2('Ongoing')">Ongoing</button></a>
                <a href="#Completed" data-toggle="tab" ><button class="ProgressTabItems" onclick="openTab2('Completed')">Completed</button></a>
                <a href="#Unfinished" data-toggle="tab" ><button class="ProgressTabItems" onclick="openTab2('Unfinished')">Unfinished</button></a>
                <a href="#Publication" data-toggle="tab" ><button class="ProgressTabItems" onclick="openTab2('Publication')">Publications</button></a>
                <a href="#Presentation" data-toggle="tab" ><button class="ProgressTabItems" onclick="openTab2('Presentation')">Presentations</button></a>
                <a href="#Citation" data-toggle="tab" ><button class="ProgressTabItems" onclick="openTab2('Citation')">Citations</button></a>
                <a href="#Utilization" data-toggle="tab" ><button class="ProgressTabItems" onclick="openTab2('Utilization')">Utilization</button></a>
                <a href="#Copyright" data-toggle="tab" ><button class="ProgressTabItems" onclick="openTab2('Copyright')">Copyrighted Research Outputs</button></a>
            </div>

            <div id="All" class="Contents tab2">
                <div class="input-group rounded"style="margin-bottom:20px; ">

                    <label class="labeler" for="Status" style="margin-left:60px;">Sort By Level:</label>
                    
                        <select class="form-controler" name="levelvalAll" id="levelvalAll">
                            <option value="All">All</option>
                            <option value="International" >International</option>
                            <option value="National">National</option>
                            <option value="Regional">Regional</option>
                            <option value="Provincial/City/Municipal">Provincial/City/Municipal</option>   
                            <option value="Local-PUP">Local-PUP</option> 
                        </select> 
                    <label class="labeler" for="Status" style="margin-left:60px;">Sort By Year:</label>
                    
                    <select class="form-controler" name="yearvalAll" id="yearvalAll">
                        <?php

                            $college = "SELECT SchoolYear FROM schoolyear ORDER BY YearId DESC";
                            $collegeval = mysqli_query($con,$college);
                            
                            if(mysqli_num_rows($collegeval)>0)
                            {
                                echo " <option value='All'>All</option>";
                                foreach($collegeval as $collegepart)
                                {
                                    $collegepart = $collegepart['SchoolYear'];
                                    echo " <option value='$collegepart'>$collegepart</option>";
                                }
                                
                                
                            } 
                        ?> 
                    </select>  
                        
                </div>
                <div class="input-group rounded" style="float:right; padding:5px;">
                    <input type="search" class="form-control rounded" placeholder="Research Name" aria-label="Search"aria-describedby="search-addon" />
                </div>
                <div class="tableAll">
                    <table class="table-main" style="display:block; height:400px; overflow: auto;">
                        <thead>
                            <tr style="position:sticky; top:0; background-color:white; border-color:red;">
                                <th>#</th>
                                <th scope="col">Research Name</th>
                                <th scope="col">Date Started</th>
                                <th scope="col">Target Date</th>
                                <th scope="col">Status</th>
                                <th scope="col">Supporting Documents</th>
                                </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $query = "SELECT * FROM researchongoing WHERE SubmissionId IN (SELECT SubmissionId FROM submission WHERE ValidationStatus = 'Accepted' AND UserId IN (SELECT UserId FROM user WHERE College='$usercollege'))";
                                $query_run = mysqli_query($con,$query);
                                $t = 1;
                                if(mysqli_num_rows($query_run)>0)
                                {
                                    while($row1 = mysqli_fetch_assoc($query_run)){

                                ?>
                            
                            <tr>
                                <th scope="row"><?php echo $t; ?></th>
                                <td><?php echo $row1['RoTitle'];?></td>
                                <td><?php echo $row1['RoDateStart'];?></td>
                                <td><?php echo $row1['RoDateTarget'];?></td>
                                <td><?php echo $row1['RoStatus'];?></td>
                                <?php $file = $row1['RoTempName']; $download = 'uploads/'.$file;?> 
                                <td><a href="<?php echo $download;?>" download><?php echo $row1['RoFilename'];?></a></td>
                            </tr>
                        <?php
                                    $t++;}
                                }
                        ?>
                            </tr>
                            <?php 
                                $query = "SELECT * FROM researchpresentation WHERE SubmissionId IN (SELECT SubmissionId FROM submission WHERE ValidationStatus = 'Accepted' AND UserId IN (SELECT UserId FROM user WHERE College='$usercollege'))";
                                $query_run = mysqli_query($con,$query);
                            
                                if(mysqli_num_rows($query_run)>0)
                                {
                                    while($row1 = mysqli_fetch_assoc($query_run)){

                                ?>
                            
                            <tr>
                                <th scope="row"><?php echo $t; ?></th>
                                <td><?php echo $row1['RpresTitle'];?></td>
                                <td><?php echo $row1['RpresDateStart'];?></td>
                                <td><?php echo $row1['RpresDateTarget'];?></td>
                                <td>Completed</td>
                                <?php $file = $row1['RpresTempName']; $download = 'uploads/'.$file;?> 
                                <td><a href="<?php echo $download;?>" download><?php echo $row1['RpresFilename'];?></a></td>
                            </tr>
                        <?php
                                    $t++;}
                                }
                        ?>
                            </tr>
                            <?php 
                                $query = "SELECT * FROM researchpublication WHERE SubmissionId IN (SELECT SubmissionId FROM submission WHERE ValidationStatus = 'Accepted' AND UserId IN (SELECT UserId FROM user WHERE College='$usercollege'))";
                                $query_run = mysqli_query($con,$query);
                                
                                if(mysqli_num_rows($query_run)>0)
                                {
                                    while($row1 = mysqli_fetch_assoc($query_run)){

                                ?>
                            
                            <tr>
                                <th scope="row"><?php echo $t; ?></th>
                                <td><?php echo $row1['RpTitle'];?></td>
                                <td><?php echo $row1['RpDateStart'];?></td>
                                <td><?php echo $row1['RpDateTarget'];?></td>
                                <td>Completed</td>
                                <?php $file = $row1['RpTempName']; $download = 'uploads/'.$file;?> 
                                <td><a href="<?php echo $download;?>" download><?php echo $row1['RpFilename'];?></a></td>
                            </tr>
                        <?php
                                    $t++;}
                                }
                        ?>
                            </tr>
                            <?php 
                                $query = "SELECT * FROM researchcitation WHERE SubmissionId IN (SELECT SubmissionId FROM submission WHERE ValidationStatus = 'Accepted' AND UserId IN (SELECT UserId FROM user WHERE College='$usercollege'))";
                                $query_run = mysqli_query($con,$query);
                                
                                if(mysqli_num_rows($query_run)>0)
                                {
                                    while($row1 = mysqli_fetch_assoc($query_run)){

                                ?>
                            
                            <tr>
                                <th scope="row"><?php echo $t; ?></th>
                                <td><?php echo $row1['RcTitle'];?></td>
                                <td><?php echo $row1['RcDateStart'];?></td>
                                <td><?php echo $row1['RcDateTarget'];?></td>
                                <td>Completed</td>
                                <?php $file = $row1['RcTempName']; $download = 'uploads/'.$file;?> 
                                <td><a href="<?php echo $download;?>" download><?php echo $row1['RcFilename'];?></a></td>
                            </tr>
                        <?php
                                    $t++;}
                                }
                        ?>
                            </tr>
                            <?php 
                                $query = "SELECT * FROM researchutilization WHERE SubmissionId IN (SELECT SubmissionId FROM submission WHERE ValidationStatus = 'Accepted' AND UserId IN (SELECT UserId FROM user WHERE College='$usercollege'))";
                                $query_run = mysqli_query($con,$query);
                                
                                if(mysqli_num_rows($query_run)>0)
                                {
                                    while($row1 = mysqli_fetch_assoc($query_run)){

                                ?>
                            
                            <tr>
                                <th scope="row"><?php echo $t; ?></th>
                                <td><?php echo $row1['RuTitle'];?></td>
                                <td><?php echo $row1['RuDateStart'];?></td>
                                <td><?php echo $row1['RuDateTarget'];?></td>
                                <td>Completed</td>
                                <?php $file = $row1['RuTempName']; $download = 'uploads/'.$file;?> 
                                <td><a href="<?php echo $download;?>" download><?php echo $row1['RuFilename'];?></a></td>
                            </tr>
                        <?php
                                    $t++;}
                                }
                        ?>
                            
                            </tr>
                            <?php 
                                $query = "SELECT * FROM copyrightedoutput WHERE SubmissionId IN (SELECT SubmissionId FROM submission WHERE ValidationStatus = 'Accepted' AND UserId IN (SELECT UserId FROM user WHERE College='$usercollege'))";
                                $query_run = mysqli_query($con,$query);
                                
                                if(mysqli_num_rows($query_run)>0)
                                {
                                    while($row1 = mysqli_fetch_assoc($query_run)){

                                ?>
                            
                            <tr>
                                <th scope="row"><?php echo $t; ?></th>
                                <td><?php echo $row1['CoTitle'];?></td>
                                <td><?php echo $row1['CoDateStart'];?></td>
                                <td><?php echo $row1['CoDateTarget'];?></td>
                                <td>Completed</td>
                                <?php $file = $row1['CoTempName']; $download = 'uploads/'.$file;?> 
                                <td><a href="<?php echo $download;?>" download><?php echo $row1['CoFilename'];?></a></td>
                            </tr>
                        <?php
                                    $t++;}
                                }
                        ?>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <button id="viewallResearch" class="btn btn-primarys viewallResearch" style="padding: 10px; font-size: 16px;">View Research Titles</button>
                <div id ="dataModalAll" class="modal fade" style="background-color: rgba(0,0,0,0.3); height:100%; Width:100%">
                    <div class="modal-dialog "style="width:100%; max-width:1600; height:100%; margin:0 auto;margin-top:50px;">
                        <div class="modal-content" style="width:100%; max-width:1500px; margin:0 auto; padding:40px; margin-top:30px; top:0;left0; bottom:0; height:900px; ">
                            <div class="modal-header" style="margin-top:100px;">                            
                                <h4 class="modal-title">Quarterly Accomplishment Report</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body" id="research_detailAll" style="overflow-x:auto;bottom:0; top:0;">

                            </div>
                            <div class="modal-footer">
                                <form action="exportAllResearch.php" class="mr-auto" method="POST">
                                    <input name="thislevel" id="thislevel" type="hidden">   
                                    <input name="col" id="col" type="hidden">
                                    <input name= "thisyear" id="thisyear" type="hidden">
                                    <button id="printresearchbtn" name="export_excel" class="btn btn-primarys mr-auto" style="paddin:15px; font-size: 16px; ">Print Research Titles</button>
                                </form>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="div_all">
                    <h2 align="center">PUP Research Titles Data</h2>
                    <div id = "chart_all"></div>
                    <div id="legend" class="bars-legend"></div>
                </div>
                <button id="save_all" class="btn btn-primarys">Download Chart</button>
                
                    <div id="legend" class="bars-legend"></div>
            </div>
 
            <div id="Ongoing" class="Contents tab2" style="display:none;">
                <div class="input-group rounded" style="margin-bottom:20px; ">

                    <label class="labeler" for="Status" style="margin-left:60px;">Sort By Year:</label>
                    
                    <select class="form-controler" name="yearvalOngoing" id="yearvalOngoing">
                        <?php

                            $college = "SELECT SchoolYear FROM schoolyear ORDER BY YearId DESC";
                            $collegeval = mysqli_query($con,$college);
                            
                            if(mysqli_num_rows($collegeval)>0)
                            {
                                echo " <option value='All'>All</option>";
                                foreach($collegeval as $collegepart)
                                {
                                    $collegepart = $collegepart['SchoolYear'];
                                    echo " <option value='$collegepart'>$collegepart</option>";
                                }
                                
                                
                            } 
                        ?> 
                    </select> 
                     
                </div>
                <div class="input-group rounded" style="float:right; padding:5px;">
                    <input type="search" class="form-control rounded" placeholder="Research Name" aria-label="Search"aria-describedby="search-addon" />
                </div>
                <div class="tableOngoing">
                    <table class="table-main" style="display:block; height:400px; overflow: auto;">
                        <thead>
                            <tr style="position:sticky; top:0; background-color:white; border-color:red;">
                                <th scope="col">#</th>
                                <th scope="col">Research Name</th>
                                <th scope="col">Date Started</th>
                                <th scope="col">Target Date</th>
                                <th scope="col">Research Status</th>
                                <th scope="col">Supporting Documents</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $query = "SELECT * FROM researchongoing WHERE RoStatus='Ongoing' AND SubmissionId IN (SELECT SubmissionId FROM submission WHERE ValidationStatus = 'Accepted' AND UserId IN (SELECT UserId FROM user WHERE College='$usercollege'))";
                                $query_run = mysqli_query($con,$query);
                                $t = 1;
                                if(mysqli_num_rows($query_run)>0)
                                {
                                    while($row1 = mysqli_fetch_assoc($query_run)){

                                ?>
                            
                            <tr>
                                <th scope="row"><?php echo $t; ?></th>
                                <td><?php echo $row1['RoTitle'];?></td>
                                <td><?php echo $row1['RoDateStart'];?></td>
                                <td><?php echo $row1['RoDateTarget'];?></td>
                                <td><?php echo $row1['RoStatus'];?></td>
                                <?php $file = $row1['RoTempName']; $download = 'uploads/'.$file;?> 
                                <td><a href="<?php echo $download;?>" download><?php echo $row1['RoFilename'];?></a></td>
                            </tr>
                        <?php
                                    $t++;}
                                }
                        ?>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <button id="viewOngoingResearch" class="btn btn-primarys viewOngoingResearch" style="padding: 10px; font-size: 16px;">View Research Titles</button>
                <div id ="dataModalOngoing" class="modal fade" style="background-color: rgba(0,0,0,0.3); height:100%; Width:100%">
                    <div class="modal-dialog "style="width:100%; max-width:1600; height:100%; margin:0 auto;margin-top:50px;">
                        <div class="modal-content" style="width:100%; max-width:1500px; margin:0 auto; padding:40px; margin-top:30px; top:0;left0; bottom:0; height:900px; ">
                            <div class="modal-header" style="margin-top:100px;">                            
                                <h4 class="modal-title">Quarterly Accomplishment Report</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body" id="research_detailOngoing" style="overflow-x:auto;bottom:0; top:0;">

                            </div>
                            <div class="modal-footer">
                                <form action="exportOngoingResearch.php" class="mr-auto" method="POST">
                                    <input name="col2" id="col2" type="hidden">
                                    <input name= "thisyear2" id="thisyear2" type="hidden">
                                    <button id="printresearchbtn" name="export_excel" class="btn btn-primarys mr-auto" style="paddin:15px; font-size: 16px; ">Print QAR Submissions</button>
                                </form>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="div_ongoing">
                    <h2 align="center">PUP Ongoing Research Titles Data</h2>
                    <div id = "chart_ongoing"></div>
                    <div id="legendongoing" class="bars-legend"></div>
                </div>
                <button id="save_ongoing" class="btn btn-primarys">Download Chart</button>
            </div>
            <div id="Completed" class="Contents tab2" style="display:none;">
                <div class="input-group rounded"style="margin-bottom:20px; ">
                    <label class="labeler" for="Status" style="margin-left:60px;">Sort By Year:</label>
                    
                    <select class="form-controler" name="yearvalCompleted" id="yearvalCompleted">
                        <?php

                            $college = "SELECT SchoolYear FROM schoolyear ORDER BY YearId DESC";
                            $collegeval = mysqli_query($con,$college);
                            
                            if(mysqli_num_rows($collegeval)>0)
                            {
                                echo " <option value='All'>All</option>";
                                foreach($collegeval as $collegepart)
                                {
                                    $collegepart = $collegepart['SchoolYear'];
                                    echo " <option value='$collegepart'>$collegepart</option>";
                                }
                                
                                
                            } 
                        ?> 
                    </select> 
                </div>
                <div class="input-group rounded" style="float:right; padding:5px;">
                    <input type="search" class="form-control rounded" placeholder="Research Name" aria-label="Search"aria-describedby="search-addon" />
                </div>
                <div class="tableCompleted">
                    <table class="table-main" style="display:block; height:400px; overflow: auto;">
                        <thead>
                            <tr style="position:sticky; top:0; background-color:white; border-color:red;">
                                <th scope="col">#</th>
                                <th scope="col">Research Name</th>
                                <th scope="col">Date Started</th>
                                <th scope="col">Target Date</th>
                                <th scope="col">Date Completed</th>
                                <th scope="col">Supporting Documents</th>
                                </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $query = "SELECT * FROM researchongoing WHERE RoStatus = 'Completed' AND SubmissionId IN (SELECT SubmissionId FROM submission WHERE ValidationStatus = 'Accepted' AND UserId IN (SELECT UserId FROM user WHERE College='$usercollege'))";
                                $query_run = mysqli_query($con,$query);
                                $t = 1;
                                if(mysqli_num_rows($query_run)>0)
                                {
                                    while($row1 = mysqli_fetch_assoc($query_run)){

                                ?>
                            
                            <tr>
                                <th scope="row"><?php echo $t; ?></th>
                                <td><?php echo $row1['RoTitle'];?></td>
                                <td><?php echo $row1['RoDateStart'];?></td>
                                <td><?php echo $row1['RoDateTarget'];?></td>
                                <td><?php echo $row1['RoDateCompleted'];?></td>
                                <?php $file = $row1['RoTempName']; $download = 'uploads/'.$file;?> 
                                <td><a href="<?php echo $download;?>" download><?php echo $row1['RoFilename'];?></a></td>
                            </tr>
                        <?php
                                    $t++;}
                                }
                        ?>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <button id="viewCompletedResearch" class="btn btn-primarys viewCompletedResearch" style="padding: 10px; font-size: 16px;">View Research Titles</button>
                <div id ="dataModalCompleted" class="modal fade" style="background-color: rgba(0,0,0,0.3); height:100%; Width:100%">
                    <div class="modal-dialog "style="width:100%; max-width:1600; height:100%; margin:0 auto;margin-top:50px;">
                        <div class="modal-content" style="width:100%; max-width:1500px; margin:0 auto; padding:40px; margin-top:30px; top:0;left0; bottom:0; height:900px; ">
                            <div class="modal-header" style="margin-top:100px;">                            
                                <h4 class="modal-title">Quarterly Accomplishment Report</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body" id="research_detailCompleted" style="overflow-x:auto;bottom:0; top:0;">

                            </div>
                            <div class="modal-footer">
                                <form action="exportCompletedResearch.php" class="mr-auto" method="POST">
                                    <input name="col3" id="col3" type="hidden">
                                    <input name= "thisyear3" id="thisyear3" type="hidden">
                                    <button id="printresearchbtn" name="export_excel" class="btn btn-primarys mr-auto" style="paddin:15px; font-size: 16px; ">Print QAR Submissions</button>
                                </form>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="div_completed">
                    <h2 align="center">PUP Completed Research Titles Data</h2>
                    <div id = "chart_completed"></div>
                    <div id="legendcompleted" class="bars-legend"></div>
                </div>
                <button id="save" class="btn btn-primarys">Download Chart</button>
            </div>
            <div id="Unfinished" class="Contents tab2" style="display:none;">
                <div class="input-group rounded"style="margin-bottom:20px; ">
                    <label class="labeler" for="Status" style="margin-left:60px;">Sort By Year:</label>
                    
                    <select class="form-controler" name="yearvalUnfinished" id="yearvalUnfinished">
                        <?php

                            $college = "SELECT SchoolYear FROM schoolyear ORDER BY YearId DESC";
                            $collegeval = mysqli_query($con,$college);
                            
                            if(mysqli_num_rows($collegeval)>0)
                            {
                                echo " <option value='All'>All</option>";
                                foreach($collegeval as $collegepart)
                                {
                                    $collegepart = $collegepart['SchoolYear'];
                                    echo " <option value='$collegepart'>$collegepart</option>";
                                }
                                
                                
                            } 
                        ?> 
                    </select> 
                </div>
                <div class="input-group rounded" style="float:right; padding:5px;">
                    <input type="search" class="form-control rounded" placeholder="Research Name" aria-label="Search"aria-describedby="search-addon" />
                </div>
                <div class="tableUnfinished">
                    <table class="table-main" style="display:block; height:400px; overflow: auto;">
                        <thead>
                            <tr style="position:sticky; top:0; background-color:white; border-color:red;">
                                <th scope="col">#</th>
                                <th scope="col">Research Name</th>
                                <th scope="col">Date Started</th>
                                <th scope="col">Target Date</th>
                                <th scope="col">Supporting Documents</th>
                                
                                </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $query = "SELECT * FROM researchongoing WHERE RoStatus = 'Deferred' AND SubmissionId IN (SELECT SubmissionId FROM submission WHERE ValidationStatus = 'Accepted' AND UserId IN (SELECT UserId FROM user WHERE College='$usercollege'))";
                                $query_run = mysqli_query($con,$query);
                                $t = 1;
                                if(mysqli_num_rows($query_run)>0)
                                {
                                    while($row1 = mysqli_fetch_assoc($query_run)){

                                ?>
                            
                            <tr>
                                <th scope="row"><?php echo $t; ?></th>
                                <td><?php echo $row1['RoTitle'];?></td>
                                <td><?php echo $row1['RoDateStart'];?></td>
                                <td><?php echo $row1['RoDateTarget'];?></td>
                                <?php $file = $row1['RoTempName']; $download = 'uploads/'.$file;?> 
                                <td><a href="<?php echo $download;?>" download><?php echo $row1['RoFilename'];?></a></td>
                            </tr>
                        <?php
                                    $t++;}
                                }
                        ?>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <button id="viewUnfinishedResearch" class="btn btn-primarys viewUnfinishedResearch" style="padding: 10px; font-size: 16px;">View Research Titles</button>
                <div id ="dataModalUnfinished" class="modal fade" style="background-color: rgba(0,0,0,0.3); height:100%; Width:100%">
                    <div class="modal-dialog "style="width:100%; max-width:1600; height:100%; margin:0 auto;margin-top:50px;">
                        <div class="modal-content" style="width:100%; max-width:1500px; margin:0 auto; padding:40px; margin-top:30px; top:0;left0; bottom:0; height:900px; ">
                            <div class="modal-header" style="margin-top:100px;">                            
                                <h4 class="modal-title">Quarterly Accomplishment Report</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body" id="research_detailUnfinished" style="overflow-x:auto;bottom:0; top:0;">

                            </div>
                            <div class="modal-footer">
                                <form action="exportUnfinishedResearch.php" class="mr-auto" method="POST">
                                    <input name="col4" id="col4" type="hidden">
                                    <input name= "thisyear4" id="thisyear4" type="hidden">
                                    <button id="printresearchbtn" name="export_excel" class="btn btn-primarys mr-auto" style="paddin:15px; font-size: 16px; ">Print QAR Submissions</button>
                                </form>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="div_deferred">
                    <h2 align="center">PUP Unfinished Research Titles Data</h2>
                    <div id = "chart_deferred"></div>
                    <div id="legenddeferred" class="bars-legend"></div>
                </div>
                <button id="save_deferred" class="btn btn-primarys">Download Chart</button>
            </div>
            <div id="Publication" class="Contents tab2" style="display:none;">
                <div class="input-group rounded"style="margin-bottom:20px; "> 
                    <label class="labeler" for="Status" style="margin-left:60px;">Sort By Year:</label>
                    
                    <select class="form-controler" name="yearvalPublication" id="yearvalPublication">
                        <?php

                            $college = "SELECT SchoolYear FROM schoolyear ORDER BY YearId DESC";
                            $collegeval = mysqli_query($con,$college);
                            
                            if(mysqli_num_rows($collegeval)>0)
                            {
                                echo " <option value='All'>All</option>";
                                foreach($collegeval as $collegepart)
                                {
                                    $collegepart = $collegepart['SchoolYear'];
                                    echo " <option value='$collegepart'>$collegepart</option>";
                                }
                                
                                
                            } 
                        ?> 
                    </select> 

                    <label class="labeler" for="Status" style="margin-left:60px;">Sort By Level:</label>
                    
                        <select class="form-controler" name="levelvalPublication" id="levelvalPublication">
                            <option value="All">All</option>
                            <option value="International" >International</option>
                            <option value="National">National</option>
                            <option value="Regional">Regional</option>
                            <option value="Provincial/City/Municipal">Provincial/City/Municipal</option>   
                            <option value="Local-PUP">Local-PUP</option> 
                        </select> 
                </div>
                <div class="input-group rounded" style="float:right; padding:5px;">
                    <input type="search" class="form-control rounded" placeholder="Research Name" aria-label="Search"aria-describedby="search-addon" />
                </div>
                <div class="tablePublished">
                    <table class="table-main" style="display:block; height:400px; overflow: auto;">
                        <thead>
                            <tr style="position:sticky; top:0; background-color:white; border-color:red;">
                                <th scope="col">#</th>
                                <th scope="col">Research Name</th>
                                <th scope="col">Date Started</th>
                                <th scope="col">Target Date</th>
                                <th scope="col">Date of Publication</th>
                                <th scope="col">Supporting Documents</th>
                                </tr>
                        </thead>
                        <tbody>
                            </tr>
                                <?php 
                                    $query = "SELECT * FROM researchpublication WHERE SubmissionId IN (SELECT SubmissionId FROM submission WHERE ValidationStatus = 'Accepted' AND UserId IN (SELECT UserId FROM user WHERE College='$usercollege'))";
                                    $query_run = mysqli_query($con,$query);
                                    $t=1;
                                    if(mysqli_num_rows($query_run)>0)
                                    {
                                        while($row1 = mysqli_fetch_assoc($query_run)){

                                    ?>
                                
                                <tr>
                                    <th scope="row"><?php echo $t; ?></th>
                                    <td><?php echo $row1['RpTitle'];?></td>
                                    <td><?php echo $row1['RpDateStart'];?></td>
                                    <td><?php echo $row1['RpDateTarget'];?></td>
                                    <td><?php echo $row1['RpDatePublished'];?></td>
                                    
                                    <?php $file = $row1['RpTempName']; $download = 'uploads/'.$file;?> 
                                    <td><a href="<?php echo $download;?>" download><?php echo $row1['RpFilename'];?></a></td>
                                </tr>
                            <?php
                                        $t++;}
                                    }
                            ?>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <button id="viewPublicationResearch" class="btn btn-primarys viewPublicationResearch" style="padding: 10px; font-size: 16px;">View Research Titles</button>
                <div id ="dataModalPublication" class="modal fade" style="background-color: rgba(0,0,0,0.3); height:100%; Width:100%">
                    <div class="modal-dialog "style="width:100%; max-width:1600; height:100%; margin:0 auto;margin-top:50px;">
                        <div class="modal-content" style="width:100%; max-width:1500px; margin:0 auto; padding:40px; margin-top:30px; top:0;left0; bottom:0; height:900px; ">
                            <div class="modal-header" style="margin-top:100px;">                            
                                <h4 class="modal-title">Quarterly Accomplishment Report</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body" id="research_detailPublication" style="overflow-x:auto;bottom:0; top:0;">

                            </div>
                            <div class="modal-footer">
                                <form action="exportPublication.php" class="mr-auto" method="POST">
                                    <input name="level5" id="level5" type="hidden">   
                                    <input name="col5" id="col5" type="hidden">
                                    <input name= "thisyear5" id="thisyear5" type="hidden">
                                    <button id="printresearchbtn" name="export_excel" class="btn btn-primarys mr-auto" style="paddin:15px; font-size: 16px; ">Print QAR Submissions</button>
                                </form>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="div_publication">
                    <h2 align="center">PUP Research Publication Titles Data</h2>
                    <div id ="chart_publication"></div>
                    <div id="legendpublication" class="bars-legend"></div>
                </div>
                <button id="save_publication" class="btn btn-primarys">Download Chart</button>
            </div>
            <div id="Presentation" class="Contents tab2" style="display:none;">
                <div class="input-group rounded"style="margin-bottom:20px; ">
                    <label class="labeler" for="Status" style="margin-left:60px;">Sort By Year:</label>
                    
                    <select class="form-controler" name="yearvalPresentation" id="yearvalPresentation">
                        <?php

                            $college = "SELECT SchoolYear FROM schoolyear ORDER BY YearId DESC";
                            $collegeval = mysqli_query($con,$college);
                            
                            if(mysqli_num_rows($collegeval)>0)
                            {
                                echo " <option value='All'>All</option>";
                                foreach($collegeval as $collegepart)
                                {
                                    $collegepart = $collegepart['SchoolYear'];
                                    echo " <option value='$collegepart'>$collegepart</option>";
                                }
                                
                                
                            } 
                        ?> 
                    </select> 

                    <label class="labeler" for="Status" style="margin-left:60px;">Sort By Level:</label>
                    
                        <select class="form-controler" name="levelvalPresentation" id="levelvalPresentation">
                            <option value="All">All</option>
                            <option value="International" >International</option>
                            <option value="National">National</option>
                            <option value="Regional">Regional</option>
                            <option value="Provincial/City/Municipal">Provincial/City/Municipal</option>   
                            <option value="Local-PUP">Local-PUP</option> 
                        </select> 
                </div>
                <div class="input-group rounded" style="float:right; padding:5px;">
                    <input type="search" class="form-control rounded" placeholder="Research Name" aria-label="Search"aria-describedby="search-addon" />
                </div>
                <div class="tablePresentation">
                    <table class="table-main" style="display:block; height:400px; overflow: auto;">
                        <thead>
                            <tr style="position:sticky; top:0; background-color:white; border-color:red;">
                                <th scope="col">#</th>
                                <th scope="col">Research Name</th>
                                <th scope="col">Date Started</th>
                                <th scope="col">Target Date</th>
                                <th scope="col">Date Presented</th>
                                <th scope="col">Supporting Documents</th>
                                </tr>
                        </thead>
                        <tbody>
                            </tr>
                                <?php 
                                    $query = "SELECT * FROM researchpresentation WHERE SubmissionId IN (SELECT SubmissionId FROM submission WHERE ValidationStatus = 'Accepted' AND UserId IN (SELECT UserId FROM user WHERE College='$usercollege'))";
                                    $query_run = mysqli_query($con,$query);
                                    $t=1;
                                    if(mysqli_num_rows($query_run)>0)
                                    {
                                        while($row1 = mysqli_fetch_assoc($query_run)){

                                    ?>
                                
                                <tr>
                                    <th scope="row"><?php echo $t; ?></th>
                                    <td><?php echo $row1['RpresTitle'];?></td>
                                    <td><?php echo $row1['RpresDateStart'];?></td>
                                    <td><?php echo $row1['RpresDateTarget'];?></td>
                                    <td><?php echo $row1['RpresDatePresent'];?></td>
                                    
                                    <?php $file = $row1['RpresTempName']; $download = 'uploads/'.$file;?> 
                                    <td><a href="<?php echo $download;?>" download><?php echo $row1['RpresFilename'];?></a></td>
                                </tr>
                            <?php
                                        $t++;}
                                    }
                            ?>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <button id="viewPresentationResearch" class="btn btn-primarys viewPresentationResearch" style="padding: 10px; font-size: 16px;">View Research Titles</button>
                <div id ="dataModalPresentation" class="modal fade" style="background-color: rgba(0,0,0,0.3); height:100%; Width:100%">
                    <div class="modal-dialog "style="width:100%; max-width:1600; height:100%; margin:0 auto;margin-top:50px;">
                        <div class="modal-content" style="width:100%; max-width:1500px; margin:0 auto; padding:40px; margin-top:30px; top:0;left0; bottom:0; height:900px; ">
                            <div class="modal-header" style="margin-top:100px;">                            
                                <h4 class="modal-title">Quarterly Accomplishment Report</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body" id="research_detailPresentation" style="overflow-x:auto;bottom:0; top:0;">

                            </div>
                            <div class="modal-footer">
                                <form action="exportPresentation.php" class="mr-auto" method="POST">
                                    <input name="level6" id="level6" type="hidden">   
                                    <input name="col6" id="col6" type="hidden">
                                    <input name= "thisyear6" id="thisyear6" type="hidden">
                                    <button id="printresearchbtn" name="export_excel" class="btn btn-primarys mr-auto" style="paddin:15px; font-size: 16px; ">Print QAR Submissions</button>
                                </form>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="div_presentation">
                    <h2 align="center">PUP Research Presentation Titles Data</h2>
                    <div id ="chart_presentation"></div>
                    <div id="legendpresentation" class="bars-legend"></div>
                </div>
                <button id="save_presentation" class="btn btn-primarys">Download Chart</button>
            </div>
            <div id="Citation" class="Contents tab2" style="display:none;">
                <div class="input-group rounded"style="margin-bottom:20px; ">
                    <label class="labeler" for="Status" style="margin-left:60px;">Sort By Year:</label>
                    
                    <select class="form-controler" name="yearvalCitation" id="yearvalCitation">
                        <?php

                            $college = "SELECT SchoolYear FROM schoolyear ORDER BY YearId DESC";
                            $collegeval = mysqli_query($con,$college);
                            
                            if(mysqli_num_rows($collegeval)>0)
                            {
                                echo " <option value='All'>All</option>";
                                foreach($collegeval as $collegepart)
                                {
                                    $collegepart = $collegepart['SchoolYear'];
                                    echo " <option value='$collegepart'>$collegepart</option>";
                                }
                                
                                
                            } 
                        ?> 
                    </select> 
                    <label class="labeler" for="Status" style="margin-left:60px;">Indexing Platform:</label>
                    
                    <select class="form-controler" name="indexing" id="indexing">
                        <option value="All">All</option>
                        <option value="Scopus" >Scopus</option>
                        <option value="Web of Science">Web of Science</option>
                        <option value="OASUC Accredited Journals">OASUC Accredited Journals</option>
                        <option value="CHED Recognized Journals">CHED Recognized Journals</option>   
                        <option value="International Refereed Journals">International Refereed Journals</option> 
                        <option value="Exellence in Research for Australia">Exellence in Research for Australia</option>  
                        <option value="ASEAN Citation Index">ASEAN Citation Index</option>
                    </select> 
                </div>
                <div class="input-group rounded" style="float:right; padding:5px;">
                    <input type="search" class="form-control rounded" placeholder="Research Name" aria-label="Search"aria-describedby="search-addon" />
                </div>
                <div class="tableCitation">
                    <table class="table-main" style="display:block; height:400px; overflow: auto;">
                        <thead>
                            <tr style="position:sticky; top:0; background-color:white; border-color:red;">
                                <th scope="col">#</th>
                                <th scope="col">Research Name</th>
                                <th scope="col">Date Started</th>
                                <th scope="col">Target Date</th>
                                <th scope="col">Date Completed</th>
                                <th scope="col">Date Completed</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                                $query = "SELECT * FROM researchcitation WHERE SubmissionId IN (SELECT SubmissionId FROM submission WHERE ValidationStatus = 'Accepted' AND UserId IN (SELECT UserId FROM user WHERE College='$usercollege'))";
                                $query_run = mysqli_query($con,$query);
                                $t=1;
                                if(mysqli_num_rows($query_run)>0)
                                {
                                    while($row1 = mysqli_fetch_assoc($query_run)){

                                ?>
                            
                            <tr>
                                <th scope="row"><?php echo $t; ?></th>
                                <td><?php echo $row1['RcTitle'];?></td>
                                <td><?php echo $row1['RcDateStart'];?></td>
                                <td><?php echo $row1['RcDateTarget'];?></td>
                                <td><?php echo $row1['RcDateCompleted'];?></td>
                                <?php $file = $row1['RcTempName']; $download = 'uploads/'.$file;?> 
                                <td><a href="<?php echo $download;?>" download><?php echo $row1['RcFilename'];?></a></td>
                            </tr>
                        <?php
                                    $t++;}
                                }
                        ?>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <button id="viewCitationResearch" class="btn btn-primarys viewCitationResearch" style="padding: 10px; font-size: 16px;">View Research Titles</button>
                <div id ="dataModalCitation" class="modal fade" style="background-color: rgba(0,0,0,0.3); height:100%; Width:100%">
                    <div class="modal-dialog "style="width:100%; max-width:1600; height:100%; margin:0 auto;margin-top:50px;">
                        <div class="modal-content" style="width:100%; max-width:1500px; margin:0 auto; padding:40px; margin-top:30px; top:0;left0; bottom:0; height:900px; ">
                            <div class="modal-header" style="margin-top:100px;">                            
                                <h4 class="modal-title">Quarterly Accomplishment Report</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body" id="research_detailCitation" style="overflow-x:auto;bottom:0; top:0;">

                            </div>
                            <div class="modal-footer">
                                <form action="exportCitation.php" class="mr-auto" method="POST">
                                    <input name="col7" id="col7" type="hidden">
                                    <input name="indexing7" id="indexing7" type="hidden">
                                    <input name= "thisyear7" id="thisyear7" type="hidden">
                                    <button id="printresearchbtn" name="export_excel" class="btn btn-primarys mr-auto" style="paddin:15px; font-size: 16px; ">Print QAR Submissions</button>
                                </form>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="div_citation">
                    <h2 align="center">PUP Research Presentation Titles Data</h2>
                    <div id ="chart_citation"></div>
                    <div id="legendcitation" class="bars-legend"></div>
                </div>
                <button id="save_citation" class="btn btn-primarys">Download Chart</button>
            </div>
            <div id="Utilization" class="Contents tab2" style="display:none;">
                <div class="input-group rounded"style="margin-bottom:20px; ">
                    <label class="labeler" for="Status" style="margin-left:60px;">Sort By Level:</label>
                            
                        <select class="form-controler" name="levelvalUtilization" id="levelvalUtilization">
                            <option value="All">All</option>
                            <option value="International" >International</option>
                            <option value="National">National</option>
                            <option value="Regional">Regional</option>
                            <option value="Provincial/City/Municipal">Provincial/City/Municipal</option>   
                            <option value="Local-PUP">Local-PUP</option> 
                        </select> 
                        <label class="labeler" for="Status" style="margin-left:60px;">Sort By Year:</label>
                    
                    <select class="form-controler" name="yearvalUtilization" id="yearvalUtilization">
                        <?php

                            $college = "SELECT SchoolYear FROM schoolyear ORDER BY YearId DESC";
                            $collegeval = mysqli_query($con,$college);
                            
                            if(mysqli_num_rows($collegeval)>0)
                            {
                                echo " <option value='All'>All</option>";
                                foreach($collegeval as $collegepart)
                                {
                                    $collegepart = $collegepart['SchoolYear'];
                                    echo " <option value='$collegepart'>$collegepart</option>";
                                }
                                
                                
                            } 
                        ?> 
                    </select> 
                </div>
 
                <div class="input-group rounded" style="float:right; padding:5px;">
                    <input type="search" class="form-control rounded" placeholder="Research Name" aria-label="Search"aria-describedby="search-addon" />
                </div>
                <div class="tableUtilization">
                    <table class="table-main" style="display:block; height:400px; overflow: auto;">
                        <thead>
                            <tr style="position:sticky; top:0; background-color:white; border-color:red;">
                                <th scope="col">#</th>
                                <th scope="col">Research Name</th>
                                <th scope="col">Date Started</th>
                                <th scope="col">Target Date</th>
                                <th scope="col">Agency/Organization that utilized the research output</th>
                                <th scope="col">Supporting Documents</th>
                                </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $query = "SELECT * FROM researchutilization WHERE SubmissionId IN (SELECT SubmissionId FROM submission WHERE ValidationStatus = 'Accepted' AND UserId IN (SELECT UserId FROM user WHERE College='$usercollege'))";
                                $query_run = mysqli_query($con,$query);
                                $t=1;
                                if(mysqli_num_rows($query_run)>0)
                                {
                                    while($row1 = mysqli_fetch_assoc($query_run)){

                                ?>
                            
                            <tr>
                                <th scope="row"><?php echo $t; ?></th>
                                <td><?php echo $row1['RuTitle'];?></td>
                                <td><?php echo $row1['RuDateStart'];?></td>
                                <td><?php echo $row1['RuDateTarget'];?></td>
                                <td><?php echo $row1['RuAgency'];?></td>
                                <?php $file = $row1['RuTempName']; $download = 'uploads/'.$file;?> 
                                <td><a href="<?php echo $download;?>" download><?php echo $row1['RuFilename'];?></a></td>
                            </tr>
                        <?php
                                    $t++;}
                                }
                        ?>
                            
                            </tr>
                        </tbody>
                    </table>
                </div>
                <button id="viewUtilizationResearch" class="btn btn-primarys viewUtilizationResearch" style="padding: 10px; font-size: 16px;">View Research Titles</button>
                <div id ="dataModalUtilization" class="modal fade" style="background-color: rgba(0,0,0,0.3); height:100%; Width:100%">
                    <div class="modal-dialog "style="width:100%; max-width:1600; height:100%; margin:0 auto;margin-top:50px;">
                        <div class="modal-content" style="width:100%; max-width:1500px; margin:0 auto; padding:40px; margin-top:30px; top:0;left0; bottom:0; height:900px; ">
                            <div class="modal-header" style="margin-top:100px;">                            
                                <h4 class="modal-title">Quarterly Accomplishment Report</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body" id="research_detailUtilization" style="overflow-x:auto;bottom:0; top:0;">

                            </div>
                            <div class="modal-footer">
                                <form action="exportUtilization.php" class="mr-auto" method="POST">
                                    <input name="level8" id="level8" type="hidden">   
                                    <input name="col8" id="col8" type="hidden">
                                    <input name= "thisyear8" id="thisyear8" type="hidden">
                                    <button id="printresearchbtn" name="export_excel" class="btn btn-primarys mr-auto" style="paddin:15px; font-size: 16px; ">Print QAR Submissions</button>
                                </form>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="div_utilization">
                    <h2 align="center">PUP Research Presentation Titles Data</h2>
                    <div id ="chart_utilization"></div>
                    <div id="legendutilization" class="bars-legend"></div>
                </div>
                <button id="save_utilization" class="btn btn-primarys">Download Chart</button>
            </div>
            <div id="Copyright" class="Contents tab2" style="display:none;">
                <div class="input-group rounded"style="margin-bottom:20px; "> 
                    <label class="labeler" for="Status" style="margin-left:60px;">Sort By Level:</label>
                        
                        <select class="form-controler" name="levelvalCopyright" id="levelvalCopyright">
                            <option value="All">All</option>
                            <option value="International" >International</option>
                            <option value="National">National</option>
                            <option value="Regional">Regional</option>
                            <option value="Provincial/City/Municipal">Provincial/City/Municipal</option>   
                            <option value="Local-PUP">Local-PUP</option> 
                        </select> 
                        <label class="labeler" for="Status" style="margin-left:60px;">Sort By Year:</label>
                    
                    <select class="form-controler" name="yearvalCopyright" id="yearvalCopyright">
                        <?php

                            $college = "SELECT SchoolYear FROM schoolyear ORDER BY YearId DESC";
                            $collegeval = mysqli_query($con,$college);
                            
                            if(mysqli_num_rows($collegeval)>0)
                            {
                                echo " <option value='All'>All</option>";
                                foreach($collegeval as $collegepart)
                                {
                                    $collegepart = $collegepart['SchoolYear'];
                                    echo " <option value='$collegepart'>$collegepart</option>";
                                }
                                
                                
                            } 
                        ?> 
                    </select> 
                </div>
                <div class="input-group rounded" style="float:right; padding:5px;">
                    <input type="search" class="form-control rounded" placeholder="Research Name" aria-label="Search"aria-describedby="search-addon" />
                </div>
                <div class="tableCopyright">
                    <table class="table-main" style="display:block; height:400px; overflow: auto;">
                        <thead>
                            <tr style="position:sticky; top:0; background-color:white; border-color:red;">
                                <th scope="col">#</th>
                                <th scope="col">Research Name</th>
                                <th scope="col">Date Started</th>
                                <th scope="col">Target Date</th>
                                <th scope="col">Year the research is copyrighted</th>
                                <th scope="col">Supporting Documents</th>
                                </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $t = 1;
                                $query = "SELECT * FROM copyrightedoutput WHERE SubmissionId IN (SELECT SubmissionId FROM submission WHERE ValidationStatus = 'Accepted' AND UserId IN (SELECT UserId FROM user WHERE College='$usercollege'))";
                                $query_run = mysqli_query($con,$query);
                                
                                if(mysqli_num_rows($query_run)>0)
                                {
                                    while($row1 = mysqli_fetch_assoc($query_run)){

                                ?>
                            
                            <tr>
                                <th scope="row"><?php echo $t; ?></th>
                                <td><?php echo $row1['CoTitle'];?></td>
                                <td><?php echo $row1['CoDateStart'];?></td>
                                <td><?php echo $row1['CoDateTarget'];?></td>
                                <td><?php echo $row1['CoCopyrightYear'];?></td>
                                <?php $file = $row1['CoTempName']; $download = 'uploads/'.$file;?> 
                                <td><a href="<?php echo $download;?>" download><?php echo $row1['CoFilename'];?></a></td>
                            </tr>
                        <?php
                                    $t++;}
                                }
                        ?>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <button id="viewCopyrightResearch" class="btn btn-primarys viewCopyrightResearch" style="padding: 10px; font-size: 16px;">View Research Titles</button>
                <div id ="dataModalCopyright" class="modal fade" style="background-color: rgba(0,0,0,0.3); height:100%; Width:100%">
                    <div class="modal-dialog "style="width:100%; max-width:1600; height:100%; margin:0 auto;margin-top:50px;">
                        <div class="modal-content" style="width:100%; max-width:1500px; margin:0 auto; padding:40px; margin-top:30px; top:0;left0; bottom:0; height:900px; ">
                            <div class="modal-header" style="margin-top:100px;">                            
                                <h4 class="modal-title">Quarterly Accomplishment Report</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body" id="research_detailCopyright" style="overflow-x:auto;bottom:0; top:0;">

                            </div>
                            <div class="modal-footer">
                                <form action="exportCopyright.php" class="mr-auto" method="POST">
                                    <input name="level9" id="level9" type="hidden">   
                                    <input name="col9" id="col9" type="hidden">
                                    <input name= "thisyear9" id="thisyear9" type="hidden">
                                    <button id="printresearchbtn" name="export_excel" class="btn btn-primarys mr-auto" style="paddin:15px; font-size: 16px; ">Print QAR Submissions</button>
                                </form>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="div_copyright">
                    <h2 align="center">PUP Research Presentation Titles Data</h2>
                    <div id ="chart_copyright"></div>
                    <div id="legendcopyright" class="bars-legend"></div>
                </div>
                <button id="save_copyright" class="btn btn-primarys">Download Chart</button>
            </div>
            
        </div>
    </div>
    <script>
        $(document).ready(function(){
            $('.view_data').click(function(){
                var submission_id = $(this).attr("id");
                
                $.ajax({
                    url:"DisplayIndividualQAR.php",
                    method:"post",
                    data:{submission_id:submission_id},
                    success:function(data){
                        $('#submission_detail').html(data);
                        $('#dataModal').modal("show");
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function(){
            $('.viewallbtn').click(function(){
                var quarterid = $('#quarterval').val();
                var college = "<?php echo $usercollege;?>";
                
                $.ajax({
                    url:"DisplayAllQAR.php",
                    method:"post",
                    data:{quarterid:quarterid,college:college},
                    success:function(data){
                        $('#submission_detail').html(data);
                        $('#dataModal').modal("show");
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function(){
            $('.accept').click(function(){
                var submission_id = $(this).attr("id");

                $.ajax({
                    url:"AcceptConfirmation.php",
                    method:"post",
                    data:{submission_id:submission_id},
                    success:function(data){
                        $('#accept_detail').html(data);
                        $('#dataModalaccept').modal("show");
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function(){
            $('.send_feedback').click(function(){
                var submission_id = $(this).attr("id");

                $.ajax({
                    url:"SubmitFeedback.php",
                    method:"post",
                    data:{submission_id:submission_id},
                    success:function(data){
                        $('#feedback_detail').html(data);
                        $('#dataModalfeedback').modal("show");
                    }
                });
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function(){
            $("#quarterval").on('change',function(){
                var value = $(this).val();
               
                
                $.ajax({
                    url:"fetchSubmissionDean.php",
                    type:"POST",
                    data:{request: value},
                    beforeSend:function(){
                        $(".subcon1").html("<span>Please Wait...</span>");
                    },
                    success:function(data){
                        $(".subcon1").html(data);
                    }
                });
            });
        });
    </script>

    <script>
        function openTab(tabName) {
            var i;
            var x = document.getElementsByClassName("tab");
            for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";  
            }
            document.getElementById(tabName).style.display = "block";  
            }
    </script>
    <script>
        function openTab2(tabName) {
            var i;
            var x = document.getElementsByClassName("tab2");
            for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";  
            }
            document.getElementById(tabName).style.display = "block";  
            }
    </script>
        <script>
        const addbtnz = document.getElementById('addbtnz');
        const modelz_container = document.getElementById('modalz_containez');
        const closez = document.getElementById('closez');

        addbtnz.addEventListener('click',()=>{
            modalz_containerz.classList.add('show');
        });

        closez.addEventListener('click',()=>{
            modalz_containerz.classList.remove('show');
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#levelvalAll").on('change',function(){
                var value = $(this).val();
                var col = "<?php echo $usercollege;?>";
                var year = $('#yearvalAll').val();
                
                $.ajax({
                    url:"fetchSubmissionHigherAll.php",
                    type:"POST",
                    data:{request: value, col: col, year: year},
                    beforeSend:function(){
                        $(".tableAll").html("<span>Please Wait...</span>");
                    },
                    success:function(data){
                        $(".tableAll").html(data);
                    }
                });
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function(){
            $("#yearvalAll").on('change',function(){
                var year = $(this).val();
                var value = $('#levelvalAll').val();
                var col = "<?php echo $usercollege;?>";
                
                $.ajax({
                    url:"fetchSubmissionHigherAll.php",
                    type:"POST",
                    data:{request: value, col: col, year: year},
                    beforeSend:function(){
                        $(".tableAll").html("<span>Please Wait...</span>");
                    },
                    success:function(data){
                        $(".tableAll").html(data);
                    }
                });
            });
        });
    </script>

    
    <script type="text/javascript">
        $(document).ready(function(){
            $("#yearvalOngoing").on('change',function(){
                var year = $(this).val();
                var col = "<?php echo $usercollege;?>";
                
                $.ajax({
                    url:"fetchSubmissionHigherOngoing.php",
                    type:"POST",
                    data:{col: col, year: year},
                    beforeSend:function(){
                        $(".tableOngoing").html("<span>Please Wait...</span>");
                    },
                    success:function(data){
                        $(".tableOngoing").html(data);
                    }
                });
            });
        });
    </script>

    
    <script type="text/javascript">
        $(document).ready(function(){
            $("#yearvalCompleted").on('change',function(){
                var year = $(this).val();
                var col = "<?php echo $usercollege;?>";
                
                $.ajax({
                    url:"fetchSubmissionHigherCompleted.php",
                    type:"POST",
                    data:{col: col,year: year},
                    beforeSend:function(){
                        $(".tableCompleted").html("<span>Please Wait...</span>");
                    },
                    success:function(data){
                        $(".tableCompleted").html(data);
                    }
                });
            });
        });
    </script>

    
    <script type="text/javascript">
        $(document).ready(function(){
            $("#yearvalUnfinished").on('change',function(){
                var year = $(this).val();
                var col = "<?php echo $usercollege;?>";
                
                $.ajax({
                    url:"fetchSubmissionHigherUnfinished.php",
                    type:"POST",
                    data:{col: col, year: year},
                    beforeSend:function(){
                        $(".tableUnfinished").html("<span>Please Wait...</span>");
                    },
                    success:function(data){
                        $(".tableUnfinished").html(data);
                    }
                });
            });
        });
    </script>


    <script type="text/javascript">
        $(document).ready(function(){
            $("#levelvalPublication").on('change',function(){
                var value = $(this).val();
                var col = "<?php echo $usercollege;?>";
                var year = $('#yearvalPublication').val();
                
                $.ajax({
                    url:"fetchSubmissionHigherPublication.php",
                    type:"POST",
                    data:{request: value, col: col,year: year},
                    beforeSend:function(){
                        $(".tablePublished").html("<span>Please Wait...</span>");
                    },
                    success:function(data){
                        $(".tablePublished").html(data);
                    }
                });
            });
        });
    </script>
    
    <script type="text/javascript">
        $(document).ready(function(){
            $("#yearvalPublication").on('change',function(){
                var year = $(this).val();
                var value = $('#levelvalPublication').val();
                var col = "<?php echo $usercollege;?>";
                
                $.ajax({
                    url:"fetchSubmissionHigherPublication.php",
                    type:"POST",
                    data:{request: value, col: col, year: year},
                    beforeSend:function(){
                        $(".tablePublished").html("<span>Please Wait...</span>");
                    },
                    success:function(data){
                        $(".tablePublished").html(data);
                    }
                });
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function(){
            $("#levelvalPresentation").on('change',function(){
                var value = $(this).val();
                var col = "<?php echo $usercollege;?>";
                var year = $('#yearvalPresentation').val();
                
                $.ajax({
                    url:"fetchSubmissionHigherPresentation.php",
                    type:"POST",
                    data:{request: value, col: col, year:year},
                    beforeSend:function(){
                        $(".tablePresentation").html("<span>Please Wait...</span>");
                    },
                    success:function(data){
                        $(".tablePresentation").html(data);
                    }
                });
            });
        });
    </script>
    
    <script type="text/javascript">
        $(document).ready(function(){
            $("#yearvalPresentation").on('change',function(){
                var year = $(this).val();
                var value = $('#levelvalPresentation').val();
                var col = "<?php echo $usercollege;?>";
                
                $.ajax({
                    url:"fetchSubmissionHigherPresentation.php",
                    type:"POST",
                    data:{request: value, col: col,year: year},
                    beforeSend:function(){
                        $(".tablePresentation").html("<span>Please Wait...</span>");
                    },
                    success:function(data){
                        $(".tablePresentation").html(data);
                    }
                });
            });
        });
    </script>

    
    <script type="text/javascript">
        $(document).ready(function(){
            $("#yearvalCitation").on('change',function(){
                var year = $(this).val();
                var indexing = $('#indexing').val();
                var col = "<?php echo $usercollege;?>";
                
                
                $.ajax({
                    url:"fetchSubmissionHigherCitation.php",
                    type:"POST",
                    data:{col: col,indexing: indexing,year: year},
                    beforeSend:function(){
                        $(".tableCitation").html("<span>Please Wait...</span>");
                    },
                    success:function(data){
                        $(".tableCitation").html(data);
                    }
                });
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#indexing").on('change',function(){
                var indexing = $(this).val();
                var year = $('#yearvalCitation').val();
                var col = "<?php echo $usercollege;?>";
                
                
                $.ajax({
                    url:"fetchSubmissionHigherCitation.php",
                    type:"POST",
                    data:{col: col,indexing: indexing,year: year},
                    beforeSend:function(){
                        $(".tableCitation").html("<span>Please Wait...</span>");
                    },
                    success:function(data){
                        $(".tableCitation").html(data);
                    }
                });
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function(){
            $("#levelvalUtilization").on('change',function(){
                var value = $(this).val();
                var col = "<?php echo $usercollege;?>";
                var year = $('#yearvalUtilization').val();
                
                $.ajax({
                    url:"fetchSubmissionHigherUtilization.php",
                    type:"POST",
                    data:{request: value, col: col,year:year},
                    beforeSend:function(){
                        $(".tableUtilization").html("<span>Please Wait...</span>");
                    },
                    success:function(data){
                        $(".tableUtilization").html(data);
                    }
                });
            });
        });
    </script>
    
    <script type="text/javascript">
        $(document).ready(function(){
            $("#yearvalUtilization").on('change',function(){
                var year = $(this).val();
                var value = $('#levelvalUtilization').val();
                var col = "<?php echo $usercollege;?>";
                
                $.ajax({
                    url:"fetchSubmissionHigherUtilization.php",
                    type:"POST",
                    data:{request: value, col: col,year:year},
                    beforeSend:function(){
                        $(".tableUtilization").html("<span>Please Wait...</span>");
                    },
                    success:function(data){
                        $(".tableUtilization").html(data);
                    }
                });
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function(){
            $("#levelvalCopyright").on('change',function(){
                var value = $(this).val();
                var col = "<?php echo $usercollege;?>";
                var year = $('#yearvalCopyright').val();
                
                $.ajax({
                    url:"fetchSubmissionHigherCopyright.php",
                    type:"POST",
                    data:{request: value, col: col,year:year},
                    beforeSend:function(){
                        $(".tableCopyright").html("<span>Please Wait...</span>");
                    },
                    success:function(data){
                        $(".tableCopyright").html(data);
                    }
                });
            });
        });
    </script>
    
    <script type="text/javascript">
        $(document).ready(function(){
            $("#yearvalCopyright").on('change',function(){
                var year = $(this).val();
                var value = $('#levelvalCopyright').val();
                var col = "<?php echo $usercollege;?>";
                
                $.ajax({
                    url:"fetchSubmissionHigherCopyright.php",
                    type:"POST",
                    data:{request: value, col: col, year:year},
                    beforeSend:function(){
                        $(".tableCopyright").html("<span>Please Wait...</span>");
                    },
                    success:function(data){
                        $(".tableCopyright").html(data);
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function(){
            $('.viewallResearch').click(function(){
                var level = $('#levelvalAll').val();
                var year = $('#yearvalAll').val();
                var college = "<?php echo $usercollege;?>";
                
                $.ajax({
                    url:"DisplayAllResearch.php",
                    method:"post",
                    data:{level:level,college:college,year:year},
                    success:function(data){
                        $('#research_detailAll').html(data);
                        $('#dataModalAll').modal("show");
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function(){
            $('.viewOngoingResearch').click(function(){
                var year = $('#yearvalOngoing').val();
                var college = "<?php echo $usercollege;?>";
                
                $.ajax({
                    url:"DisplayOngoingResearch.php",
                    method:"post",
                    data:{college:college,year:year},
                    success:function(data){
                        $('#research_detailOngoing').html(data);
                        $('#dataModalOngoing').modal("show");
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function(){
            $('.viewCompletedResearch').click(function(){
                var year = $('#yearvalCompleted').val();
                var college = "<?php echo $usercollege;?>";
                
                $.ajax({
                    url:"DisplayCompletedResearch.php",
                    method:"post",
                    data:{college:college,year:year},
                    success:function(data){
                        $('#research_detailCompleted').html(data);
                        $('#dataModalCompleted').modal("show");
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function(){
            $('.viewUnfinishedResearch').click(function(){
                var year = $('#yearvalUnfinished').val();
                var college = "<?php echo $usercollege;?>";
                
                $.ajax({
                    url:"DisplayUnfinishedResearch.php",
                    method:"post",
                    data:{college:college,year:year},
                    success:function(data){
                        $('#research_detailUnfinished').html(data);
                        $('#dataModalUnfinished').modal("show");
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function(){
            $('.viewPublicationResearch').click(function(){
                var level = $('#levelvalPublication').val();
                var year = $('#yearvalPublication').val();
                var college = "<?php echo $usercollege;?>";
                
                $.ajax({
                    url:"DisplayPublicationResearch.php",
                    method:"post",
                    data:{level:level,college:college,year:year},
                    success:function(data){
                        $('#research_detailPublication').html(data);
                        $('#dataModalPublication').modal("show");
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function(){
            $('.viewPresentationResearch').click(function(){
                var level = $('#levelvalPresentation').val();
                var year = $('#yearvalPresentation').val();
                var college ="<?php echo $usercollege;?>";
                
                $.ajax({
                    url:"DisplayPresentationResearch.php",
                    method:"post",
                    data:{level:level,college:college,year:year},
                    success:function(data){
                        $('#research_detailPresentation').html(data);
                        $('#dataModalPresentation').modal("show");
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function(){
            $('.viewCitationResearch').click(function(){
                var indexing = $('#indexing').val();
                var year = $('#yearvalCitation').val();
                var college ="<?php echo $usercollege;?>";
                
                $.ajax({
                    url:"DisplayCitationResearch.php",
                    method:"post",
                    data:{indexing:indexing,college:college,year:year},
                    success:function(data){
                        $('#research_detailCitation').html(data);
                        $('#dataModalCitation').modal("show");
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function(){
            $('.viewUtilizationResearch').click(function(){
                var level = $('#levelvalUtilization').val();
                var year = $('#yearvalUtilization').val();
                var college = "<?php echo $usercollege; ?>"
                
                $.ajax({
                    url:"DisplayUtilizationResearch.php",
                    method:"post",
                    data:{level:level,college:college,year:year},
                    success:function(data){
                        $('#research_detailUtilization').html(data);
                        $('#dataModalUtilization').modal("show");
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function(){
            $('.viewCopyrightResearch').click(function(){
                var level = $('#levelvalCopyright').val();
                var year = $('#yearvalCopyright').val();
                var college = "<?php echo $usercollege; ?>"
                
                $.ajax({
                    url:"DisplayCopyrightResearch.php",
                    method:"post",
                    data:{level:level,college:college,year:year},
                    success:function(data){
                        $('#research_detailCopyright').html(data);
                        $('#dataModalCopyright').modal("show");
                    }
                });
            });
        });
    </script>
    <script>
        var chart_completed = new Morris.Bar({
            element : 'chart_completed',
            data: [<?php echo $char_data_completed; ?>],
            xkey:'year',
            ykeys:['Titles'],
            labels:['Completed Research'],
            hideHover:'auto',
            resize: true
            
        });

        chart_completed.options.labels.forEach(function(label, i) {
        var legendItemcompleted = $('<span></span>').text( label).prepend('<br><span>&nbsp;</span>');
        legendItemcompleted.find('span')
        .css('backgroundColor', chart_completed.options.barColors[i])
        .css('width', '20px')
        .css('display', 'inline-block')
        .css('margin', '5px');
        $('#legendcompleted').append(legendItemcompleted)
        });

        $("#save").click(function() {
        html2canvas(document.getElementById('div_completed')).then(canvas => {
            var w = document.getElementById("div_completed").offsetWidth;
            var h = document.getElementById("div_completed").offsetHeight;

            var img = canvas.toDataURL("image/jpeg", 5);

            var doc = new jsPDF('L', 'pt', [w, h]);
            doc.addImage(img, 'JPEG', 0, 0, w, h);
            doc.save('Completed Research Chart.pdf');
        }).catch(function(e) {
            console.log(e.message);
        });
    });
    </script>

    <script>
        var chart_all = Morris.Bar({
            element : 'chart_all',
            data: [<?php echo $char_data_all; ?>],
            
            xkey:'year',
            ykeys:['Ongoing','Publication','Presentation','Citation','Utilization','Copyright'],
            labels:['Research Ongoing/Completed','Research Publication','Research Presentation','Research Citation','Research Utilization','Research Copyright'],
            hideHover:'auto',
            resize: true
            
            
        });

        

        chart_all.options.labels.forEach(function(label, i) {
        var legendItem = $('<span></span>').text( label).prepend('<br><span>&nbsp;</span>');
        legendItem.find('span')
        .css('backgroundColor', chart_all.options.barColors[i])
        .css('width', '20px')
        .css('display', 'inline-block')
        .css('margin', '5px');
        $('#legend').append(legendItem)
    });

        $("#save_all").click(function() {
        html2canvas(document.getElementById('div_all')).then(canvas => {
            var w = document.getElementById("div_all").offsetWidth;
            var h = document.getElementById("div_all").offsetHeight;

            var img = canvas.toDataURL("image/jpeg", 5);

            var doc = new jsPDF('L', 'pt', [w, h]);
            doc.addImage(img, 'JPEG', 0, 0, w, h);
            doc.save('All Research Chart.pdf');
        }).catch(function(e) {
            console.log(e.message);
        });


    });
  
    
    </script>
       
  
    <script>
        var chart_ongoing = Morris.Bar({
            element : 'chart_ongoing',
            data: [<?php echo $char_data_ongoing; ?>],
            xkey:'year',
            ykeys:['Titles'],
            labels:['Ongoing Research'],
            hideHover:'auto',
            resize: true
            
        });

        chart_ongoing.options.labels.forEach(function(label, i) {
        var legendItemongoing = $('<span></span>').text( label).prepend('<br><span>&nbsp;</span>');
        legendItemongoing.find('span')
        .css('backgroundColor', chart_ongoing.options.barColors[i])
        .css('width', '20px')
        .css('display', 'inline-block')
        .css('margin', '5px');
        $('#legendongoing').append(legendItemongoing)
        });

        $("#save_ongoing").click(function() {
        html2canvas(document.getElementById('div_ongoing')).then(canvas => {
            var w = document.getElementById("div_ongoing").offsetWidth;
            var h = document.getElementById("div_ongoing").offsetHeight;

            var img = canvas.toDataURL("image/jpeg", 5);

            var doc = new jsPDF('L', 'pt', [w, h]);
            doc.addImage(img, 'JPEG', 0, 0, w, h);
            doc.save('Ongoing Research Chart.pdf');
        }).catch(function(e) {
            console.log(e.message);
        });
    });
    </script>

    <script>
        var chart_deferred = new Morris.Bar({
            element : 'chart_deferred',
            data: [<?php echo $char_data_deferred; ?>],
            xkey:'year',
            ykeys:['Titles'],
            labels:['Deferred Research'],
            hideHover:'auto',
            resize: true
            
        });

        chart_deferred.options.labels.forEach(function(label, i) {
        var legendItemdeferred = $('<span></span>').text( label).prepend('<br><span>&nbsp;</span>');
        legendItemdeferred.find('span')
        .css('backgroundColor', chart_deferred.options.barColors[i])
        .css('width', '20px')
        .css('display', 'inline-block')
        .css('margin', '5px');
        $('#legenddeferred').append(legendItemdeferred)
        });

        $("#save_deferred").click(function() {
        html2canvas(document.getElementById('div_deferred')).then(canvas => {
            var w = document.getElementById("div_deferred").offsetWidth;
            var h = document.getElementById("div_deferred").offsetHeight;

            var img = canvas.toDataURL("image/jpeg", 5);

            var doc = new jsPDF('L', 'pt', [w, h]);
            doc.addImage(img, 'JPEG', 0, 0, w, h);
            doc.save('Deferred Research Chart.pdf');
        }).catch(function(e) {
            console.log(e.message);
        });
    });
    </script>

    <script>
        var chart_publication = new Morris.Bar({
            element : 'chart_publication',
            data: [<?php echo $char_data_publication; ?>],
            xkey:'year',
            ykeys:['Titles'],
            labels:['Research Publications'],
            hideHover:'auto',
            resize: true
            
        });

        chart_publication.options.labels.forEach(function(label, i) {
        var legendItempublication = $('<span></span>').text( label).prepend('<br><span>&nbsp;</span>');
        legendItempublication.find('span')
        .css('backgroundColor', chart_publication.options.barColors[i])
        .css('width', '20px')
        .css('display', 'inline-block')
        .css('margin', '5px');
        $('#legendpublication').append(legendItempublication)
        });

        $("#save_publication").click(function() {
        html2canvas(document.getElementById('div_publication')).then(canvas => {
            var w = document.getElementById("div_publication").offsetWidth;
            var h = document.getElementById("div_publication").offsetHeight;

            var img = canvas.toDataURL("image/jpeg", 5);

            var doc = new jsPDF('L', 'pt', [w, h]);
            doc.addImage(img, 'JPEG', 0, 0, w, h);
            doc.save('Research Publication Chart.pdf');
        }).catch(function(e) {
            console.log(e.message);
        });
    });
    </script>

    <script>
        var chart_presentation = new Morris.Bar({
            element : 'chart_presentation',
            data: [<?php echo $char_data_presentation; ?>],
            xkey:'year',
            ykeys:['Titles'],
            labels:['Research Presentations'],
            hideHover:'auto',
            resize: true
            
        });

        chart_presentation.options.labels.forEach(function(label, i) {
        var legendItempresentation = $('<span></span>').text( label).prepend('<br><span>&nbsp;</span>');
        legendItempresentation.find('span')
        .css('backgroundColor', chart_presentation.options.barColors[i])
        .css('width', '20px')
        .css('display', 'inline-block')
        .css('margin', '5px');
        $('#legendpresentation').append(legendItempresentation)
        });

        $("#save_presentation").click(function() {
        html2canvas(document.getElementById('div_presentation')).then(canvas => {
            var w = document.getElementById("div_presentation").offsetWidth;
            var h = document.getElementById("div_presentation").offsetHeight;

            var img = canvas.toDataURL("image/jpeg", 5);

            var doc = new jsPDF('L', 'pt', [w, h]);
            doc.addImage(img, 'JPEG', 0, 0, w, h);
            doc.save('Research Presentation Chart.pdf');
        }).catch(function(e) {
            console.log(e.message);
        });
    });
    </script>

    <script>
        var chart_utilization = new Morris.Bar({
            element : 'chart_utilization',
            data: [<?php echo $char_data_utilization; ?>],
            xkey:'year',
            ykeys:['Titles'],
            labels:['Research Utilized'],
            hideHover:'auto',
            resize: true
            
        });

        chart_utilization.options.labels.forEach(function(label, i) {
        var legendItemutilization = $('<span></span>').text( label).prepend('<br><span>&nbsp;</span>');
        legendItemutilization.find('span')
        .css('backgroundColor', chart_utilization.options.barColors[i])
        .css('width', '20px')
        .css('display', 'inline-block')
        .css('margin', '5px');
        $('#legendutilization').append(legendItemutilization)
        });

        $("#save_utilization").click(function() {
        html2canvas(document.getElementById('div_utilization')).then(canvas => {
            var w = document.getElementById("div_utilization").offsetWidth;
            var h = document.getElementById("div_utilization").offsetHeight;

            var img = canvas.toDataURL("image/jpeg", 5);

            var doc = new jsPDF('L', 'pt', [w, h]);
            doc.addImage(img, 'JPEG', 0, 0, w, h);
            doc.save('Research Utilization Chart.pdf');
        }).catch(function(e) {
            console.log(e.message);
        });
    });
    </script>

    <script>
        var chart_copyright = new Morris.Bar({
            element : 'chart_copyright',
            data: [<?php echo $char_data_copyright; ?>],
            xkey:'year',
            ykeys:['Titles'],
            labels:['Copyrighted Research Outputs'],
            hideHover:'auto',
            resize: true
            
        });

        chart_copyright.options.labels.forEach(function(label, i) {
        var legendItemcopyright = $('<span></span>').text( label).prepend('<br><span>&nbsp;</span>');
        legendItemcopyright.find('span')
        .css('backgroundColor', chart_copyright.options.barColors[i])
        .css('width', '20px')
        .css('display', 'inline-block')
        .css('margin', '5px');
        $('#legendcopyright').append(legendItemcopyright)
        });

        $("#save_copyright").click(function() {
        html2canvas(document.getElementById('div_copyright')).then(canvas => {
            var w = document.getElementById("div_copyright").offsetWidth;
            var h = document.getElementById("div_copyright").offsetHeight;

            var img = canvas.toDataURL("image/jpeg", 5);

            var doc = new jsPDF('L', 'pt', [w, h]);
            doc.addImage(img, 'JPEG', 0, 0, w, h);
            doc.save('Copyrighted Research Output Chart.pdf');
        }).catch(function(e) {
            console.log(e.message);
        });
    });
    </script>

    <script>
        var chart_citation = new Morris.Bar({
            element : 'chart_citation',
            data: [<?php echo $char_data_citation; ?>],
            xkey:'year',
            ykeys:['Scopus','Web','Oasuc','Ched','International','Exellence','Asean'],
            labels:['Scopus','Web of Science','OASUC Accredited Journals','CHED Recognized Journals','International Refereed Journals','Excellence in Research for Australia','ASEAN Citation Index'],
            hideHover:'auto',
            stacked:true,
            resize: true
            
        });

        chart_citation.options.labels.forEach(function(label, i) {
        var legendItemcitation = $('<span></span>').text( label).prepend('<br><span>&nbsp;</span>');
        legendItemcitation.find('span')
        .css('backgroundColor', chart_citation.options.barColors[i])
        .css('width', '20px')
        .css('display', 'inline-block')
        .css('margin', '5px');
        $('#legendcitation').append(legendItemcitation)
        });

        $("#save_citation").click(function() {
        html2canvas(document.getElementById('div_citation')).then(canvas => {
            var w = document.getElementById("div_citation").offsetWidth;
            var h = document.getElementById("div_citation").offsetHeight;

            var img = canvas.toDataURL("image/jpeg", 5);

            var doc = new jsPDF('L', 'pt', [w, h]);
            doc.addImage(img, 'JPEG', 0, 0, w, h);
            doc.save('Research Citation Chart.pdf');
        }).catch(function(e) {
            console.log(e.message);
        });
    });
    </script>

    <script>
      $("#ResearchTab").on("click", function () {

        chart_all.redraw();
            $(window).trigger('resize');
            $('svg').css({ width: '100%' });
        });
            
        
    
    </script>

    <script>
        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            var target = $(e.target).attr("href");

            switch (target) {

            case "#All":
            chart_all.redraw();
            $(window).trigger('resize');
            $('svg').css({ width: '100%' });
            break;

            
            

            case "#Ongoing":
            chart_ongoing.redraw();
            $(window).trigger('resize');
            $('svg').css({ width: '100%' });
            break;

            case "#Completed":
            chart_completed.redraw();
            $(window).trigger('resize');
            $('svg').css({ width: '100%' });
            break;

            case "#Unfinished":
            chart_deferred.redraw();
            $(window).trigger('resize');
            $('svg').css({ width: '100%' });
            break;

            case "#Publication":
            chart_publication.redraw();
            $(window).trigger('resize');
            $('svg').css({ width: '100%' });
            break;

            case "#Presentation":
            chart_presentation.redraw();
            $(window).trigger('resize');
            $('svg').css({ width: '100%' });
            break;

            case "#Utilization":
            chart_utilization.redraw();
            $(window).trigger('resize');
            $('svg').css({ width: '100%' });
            break;

            case "#Copyright":
            chart_copyright.redraw();
            $(window).trigger('resize');
            $('svg').css({ width: '100%' });
            break;

            case "#Citation":
            chart_citation.redraw();
            $(window).trigger('resize');
            $('svg').css({ width: '100%' });
            break;
            }
        });
    </script>

    <script>
        function revise(val,checkboxElem) {
            
            
            if (checkboxElem.checked) {
                var revdata = '1';
               
           
            } else {
                var revdata = '0';
                
            }
            var rev = val;
            var userId = $('#userId').val();
            var array = rev.split(" ");
            var revId = array[1];
            var qarpart = array[0];
            

            
            $.ajax({
                    url:"setrev.php",
                    type:"POST",
                    data:{revdata: revdata, revId: revId, qarpart: qarpart, userId: userId},
                    success:function(data){
                        alert("Revision Status has been changed")
                    }

            });


        };
    </script>
</body>

