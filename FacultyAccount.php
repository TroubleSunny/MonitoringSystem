<?php 
session_start();

include("connection.php");
include("functions.php");
include("navbar.php");

$user_data = check_login($con);
$_SESSION["suc"] = 0;
$stat = ("UPDATE addstat SET stat = 0 WHERE id = 1");
mysqli_query($con,$stat);

$test = $user_data['UserId'];
$quarter = $con->query("SELECT * FROM quarter WHERE QuarterProgress = 'Ongoing'");
$quarteryear = $con->query("SELECT SchoolYear FROM schoolyear WHERE YearId = (SELECT YearId FROM quarter WHERE QuarterProgress = 'Ongoing')");
while($qu = $quarter->fetch_assoc())
{
    $q = $qu['QuarterPart'];
    $quarterdate = $qu['QuarterEnd'];
}
while($quy = $quarteryear->fetch_assoc())
{
    $qy = $quy['SchoolYear'];
}

$mon = date('m');
$day = date('d');
$year = date('Y');
$currentdate = date('Y-m-d');




if(($mon == 1 || $mon == 4 || $mon == 7 || $mon == 10) && $day == 1 && $currentdate > $quarterdate)
{
    
    $fetchquarterquery = "SELECT * FROM quarter WHERE QuarterProgress ='Ongoing'";
    $fetchquarterrun = mysqli_query($con,$fetchquarterquery);
    $fetchquarter = mysqli_fetch_assoc($fetchquarterrun);

    $fetchyearquery = "SELECT * FROM schoolyear ORDER BY SchoolYear DESC LIMIT 1";
    $fetchyearrun = mysqli_query($con,$fetchyearquery);
    $fetchyear = mysqli_fetch_assoc($fetchyearrun);
 
    $updatesubmission = "UPDATE submission SET SubmissionStatus = 'Submitted' WHERE SubmissionStatus = 'Ongoing'";
    $updatesubmission = mysqli_query($con,$updatesubmission);

    $currentyearid = $fetchyear['YearId'];

    if($fetchyear['SchoolYear']<$year)
    {
        $newyearquery = "INSERT INTO schoolyear (SchoolYear) VALUES ('$year')";
        $newyearrun = mysqli_query($con,$newyearquery);
        
        $fetchyearquery = "SELECT * FROM schoolyear ORDER BY SchoolYear DESC LIMIT 1";
        $fetchyearrun = mysqli_query($con,$fetchyearquery);
        $fetchyear = mysqli_fetch_assoc($fetchyearrun);

        $currentyearid = $fetchyear['YearId'];
        if($mon == 1)
        {
            $updateongoing = "UPDATE quarter SET QuarterProgress = 'Finished' WHERE QuarterProgress = 'Ongoing'";
            $updateongoingrun = mysqli_query($con,$updateongoing);

            $futuredate = "$year-03-01";
            $quarterend = new DateTime($futuredate); 
            $quarterend = $quarterend->format( 'Y-m-t' );
            $update = "INSERT INTO quarter (QuarterPart,QuarterStart,QuarterEnd,QuarterProgress,YearId) VALUES ('First Quarter','$currentdate','$quarterend','Ongoing','$currentyearid')";
            $updaterun = mysqli_query($con,$update);

 
        }
        if($mon == 4)
        {
            $updateongoing = "UPDATE quarter SET QuarterProgress = 'Finished' WHERE QuarterProgress = 'Ongoing'";
            $updateongoingrun = mysqli_query($con,$updateongoing);

            $futuredate = "$year-06-01";
            $quarterend = new DateTime($futuredate); 
            $quarterend = $quarterend->format( 'Y-m-t' );
            $update = "INSERT INTO quarter (QuarterPart,QuarterStart,QuarterEnd,QuarterProgress,YearId) VALUES ('Second Quarter','$currentdate','$quarterend','Ongoing','$currentyearid')";
            $updaterun = mysqli_query($con,$update);
        }
        if($mon == 7)
        {
            $updateongoing = "UPDATE quarter SET QuarterProgress = 'Finished' WHERE QuarterProgress = 'Ongoing'";
            $updateongoingrun = mysqli_query($con,$updateongoing);

            $futuredate = "$year-09-01";
            $quarterend = new DateTime($futuredate); 
            $quarterend = $quarterend->format( 'Y-m-t' );
            $update = "INSERT INTO quarter (QuarterPart,QuarterStart,QuarterEnd,QuarterProgress,YearId) VALUES ('Third Quarter','$currentdate','$quarterend','Ongoing','$currentyearid')";
            $updaterun = mysqli_query($con,$update);
        }
        if($mon == 10)
        {
            $updateongoing = "UPDATE quarter SET QuarterProgress = 'Finished' WHERE QuarterProgress = 'Ongoing'";
            $updateongoingrun = mysqli_query($con,$updateongoing);

            $futuredate = "$year-12-01";
            $quarterend = new DateTime($futuredate); 
            $quarterend = $quarterend->format( 'Y-m-t' );
            $update = "INSERT INTO quarter (QuarterPart,QuarterStart,QuarterEnd,QuarterProgress,YearId) VALUES ('Fourth Quarter','$currentdate','$quarterend','Ongoing','$currentyearid')";
            $updaterun = mysqli_query($con,$update);
        }
    }
    else
    {
        if($mon == 1)
        {
            $updateongoing = "UPDATE quarter SET QuarterProgress = 'Finished' WHERE QuarterProgress = 'Ongoing'";
            $updateongoingrun = mysqli_query($con,$updateongoing);

            $futuredate = "$year-03-01";
            $quarterend = new DateTime($futuredate); 
            $quarterend = $quarterend->format( 'Y-m-t' );
            $update = "INSERT INTO quarter (QuarterPart,QuarterStart,QuarterEnd,QuarterProgress,YearId) VALUES ('First Quarter','$currentdate','$quarterend','Ongoing','$currentyearid')";
            $updaterun = mysqli_query($con,$update);
 
        }
        if($mon == 4)
        {
            $updateongoing = "UPDATE quarter SET QuarterProgress = 'Finished' WHERE QuarterProgress = 'Ongoing'";
            $updateongoingrun = mysqli_query($con,$updateongoing);

            $futuredate = "$year-06-01";
            $quarterend = new DateTime($futuredate); 
            $quarterend = $quarterend->format( 'Y-m-t' );
            $update = "INSERT INTO quarter (QuarterPart,QuarterStart,QuarterEnd,QuarterProgress,YearId) VALUES ('Second Quarter','$currentdate','$quarterend','Ongoing','$currentyearid')";
            $updaterun = mysqli_query($con,$update);
        }
        if($mon == 7)
        {
            $updateongoing = "UPDATE quarter SET QuarterProgress = 'Finished' WHERE QuarterProgress = 'Ongoing'";
            $updateongoingrun = mysqli_query($con,$updateongoing);

            $futuredate = "$year-09-01";
            $quarterend = new DateTime($futuredate); 
            $quarterend = $quarterend->format( 'Y-m-t' );
            $update = "INSERT INTO quarter (QuarterPart,QuarterStart,QuarterEnd,QuarterProgress,YearId) VALUES ('Third Quarter','$currentdate','$quarterend','Ongoing','$currentyearid')";
            $updaterun = mysqli_query($con,$update);
        }
        if($mon == 10)
        {
            $updateongoing = "UPDATE quarter SET QuarterProgress = 'Finished' WHERE QuarterProgress = 'Ongoing'";
            $updateongoingrun = mysqli_query($con,$updateongoing);

            $futuredate = "$year-12-01";
            $quarterend = new DateTime($futuredate); 
            $quarterend = $quarterend->format( 'Y-m-t' );
            $update = "INSERT INTO quarter (QuarterPart,QuarterStart,QuarterEnd,QuarterProgress,YearId) VALUES ('Fourth Quarter','$currentdate','$quarterend','Ongoing','$currentyearid')";
            $updaterun = mysqli_query($con,$update);
        }
    }

    
}

$submission = $con->query("SELECT * FROM submission WHERE UserId = '$test' AND QuarterId IN (SELECT QuarterId From quarter WHERE QuarterProgress='Ongoing')");

if(mysqli_num_rows($submission)>0)
{
    $sub = $submission->fetch_assoc();
    $submissionstatus = $sub['SubmissionStatus'];
    if($sub['ValidationStatus']==null && $submissionstatus=='Submitted')
    {
        $validationstatus = 'Pending';
        
    }
    else if($sub['ValidationStatus']==null && $submissionstatus=='Ongoing')
    {
        $validationstatus = "No QAR Submission";
        
    }
    else
    {
        $validationstatus = $sub['ValidationStatus'];
        
    }
}
else
{
    $submissionstatus = "No QAR Submitted";
    $validationstatus = "No QAR Submitted";
}


$fetchfeed = "SELECT FeedbackDetails FROM feedback WHERE SubmissionId IN(SELECT SubmissionId FROM submission WHERE UserId ='$test' AND QuarterId IN (SELECT QuarterId FROM quarter WHERE QuarterProgress='Ongoing'))";
$fet = mysqli_query($con,$fetchfeed);

if(mysqli_num_rows($fet)>0)
{
    $fetch = mysqli_fetch_assoc($fet);
    $feedback = $fetch['FeedbackDetails'];
   
}
else
{
    
    $feedback = null;
}


?>
        


<section id="inner-headline">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="pageTitle">PROFILE</h2>
            </div>
        </div>
    </div>
</section>

<div class="container" style="margin-top: 90px;min-height: 1000px;">
    <div class="row">
        <div class="col-sm-3" style="width: 40%; border:black">
           <div class="panel panel-default">            
                <div class="panel-body"> 
                    <div  id="image-container">
                        <?php 
                            if($user_data['UserPhoto']==NULL)
                            {
                                ?>
                                <img title="profile image"  data-target="#myModal"  data-toggle="modal" src="plugins/home-plugins/img/564-5640631_file-antu-insert-image-svg-insert-image-here.png" style="Width:100%"/>
                                <?php
                            }
                            else
                            {
                                $download = 'uploads/'.$user_data['UserPhoto']; 
                                ?>
                                <img title="profile image"  data-toggle="modal" src="<?php echo $download; ?>" style="Width:100%"/>
                                <?php
                            }
                        ?>
                        
                        <div class='panel-body'>  
                        <div class='col-md-11'>       
                            
                           
                        </div>
                    </div>
                    </div>
                </div>
                <ul class="list-group">
                    <form action="Insert/updatemember.php" method="POST" enctype="multipart/form-data">
                        <input name="change" type="hidden" value="<?php echo $test; ?>">
                        <li class="list-group-item text-muted">Profile</li>
                       
                        <li class="list-group-item text-right"><span class="pull-left"><strong style="color:#800000;">Name</strong></span><input name="name" style="border:none" value="<?php echo $user_data['RealName']; ?>"></li> 
                        <li class="list-group-item text-right"><span class="pull-left"><strong style="color:#800000;">User Name</strong></span><input name="username" style="border:none" value="<?php echo $user_data['UserName']; ?>"></li> 
                        <li class="list-group-item text-right"><span class="pull-left"><strong style="color:#800000;">Email Address</strong></span><input name="email" style="border:none" value="<?php echo $user_data['UserEmail']; ?>"></li> 
                        <li class="list-group-item text-right"><span class="pull-left"><strong style="color:#800000;">Password</strong></span><input type="password" name="password" style="border:none" value="<?php echo $user_data['UserPassword']; ?>"></li> 
                        <li class="list-group-item text-left"><strong style="color:#800000;">Profile image</strong></span><input name='file' type='file' value='' accept="image/*"> </li>
                        <li class="list-group-item text-muted"><button class="btn " name="submit" value="submit" type="submit" style="" onclick="return confirm('Save submission for this segment?');">Save</span></button></li>
                    </form>
                </ul> 
                <div class="box box-solid">  
                    <div class="box-body no-padding">
                        <ul class="nav nav-pills nav-stacked"> 
                            <li class="list-group-item text-right"><span class="pull-left"><strong style="color:#800000;">Section</strong></span><?php echo $user_data['College']; ?></li> 
                            <li class="" ><a href="" style="color:#800000;"><i class="fa fa-user"></i> QAR Submissions </a></li>
                           
    
                            <li class="list-group-item text-right"><span class="pull-left"><strong style="color:#800000;">Current Submission Status</strong></span><?php echo $submissionstatus; ?></li> 
                            <li class="list-group-item text-right"><span class="pull-left"><strong style="color:#800000;">Validation Status</strong></span><?php echo $validationstatus; ?></li> 
                            
                        </ul>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="col-sm-9" style="width: 60%; border:red ">
            <div class="BannerInfo"> 
                <p>QAR <?php echo "$q ($qy)";?> Submissions are open <p>
            </div>
            <div class=" ProgressTabs" style="background:white">
                <button class="ProgressTabItems" onclick="openTab('Ongoing')">Ongoing Research</button>
                <button class="ProgressTabItems" onclick="openTab('Completed')">Completed Research</button>
                <button class="ProgressTabItems" onclick="openTab('Published')">Publications</button>
                <button class="ProgressTabItems" onclick="openTab('Presentation')">Presentations</button>
                <button class="ProgressTabItems" onclick="openTab('Citation')">Citations</button>
            </div>
            <div id="Ongoing" class="ProgressContents tab">
                <table class="table" style="display:block; height:325px; overflow: auto;">
                    <thead>
                        <tr style="position:sticky; top:0; background-color:white;">
                            <th scope="col">#</th>
                            <th scope="col">Research Title</th>
                            <th scope="col"><nobr>Date Started</th>
                            <th scope="col"><nobr>Target Date</th>
                            <th scope="col">Supporting Document</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $query = "SELECT * FROM researchongoing WHERE RoStatus='Ongoing' AND SubmissionId IN (SELECT SubmissionId FROM submission WHERE UserId='$test')";
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
                            else
                            {
                                echo "No record Found";
                            }
                        ?>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div id="Completed" class="ProgressContents tab" style="display:none">
                
                <table class="table" style="display:block; height:325px; overflow: auto;">
                    <thead>
                        <tr style="position:sticky; top:0; background-color:white;">
                            <th scope="col">#</th>
                            <th scope="col">Research Title</th>
                            <th scope="col"><nobr>Date Started</th>
                            <th scope="col"><nobr>Date Completed</th>
                            <th scope="col">Supporting Document</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $query = "SELECT * FROM researchongoing WHERE RoStatus='Completed' AND SubmissionId IN (SELECT SubmissionId FROM submission WHERE UserId='$test')";
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
                            <td><?php echo $row1['RoDateCompleted'];?></td>
                            
                            <?php $file = $row1['RoTempName']; $download = 'uploads/'.$file;?> 
                            <td><a href="<?php echo $download;?>" download><?php echo $row1['RoFilename'];?></a></td>
                        </tr>
                        <?php
                                    $t++;}
                                }
                                else
                            {
                                echo "No record Found";
                            }
                        ?>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div id="Presentation" class="ProgressContents tab" style="display:none">
                
                <table class="table" style="display:block; height:325px; overflow: auto;">
                    <thead>
                        <tr style="position:sticky; top:0; background-color:white;">
                            <th scope="col">#</th>
                            <th scope="col">Research Title</th>
                            <th scope="col"><nobr>Date Completed</th>
                            <th scope="col"><nobr>Date Presented</th>
                            <th scope="col">Date Supporting Documents</th>
                        </tr>
                    </thead>
                    <tbody>
                        </tr>
                                <?php 
                                    $query = "SELECT * FROM researchpresentation WHERE SubmissionId IN (SELECT SubmissionId FROM submission WHERE UserId='$test')";
                                    $query_run = mysqli_query($con,$query);
                                    $t=1;
                                    if(mysqli_num_rows($query_run)>0)
                                    {
                                        while($row1 = mysqli_fetch_assoc($query_run)){

                                    ?>
                                
                                <tr>
                                    <th scope="row"><?php echo $t; ?></th>
                                    <td><?php echo $row1['RpresTitle'];?></td>
                                    <td><?php echo $row1['RpresDateCompleted'];?></td>
                                    <td><?php echo $row1['RpresDatePresent'];?></td>
                                    
                                    <?php $file = $row1['RpresTempName']; $download = 'uploads/'.$file;?> 
                                    <td><a href="<?php echo $download;?>" download><?php echo $row1['RpresFilename'];?></a></td>
                                </tr>
                            <?php
                                        $t++;}
                                    }
                                    else
                            {
                                echo "No record Found";
                            }
                            ?>
                            </tr>
                    </tbody>
                </table>
            </div>
            <div id="Citation" class="ProgressContents tab" style="display:none">
                
                <table class="table" style="display:block; height:325px; overflow: auto;">
                    <thead>
                        <tr style="position:sticky; top:0; background-color:white;">
                            <th scope="col">#</th>
                            <th scope="col">Research Title</th>
                            <th scope="col"><nobr>Date Completed</th>
                            <th scope="col">Indexing Platform</th>
                            <th scope="col">Supporting Document</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $query = "SELECT * FROM researchcitation WHERE SubmissionId IN (SELECT SubmissionId FROM submission WHERE UserId='$test')";
                            $query_run = mysqli_query($con,$query);
                            $t=1;
                            if(mysqli_num_rows($query_run)>0)
                            {
                                while($row1 = mysqli_fetch_assoc($query_run)){

                            ?>
                        
                        <tr>
                            <th scope="row"><?php echo $t; ?></th>
                            <td><?php echo $row1['RcTitle'];?></td>

                            <td><?php echo $row1['RcDateCompleted'];?></td>
                            <td><?php echo $row1['RcJournalIndexing'];?></td>
                            <?php $file = $row1['RcTempName']; $download = 'uploads/'.$file;?> 
                            <td><a href="<?php echo $download;?>" download><?php echo $row1['RcFilename'];?></a></td>
                        </tr>
                        <?php
                                    $t++;}
                                }
                            
                            else
                            {
                                echo "No record Found";
                            }
                        ?>
                            </tr>
                    </tbody>
                </table>
            </div>
            <div id="Published" class="ProgressContents tab" style="display:none">
                
                <table class="table" style="display:block; height:325px; overflow: auto;">
                    <thead>
                        <tr style="position:sticky; top:0; background-color:white;">
                            <th scope="col">#</th>
                            <th scope="col">Research Title</th>
                            <th scope="col"><nobr>Date Completed</th>
                            <th scope="col"><nobr>Date Published</th>
                            <th scope="col">Supporting Document</th>
                        </tr>
                    </thead>
                    <tbody>
                        </tr>
                            <?php 
                                $query = "SELECT * FROM researchpublication WHERE SubmissionId IN (SELECT SubmissionId FROM submission WHERE UserId='$test')";
                                $query_run = mysqli_query($con,$query);
                                $t=1;
                                if(mysqli_num_rows($query_run)>0)
                                {
                                    while($row1 = mysqli_fetch_assoc($query_run)){

                                ?>
                            
                            <tr>
                                <th scope="row"><?php echo $t; ?></th>
                                <td><?php echo $row1['RpTitle'];?></td>
                                <td><?php echo $row1['RpDateCompleted'];?></td>
                                <td><?php echo $row1['RpDatePublished'];?></td>
                                
                                <?php $file = $row1['RpTempName']; $download = 'uploads/'.$file;?> 
                                <td><a href="<?php echo $download;?>" download><?php echo $row1['RpFilename'];?></a></td>
                            </tr>
                        <?php
                                    $t++;}
                                }
                                else
                                {
                                    echo "No record Found";
                                }
                        ?>
                        </tr>
                    </tbody>
                </table>
                
            </div>
            <div style="color:#800000; margin:5px; font-weight:bold;">List of Revisions requested</div>
            <div>
                <table class="table" style="display:block; height:300px; overflow: auto;">
                    <thead>
                        <tr style="position:sticky; top:0; background-color:white;">
                            <th scope="col">#</th>
                            <th scope="col">Submission Segment</th>
                            <th scope="col"><nobr>Date Submitted</th>
                            <th scope="col">Supporting Document Submitted</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $t = 1;
                            $querysub = "SELECT DateSubmitted FROM submission WHERE SubmissionId IN (SELECT SubmissionId FROM submission WHERE UserId='$test' AND QuarterId IN(SELECT QuarterId FROM quarter WHERE QuarterProgress = 'Ongoing'))";
                            $query_runsub = mysqli_query($con,$querysub);
                            if(mysqli_num_rows($query_runsub)>0)
                            {
                                $d = mysqli_fetch_assoc($query_runsub);
                                $datesubmitted = $d['DateSubmitted'];
                            }
                            $query = "SELECT * FROM ongoingstudy WHERE RevStat = 1 AND SubmissionId IN (SELECT SubmissionId FROM submission WHERE UserId='$test' AND QuarterId IN(SELECT QuarterId FROM quarter WHERE QuarterProgress = 'Ongoing'))";
                            $query_run = mysqli_query($con,$query);
                            
                            if(mysqli_num_rows($query_run)>0)
                            {
                                while($row1 = mysqli_fetch_assoc($query_run)){

                            ?>
                        
                        <tr>
                            <th scope="row"><?php echo $t; ?></th>
                            <td><a href="AccomplishmentReportA.php">A.Ongoing/Advanced Professional Study</a></td>
                            <td><?php echo $datesubmitted; ?></td>
                            
                            <?php $file = $row1['OngoingTempName']; $download = 'uploads/'.$file;?> 
                            <td><a href="<?php echo $download;?>" download><?php echo $row1['OngoingFilename'];?></a></td>
                                
                        </tr>
                        <?php
                                $t++;}
                            }
                        ?>
                        <?php 
                            
                            $query = "SELECT * FROM awards WHERE RevStat = 1 AND SubmissionId IN (SELECT SubmissionId FROM submission WHERE UserId='$test' AND QuarterId IN(SELECT QuarterId FROM quarter WHERE QuarterProgress = 'Ongoing'))";
                            $query_run = mysqli_query($con,$query);
                            
                            if(mysqli_num_rows($query_run)>0)
                            {
                                while($row1 = mysqli_fetch_assoc($query_run)){

                            ?>
                        
                        <tr>
                            <th scope="row"><?php echo $t; ?></th>
                            <td><a href="OutstandingB.php?Record=<?php echo $row1['AwardsId']; ?>">B.1.Administrative Employees Outstanding Achievements/Awards </a></td>
                           
                            <td><?php echo $datesubmitted; ?></td>
                            <?php $file = $row1['AwTempName']; $download = 'uploads/'.$file;?> 
                            <td><a href="<?php echo $download;?>" download><?php echo $row1['AwFilename'];?></a></td>
                                
                        </tr>
                        <?php
                                $t++;}
                            }
                        ?>
                        <?php 
                            
                            $query = "SELECT * FROM membership WHERE RevStat = 1 AND SubmissionId IN (SELECT SubmissionId FROM submission WHERE UserId='$test' AND QuarterId IN(SELECT QuarterId FROM quarter WHERE QuarterProgress = 'Ongoing'))";
                            $query_run = mysqli_query($con,$query);
                            
                            if(mysqli_num_rows($query_run)>0)
                            {
                                while($row1 = mysqli_fetch_assoc($query_run)){

                            ?>
                        
                        <tr>
                            <th scope="row"><?php echo $t; ?></th>
                            <td><a href="OutstandingB2.php?Record=<?php echo $row1['MembershipId']; ?>">B.2.Officership/ Membership in Professional Organization/s</a></td>
                           
                            <td><?php echo $datesubmitted; ?></td>
                            <?php $file = $row1['MTempName']; $download = 'uploads/'.$file;?> 
                            <td><a href="<?php echo $download;?>" download><?php echo $row1['MFilename'];?></a></td>
                                
                        </tr>
                        <?php
                                $t++;}
                            }
                        ?>
                        <?php 
                            
                            $query = "SELECT * FROM attendancedp WHERE RevStat = 1 AND SubmissionId IN (SELECT SubmissionId FROM submission WHERE UserId='$test' AND QuarterId IN(SELECT QuarterId FROM quarter WHERE QuarterProgress = 'Ongoing'))";
                            $query_run = mysqli_query($con,$query);
                            
                            if(mysqli_num_rows($query_run)>0)
                            {
                                while($row1 = mysqli_fetch_assoc($query_run)){

                            ?>
                        
                        <tr>
                            <th scope="row"><?php echo $t; ?></th>
                            <td><a href="OutstandingB3.php?Record=<?php echo $row1['AdId']; ?>">B.3.1 Attendance in Relevant Administrative Employee Development Program (Seminars/ Webinars, Fora/Conferences)</a></td>
                           
                            <td><?php echo $datesubmitted; ?></td>
                            <?php $file = $row1['AdTempName']; $download = 'uploads/'.$file;?> 
                            <td><a href="<?php echo $download;?>" download><?php echo $row1['AdFilename'];?></a></td>
                                
                        </tr>
                        <?php
                                $t++;}
                            }
                        ?>
                        <?php 
                            
                            $query = "SELECT * FROM attendancet WHERE RevStat = 1 AND SubmissionId IN (SELECT SubmissionId FROM submission WHERE UserId='$test' AND QuarterId IN(SELECT QuarterId FROM quarter WHERE QuarterProgress = 'Ongoing'))";
                            $query_run = mysqli_query($con,$query);
                            
                            if(mysqli_num_rows($query_run)>0)
                            {
                                while($row1 = mysqli_fetch_assoc($query_run)){

                            ?>
                        
                        <tr>
                            <th scope="row"><?php echo $t; ?></th>
                            <td><a href="OutstandingB4.php?Record=<?php echo $row1['AtId']; ?>">B.3.2. Attendance in Training/s</a></td>
                           
                            <td><?php echo $datesubmitted; ?></td>
                            <?php $file = $row1['AtTempName']; $download = 'uploads/'.$file;?> 
                            <td><a href="<?php echo $download;?>" download><?php echo $row1['AtFilename'];?></a></td>
                                
                        </tr>
                        <?php
                                $t++;}
                            }
                        ?>

                        <?php 
                            
                            $query = "SELECT * FROM opcr WHERE RevStat = 1 AND SubmissionId IN (SELECT SubmissionId FROM submission WHERE UserId='$test' AND QuarterId IN(SELECT QuarterId FROM quarter WHERE QuarterProgress = 'Ongoing'))";
                            $query_run = mysqli_query($con,$query);
                            
                            if(mysqli_num_rows($query_run)>0)
                            {
                                while($row1 = mysqli_fetch_assoc($query_run)){

                            ?>
                        
                        <tr>
                            <th scope="row"><?php echo $t; ?></th>
                            <td><a href="AccomplishmentOPCR1.php?Record=<?php echo $row1['OpId']; ?>">II.Accomplishment Based on OPCR</a></td>
                           
                            <td><?php echo $datesubmitted; ?></td>
                            <?php $file = $row1['OpTempName']; $download = 'uploads/'.$file;?> 
                            <td><a href="<?php echo $download;?>" download><?php echo $row1['OpFilename'];?></a></td>
                                
                        </tr>
                        <?php
                                $t++;}
                            }
                        ?>
                        <?php 
                            
                            $query = "SELECT * FROM opcre WHERE RevStat = 1 AND SubmissionId IN (SELECT SubmissionId FROM submission WHERE UserId='$test' AND QuarterId IN(SELECT QuarterId FROM quarter WHERE QuarterProgress = 'Ongoing'))";
                            $query_run = mysqli_query($con,$query);
                            
                            if(mysqli_num_rows($query_run)>0)
                            {
                                while($row1 = mysqli_fetch_assoc($query_run)){

                            ?>
                        
                        <tr>
                            <th scope="row"><?php echo $t; ?></th>
                            <td><a href="AccomplishmentOPCR2.php?Record=<?php echo $row1['OeId']; ?>">II.Accomplishment Based on OPCR(Efficiency)</a></td>
                           
                            <td><?php echo $datesubmitted; ?></td>
                            <?php $file = $row1['OeTempName']; $download = 'uploads/'.$file;?> 
                            <td><a href="<?php echo $download;?>" download><?php echo $row1['OeFilename'];?></a></td>
                                
                        </tr>
                        <?php
                                $t++;}
                            }
                        ?>

                        <?php 
                            
                            $query = "SELECT * FROM opcrt WHERE RevStat = 1 AND SubmissionId IN (SELECT SubmissionId FROM submission WHERE UserId='$test' AND QuarterId IN(SELECT QuarterId FROM quarter WHERE QuarterProgress = 'Ongoing'))";
                            $query_run = mysqli_query($con,$query);
                            
                            if(mysqli_num_rows($query_run)>0)
                            {
                                while($row1 = mysqli_fetch_assoc($query_run)){

                            ?>
                        
                        <tr>
                            <th scope="row"><?php echo $t; ?></th>
                            <td><a href="AccomplishmentOPCR3.php?Record=<?php echo $row1['OtId']; ?>">II.Accomplishment Based on OPCR(Timeliness)</a></td>
                           
                            <td><?php echo $datesubmitted; ?></td>
                            <?php $file = $row1['OtTempName']; $download = 'uploads/'.$file;?> 
                            <td><a href="<?php echo $download;?>" download><?php echo $row1['OtFilename'];?></a></td>
                                
                        </tr>
                        <?php
                                $t++;}
                            }
                        ?>
                        <?php 
                            
                            $query = "SELECT * FROM attendanceu WHERE RevStat = 1 AND SubmissionId IN (SELECT SubmissionId FROM submission WHERE UserId='$test' AND QuarterId IN(SELECT QuarterId FROM quarter WHERE QuarterProgress = 'Ongoing'))";
                            $query_run = mysqli_query($con,$query);
                            
                            if(mysqli_num_rows($query_run)>0)
                            {
                                while($row1 = mysqli_fetch_assoc($query_run)){

                            ?>
                        
                        <tr>
                            <th scope="row"><?php echo $t; ?></th>
                            <td><a href="AttendanceUniversity.php?Record=<?php echo $row1['AuId']; ?>">III. Attendance in University Function</a></td>
                           
                            <td><?php echo $datesubmitted; ?></td>
                            <?php $file = $row1['AuTempName']; $download = 'uploads/'.$file;?> 
                            <td><a href="<?php echo $download;?>" download><?php echo $row1['AuFilename'];?></a></td>
                                
                        </tr>
                        <?php
                                $t++;}
                            }
                        ?>
                        <?php 
                            
                            $query = "SELECT * FROM reqandque WHERE RevStat = 1 AND SubmissionId IN (SELECT SubmissionId FROM submission WHERE UserId='$test' AND QuarterId IN(SELECT QuarterId FROM quarter WHERE QuarterProgress = 'Ongoing'))";
                            $query_run = mysqli_query($con,$query);
                            
                            if(mysqli_num_rows($query_run)>0)
                            {
                                while($row1 = mysqli_fetch_assoc($query_run)){

                            ?>
                        
                        <tr>
                            <th scope="row"><?php echo $t; ?></th>
                            <td><a href="RequestsQueries.php?Record=<?php echo $row1['ReqId']; ?>">IV. Requests and queries acted upon</a></td>
                           
                            <td><?php echo $datesubmitted; ?></td>
                            <?php $file = $row1['ReqTempName']; $download = 'uploads/'.$file;?> 
                            <td><a href="<?php echo $download;?>" download><?php echo $row1['ReqFilename'];?></a></td>
                                
                        </tr>
                        <?php
                                $t++;}
                            }
                        ?>
                        <?php 
                            
                            $query = "SELECT * FROM specialtasks WHERE RevStat = 1 AND SubmissionId IN (SELECT SubmissionId FROM submission WHERE UserId='$test' AND QuarterId IN(SELECT QuarterId FROM quarter WHERE QuarterProgress = 'Ongoing'))";
                            $query_run = mysqli_query($con,$query);
                            
                            if(mysqli_num_rows($query_run)>0)
                            {
                                while($row1 = mysqli_fetch_assoc($query_run)){

                            ?>
                        
                        <tr>
                            <th scope="row"><?php echo $t; ?></th>
                            <td><a href="SpecialTasks.php?Record=<?php echo $row1['StId']; ?>">V. Special Tasks</a></td>
                           
                            <td><?php echo $datesubmitted; ?></td>
                            <?php $file = $row1['StTempName']; $download = 'uploads/'.$file;?> 
                            <td><a href="<?php echo $download;?>" download><?php echo $row1['StFilename'];?></a></td>
                                
                        </tr>
                        <?php
                                $t++;}
                            }
                        ?>
                        <?php 
                            
                            $query = "SELECT * FROM researchongoing WHERE RevStat = 1 AND SubmissionId IN (SELECT SubmissionId FROM submission WHERE UserId='$test' AND QuarterId IN(SELECT QuarterId FROM quarter WHERE QuarterProgress = 'Ongoing'))";
                            $query_run = mysqli_query($con,$query);
                            
                            if(mysqli_num_rows($query_run)>0)
                            {
                                while($row1 = mysqli_fetch_assoc($query_run)){

                            ?>
                        
                        <tr>
                            <th scope="row"><?php echo $t; ?></th>
                            <td><a href="ResearchOngoing.php?Record=<?php echo $row1['RoId']; ?>">A. 1. Research Ongoing /Completed</a></td>
                           
                            <td><?php echo $datesubmitted; ?></td>
                            <?php $file = $row1['RoTempName']; $download = 'uploads/'.$file;?> 
                            <td><a href="<?php echo $download;?>" download><?php echo $row1['RoFilename'];?></a></td>
                                
                        </tr>
                        <?php
                                $t++;}
                            }
                        ?>
                        <?php 
                            
                            $query = "SELECT * FROM researchpublication WHERE RevStat = 1 AND SubmissionId IN (SELECT SubmissionId FROM submission WHERE UserId='$test' AND QuarterId IN(SELECT QuarterId FROM quarter WHERE QuarterProgress = 'Ongoing'))";
                            $query_run = mysqli_query($con,$query);
                            
                            if(mysqli_num_rows($query_run)>0)
                            {
                                while($row1 = mysqli_fetch_assoc($query_run)){

                            ?>
                        
                        <tr>
                            <th scope="row"><?php echo $t; ?></th>
                            <td><a href="ResearchPublication.php?Record=<?php echo $row1['RpId']; ?>">A.2. Research Publication</a></td>
                           
                            <td><?php echo $datesubmitted; ?></td>
                            <?php $file = $row1['RpTempName']; $download = 'uploads/'.$file;?> 
                            <td><a href="<?php echo $download;?>" download><?php echo $row1['RpFilename'];?></a></td>
                                
                        </tr>
                        <?php
                                $t++;}
                            }
                        ?>
                        <?php 
                            
                            $query = "SELECT * FROM researchpresentation WHERE RevStat = 1 AND SubmissionId IN (SELECT SubmissionId FROM submission WHERE UserId='$test' AND QuarterId IN(SELECT QuarterId FROM quarter WHERE QuarterProgress = 'Ongoing'))";
                            $query_run = mysqli_query($con,$query);
                            
                            if(mysqli_num_rows($query_run)>0)
                            {
                                while($row1 = mysqli_fetch_assoc($query_run)){

                            ?>
                        
                        <tr>
                            <th scope="row"><?php echo $t; ?></th>
                            <td><a href="ResearchPresentation.php?Record=<?php echo $row1['RpresId']; ?>">A.3. Research Presentation</a></td>
                           
                            <td><?php echo $datesubmitted; ?></td>
                            <?php $file = $row1['RpresTempName']; $download = 'uploads/'.$file;?> 
                            <td><a href="<?php echo $download;?>" download><?php echo $row1['RpresFilename'];?></a></td>
                                
                        </tr>
                        <?php
                                $t++;}
                            }
                        ?>
                        <?php 
                            
                            $query = "SELECT * FROM researchcitation WHERE RevStat = 1 AND SubmissionId IN (SELECT SubmissionId FROM submission WHERE UserId='$test' AND QuarterId IN(SELECT QuarterId FROM quarter WHERE QuarterProgress = 'Ongoing'))";
                            $query_run = mysqli_query($con,$query);
                            
                            if(mysqli_num_rows($query_run)>0)
                            {
                                while($row1 = mysqli_fetch_assoc($query_run)){

                            ?>
                        
                        <tr>
                            <th scope="row"><?php echo $t; ?></th>
                            <td><a href="ResearchCitation.php?Record=<?php echo $row1['CitationId']; ?>">A.4. Research Citation</a></td>
                           
                            <td><?php echo $datesubmitted; ?></td>
                            <?php $file = $row1['RcTempName']; $download = 'uploads/'.$file;?> 
                            <td><a href="<?php echo $download;?>" download><?php echo $row1['RcFilename'];?></a></td>
                                
                        </tr>
                        <?php
                                $t++;}
                            }
                        ?>
                        <?php 
                            
                            $query = "SELECT * FROM researchutilization WHERE RevStat = 1 AND SubmissionId IN (SELECT SubmissionId FROM submission WHERE UserId='$test' AND QuarterId IN(SELECT QuarterId FROM quarter WHERE QuarterProgress = 'Ongoing'))";
                            $query_run = mysqli_query($con,$query);
                            
                            if(mysqli_num_rows($query_run)>0)
                            {
                                while($row1 = mysqli_fetch_assoc($query_run)){

                            ?>
                        
                        <tr>
                            <th scope="row"><?php echo $t; ?></th>
                            <td><a href="ResearchUtilization.php?Record=<?php echo $row1['UtiId']; ?>">A.5. Research Utilization</a></td>
                           
                            <td><?php echo $datesubmitted; ?></td>
                            <?php $file = $row1['RuTempName']; $download = 'uploads/'.$file;?> 
                            <td><a href="<?php echo $download;?>" download><?php echo $row1['RuFilename'];?></a></td>
                                
                        </tr>
                        <?php
                                $t++;}
                            }
                        ?>
                        <?php 
                            
                            $query = "SELECT * FROM copyrightedoutput WHERE RevStat = 1 AND SubmissionId IN (SELECT SubmissionId FROM submission WHERE UserId='$test' AND QuarterId IN(SELECT QuarterId FROM quarter WHERE QuarterProgress = 'Ongoing'))";
                            $query_run = mysqli_query($con,$query);
                            
                            if(mysqli_num_rows($query_run)>0)
                            {
                                while($row1 = mysqli_fetch_assoc($query_run)){

                            ?>
                        
                        <tr>
                            <th scope="row"><?php echo $t; ?></th>
                            <td><a href="CopyrightedOutput.php?Record=<?php echo $row1['CoId']; ?>">A.6. Copyrighted Research Output</a></td>
                           
                            <td><?php echo $datesubmitted; ?></td>
                            <?php $file = $row1['CoTempName']; $download = 'uploads/'.$file;?> 
                            <td><a href="<?php echo $download;?>" download><?php echo $row1['CoFilename'];?></a></td>
                                
                        </tr>
                        <?php
                                $t++;}
                            }
                        ?>
                        <?php 
                            
                            $query = "SELECT * FROM iicw WHERE RevStat = 1 AND SubmissionId IN (SELECT SubmissionId FROM submission WHERE UserId='$test' AND QuarterId IN(SELECT QuarterId FROM quarter WHERE QuarterProgress = 'Ongoing'))";
                            $query_run = mysqli_query($con,$query);
                            
                            if(mysqli_num_rows($query_run)>0)
                            {
                                while($row1 = mysqli_fetch_assoc($query_run)){

                            ?>
                        
                        <tr>
                            <th scope="row"><?php echo $t; ?></th>
                            <td><a href="InventionsB.php?Record=<?php echo $row1['iicwId']; ?>">B.1 Administrative Employee Invention, Innovation and Creative Works Commitment</a></td>
                           
                            <td><?php echo $datesubmitted; ?></td>
                            <?php $file = $row1['ITempName']; $download = 'uploads/'.$file;?> 
                            <td><a href="<?php echo $download;?>" download><?php echo $row1['IFilename'];?></a></td>
                                
                        </tr>
                        <?php
                                $t++;}
                            }
                        ?>
                        <?php 
                            
                            $query = "SELECT * FROM eservice_consultant WHERE RevStat = 1 AND SubmissionId IN (SELECT SubmissionId FROM submission WHERE UserId='$test' AND QuarterId IN(SELECT QuarterId FROM quarter WHERE QuarterProgress = 'Ongoing'))";
                            $query_run = mysqli_query($con,$query);
                            
                            if(mysqli_num_rows($query_run)>0)
                            {
                                while($row1 = mysqli_fetch_assoc($query_run)){

                            ?>
                        
                        <tr>
                            <th scope="row"><?php echo $t; ?></th>
                            <td><a href="ExtensionRendered.php?Record=<?php echo $row1['EcId']; ?>">C.1. Expert Service Rendered</a></td>
                           
                            <td><?php echo $datesubmitted; ?></td>
                            <?php $file = $row1['ETempName']; $download = 'uploads/'.$file;?> 
                            <td><a href="<?php echo $download;?>" download><?php echo $row1['EFilename'];?></a></td>
                                
                        </tr>
                        <?php
                                $t++;}
                            }
                        ?>
                        <?php 
                            
                            $query = "SELECT * FROM eservice_conference WHERE RevStat = 1 AND SubmissionId IN (SELECT SubmissionId FROM submission WHERE UserId='$test' AND QuarterId IN(SELECT QuarterId FROM quarter WHERE QuarterProgress = 'Ongoing'))";
                            $query_run = mysqli_query($con,$query);
                            
                            if(mysqli_num_rows($query_run)>0)
                            {
                                while($row1 = mysqli_fetch_assoc($query_run)){

                            ?>
                        
                        <tr>
                            <th scope="row"><?php echo $t; ?></th>
                            <td><a href="ExtensionRendered2.php?Record=<?php echo $row1['ConId']; ?>">C.1. Expert Service Rendered</a></td>
                           
                            <td><?php echo $datesubmitted; ?></td>
                            <?php $file = $row1['EConferenceTempName']; $download = 'uploads/'.$file;?> 
                            <td><a href="<?php echo $download;?>" download><?php echo $row1['EConferenceFilename'];?></a></td>
                                
                        </tr>
                        <?php
                                $t++;}
                            }
                        ?>
                        <?php 
                            
                            $query = "SELECT * FROM extension_journals WHERE RevStat = 1 AND SubmissionId IN (SELECT SubmissionId FROM submission WHERE UserId='$test' AND QuarterId IN(SELECT QuarterId FROM quarter WHERE QuarterProgress = 'Ongoing'))";
                            $query_run = mysqli_query($con,$query);
                            
                            if(mysqli_num_rows($query_run)>0)
                            {
                                while($row1 = mysqli_fetch_assoc($query_run)){

                            ?>
                        
                        <tr>
                            <th scope="row"><?php echo $t; ?></th>
                            <td><a href="ExtensionRendered3.php?Record=<?php echo $row1['EjId']; ?>">C.1. Expert Service Rendered</a></td>
                           
                            <td><?php echo $datesubmitted; ?></td>
                            <?php $file = $row1['EjTempName']; $download = 'uploads/'.$file;?> 
                            <td><a href="<?php echo $download;?>" download><?php echo $row1['EjFilename'];?></a></td>
                                
                        </tr>
                        <?php
                                $t++;}
                            }
                        ?>
                        <?php 
                            
                            $query = "SELECT * FROM extensionprogram WHERE RevStat = 1 AND SubmissionId IN (SELECT SubmissionId FROM submission WHERE UserId='$test' AND QuarterId IN(SELECT QuarterId FROM quarter WHERE QuarterProgress = 'Ongoing'))";
                            $query_run = mysqli_query($con,$query);
                            
                            if(mysqli_num_rows($query_run)>0)
                            {
                                while($row1 = mysqli_fetch_assoc($query_run)){

                            ?>
                        
                        <tr>
                            <th scope="row"><?php echo $t; ?></th>
                            <td><a href="ExtensionActivity.php?Record=<?php echo $row1['EpId']; ?>">C.2. Extension Program, Project and Activity (Ongoing and Completed)</a></td>
                           
                            <td><?php echo $datesubmitted; ?></td>
                            <?php $file = $row1['EPTempName']; $download = 'uploads/'.$file;?> 
                            <td><a href="<?php echo $download;?>" download><?php echo $row1['EPFilename'];?></a></td>
                                
                        </tr>
                        <?php
                                $t++;}
                            }
                        ?>
                        <?php 
                            
                            $query = "SELECT * FROM partnership WHERE RevStat = 1 AND SubmissionId IN (SELECT SubmissionId FROM submission WHERE UserId='$test' AND QuarterId IN(SELECT QuarterId FROM quarter WHERE QuarterProgress = 'Ongoing'))";
                            $query_run = mysqli_query($con,$query);
                            
                            if(mysqli_num_rows($query_run)>0)
                            {
                                while($row1 = mysqli_fetch_assoc($query_run)){

                            ?>
                        
                        <tr>
                            <th scope="row"><?php echo $t; ?></th>
                            <td><a href="Partnerships.php?Record=<?php echo $row1['PartnershipId']; ?>">C.3.Partnership/Linkages/Network</a></td>
                           
                            <td><?php echo $datesubmitted; ?></td>
                            <?php $file = $row1['PartnershipTempName']; $download = 'uploads/'.$file;?> 
                            <td><a href="<?php echo $download;?>" download><?php echo $row1['PartnershipFilename'];?></a></td>
                                
                        </tr>
                        <?php
                                $t++;}
                            }
                        ?>
                        <?php 
                            
                            $query = "SELECT * FROM inolvementmobility WHERE RevStat = 1 AND SubmissionId IN (SELECT SubmissionId FROM submission WHERE UserId='$test' AND QuarterId IN(SELECT QuarterId FROM quarter WHERE QuarterProgress = 'Ongoing'))";
                            $query_run = mysqli_query($con,$query);
                            
                            if(mysqli_num_rows($query_run)>0)
                            {
                                while($row1 = mysqli_fetch_assoc($query_run)){

                            ?>
                        
                        <tr>
                            <th scope="row"><?php echo $t; ?></th>
                            <td><a href="InvolvementMobility.php?Record=<?php echo $row1['IMId']; ?>">C.4. Involvement in Inter-Country Mobility</a></td>
                           
                            <td><?php echo $datesubmitted; ?></td>
                            <?php $file = $row1['IMTempName']; $download = 'uploads/'.$file;?> 
                            <td><a href="<?php echo $download;?>" download><?php echo $row1['IMFilename'];?></a></td>
                                
                        </tr>
                        <?php
                                $t++;}
                            }
                        ?>
                        <?php 
                            
                            $query = "SELECT * FROM viabledemo WHERE RevStat = 1 AND SubmissionId IN (SELECT SubmissionId FROM submission WHERE UserId='$test' AND QuarterId IN(SELECT QuarterId FROM quarter WHERE QuarterProgress = 'Ongoing'))";
                            $query_run = mysqli_query($con,$query);
                            
                            if(mysqli_num_rows($query_run)>0)
                            {
                                while($row1 = mysqli_fetch_assoc($query_run)){

                            ?>
                        
                        <tr>
                            <th scope="row"><?php echo $t; ?></th>
                            <td><a href="ViableProjects.php?Record=<?php echo $row1['VdId']; ?>">D. Viable Demonstration Projects</a></td>
                           
                            <td><?php echo $datesubmitted; ?></td>
                            <?php $file = $row1['VdTempName']; $download = 'uploads/'.$file;?> 
                            <td><a href="<?php echo $download;?>" download><?php echo $row1['VdFilename'];?></a></td>
                                
                        </tr>
                        <?php
                                $t++;}
                            }
                        ?>
                        <?php 
                            
                            $query = "SELECT * FROM awardorg WHERE RevStat = 1 AND SubmissionId IN (SELECT SubmissionId FROM submission WHERE UserId='$test' AND QuarterId IN(SELECT QuarterId FROM quarter WHERE QuarterProgress = 'Ongoing'))";
                            $query_run = mysqli_query($con,$query);
                            
                            if(mysqli_num_rows($query_run)>0)
                            {
                                while($row1 = mysqli_fetch_assoc($query_run)){

                            ?>
                        
                        <tr>
                            <th scope="row"><?php echo $t; ?></th>
                            <td><a href="AwardsOrganization.php?Record=<?php echo $row1['AoId']; ?>">E. Awards/ Recognitions Received by Office from Reputable Organization</a></td>
                           
                            <td><?php echo $datesubmitted; ?></td>
                            <?php $file = $row1['AoTempName']; $download = 'uploads/'.$file;?> 
                            <td><a href="<?php echo $download;?>" download><?php echo $row1['AoFilename'];?></a></td>
                                
                        </tr>
                        <?php
                                $t++;}
                            }
                        ?>
                        <?php 
                            
                            $query = "SELECT * FROM relationprogram WHERE RevStat = 1 AND SubmissionId IN (SELECT SubmissionId FROM submission WHERE UserId='$test' AND QuarterId IN(SELECT QuarterId FROM quarter WHERE QuarterProgress = 'Ongoing'))";
                            $query_run = mysqli_query($con,$query);
                            
                            if(mysqli_num_rows($query_run)>0)
                            {
                                while($row1 = mysqli_fetch_assoc($query_run)){

                            ?>
                        
                        <tr>
                            <th scope="row"><?php echo $t; ?></th>
                            <td><a href="CommunityProgram.php?Record=<?php echo $row1['RapId']; ?>">F. Community Relation and Outreach Program</a></td>
                           
                            <td><?php echo $datesubmitted; ?></td>
                            <?php $file = $row1['RapTempName']; $download = 'uploads/'.$file;?> 
                            <td><a href="<?php echo $download;?>" download><?php echo $row1['RapFilename'];?></a></td>
                                
                        </tr>
                        <?php
                                $t++;}
                            }
                            $query = "SELECT * FROM submission WHERE RevStat = 1 AND SubmissionId IN (SELECT SubmissionId FROM submission WHERE UserId='$test' AND QuarterId IN(SELECT QuarterId FROM quarter WHERE QuarterProgress = 'Ongoing'))";
                            $query_run = mysqli_query($con,$query);
                            if(mysqli_num_rows($query_run)<0)
                            {
                                echo "No Revisions requested";
                            }
                        ?>
                        
                        
                    </tbody>
                </table>
            </div>
            <div style="color:#800000; margin:5px; font-weight:bold;">Feedback On Submitted QAR</div>
            <textarea style="padding:10px; border-color:#800000; " name="feedback" cols="91" rows="6" readonly><?php echo $feedback;?></textarea>
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
        </div>
        
    </div>
    <div class="Button-group">
        <div class="border border-light p-3 mb-4"> 
            <button id="submitbtn" class="btn btn-primary" name="submit" type="submit" style="font-weight: bold;">Submit QAR</span></button>
            <?php
                if($user_data['UserLevel']=='Researcher')
                {
                    ?>
                    <button id="higher" class="btn btn-primarys" name="submit" type="submit" style="font-weight: bold;">QAR Submissions</span></button>
                    <?php
                }
                if($user_data['UserLevel']=='Dean')
                {
                    ?>
                    <button id="dean" class="btn btn-primarys" name="submit" type="submit" style="font-weight: bold;">QAR Submissions</span></button>
                    <?php
                }
            ?>
        </div>
    </div>
</div>
<script type="text/javascript">
    document.getElementById("submitbtn").onclick = function () {
        location.href = "Insert/SubmissionInsert.php";
    };
</script>
<script type="text/javascript">
    document.getElementById("higher").onclick = function () {
        location.href = "Higher.php";
    };
</script>
<script type="text/javascript">
    document.getElementById("dean").onclick = function () {
        location.href = "Dean.php";
    };
</script>


