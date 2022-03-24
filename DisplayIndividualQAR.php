<?php
session_start();
include("connection.php");
include("functions.php");

$user_data = check_login($con);

$level = $user_data['UserLevel'];

if(isset($_POST['submission_id']))
{   
    $call = 1;
    $val = $_POST['submission_id'];

    $takestat = "SELECT SubmissionId FROM submission WHERE SubmissionId = '$val' AND QuarterId IN(SELECT QuarterId FROM quarter WHERE QuarterProgress = 'Ongoing')";
    $takestate = mysqli_query($con,$takestat);
    if(mysqli_num_rows($takestate)>0)
    {
        $que = 1;
        
    }
    else
    {
        $que = 2;
    }

    $takename = "SELECT RealName FROM user WHERE UserId=(SELECT UserId FROM submission WHERE SubmissionId = '$val')";
    $take = mysqli_query($con,$takename);
    $getname = mysqli_fetch_assoc($take);
    $name = $getname['RealName'];

    $query = "SELECT * FROM ongoingstudy WHERE SubmissionId = '$val'";
    $query_run = mysqli_query($con,$query);
    $count = mysqli_num_rows($query_run);
 
    $query2 = "SELECT * FROM awards WHERE SubmissionId = '$val'";
    $query_run2 = mysqli_query($con,$query2);
    $count2 = mysqli_num_rows($query_run2);

    $query3 = "SELECT * FROM membership WHERE SubmissionId = '$val'";
    $query_run3 = mysqli_query($con,$query3);
    $count3 = mysqli_num_rows($query_run3);

    $query4 = "SELECT * FROM attendancedp WHERE SubmissionId = '$val'";
    $query_run4 = mysqli_query($con,$query4);
    $count4 = mysqli_num_rows($query_run4);

    $query5 = "SELECT * FROM attendancet WHERE SubmissionId = '$val'";
    $query_run5 = mysqli_query($con,$query5);
    $count5 = mysqli_num_rows($query_run5);

    $query6 = "SELECT * FROM opcr WHERE SubmissionId = '$val'";
    $query_run6 = mysqli_query($con,$query6);
    $count6 = mysqli_num_rows($query_run6);

    $query7 = "SELECT * FROM opcre WHERE SubmissionId = '$val'";
    $query_run7 = mysqli_query($con,$query7);
    $count7 = mysqli_num_rows($query_run7);

    $query8 = "SELECT * FROM opcrt WHERE SubmissionId = '$val'";
    $query_run8 = mysqli_query($con,$query8);
    $count8 = mysqli_num_rows($query_run8);

    $query9 = "SELECT * FROM attendanceu WHERE SubmissionId = '$val'";
    $query_run9 = mysqli_query($con,$query9);
    $count9 = mysqli_num_rows($query_run9);

    $query10 = "SELECT * FROM reqandque WHERE SubmissionId = '$val'";
    $query_run10 = mysqli_query($con,$query10);
    $count10 = mysqli_num_rows($query_run10);

    $query11 = "SELECT * FROM specialtasks WHERE SubmissionId = '$val'";
    $query_run11 = mysqli_query($con,$query11);
    $count11 = mysqli_num_rows($query_run11);

    $query12 = "SELECT * FROM researchongoing WHERE SubmissionId = '$val'";
    $query_run12 = mysqli_query($con,$query12);
    $count12 = mysqli_num_rows($query_run12);

    $query13 = "SELECT * FROM researchpublication WHERE SubmissionId = '$val'";
    $query_run13 = mysqli_query($con,$query13);
    $count13 = mysqli_num_rows($query_run13);

    $query14 = "SELECT * FROM researchpresentation WHERE SubmissionId = '$val'";
    $query_run14 = mysqli_query($con,$query14);
    $count14 = mysqli_num_rows($query_run14);

    $query15 = "SELECT * FROM researchcitation WHERE SubmissionId = '$val'";
    $query_run15 = mysqli_query($con,$query15);
    $count15 = mysqli_num_rows($query_run15);

    $query16 = "SELECT * FROM researchutilization WHERE SubmissionId = '$val'";
    $query_run16 = mysqli_query($con,$query16);
    $count16 = mysqli_num_rows($query_run16);

    $query17 = "SELECT * FROM copyrightedoutput WHERE SubmissionId = '$val'";
    $query_run17 = mysqli_query($con,$query17);
    $count17 = mysqli_num_rows($query_run17);

    $query18 = "SELECT * FROM iicw WHERE SubmissionId = '$val'";
    $query_run18 = mysqli_query($con,$query18);
    $count18 = mysqli_num_rows($query_run18);

    $query19 = "SELECT * FROM eservice_consultant WHERE SubmissionId = '$val'";
    $query_run19 = mysqli_query($con,$query19);
    $count19 = mysqli_num_rows($query_run19);

    $query20 = "SELECT * FROM eservice_conference WHERE SubmissionId = '$val'";
    $query_run20 = mysqli_query($con,$query20);
    $count20 = mysqli_num_rows($query_run20);

    $query21 = "SELECT * FROM extension_journals WHERE SubmissionId = '$val'";
    $query_run21 = mysqli_query($con,$query21);
    $count21 = mysqli_num_rows($query_run21);

    $query22 = "SELECT * FROM extensionprogram WHERE SubmissionId = '$val'";
    $query_run22 = mysqli_query($con,$query22);
    $count22 = mysqli_num_rows($query_run22);

    $query23 = "SELECT * FROM partnership WHERE SubmissionId = '$val'";
    $query_run23 = mysqli_query($con,$query23);
    $count23 = mysqli_num_rows($query_run23);

    $query24 = "SELECT * FROM inolvementmobility WHERE SubmissionId = '$val'";
    $query_run24 = mysqli_query($con,$query24);
    $count24 = mysqli_num_rows($query_run24);

    $query25 = "SELECT * FROM viabledemo WHERE SubmissionId = '$val'";
    $query_run25 = mysqli_query($con,$query25);
    $count25 = mysqli_num_rows($query_run25);

    $query26 = "SELECT * FROM awardorg WHERE SubmissionId = '$val'";
    $query_run26 = mysqli_query($con,$query26);
    $count26 = mysqli_num_rows($query_run26);

    $query27 = "SELECT * FROM relationprogram WHERE SubmissionId = '$val'";
    $query_run27 = mysqli_query($con,$query27);
    $count27 = mysqli_num_rows($query_run27);

    

    


?>
    <div class="tableContainer">
    <input id="call" type="hidden" value="<?php echo $call; ?>">
    <input id="userId" type="hidden" value="<?php echo $val; ?>">
        <h4><?php echo $name; ?></h4>
        <?php if($count){?>
        <table class="table-main">
            <h4 style="margin:0 auto; align-items:center; justify-content:center; text-align:center;">I. ACCOMPLISHMENT REPORT </h4>
            <h4>A.  ONGOING ADVANCED/ PROFESSIONAL  STUDY  </h4>
            <thead>
                <tr>
                    <th>Degree/Program</th>
                    <th>School Name</th>
                    <th>Program Accreditation Level/ World Ranking/ COE or COD*</th>
                    <th>Type of Support</th>
                    <th>Name of Sponsor/ Agency/ Organization</th>
                    <th>Amount</th>
                    <th><nobr>Duration (From)</th>
                    <th><nobr>Duration (To)</th>
                    <th>Status</th>
                    <th>Number of Units earned </th>
                    <th>Number of units currently enrolled</th>
                    <th>Supporting Document</th>
                    <?php
                        if($level == 'Dean' && $que == 1)
                        {
                            ?>
                            <th><nobr>Mark for Revision</th>
                            
                            <?php
                        }
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                while($row1 = mysqli_fetch_assoc($query_run)){
                        $rower1 = $row1['OngoingId'];
                    ?>
                
                <tr>
                    <td><?php echo $row1['Deg'];?></td>
                    <td><?php echo $row1['SchoolName'];?></td>
                    <td><?php echo $row1['SchoolLevel'];?></td>
                    <td><?php echo $row1['SupportType'];?></td>
                    <td><?php echo $row1['SponsorName'];?></td>
                    <td><?php echo $row1['Amount'];?></td>
                    <td><?php echo $row1['OngoingFrom'];?></td>
                    <td><?php echo $row1['OngoingTo'];?></td>
                    <td><?php echo $row1['OngoingStatus'];?></td>
                    <td><?php echo $row1['NumUnits'];?></td>
                    <td><?php echo $row1['NumEnrolled'];?></td>
                    <?php $file = $row1['OngoingTempName']; $download = 'uploads/'.$file;?> 
                    <td><a href="<?php echo $download;?>" download><?php echo $row1['OngoingFilename'];?></a></td>
                    <?php
                        if($level == 'Dean' && $que == 1)
                        {
                            if($row1['RevStat']== 1)
                            {

                            
                            ?>
                            <td style="text-align:center;">
                                
                                    <input class="revision" style="text-align:center; padding:0; vertical-align:middle;" type="checkbox" name="revision" id='revision' value="<?php echo "1 $rower1"; ?>" onchange="revise(this.value,this)" checked>
                                   
                                
                            </td>
                            <?php
                            }
                            else
                            {

                            
                            ?>
                            <td style="text-align:center;">
                                
                                    <input class="revision" style="text-align:center; padding:0; vertical-align:middle;" type="checkbox" name="revision" id='revision' value="<?php echo "1 $rower1"; ?>" onchange="revise(this.value,this)">
                                 
                               
                            </td>
                           
                            <?php
                            }
                        }
                    ?>
                </tr>
                <?php
                    $i++;} 
                }               
                ?>
            </tbody>
        </table>
        <?php

        if($count2){ ?>
        <table class="table-main">
            <h4 style="margin:0 auto; align-items:center; justify-content:center;">B. OUTSTANDING ACHIEVEMENTS/ AWARDS, OFFICERSHIP/MEMBERSHIP IN PROFESSIONAL ORGANIZATION/S, & TRAININGS/ SEMINARS ATTENDED</h4>
            <h4>B. 1. Administrative Employees Outstanding Achievements/Awards </h4>
            <thead>
                <tr>
                    <th>Awards of distinction received in recognition of achievement in relevant areas of specialization/profession and/or assignment of Administrative Employee concerned</th>
                    <th>Classification</th>
                    <th>Award Giving Body</th>
                    <th>Level</th>
                    <th>Venue</th>
                    <th><nobr>Inclusive Date/ Date of Awards(From)</th>
                    <th><nobr>Inclusive Date/ Date of Awards(To)</th>
                    <th>Supporting Document</th>
                    <?php
                        if($level == 'Dean' && $que == 1)
                        {
                            ?>
                            <th><nobr>Mark for Revision</th>
                            
                            <?php
                        }
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                while($row1 = mysqli_fetch_assoc($query_run2)){
                    $rower2 = $row1['AwardsId'];
        
                    ?>
                
                <tr>
                    <td><?php echo $row1['AwAward'];?></td>
                    <td><?php echo $row1['AwClass'];?></td>
                    <td><?php echo $row1['AwBody'];?></td>
                    <td><?php echo $row1['AwLevel'];?></td>
                    <td><?php echo $row1['AwVenue'];?></td>
                    <td><?php echo $row1['AwDateFrom'];?></td>
                    <td><?php echo $row1['AwDateTo'];?></td>
                    <?php $file = $row1['AwTempName']; $download = 'uploads/'.$file;?> 
                    <td><a href="<?php echo $download;?>" download><?php echo $row1['AwFilename'];?></a></td>
                    <?php
                        if($level == 'Dean')
                        {
                            if($row1['RevStat']== 1)
                            {

                            
                            ?>
                            <td style="text-align:center;">
                                
                                    <input class="revision" style="text-align:center; padding:0; vertical-align:middle;" type="checkbox" name="revision2" id='revision2' value="<?php echo "2 $rower2"; ?>" onchange="revise(this.value,this)" checked>
                                    
                                </div>
                            </td>
                            <?php
                            }
                            else
                            {
                            ?>
                            
                            <td style="text-align:center;">
                               
                                    <input class="revision" style="text-align:center; padding:0; vertical-align:middle;" type="checkbox" name="revision2" id='revision2' value="<?php echo "2 $rower2"; ?>" onchange="revise(this.value,this)">
                                    
                                </div>
                            </td>
                           
                            <?php
                            }
                        }
                    ?>
                </tr>
                <?php
                    $i++;}
                }               
                ?>
            </tbody>
        </table>
        <?php

        if($count3){ ?>
        <table class="table-main">
            <h4>B. 2. Officership/ Membership in Professional Organization/s</h4>
            <thead>
                <tr>
                    <th>Name of the Organization</th>
                    <th>Classification</th>
                    <th>Position</th>
                    <th>Level</th>
                    <th>Organization Address</th>
                    <th><nobr>Inclusive Date/ Date (From)</th>
                    <th><nobr>Inclusive Date/ Date (To)</th>
                    <th>Supporting Document</th>
                    <?php
                        if($level == 'Dean' && $que == 1)
                        {
                            ?>
                            <th><nobr>Mark for Revision</th>
                            
                            <?php
                        }
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                while($row1 = mysqli_fetch_assoc($query_run3)){
                    $rower3 = $row1['MembershipId'];
                    ?>
                
                <tr>
                    <td><?php echo $row1['MName'];?></td>
                    <td><?php echo $row1['MClass'];?></td>
                    <td><?php echo $row1['MPosition'];?></td>
                    <td><?php echo $row1['MLevel'];?></td>
                    <td><?php echo $row1['MAddress'];?></td>
                    <td><?php echo $row1['MDateFrom'];?></td>
                    <td><?php echo $row1['MDateTo'];?></td>
                    <?php $file = $row1['MTempName']; $download = 'uploads/'.$file;?> 
                    <td><a href="<?php echo $download;?>" download><?php echo $row1['MFilename'];?></a></td>
                    <?php
                        if($level == 'Dean' && $que == 1)
                        {
                            if($row1['RevStat']== 1)
                            {

                            
                            ?>
                            <td style="text-align:center;">
                                
                                    <input class="revision" style="text-align:center; padding:0; vertical-align:middle;" type="checkbox" name="revision3" id='revision3' value="<?php echo "3 $rower3"; ?>" onchange="revise(this.value,this)" checked>
                                    
                               
                            </td>
                            <?php
                            }
                            else
                            {
                            ?>
                            
                            <td style="text-align:center;">
                                
                                    <input class="revision" style="text-align:center; padding:0; vertical-align:middle;" type="checkbox" name="revision3" id='revision3' value="<?php echo "3 $rower3"; ?>" onchange="revise(this.value,this)">
                                    
                             
                            </td>
                           
                            <?php
                            }
                        }
                    ?>
                </tr>
                <?php
                    $i++;}
                }               
                ?>
            </tbody>
        </table>
        <?php

        if($count4){ ?>
        <table class="table-main">
            <h4>B.3.1 Attendance in Relevant Administrative Employee Development Program (Seminars/ Webinars, Fora/Conferences) </h4>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Classification</th>
                    <th>Nature</th>
                    <th><nobr>Budget (In PhP)</th>
                    <th>Source of Fund</th>
                    <th>Organizer</th>
                    <th>Level</th>
                    <th>Venue</th>
                    <th><nobr>Inclusive Date/ Date (From)</th>
                    <th><nobr>Inclusive Date/ Date (To)</th>
                    <th>Total No. of Hours</th>
                    <th>Supporting Document</th>
                    <?php
                        if($level == 'Dean' && $que == 1)
                        {
                            ?>
                            <th><nobr>Mark for Revision</th>
                            
                            <?php
                        }
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                while($row1 = mysqli_fetch_assoc($query_run4)){
                    $rower4 = $row1['AdId'];
                    ?>
                
                <tr>
                    <td><?php echo $row1['AdTitle'];?></td>
                    <td><?php echo $row1['AdClass'];?></td>
                    <td><?php echo $row1['AdNature'];?></td>
                    <td><?php echo $row1['AdBudget'];?></td>
                    <td><?php echo $row1['AdSource'];?></td>
                    <td><?php echo $row1['AdOrganizer'];?></td>
                    <td><?php echo $row1['AdLevel'];?></td>
                    <td><?php echo $row1['AdVenue'];?></td>
                    <td><?php echo $row1['AdDateFrom'];?></td>
                    <td><?php echo $row1['AdDateTo'];?></td>
                    <td><?php echo $row1['AdHours'];?></td>
                    <?php $file = $row1['AdTempName']; $download = 'uploads/'.$file;?> 
                    <td><a href="<?php echo $download;?>" download><?php echo $row1['AdFilename'];?></a></td>
                    <?php
                        if($level == 'Dean')
                        {
                            if($row1['RevStat']== 1)
                            {

                            
                            ?>
                            <td style="text-align:center;">
                                
                                    <input class="revision" style="text-align:center; padding:0; vertical-align:middle;" type="checkbox" name="revision3" id='revision3' value="<?php echo "4 $rower4"; ?>" onchange="revise(this.value,this)" checked>
                                    
                            </td>
                            <?php
                            }
                            else
                            {
                            ?>
                            
                            <td style="text-align:center;">
                                <div class="revision">
                                    <input style="text-align:center; padding:0; vertical-align:middle;" type="checkbox" name="revision3" id='revision3' value="<?php echo "4 $rower4"; ?>" onchange="revise(this.value,this)">
                                    <label for="revision"></label>
                                </div>
                            </td>
                           
                            <?php
                            }
                        }
                    ?>
                </tr>
                <?php
                    $i++;}
                }               
                ?>
            </tbody>
        </table>
        <?php

        if($count5){ ?>
        <table class="table-main">
            <h4>B.3.2. Attendance in Training/s</h4>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Classification</th>
                    <th>Nature</th>
                    <th><nobr>Budget (In PhP)</th>
                    <th><nobr>Source of Fund</th>
                    <th>Organizer</th>
                    <th>Level</th>
                    <th>Venue</th>
                    <th><nobr>Inclusive Date/ Date (From)</th>
                    <th><nobr>Inclusive Date/ Date (To)</th>
                    <th>Total No. of Hours</th>
                    <th>Supporting Documents Submitted (MOA/MOU, Certificate of Recognitions/Appreciations)</th>
                    <?php
                        if($level == 'Dean' && $que == 1)
                        {
                            ?>
                            <th><nobr>Mark for Revision</th>
                            
                            <?php
                        }
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                while($row1 = mysqli_fetch_assoc($query_run5)){
                    $rower5 = $row1['AtId'];
                    ?>
                
                <tr>
                    <td><?php echo $row1['AtTitle'];?></td>
                    <td><?php echo $row1['AtClass'];?></td>
                    <td><?php echo $row1['AtNature'];?></td>
                    <td><?php echo $row1['AtBudget'];?></td>
                    <td><?php echo $row1['AtSource'];?></td>
                    <td><?php echo $row1['AtOrganizer'];?></td>
                    <td><?php echo $row1['AtLevel'];?></td>
                    <td><?php echo $row1['AtVenue'];?></td>
                    <td><?php echo $row1['AtDateFrom'];?></td>
                    <td><?php echo $row1['AtDateTo'];?></td>
                    <td><?php echo $row1['AtHours'];?></td>
                    <?php $file = $row1['AtTempName']; $download = 'uploads/'.$file;?> 
                    <td><a href="<?php echo $download;?>" download><?php echo $row1['AtFilename'];?></a></td>
                    <?php
                        if($level == 'Dean')
                        {
                            if($row1['RevStat']== 1)
                            {

                            
                            ?>
                            <td style="text-align:center;">
                               
                                    <input class="revision" style="text-align:center; padding:0; vertical-align:middle;" type="checkbox" name="revision3" id='revision3' value="<?php echo "5 $rower5"; ?>" onchange="revise(this.value,this)" checked>
                                   
                            </td>
                            <?php
                            }
                            else
                            {
                            ?>
                            
                            <td style="text-align:center;">
                               
                                    <input class="revision" style="text-align:center; padding:0; vertical-align:middle;" type="checkbox" name="revision3" id='revision3' value="<?php echo "5 $rower5"; ?>" onchange="revise(this.value,this)">
                                    
                            </td>
                           
                            <?php
                            }
                        }
                    ?>
                </tr>
                <?php
                    $i++;}
                }               
                ?>
            </tbody>
        </table>
        <?php

        if($count6){ ?>
        <table class="table-main">
        <h4 style="margin:0 auto; align-items:center; justify-content:center; text-align:center;">II. ACCOMPLISHMENTS BASED ON OPCR</h4>
            <thead>
                <tr>
                    <th>Final Output</th>
                   
                    <th><nobr>Target Date</th>
                    <th><nobr>Actual Date</th>
                    <th>Description of Accomplishment</th>
                    <th>Status</th>
                    <th>Status/Remarks</th>
                    <th>Supporting Documents Submitted</th>
                    <?php
                        if($level == 'Dean' && $que == 1)
                        {
                            ?>
                            <th><nobr>Mark for Revision</th>
                            
                            <?php
                        }
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                while($row1 = mysqli_fetch_assoc($query_run6)){
                    $rower6 = $row1['OpId'];
                    ?>
                
                <tr>
                    <td><?php echo $row1['OpOutput'];?></td>
                    <td><?php echo $row1['OpTargetDate'];?></td>
                    <td><?php echo $row1['OpActualDate'];?></td>
                    <td><?php echo $row1['OpDesc'];?></td>
                    <td><?php echo $row1['OpStatus'];?></td>
                    <td><?php echo $row1['OpRemarks'];?></td>
                    <?php $file = $row1['OpTempName']; $download = 'uploads/'.$file;?> 
                    <td><a href="<?php echo $download;?>" download><?php echo $row1['OpFilename'];?></a></td>
                    <?php
                        if($level == 'Dean' && $que == 1)
                        {
                            if($row1['RevStat']== 1)
                            {

                            
                            ?>
                            <td style="text-align:center;">
                                
                                    <input class="revision" style="text-align:center; padding:0; vertical-align:middle;" type="checkbox" name="revision3" id='revision3' value="<?php echo "6 $rower6"; ?>" onchange="revise(this.value,this)" checked>
                                    
                            </td>
                            <?php
                            }
                            else
                            {
                            ?>
                            
                            <td style="text-align:center;">
                                
                                    <input class = "revision" style="text-align:center; padding:0; vertical-align:middle;" type="checkbox" name="revision3" id='revision3' value="<?php echo "6 $rower6"; ?>" onchange="revise(this.value,this)">
                                   
                            </td>
                           
                            <?php
                            }
                        }
                    ?>
                </tr>
                <?php
                    $i++;}
                }               
                ?>
            </tbody>
        </table>

        <?php

        if($count7){ ?>
        <table class="table-main">
        <h4>Commitment Measurable by Efficiency</h4>
            <thead>
                <tr>
                    <th>Final Output</th>
                    
                    <th><nobr>Target Date</th>
                    <th><nobr>Actual Date</th>
                    <th>Description of Accomplishment</th>
                    <th>Status</th>
                    <th>Status/Remarks</th>
                    <th>Supporting Documents Submitted</th>
                    <?php
                        if($level == 'Dean' && $que == 1)
                        {
                            ?>
                            <th><nobr>Mark for Revision</th>
                            
                            <?php
                        }
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                while($row1 = mysqli_fetch_assoc($query_run7)){
                    $rower7 = $row1['OeId'];
                    ?>
                
                <tr>
                    <td><?php echo $row1['OeOutput'];?></td>
                    <td><?php echo $row1['OeTargetDate'];?></td>
                    <td><?php echo $row1['OeActualDate'];?></td>
                    <td><?php echo $row1['OeDesc'];?></td>
                    <td><?php echo $row1['OeStatus'];?></td>
                    <td><?php echo $row1['OeRemarks'];?></td>
                    <?php $file = $row1['OeTempName']; $download = 'uploads/'.$file;?> 
                    <td><a href="<?php echo $download;?>" download><?php echo $row1['OeFilename'];?></a></td>
                    <?php
                        if($level == 'Dean' && $que == 1)
                        {
                            if($row1['RevStat']== 1)
                            {

                            
                            ?>
                            <td style="text-align:center;">
                                
                                    <input class = "revision" style="text-align:center; padding:0; vertical-align:middle;" type="checkbox" name="revision3" id='revision3' value="<?php echo "7 $rower7"; ?>" onchange="revise(this.value,this)" checked>
                                   
                            </td>
                            <?php
                            }
                            else
                            {
                            ?>
                            
                            <td style="text-align:center;">
                                
                                    <input class = "revision" style="text-align:center; padding:0; vertical-align:middle;" type="checkbox" name="revision3" id='revision3' value="<?php echo "7 $rower7"; ?>" onchange="revise(this.value,this)">
                                    
                            </td>
                           
                            <?php
                            }
                        }
                    ?>
                </tr>
                <?php
                    $i++;}
                }               
                ?>
            </tbody>
        </table>
        <?php

        if($count8){ ?>
        <table class="table-main">
        <h4>Commitment Measurable by Timeliness</h4>
            <thead>
                <tr>
                    <th>Final Output</th>
                    
                    <th><nobr>Target Date</th>
                    <th><nobr>Actual Date</th>
                    <th>Description of Accomplishment</th>
                    <th>Status</th>
                    <th>Status/Remarks</th>
                    <th>Supporting Documents Submitted</th>
                    <?php
                        if($level == 'Dean' && $que == 1)
                        {
                            ?>
                            <th><nobr>Mark for Revision</th>
                            
                            <?php
                        }
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                while($row1 = mysqli_fetch_assoc($query_run8)){
                    $rower8 = $row1['OtId'];
                    ?>
                
                <tr>
                    <td><?php echo $row1['OtOutput'];?></td>
                    <td><?php echo $row1['OtTargetDate'];?></td>
                    <td><?php echo $row1['OtActualDate'];?></td>
                    <td><?php echo $row1['OtDesc'];?></td>
                    <td><?php echo $row1['OtStatus'];?></td>
                    <td><?php echo $row1['OtRemarks'];?></td>
                    <?php $file = $row1['OtTempName']; $download = 'uploads/'.$file;?> 
                    <td><a href="<?php echo $download;?>" download><?php echo $row1['OtFilename'];?></a></td>
                    <?php
                        if($level == 'Dean')
                        {
                            if($row1['RevStat']== 1)
                            {

                            
                            ?>
                            <td style="text-align:center;">
                                
                                    <input class = "revision" style="text-align:center; padding:0; vertical-align:middle;" type="checkbox" name="revision3" id='revision3' value="<?php echo "8 $rower8"; ?>" onchange="revise(this.value,this)" checked>
                                    
                            </td>
                            <?php
                            }
                            else
                            {
                            ?>
                            
                            <td style="text-align:center;">
                                
                                    <input class = "revision" style="text-align:center; padding:0; vertical-align:middle;" type="checkbox" name="revision3" id='revision3' value="<?php echo "8 $rower8"; ?>" onchange="revise(this.value,this)">
                                    
                            </td>
                           
                            <?php
                            }
                        }
                    ?>
                </tr>
                <?php
                    $i++;}
                }               
                ?>
            </tbody>
        </table>

        <?php

        if($count9){ ?>
        <table class="table-main">
        <h4 style="margin:0 auto; align-items:center; justify-content:center; text-align:center;">III. Attendance in University Function</h4>
            <thead>
                <tr>
                    <th>Brief Description of Activity</th>
                    <th><nobr>Date Started</th>
                    <th><nobr>Date Completed</th>
                    <th>Status of Attendance</th>
                    <th>Proof of Compliance</th>
                    <?php
                        if($level == 'Dean' && $que == 1)
                        {
                            ?>
                            <th><nobr>Mark for Revision</th>
                            
                            <?php
                        }
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                while($row1 = mysqli_fetch_assoc($query_run9)){
                    $rower9 = $row1['AuId'];
                    ?>
                
                <tr>
                    <td><?php echo $row1['AuDesc'];?></td>
                    <td><?php echo $row1['AuDateStart'];?></td>
                    <td><?php echo $row1['AuDateComp'];?></td>
                    <td><?php echo $row1['AuStatus'];?></td>
                    <?php $file = $row1['AuTempName']; $download = 'uploads/'.$file;?> 
                    <td><a href="<?php echo $download;?>" download><?php echo $row1['AuFilename'];?></a></td>
                    <?php
                        if($level == 'Dean' && $que == 1)
                        {
                            if($row1['RevStat']== 1)
                            {

                            
                            ?>
                            <td style="text-align:center;">
                               
                                    <input class = "revision" style="text-align:center; padding:0; vertical-align:middle;" type="checkbox" name="revision3" id='revision3' value="<?php echo "9 $rower9"; ?>" onchange="revise(this.value,this)" checked>
                                    
                            </td>
                            <?php
                            }
                            else
                            {
                            ?>
                            
                            <td style="text-align:center;">
                                
                                    <input class = "revision" style="text-align:center; padding:0; vertical-align:middle;" type="checkbox" name="revision3" id='revision3' value="<?php echo "9 $rower9"; ?>" onchange="revise(this.value,this)">
                                    
                            </td>
                           
                            <?php
                            }
                        }
                    ?>
                </tr>
                <?php
                    $i++;}
                }               
                ?>
            </tbody>
        </table>
        <?php

        if($count10){ ?>
        <table class="table-main">
        <h4 style="margin:0 auto; align-items:center; justify-content:center; text-align:center;">IV. Requests and queries acted upon</h4>
            <thead>
                <tr>
                    <th>Number of Written Reports Acted Upon</th>
                    <th>Brief Description of Request</th>
                    <th>Average Days/ Time or Processing</th>
                    <th>Category</th>
                    <th>Supporting Documents Submitted</th>
                    <?php
                        if($level == 'Dean' && $que == 1)
                        {
                            ?>
                            <th><nobr>Mark for Revision</th>
                            
                            <?php
                        }
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                while($row1 = mysqli_fetch_assoc($query_run10)){
                    $rower10 = $row1['ReqId'];
        
                    ?>
                
                <tr>
                    <td><?php echo $row1['ReqActed'];?></td>
                    <td><?php echo $row1['ReqDesc'];?></td>
                    <td><?php echo $row1['ReqAverageTime'];?></td>
                    <td><?php echo $row1['ReqCategory'];?></td>
                    <?php $file = $row1['ReqTempName']; $download = 'uploads/'.$file;?> 
                    <td><a href="<?php echo $download;?>" download><?php echo $row1['ReqFilename'];?></a></td>
                    <?php
                        if($level == 'Dean' && $que == 1)
                        {
                            if($row1['RevStat']== 1)
                            {

                            
                            ?>
                            <td style="text-align:center;">
                            
                                    <input class = "revision" style="text-align:center; padding:0; vertical-align:middle;" type="checkbox" name="revision3" id='revision3' value="<?php echo "10 $rower10"; ?>" onchange="revise(this.value,this)" checked>
                                    
                            </td>
                            <?php
                            }
                            else
                            {
                            ?>
                            
                            <td style="text-align:center;">
                              
                                    <input class = "revision" style="text-align:center; padding:0; vertical-align:middle;" type="checkbox" name="revision3" id='revision3' value="<?php echo "10 $rower10"; ?>" onchange="revise(this.value,this)">
                                   
                            </td>
                           
                            <?php
                            }
                        }
                    ?>
                </tr>
                <?php
                    $i++;}
                }               
                ?>
            </tbody>
        </table>
        <?php

        if($count11){ ?>
        <table class="table-main">
        <h4 style="margin:0 auto; align-items:center; justify-content:center; text-align:center;">V. Special Tasks</h4>
            <thead>
                <tr>
                    <th>Brief Description of Accomplishment</th>
                    <th>Output</th>
                    <th>Outcome</th>
                    <th>Participation/Significant Contribution</th>
                    <th>Special Order</th>
                    <th>Level</th>
                    <th><nobr>Inclusive Date (From)</th>
                    <th><nobr>Inclusive Date (To)</th>
                    <th>Nature of Accomplishment</th>
                    <th>Supporting Documents Submitted</th>
                    <?php
                        if($level == 'Dean' && $que == 1)
                        {
                            ?>
                            <th><nobr>Mark for Revision</th>
                            
                            <?php
                        }
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                while($row1 = mysqli_fetch_assoc($query_run11)){
                    $rower11 = $row1['StId'];
                    ?>
                
                <tr>
                    <td><?php echo $row1['StDesc'];?></td>
                    <td><?php echo $row1['StOutput'];?></td>
                    <td><?php echo $row1['StOutcome'];?></td>
                    <td><?php echo $row1['StParticipation'];?></td>
                    <td><?php echo $row1['StSpecial'];?></td>
                    <td><?php echo $row1['StLevel'];?></td>
                    <td><?php echo $row1['StDateFrom'];?></td>
                    <td><?php echo $row1['StDateTo'];?></td>
                    <td><?php echo $row1['StNature'];?></td>
                    <?php $file = $row1['StTempName']; $download = 'uploads/'.$file;?> 
                    <td><a href="<?php echo $download;?>" download><?php echo $row1['StFilename'];?></a></td>
                    <?php
                        if($level == 'Dean' && $que == 1)
                        {
                            if($row1['RevStat']== 1)
                            {

                            
                            ?>
                            <td style="text-align:center;">
                                
                                    <input class = "revision" style="text-align:center; padding:0; vertical-align:middle;" type="checkbox" name="revision3" id='revision3' value="<?php echo "11 $rower11"; ?>" onchange="revise(this.value,this)" checked>
                                    
                             
                            </td>
                            <?php
                            }
                            else
                            {
                            ?>
                            
                            <td style="text-align:center;">
                               
                                    <input class = "revision" style="text-align:center; padding:0; vertical-align:middle;" type="checkbox" name="revision3" id='revision3' value="<?php echo "11 $rower11"; ?>" onchange="revise(this.value,this)">
                                    
                            </td>
                           
                            <?php
                            }
                        }
                    ?>
                </tr>
                <?php
                    $i++;}
                }               
                ?>
            </tbody>
        </table>
        <?php

        if($count12){ ?>
        <table class="table-main">
        <h4 style="margin:0 auto; align-items:center; justify-content:center; text-align:center;">VI. Other Accomplishments (If Any)</h4>
        <h4>A. Research & Book Chapter (Production, Citation, Presentation)</h4>
        <h4>A. 1. Research Ongoing /Completed</h4>
            <thead>
                <tr>
                    <th>Research Classification</th>
                    <th>Category</th>
                    <th>University Research Agenda</th>
                    <th>Title of Research</th>
                    <th>Researcher/s (Surname, First Name, M.I.)</th>
                    <th>Nature of Involvement</th>
                    <th>Type of Research</th>
                    <th>Keywords(at least five (5) keywords)</th>
                    <th>Type of Funding</th>
                    <th>Amount of Funding</th>
                    <th>Funding Agency</th>
                    <th><nobr>Actual Date Started</th>
                    <th><nobr>Target Date of Completion</th>
                    <th>Status</th>
                    <th><nobr>Date Completed</th>
                    <th>Supporting Documents Submitted</th>
                    <?php
                        if($level == 'Dean' && $que == 1)
                        {
                            ?>
                            <th><nobr>Mark for Revision</th>
                            
                            <?php
                        }
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                $n = null;
                while($row1 = mysqli_fetch_assoc($query_run12))
                    
                {
                    $rower12 = $row1['RoId'];
                    $t=1;
                    $rescount=0;
                    $researcher = array();
                    $n = $row1['RoId'];
                    $rname = "SELECT RoName FROM ro_name WHERE RoId = '$n'";
                    $resname = mysqli_query($con,$rname);
                    $countres = mysqli_num_rows($resname);
                    $researcher = mysqli_fetch_all($resname);

                    $rword = "SELECT * FROM ro_keywords WHERE RoId = '$n'";
                    $keywords = mysqli_query($con,$rword);
                    $countword = mysqli_num_rows($keywords);

                    while($rowkey = mysqli_fetch_assoc($keywords))
                    {
                       
                        
                        if($t==1)
                        {
                            
                    ?>
                
                        <tr>
                            <td><?php echo $row1['RoClass'];?></td>
                            <td><?php echo $row1['RoCategory'];?></td>
                            <td><?php echo $row1['RoAgenda'];?></td>
                            <td><?php echo $row1['RoTitle'];?></td>
                            <td><?php echo $researcher[$rescount][0];?></td>
                            
                            
                            
                            <td><?php echo $row1['RoInvolve'];?></td>
                            <td><?php echo $row1['RoType'];?></td>
                            <td><?php echo $rowkey['RoKeyword'];?></td>
                            <td><?php echo $row1['RoFundType'];?></td>
                            <td><?php echo $row1['RoFundAmount'];?></td>
                            <td><?php echo $row1['RoFundAgency'];?></td>
                            <td><?php echo $row1['RoDateStart'];?></td>
                            <td><?php echo $row1['RoDateTarget'];?></td>
                            <td><?php echo $row1['RoStatus'];?></td>
                            <td><?php echo $row1['RoDateCompleted'];?></td>
                            <?php $file = $row1['RoTempName']; $download = 'uploads/'.$file;?> 
                            <td><a href="<?php echo $download;?>" download><?php echo $row1['RoFilename'];?></a></td>
                            <?php
                                if($level == 'Dean' && $que == 1)
                                {
                                    if($row1['RevStat']== 1)
                                    {

                                    
                                    ?>
                                    <td style="text-align:center;">
                                        
                                            <input class = "revision" style="text-align:center; padding:0; vertical-align:middle;" type="checkbox" name="revision3" id='revision3' value="<?php echo "12 $rower12"; ?>" onchange="revise(this.value,this)" checked>
                                            
                                    </td>
                                    <?php
                                    }
                                    else
                                    {
                                    ?>
                                    
                                    <td style="text-align:center;">
                                       
                                            <input class = "revision" style="text-align:center; padding:0; vertical-align:middle;" type="checkbox" name="revision3" id='revision3' value="<?php echo "12 $rower12"; ?>" onchange="revise(this.value,this)">
                                           
                                    </td>
                                
                                    <?php
                                    }
                                }
                            ?>
                        </tr>
                    <?php
                        }
                        else
                        {
                            ?>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><?php if($rescount < $countres) {echo $researcher[$rescount][0];}?></td>
                            

                            <td></td>
                            <td></td>
                            <td><?php if($rowkey['RoKeyword']!=null){echo $rowkey['RoKeyword'];}?></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    <?php }
                
                        $t++; $rescount++;}
                        $i++;}
                }               
                ?>
            </tbody>
        </table>
        <?php

        if($count13){ ?>
        <table class="table-main">
        <h4>A.2. Research Publication</h4>
            <thead>
                <tr>
                    <th>Title of Research</th>
                    <th>Research Classification</th>
                    <th>Category</th>
                    <th>University Research Agenda</th>
                    <th>Researcher/s (Surname, First Name, M.I.)</th>
                    <th>Nature of Involvement</th>
                    <th>Type of Research</th>
                    <th>Keywords(at least five (5) keywords)</th>
                    <th>Type of Funding</th>
                    <th>Amount of Funding</th>
                    <th>Funding Agency</th>
                    <th><nobr>Actual Date Started</th>
                    <th><nobr>Target Date of Completion</th>
                    <th><nobr>Date Completed</th>
                    <th>Journal Name</th>
                    <th>Page Number</th>
                    <th>Volume No.</th>
                    <th>Issue No.</th>
                    <th>Indexing Platform</th>
                    <th><nobr>Date Published</th>
                    <th>Publisher</th>
                    <th>Editor</th>
                    <th>ISSN/ISBN</th>
                    <th>Level of Publication</th>
                    <th>Supporting Documents Submitted</th>
                    <?php
                        if($level == 'Dean' && $que == 1)
                        {
                            ?>
                            <th><nobr>Mark for Revision</th>
                            
                            <?php
                        }
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                $n = null;
                while($row1 = mysqli_fetch_assoc($query_run13))
                    
                {
                    $rower13 = $row1['RpId'];
                    $t=1;
                    $rescount=0;
                    $researcher = array();
                    $n = $row1['RpId'];
                    $rname = "SELECT RpName FROM rp_name WHERE RpId = '$n'";
                    $resname = mysqli_query($con,$rname);
                    $countres = mysqli_num_rows($resname);
                    $researcher = mysqli_fetch_all($resname);

                    $rword = "SELECT * FROM rp_keywords WHERE RpId = '$n'";
                    $keywords = mysqli_query($con,$rword);
                    $countword = mysqli_num_rows($keywords);

                    while($rowkey = mysqli_fetch_assoc($keywords))
                    {
                       
                        
                        if($t==1)
                        {
                            
                    ?>
                
                        <tr>
                            <td><?php echo $row1['RpTitle'];?></td>
                            <td><?php echo $row1['RpClass'];?></td>
                            <td><?php echo $row1['RpCategory'];?></td>
                            <td><?php echo $row1['RpAgenda'];?></td>
                            
                            <td><?php echo $researcher[$rescount][0];?></td>
                            
                            
                            
                            <td><?php echo $row1['RpInvolve'];?></td>
                            <td><?php echo $row1['RpType'];?></td>
                            <td><?php echo $rowkey['RpKeyword'];?></td>
                            <td><?php echo $row1['RpFundType'];?></td>
                            <td><?php echo $row1['RpFundAmount'];?></td>
                            <td><?php echo $row1['RpFundAgency'];?></td>
                            <td><?php echo $row1['RpDateStart'];?></td>
                            <td><?php echo $row1['RpDateTarget'];?></td>
                            <td><?php echo $row1['RpDateCompleted'];?></td>
                            <td><?php echo $row1['RpJournalName'];?></td>
                            <td><?php echo $row1['RpPageNumber'];?></td>
                            <td><?php echo $row1['RpVolumeNo'];?></td>
                            <td><?php echo $row1['RpIssueNo'];?></td>
                            <td><?php echo $row1['RpIndexingPlatform'];?></td>
                            <td><?php echo $row1['RpDatePublished'];?></td>
                            <td><?php echo $row1['RpPublisher'];?></td>
                            <td><?php echo $row1['RpEditor'];?></td>
                            <td><?php echo $row1['RpISSN'];?></td>
                            <td><?php echo $row1['RpLevel'];?></td>
                            <?php $file = $row1['RpTempName']; $download = 'uploads/'.$file;?> 
                            <td><a href="<?php echo $download;?>" download><?php echo $row1['RpFilename'];?></a></td>
                            <?php
                                if($level == 'Dean' && $que == 1)
                                {
                                    if($row1['RevStat']== 1)
                                    {

                                    
                                    ?>
                                    <td style="text-align:center;">
                                       
                                            <input class = "revision" style="text-align:center; padding:0; vertical-align:middle;" type="checkbox" name="revision3" id='revision3' value="<?php echo "13 $rower13"; ?>" onchange="revise(this.value,this)" checked>
                                            
                                    </td>
                                    <?php
                                    }
                                    else
                                    {
                                    ?>
                                    
                                    <td style="text-align:center;">
                                        
                                            <input class = "revision" style="text-align:center; padding:0; vertical-align:middle;" type="checkbox" name="revision3" id='revision3' value="<?php echo "13 $rower13"; ?>" onchange="revise(this.value,this)">
                                           
                                    </td>
                                
                                    <?php
                                    }
                                }
                            ?>
                        </tr>
                    <?php
                        }
                        else
                        {
                            ?>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><?php if($rescount < $countres) {echo $researcher[$rescount][0];}?></td>
                            

                            <td></td>
                            <td></td>
                            <td><?php if($rowkey['RpKeyword']!=null){echo $rowkey['RpKeyword'];}?></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    <?php }
                
                        $t++; $rescount++;}
                        $i++;}
                }               
                ?>
            </tbody>
        </table>
        <?php

        if($count14){ ?>
        <table class="table-main">
        <h4>A.3. Research Presentation</h4>
            <thead>
                <tr>
                    <th>Title of Research</th>
                    <th>Research Classification</th>
                    <th>Category</th>
                    <th>University Research Agenda</th>
                    <th>Researcher/s (Surname, First Name, M.I.)</th>
                    <th>Nature of Involvement</th>
                    <th>Type of Research</th>
                    <th>Keywords(at least five (5) keywords)</th>
                    <th>Type of Funding</th>
                    <th>Amount of Funding</th>
                    <th>Funding Agency</th>
                    <th><nobr>Actual Date Started</th>
                    <th><nobr>Target Date of Completion</th>
                    <th><nobr>Date Completed</th>
                    <th>Conference Title</th>
                    <th>Organizer</th>
                    <th>Venue</th>
                    <th><nobr>Date of Presentation</th>
                    <th>Level</th>
                    <th>Supporting Documents Submitted</th>
                    <?php
                        if($level == 'Dean' && $que == 1)
                        {
                            ?>
                            <th><nobr>Mark for Revision</th>
                            
                            <?php
                        }
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                $n = null;
                while($row1 = mysqli_fetch_assoc($query_run14))
                    
                {
                    $rower14 = $row1['RpresId'];
                    $t=1;
                    $rescount=0;
                    $researcher = array();
                    $n = $row1['RpresId'];
                    $rname = "SELECT RpresName FROM rpres_name WHERE RpresId = '$n'";
                    $resname = mysqli_query($con,$rname);
                    $countres = mysqli_num_rows($resname);
                    $researcher = mysqli_fetch_all($resname);

                    $rword = "SELECT * FROM rpres_keywords WHERE RpresId = '$n'";
                    $keywords = mysqli_query($con,$rword);
                    $countword = mysqli_num_rows($keywords);

                    while($rowkey = mysqli_fetch_assoc($keywords))
                    {
                    
                        
                        if($t==1)
                        {
                            
                    ?>
                
                        <tr>
                            <td><?php echo $row1['RpresTitle'];?></td>
                            <td><?php echo $row1['RpresClass'];?></td>
                            <td><?php echo $row1['RpresCategory'];?></td>
                            <td><?php echo $row1['RpresAgenda'];?></td>
                            <td><?php echo $researcher[$rescount][0];?></td>
                            
                            
                            
                            <td><?php echo $row1['RpresInvolve'];?></td>
                            <td><?php echo $row1['RpresType'];?></td>
                            <td><?php echo $rowkey['RpresKeyword'];?></td>
                            <td><?php echo $row1['RpresFundType'];?></td>
                            <td><?php echo $row1['RpresFundAmount'];?></td>
                            <td><?php echo $row1['RpresFundAgency'];?></td>
                            <td><?php echo $row1['RpresDateStart'];?></td>
                            <td><?php echo $row1['RpresDateTarget'];?></td>
                            
                            <td><?php echo $row1['RpresDateCompleted'];?></td>
                            <td><?php echo $row1['RpresConTitle'];?></td>
                            <td><?php echo $row1['RpresOrganizer'];?></td>
                            <td><?php echo $row1['RpresVenue'];?></td>
                            <td><?php echo $row1['RpresDatePresent'];?></td>
                            <td><?php echo $row1['RpresLevel'];?></td>
                            <?php $file = $row1['RpresTempName']; $download = 'uploads/'.$file;?> 
                            <td><a href="<?php echo $download;?>" download><?php echo $row1['RpresFilename'];?></a></td>
                            <?php
                                if($level == 'Dean' && $que == 1)
                                {
                                    if($row1['RevStat']== 1)
                                    {

                                    
                                    ?>
                                    <td style="text-align:center;">
                                      
                                            <input class = "revision" style="text-align:center; padding:0; vertical-align:middle;" type="checkbox" name="revision3" id='revision3' value="<?php echo "14 $rower14"; ?>" onchange="revise(this.value,this)" checked>
                                           
                                    </td>
                                    <?php
                                    }
                                    else
                                    {
                                    ?>
                                    
                                    <td style="text-align:center;">
                                     
                                            <input class = "revision" style="text-align:center; padding:0; vertical-align:middle;" type="checkbox" name="revision3" id='revision3' value="<?php echo "14 $rower14"; ?>" onchange="revise(this.value,this)">
                                            
                                    </td>
                                
                                    <?php
                                    }
                                }
                            ?>
                        </tr>
                    <?php
                        }
                        else
                        {
                            ?>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><?php if($rescount < $countres) {echo $researcher[$rescount][0];}?></td>
                            

                            <td></td>
                            <td></td>
                            <td><?php if($rowkey['RpresKeyword']!=null){echo $rowkey['RpresKeyword'];}?></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    <?php }
                
                        $t++; $rescount++;}
                        $i++;}
                }               
                ?>
            </tbody>
        </table>

        <?php

        if($count15){ ?>
        <table class="table-main">
        <h4>A.4. Research Citation</h4>
            <thead>
                <tr>
                    <th>Research Classification</th>
                    <th>Category</th>
                    <th>University Research Agenda</th>
                    <th>Title of Research</th>
                    <th>Researcher/s (Surname, First Name, M.I.)</th>
                    <th>Nature of Involvement</th>
                    <th>Type of Research</th>
                    <th>Keywords(at least five (5) keywords)</th>
                    <th>Type of Funding</th>
                    <th><nobr>Amount of Funding</th>
                    <th>Funding Agency</th>
                    <th><nobr>Actual Date Started</th>
                    <th><nobr>Target Date of Completion</th>
                    <th><nobr>Date Completed</th>
                    <th>Title of Research/Article Cited</th>
                    <th>Title of Article Where Your Research has been cited</th>
                    <th>Author/s Who Cited Your Research</th>
                    <th>Title of the Journal/Books Where Your Article has been cited</th>
                    <th>Volume No. of  the Journal/Book Where Your Article has been cited</th>
                    <th>Issue No. of  the Journal/Book Where Your Article has been cited</th>
                    <th>Page No. of  the Journal Where Your Article has been cited</th>
                    <th>Year of Publication of the Journal Where Your Article has been cited</th>
                    <th>Name of Publisher of the Journal Where Your Article has been cited</th>
                    <th>Indexing Flatform of the Journal Where Your Article has been cited</th>
                    <th>Supporting Documents Submitted</th>
                    <?php
                        if($level == 'Dean' && $que == 1)
                        {
                            ?>
                            <th><nobr>Mark for Revision</th>
                            
                            <?php
                        }
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                $n = null;
                while($row1 = mysqli_fetch_assoc($query_run15))
                    
                {
                    $rower15 = $row1['CitationId'];
                    $t=1;
                    $rescount=0;
                    $researcher = array();
                    $n = $row1['CitationId'];
                    $rname = "SELECT RcName FROM rc_name WHERE CitationId = '$n'";
                    $resname = mysqli_query($con,$rname);
                    $countres = mysqli_num_rows($resname);
                    $researcher = mysqli_fetch_all($resname);

                    $rword = "SELECT * FROM rc_keywords WHERE CitationId = '$n'";
                    $keywords = mysqli_query($con,$rword);
                    $countword = mysqli_num_rows($keywords);

                    while($rowkey = mysqli_fetch_assoc($keywords))
                    {
                    
                        
                        if($t==1)
                        {
                            
                    ?>
                
                        <tr>
                            <td><?php echo $row1['RcClass'];?></td>
                            <td><?php echo $row1['RcCategory'];?></td>
                            <td><?php echo $row1['RcAgenda'];?></td>
                            <td><?php echo $row1['RcTitle'];?></td>
                            <td><?php echo $researcher[$rescount][0];?></td>
                            
                            
                            
                            <td><?php echo $row1['RcInvolve'];?></td>
                            <td><?php echo $row1['RcType'];?></td>
                            <td><?php echo $rowkey['RcKeyword'];?></td>
                            <td><?php echo $row1['RcFundType'];?></td>
                            <td><?php echo $row1['RcFundAmount'];?></td>
                            <td><?php echo $row1['RcFundAgency'];?></td>
                            <td><?php echo $row1['RcDateStart'];?></td>
                            <td><?php echo $row1['RcDateTarget'];?></td>
                            
                            <td><?php echo $row1['RcDateCompleted'];?></td>
                            <td><?php echo $row1['RcArticleCited'];?></td>
                            <td><?php echo $row1['RcResearchCitedBy'];?></td>
                            <td><?php echo $row1['RcAuthorsCitedBy'];?></td>
                            <td><?php echo $row1['RcJournalsCitedBy'];?></td>
                            <td><?php echo $row1['RcVolNo'];?></td>
                            <td><?php echo $row1['RcJournalIssue'];?></td>
                            <td><?php echo $row1['RcJournalPage'];?></td>
                            <td><?php echo $row1['RcJournalYear'];?></td>
                            <td><?php echo $row1['RcJournalPublisher'];?></td>
                            <td><?php echo $row1['RcJournalIndexing'];?></td>
                            <?php $file = $row1['RcTempName']; $download = 'uploads/'.$file;?> 
                            <td><a href="<?php echo $download;?>" download><?php echo $row1['RcFilename'];?></a></td>
                            <?php
                                if($level == 'Dean' && $que == 1)
                                {
                                    if($row1['RevStat']== 1)
                                    {

                                    
                                    ?>
                                    <td style="text-align:center;">
                                        
                                            <input class = "revision" style="text-align:center; padding:0; vertical-align:middle;" type="checkbox" name="revision3" id='revision3' value="<?php echo "15 $rower15"; ?>" onchange="revise(this.value,this)" checked>
                                            
                                    </td>
                                    <?php
                                    }
                                    else
                                    {
                                    ?>
                                    
                                    <td style="text-align:center;">
                                        
                                            <input class = "revision" style="text-align:center; padding:0; vertical-align:middle;" type="checkbox" name="revision3" id='revision3' value="<?php echo "15 $rower15"; ?>" onchange="revise(this.value,this)">
                                            
                                    </td>
                                
                                    <?php
                                    }
                                }
                            ?>
                        </tr>
                    <?php
                        }
                        else
                        {
                            ?>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><?php if($rescount < $countres) {echo $researcher[$rescount][0];}?></td>
                            

                            <td></td>
                            <td></td>
                            <td><?php if($rowkey['RcKeyword']!=null){echo $rowkey['RcKeyword'];}?></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    <?php }
                
                        $t++; $rescount++;}
                        $i++;}
                }               
                ?>
            </tbody>
        </table>
        
        <?php

        if($count16){ ?>
        <table class="table-main">
        <h4>A.5. Research Utilization</h4>
            <thead>
                <tr>
                    <th>Research Classification</th>
                    <th>Category</th>
                    <th>University Research Agenda</th>
                    <th>Title of Research</th>
                    <th>Researcher/s (Surname, First Name, M.I.)</th>
                    <th>Nature of Involvement</th>
                    <th>Type of Research</th>
                    <th>Keywords(at least five (5) keywords)</th>
                    <th>Type of Funding</th>
                    <th><nobr>Amount of Funding</th>
                    <th>Funding Agency</th>
                    <th><nobr>Actual Date Started</th>
                    <th><nobr>Target Date of Completion</th>
                    <th><nobr>Date Completed</th>
                    <th>Agency/Organization that utilized the research output</th>
                    <th>Brief Description of Research Utilization</th>
                    <th>Level of Utilization</th>
                    <th>Supporting Documents Submitted</th>
                    <?php
                        if($level == 'Dean' && $que == 1)
                        {
                            ?>
                            <th><nobr>Mark for Revision</th>
                            
                            <?php
                        }
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                $n = null;
                while($row1 = mysqli_fetch_assoc($query_run16))
                    
                {
                    $rower16 = $row1['UtiId'];
                    $t=1;
                    $rescount=0;
                    $researcher = array();
                    $n = $row1['UtiId'];
                    $rname = "SELECT RuName FROM ru_name WHERE UtiId = '$n'";
                    $resname = mysqli_query($con,$rname);
                    $countres = mysqli_num_rows($resname);
                    $researcher = mysqli_fetch_all($resname);

                    $rword = "SELECT * FROM ru_keywords WHERE UtiId = '$n'";
                    $keywords = mysqli_query($con,$rword);
                    $countword = mysqli_num_rows($keywords);

                    while($rowkey = mysqli_fetch_assoc($keywords))
                    {
                    
                        
                        if($t==1)
                        {
                            
                    ?>
                
                        <tr>
                            <td><?php echo $row1['RuClass'];?></td>
                            <td><?php echo $row1['RuCategory'];?></td>
                            <td><?php echo $row1['RuAgenda'];?></td>
                            <td><?php echo $row1['RuTitle'];?></td>
                            <td><?php echo $researcher[$rescount][0];?></td>
                            
                            
                            
                            <td><?php echo $row1['RuInvolve'];?></td>
                            <td><?php echo $row1['RuType'];?></td>
                            <td><?php echo $rowkey['RuKeyword'];?></td>
                            <td><?php echo $row1['RuFundType'];?></td>
                            <td><?php echo $row1['RuFundAmount'];?></td>
                            <td><?php echo $row1['RuFundAgency'];?></td>
                            <td><?php echo $row1['RuDateStart'];?></td>
                            <td><?php echo $row1['RuDateTarget'];?></td>
                            
                            <td><?php echo $row1['RuDateCompleted'];?></td>
                            <td><?php echo $row1['RuAgency'];?></td>
                            <td><?php echo $row1['RuDesc'];?></td>
                            <td><?php echo $row1['RuLevel'];?></td>
                            <?php $file = $row1['RuTempName']; $download = 'uploads/'.$file;?> 
                            <td><a href="<?php echo $download;?>" download><?php echo $row1['RuFilename'];?></a></td>
                            <?php
                                if($level == 'Dean' && $que == 1)
                                {
                                    if($row1['RevStat']== 1)
                                    {

                                    
                                    ?>
                                    <td style="text-align:center;">
                                        
                                            <input class = "revision" style="text-align:center; padding:0; vertical-align:middle;" type="checkbox" name="revision3" id='revision3' value="<?php echo "16 $rower16"; ?>" onchange="revise(this.value,this)" checked>
                                            
                                    </td>
                                    <?php
                                    }
                                    else
                                    {
                                    ?>
                                    
                                    <td style="text-align:center;">
                                        
                                            <input class = "revision" style="text-align:center; padding:0; vertical-align:middle;" type="checkbox" name="revision3" id='revision3' value="<?php echo "16 $rower16"; ?>" onchange="revise(this.value,this)">
                                           
                                    </td>
                                
                                    <?php
                                    }
                                }
                            ?>
                        </tr>
                    <?php
                        }
                        else
                        {
                            ?>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><?php if($rescount < $countres) {echo $researcher[$rescount][0];}?></td>
                            

                            <td></td>
                            <td></td>
                            <td><?php if($rowkey['RuKeyword']!=null){echo $rowkey['RuKeyword'];}?></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    <?php }
                
                        $t++; $rescount++;}
                        $i++;}
                }               
                ?>
            </tbody>
        </table>   
        <?php

        if($count17){ ?>
        <table class="table-main">
        <h4>A.6. Copyrighted Research Output</h4>
            <thead>
                <tr>
                    <th>Research Classification</th>
                    <th>Category</th>
                    <th>University Research Agenda</th>
                    <th>Title of Research</th>
                    <th>Researcher/s (Surname, First Name, M.I.)</th>
                    <th>Nature of Involvement</th>
                    <th>Type of Research</th>
                    <th>Keywords(at least five (5) keywords)</th>
                    <th>Type of Funding</th>
                    <th><nobr>Amount of Funding</th>
                    <th>Funding Agency</th>
                    <th><nobr>Actual Date Started</th>
                    <th><nobr>Target Date of Completion</th>
                    <th><nobr>Date Completed</th>
                    <th><nobr>Copyright Number</th>
                    <th><nobr>Copyright Agency</th>
                    <th>Year the research copyrighted</th>
                    <th>Level</th>
                    <th>Supporting Documents Submitted</th>
                    <?php
                        if($level == 'Dean' && $que == 1)
                        {
                            ?>
                            <th><nobr>Mark for Revision</th>
                            
                            <?php
                        }
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                $n = null;
                while($row1 = mysqli_fetch_assoc($query_run17))
                    
                {
                    $rower17 = $row1['CoId'];
                    $t=1;
                    $rescount=0;
                    $researcher = array();
                    $n = $row1['CoId'];
                    $rname = "SELECT CoName FROM co_name WHERE CoId = '$n'";
                    $resname = mysqli_query($con,$rname);
                    $countres = mysqli_num_rows($resname);
                    $researcher = mysqli_fetch_all($resname);

                    $rword = "SELECT * FROM co_keywords WHERE CoId = '$n'";
                    $keywords = mysqli_query($con,$rword);
                    $countword = mysqli_num_rows($keywords);

                    while($rowkey = mysqli_fetch_assoc($keywords))
                    {
                    
                        
                        if($t==1)
                        {
                            
                    ?>
                
                        <tr>
                            <td><?php echo $row1['CoClass'];?></td>
                            <td><?php echo $row1['CoCategory'];?></td>
                            <td><?php echo $row1['CoAgenda'];?></td>
                            <td><?php echo $row1['CoTitle'];?></td>
                            <td><?php echo $researcher[$rescount][0];?></td>
                            
                            
                            
                            <td><?php echo $row1['CoInvolve'];?></td>
                            <td><?php echo $row1['CoType'];?></td>
                            <td><?php echo $rowkey['CoKeywords'];?></td>
                            <td><?php echo $row1['CoFundType'];?></td>
                            <td><?php echo $row1['CoFundAmount'];?></td>
                            <td><?php echo $row1['CoFundAgency'];?></td>
                            <td><?php echo $row1['CoDateStart'];?></td>
                            <td><?php echo $row1['CoDateTarget'];?></td>
                            
                            <td><?php echo $row1['CoDateCompleted'];?></td>
                            <td><?php echo $row1['CoCopyrightNum'];?></td>
                            <td><?php echo $row1['CoCopyrightAgency'];?></td>
                            <td><?php echo $row1['CoCopyrightYear'];?></td>
                            <td><?php echo $row1['CoLevel'];?></td>
                            <?php $file = $row1['CoTempName']; $download = 'uploads/'.$file;?> 
                            <td><a href="<?php echo $download;?>" download><?php echo $row1['CoFilename'];?></a></td>
                            <?php
                                if($level == 'Dean' && $que == 1)
                                {
                                    if($row1['RevStat']== 1)
                                    {

                                    
                                    ?>
                                    <td style="text-align:center;">
                                        
                                            <input class = "revision" style="text-align:center; padding:0; vertical-align:middle;" type="checkbox" name="revision3" id='revision3' value="<?php echo "17 $rower17"; ?>" onchange="revise(this.value,this)" checked>
                                            
                                    </td>
                                    <?php
                                    }
                                    else
                                    {
                                    ?>
                                    
                                    <td style="text-align:center;">
                                        
                                            <input class = "revision" style="text-align:center; padding:0; vertical-align:middle;" type="checkbox" name="revision3" id='revision3' value="<?php echo "17 $rower17"; ?>" onchange="revise(this.value,this)">
                                            
                                    </td>
                                
                                    <?php
                                    }
                                }
                            ?>
                        </tr>
                    <?php
                        }
                        else
                        {
                            ?>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><?php if($rescount < $countres) {echo $researcher[$rescount][0];}?></td>
                            

                            <td></td>
                            <td></td>
                            <td><?php if($rowkey['CoKeywords']!=null){echo $rowkey['CoKeywords'];}?></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    <?php }
                
                        $t++; $rescount++;}
                        $i++;}
                }               
                ?>
            </tbody>
        </table>     
        <?php

        if($count18){ ?>
        <table class="table-main">
        <h4>B. Inventions, Innovation, and Creative Works</h4>
        <h4>B.1 Administrative Employee Invention, Innovation and Creative Works Commitment</h4>
            <thead>
                <tr>
                    <th>Title of the Invention, Innovation & Creative Works</th>
                    <th>Classification</th>
                    <th>Name of Collaborator/s</th>
                    <th><nobr>Project Duration (From)</th>
                    <th><nobr>Project Duration (To)</th>
                    <th>Nature of Inventions (IT Products, Equipments, Machinery, etc.</th>
                    <th>Status</th>
                    <th>Funding Agency</th>
                    <th>Type of Funding</th>
                    <th><nobr>Amount of Fund</th>
                    <th>Supporting Document</th>
                    <?php
                        if($level == 'Dean' && $que == 1)
                        {
                            ?>
                            <th><nobr>Mark for Revision</th>
                            
                            <?php
                        }
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                $n = null;
                while($row1 = mysqli_fetch_assoc($query_run18))
                    
                {
                    $rower18 = $row1['iicwId'];
                    $t=1;
                    $rescount=0;
                    $researcher = array();
                    $n = $row1['iicwId'];

                    $rword = "SELECT * FROM collaborators WHERE iicwId = '$n'";
                    $keywords = mysqli_query($con,$rword);
                    $countword = mysqli_num_rows($keywords);

                    while($rowkey = mysqli_fetch_assoc($keywords))
                    {
                    
                        
                        if($t==1)
                        {
                            
                    ?>
                
                        <tr>
                            <td><?php echo $row1['ITitle'];?></td>
                            <td><?php echo $row1['IClass'];?></td>
                            <td><?php echo $rowkey['collaborator'];?></td>
                            <td><?php echo $row1['IDurationFrom'];?></td>
                            <td><?php echo $row1['IDurationTo'];?></td>

                            
                            
                            
                            <td><?php echo $row1['INature'];?></td>
                            <td><?php echo $row1['IStatus'];?></td>
                            
                            <td><?php echo $row1['IAgency'];?></td>
                            <td><?php echo $row1['IFundingType'];?></td>
                            <td><?php echo $row1['IFundingAmount'];?></td>
                            <?php $file = $row1['ITempName']; $download = 'uploads/'.$file;?> 
                            <td><a href="<?php echo $download;?>" download><?php echo $row1['IFilename'];?></a></td>
                            <?php
                                if($level == 'Dean' && $que == 1)
                                {
                                    if($row1['RevStat']== 1)
                                    {

                                    
                                    ?>
                                    <td style="text-align:center;">
                                        
                                            <input class = "revision" style="text-align:center; padding:0; vertical-align:middle;" type="checkbox" name="revision3" id='revision3' value="<?php echo "18 $rower18"; ?>" onchange="revise(this.value,this)" checked>
                                            
                                    </td>
                                    <?php
                                    }
                                    else
                                    {
                                    ?>
                                    
                                    <td style="text-align:center;">
                                        
                                            <input class = "revision" style="text-align:center; padding:0; vertical-align:middle;" type="checkbox" name="revision3" id='revision3' value="<?php echo "18 $rower18"; ?>" onchange="revise(this.value,this)">
                                           
                                    </td>
                                
                                    <?php
                                    }
                                }
                            ?>
                        </tr>
                    <?php
                        }
                        else
                        {
                            ?>
                        <tr>
                            <td></td>
                            <td></td>
                            <td><?php if($rowkey['collaborator']!=null){echo $rowkey['collaborator'];}?></td>
                            <td></td>
                            <td></td>
                            

                            <td></td>
                            <td></td>
                            
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            
                        </tr>
                    <?php }
                
                        $t++; $rescount++;}
                        $i++;}
                }               
                ?>
            </tbody>
        </table>
        <?php

        if($count19){ ?>
        <table class="table-main">
            <h4>C. Extension Program and Expert Service Rendered</h4>
            <h4>C.1. Expert Service Rendered</h4>
            <thead>
                <tr>
                    <th>Classification of expert services rendered as a  consultant /expert</th>
                    <th>Title of Expert Services Rendered</th>
                    <th>Category of Expert Services</th>
                    <th>Partner Agency</th>
                    <th>Venue</th>
                    <th><nobr>Inclusive Date/ Date of Awards(From)</th>
                    <th><nobr>Inclusive Date/ Date of Awards(To)</th>
                    <th>Level</th>
                    <th>Supporting Document Submitted</th>
                    <?php
                        if($level == 'Dean' && $que == 1)
                        {
                            ?>
                            <th><nobr>Mark for Revision</th>
                            
                            <?php
                        }
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                while($row1 = mysqli_fetch_assoc($query_run19)){
                    $rower19 = $row1['EcId'];
                    ?>
                
                <tr>
                    <td><?php echo $row1['EConsultantClass'];?></td>
                    <td><?php echo $row1['EConsultantTitle'];?></td>
                    <td><?php echo $row1['EConsultantCategory'];?></td>
                    <td><?php echo $row1['EConsultantAgency'];?></td>
                    <td><?php echo $row1['EConsultantVenue'];?></td>
                    <td><?php echo $row1['EConsultantDateFrom'];?></td>
                    <td><?php echo $row1['EConsultantDateTo'];?></td>
                    <td><?php echo $row1['EConsultantLevel'];?></td>
                    <?php $file = $row1['ETempName']; $download = 'uploads/'.$file;?> 
                    <td><a href="<?php echo $download;?>" download><?php echo $row1['EFilename'];?></a></td>
                    <?php
                        if($level == 'Dean' && $que == 1)
                        {
                            if($row1['RevStat']== 1)
                            {

                            
                            ?>
                            <td style="text-align:center;">
                               
                                    <input class = "revision" style="text-align:center; padding:0; vertical-align:middle;" type="checkbox" name="revision3" id='revision3' value="<?php echo "19 $rower19"; ?>" onchange="revise(this.value,this)" checked>
                                    
                            </td>
                            <?php
                            }
                            else
                            {
                            ?>
                            
                            <td style="text-align:center;">
                                
                                    <input class = "revision" style="text-align:center; padding:0; vertical-align:middle;" type="checkbox" name="revision3" id='revision3' value="<?php echo "19 $rower19"; ?>" onchange="revise(this.value,this)">
                                    
                            </td>
                        
                            <?php
                            }
                        }
                    ?>
                </tr>
                <?php
                    $i++;}
                }               
                ?>
            </tbody>
        </table>   
        
        <?php

        if($count20){ ?>
        <table class="table-main">

            <thead>
                <tr>
                    <th>Nature of services rendered in conferences, workshops, and/or training courses for professionals</th>
                    <th>Title of Conference, Workshop, and Training</th>
                    <th>Partner Agency</th>
                    <th>Venue</th>
                    <th><nobr>Inclusive Date/ Date of Awards(From)</th>
                    <th><nobr>Inclusive Date/ Date of Awards(To)</th>
                    <th>Level</th>
                    <th>Description of Supporting Documents Submitted (MOA/MOU, Certificate of Recognitions/Appreciations)</th>
                    <?php
                        if($level == 'Dean' && $que == 1)
                        {
                            ?>
                            <th><nobr>Mark for Revision</th>
                            
                            <?php
                        }
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                while($row1 = mysqli_fetch_assoc($query_run20)){
                    $rower20 = $row1['ConId'];
        
                    ?>
                
                <tr>
                    <td><?php echo $row1['EConferenceNature'];?></td>
                    <td><?php echo $row1['EConferenceTitle'];?></td>
                    <td><?php echo $row1['EConferenceAgency'];?></td>
                    <td><?php echo $row1['EConferenceVenue'];?></td>
                    <td><?php echo $row1['EConferenceDateFrom'];?></td>
                    <td><?php echo $row1['EConferenceDateTo'];?></td>
                    <td><?php echo $row1['EConferenceLevel'];?></td>
                    <?php $file = $row1['EConferenceTempName']; $download = 'uploads/'.$file;?> 
                    <td><a href="<?php echo $download;?>" download><?php echo $row1['EConferenceFilename'];?></a></td>
                    <?php
                        if($level == 'Dean' && $que == 1)
                        {
                            if($row1['RevStat']== 1)
                            {

                            
                            ?>
                            <td style="text-align:center;">
                                
                                    <input class = "revision" style="text-align:center; padding:0; vertical-align:middle;" type="checkbox" name="revision3" id='revision3' value="<?php echo "20 $rower20"; ?>" onchange="revise(this.value,this)" checked>
                                   
                            </td>
                            <?php
                            }
                            else
                            {
                            ?>
                            
                            <td style="text-align:center;">
                               
                                    <input class = "revision" style="text-align:center; padding:0; vertical-align:middle;" type="checkbox" name="revision3" id='revision3' value="<?php echo "20 $rower20"; ?>" onchange="revise(this.value,this)">
                                    
                               
                            </td>
                        
                            <?php
                            }
                        }
                    ?>
                </tr>
                <?php
                    $i++;}
                }               
                ?>
            </tbody>
        </table>
        <?php

        if($count21){ ?>
        <table class="table-main">

            <thead>
                <tr>
                    <th>External Services Rendered in Academic Journals/ Books Publication/ Newsletter/ Creative Work</th>
                    <th>Nature of  Services Rendered</th>
                    <th>Publication/ Audio Visual Production </th>
                    <th>Indexing </th>
                    <th><nobr>Copyright No. (ISSN No. /E-ISSN/ ISBN)</th>
                    <th>Level</th>
                    <th>Description of Supporting Documents</th>
                    <?php
                        if($level == 'Dean' && $que == 1)
                        {
                            ?>
                            <th><nobr>Mark for Revision</th>
                            
                            <?php
                        }
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                while($row1 = mysqli_fetch_assoc($query_run21)){
                    $rower21 = $row1['EjId'];
        
                    ?>
                
                <tr>
                    <td><?php echo $row1['EjJournals'];?></td>
                    <td><?php echo $row1['EjNature'];?></td>
                    <td><?php echo $row1['EjPublication'];?></td>
                    <td><?php echo $row1['EjIndexing'];?></td>
                    <td><?php echo $row1['EjCopyright'];?></td>
                    <td><?php echo $row1['EjLevel'];?></td>
                    <?php $file = $row1['EjTempName']; $download = 'uploads/'.$file;?> 
                    <td><a href="<?php echo $download;?>" download><?php echo $row1['EjFilename'];?></a></td>
                    <?php
                        if($level == 'Dean' && $que == 1)
                        {
                            if($row1['RevStat']== 1)
                            {

                            
                            ?>
                            <td style="text-align:center;">
                                
                                    <input class = "revision" style="text-align:center; padding:0; vertical-align:middle;" type="checkbox" name="revision3" id='revision3' value="<?php echo "21 $rower21"; ?>" onchange="revise(this.value,this)" checked>
                                    
                            </td>
                            <?php
                            }
                            else
                            {
                            ?>
                            
                            <td style="text-align:center;">
                              
                                    <input class = "revision" style="text-align:center; padding:0; vertical-align:middle;" type="checkbox" name="revision3" id='revision3' value="<?php echo "21 $rower21"; ?>" onchange="revise(this.value,this)">
                                   
                            </td>
                        
                            <?php
                            }
                        }
                    ?>
                </tr>
                <?php
                    $i++;}
                }               
                ?>
            </tbody>
        </table>
        <?php

        if($count22){ ?>
        <table class="table-main">
            <h4>C.2. Extension Program, Project and Activity (Ongoing and Completed)</h4>
            <thead>
                <tr>
                    <th colspan="14"></th>
                    <th colspan="5">Total No. of Trainees/ Beneficiaries who rated the quality of extension service </th>
                    <th colspan="5">Total No. of Trainees/ Beneficiaries who rated the timeliness of extension service</th>
                    <th colspan="3"></th>
                </tr>

                <tr>
                    <th>Title of Extension Program</th>
                    <th>Title of Extension Project</th>
                    <th>Title of Extension Activity</th>
                    <th>Nature of Involvement</th>
                    <th><nobr>Source of Fund</th>
                    <th><nobr>Amount of Fund</th>
                    <th>Classification of the Extension Activity</th>
                    <th>Partnership Levels</th>
                    <th><nobr>Project Duration (From)</th>
                    <th><nobr>Project Duration (To)</th>
                    <th>Status</th>
                    <th>Place/Venue</th>
                    <th>No. of Trainees</th>
                    <th>Classification of Trainees</th>
                    <th>Poor</th>
                    <th>Fair</th>
                    <th>Satisfactory</th>
                    <th>Very Stisfactory</th>
                    <th>Outstanding</th>
                    <th>Poor</th>
                    <th>Fair</th>
                    <th>Satisfactory</th>
                    <th>Very Stisfactory</th>
                    <th>Outstanding</th>
                    <th>Number of Hours</th>
                    <th>Description of Supporting Documents</th>
                    <?php
                        if($level == 'Dean' && $que == 1)
                        {
                            ?>
                            <th><nobr>Mark for Revision</th>
                            
                            <?php
                        }
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                while($row1 = mysqli_fetch_assoc($query_run22)){
                    $rower22 = $row1['EpId'];
                    $n = $row1['EpId'];
                    $rname = "SELECT * FROM quality_rate WHERE EpId = '$n'";
                    $resname = mysqli_query($con,$rname);
                    $countres = mysqli_num_rows($resname);
                    while($ro = mysqli_fetch_assoc($resname))
                    {
                        $qpoor = $ro['QRPoor'];
                        $qfair = $ro['QRFair'];
                        $qsatisfactory = $ro['QRSatisfactory'];
                        $qvery = $ro['QRVery'];
                        $qout = $ro['QROutstanding'];
                        
                    }
                    $rname1 = "SELECT * FROM timeliness_rate WHERE EpId = '$n'";
                    $resname1 = mysqli_query($con,$rname1);
                    $countres1 = mysqli_num_rows($resname1);
                    while($ro = mysqli_fetch_assoc($resname1))
                    {
                        $tpoor = $ro['TRPoor'];
                        $tfair = $ro['TRFair'];
                        $tsatisfactory = $ro['TRSatisfactory'];
                        $tvery = $ro['TRVery'];
                        $tout = $ro['TROutstanding'];
                        
                    }
                    ?>
                
                <tr>
                    <td><?php echo $row1['EPProgramTitle'];?></td>
                    <td><?php echo $row1['EPProjectTitle'];?></td>
                    <td><?php echo $row1['EPActivityTitle'];?></td>
                    <td><?php echo $row1['EPNature'];?></td>
                    <td><?php echo $row1['EPFundSource'];?></td> 
                    <td><?php echo $row1['EPFundAmount'];?></td>
                    <td><?php echo $row1['EPClass'];?></td>
                    <td><?php echo $row1['EPPartnership'];?></td>
                    <td><?php echo $row1['EPDateFrom'];?></td>
                    <td><?php echo $row1['EPDateTo'];?></td>
                    <td><?php echo $row1['EPStatus'];?></td>
                    <td><?php echo $row1['EPVenue'];?></td>
                    <td><?php echo $row1['EPTraineeNum'];?></td>
                    <td><?php echo $row1['EPTraineeClass'];?></td>
                    <td><?php echo $qpoor;?></td>
                    <td><?php echo $qfair;?></td>
                    <td><?php echo $qsatisfactory;?></td>
                    <td><?php echo $qvery;?></td>
                    <td><?php echo $qout;?></td>
                    <td><?php echo $tpoor;?></td>
                    <td><?php echo $tfair;?></td>
                    <td><?php echo $tsatisfactory;?></td>
                    <td><?php echo $tvery;?></td>
                    <td><?php echo $tout;?></td>
                    <td><?php echo $row1['EPHours'];?></td>
                    <?php $file = $row1['EPTempName']; $download = 'uploads/'.$file;?> 
                    <td><a href="<?php echo $download;?>" download><?php echo $row1['EPFilename'];?></a></td>
                    <?php
                        if($level == 'Dean' && $que == 1)
                        {
                            if($row1['RevStat']== 1)
                            {

                            
                            ?>
                            <td style="text-align:center;">
                                
                                    <input class = "revision" style="text-align:center; padding:0; vertical-align:middle;" type="checkbox" name="revision3" id='revision3' value="<?php echo "22 $rower22"; ?>" onchange="revise(this.value,this)" checked>
                                    
                            </td>
                            <?php
                            }
                            else
                            {
                            ?>
                            
                            <td style="text-align:center;">
                                
                                    <input class = "revision" style="text-align:center; padding:0; vertical-align:middle;" type="checkbox" name="revision3" id='revision3' value="<?php echo "22 $rower22"; ?>" onchange="revise(this.value,this)">
                                    
                            </td>
                        
                            <?php
                            }
                        }
                    ?>
                </tr>
                <?php
                    $i++;}
                }               
                ?>
            </tbody>
        </table> 
        <?php

        if($count23){ ?>
        <table class="table-main">
            <h4>C.3.Partnership/Linkages/Network</h4>
            <thead>
                <tr>
                    <th colspan="7"></th>
                    <th colspan="3">Total No. of Trainees/ Beneficiaries who rated the quality of extension service </th>
                    <th colspan="2"></th>
                </tr>
                <tr>
                    <th>Title</th>
                    <th>Type of Partner Institution </th>
                    <th>Nature of Collaboration</th>
                    <th>Deliverable/Desired Output</th>
                    <th>Target Beneficiaries</th>
                    <th>Level</th>
                    <th><nobr>Validity Period (From)</th>
                    <th><nobr>Validity Period (To)</th>
                    <th>Name</th>
                    <th><nobr>Telephone No</th>
                    <th>Address</th>
                    <th>Description of Supporting Documents</th>
                    <?php
                        if($level == 'Dean' && $que == 1)
                        {
                            ?>
                            <th><nobr>Mark for Revision</th>
                            
                            <?php
                        }
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                while($row1 = mysqli_fetch_assoc($query_run23)){
                    $rower23 = $row1['PartnershipId'];
                    ?>
                
                <tr>
                    <td><?php echo $row1['PartnershipTitle'];?></td>
                    <td><?php echo $row1['PartnershipType'];?></td>
                    <td><?php echo $row1['PartnershipNature'];?></td>
                    <td><?php echo $row1['PartnershipDeliverable'];?></td>
                    <td><?php echo $row1['PartnershipBeneficiaries'];?></td>
                    <td><?php echo $row1['PartnershipLevel'];?></td>
                    <td><?php echo $row1['PartnershipDateFrom'];?></td>
                    <td><?php echo $row1['PartnershipDateTo'];?></td>
                    <td><?php echo $row1['PartnershipContact'];?></td>
                    <td><?php echo $row1['PartnershipTel'];?></td>
                    <td><?php echo $row1['PartnershipAddress'];?></td>
                    <?php $file = $row1['PartnershipTempName']; $download = 'uploads/'.$file;?> 
                    <td><a href="<?php echo $download;?>" download><?php echo $row1['PartnershipFilename'];?></a></td>
                    <?php
                        if($level == 'Dean' && $que == 1)
                        {
                            if($row1['RevStat']== 1)
                            {

                            
                            ?>
                            <td style="text-align:center;">
                               
                                    <input class = "revision" style="text-align:center; padding:0; vertical-align:middle;" type="checkbox" name="revision3" id='revision3' value="<?php echo "23 $rower23"; ?>" onchange="revise(this.value,this)" checked>
                                    
                            </td>
                            <?php
                            }
                            else
                            {
                            ?>
                            
                            <td style="text-align:center;">
                                
                                    <input class = "revision" style="text-align:center; padding:0; vertical-align:middle;" type="checkbox" name="revision3" id='revision3' value="<?php echo "23 $rower23"; ?>" onchange="revise(this.value,this)">
                                    
                            </td>
                        
                            <?php
                            }
                        }
                    ?>
                </tr>
                <?php
                    $i++;}
                }               
                ?>
            </tbody>
        </table>      
        <?php

        if($count24){ ?>
        <table class="table-main">
            <h4>C.4. Involvement in Inter-Country Mobility</h4>
            <thead>
                <tr>
                    <th>Nature of Engagement</th>
                    <th>Type</th>
                    <th>Host Institution/ Organization/Agency</th>
                    <th>Address of Host Institution/ Organization/Agency/ Country</th>
                    <th><nobr>Inclusive Date (From)</th>
                    <th><nobr>Inclusive Date (To)</th>
                    <th>Description of Supporting Documents</th>
                    <?php
                        if($level == 'Dean' && $que == 1)
                        {
                            ?>
                            <th><nobr>Mark for Revision</th>
                            
                            <?php
                        }
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                while($row1 = mysqli_fetch_assoc($query_run24)){
                    $rower24 = $row1['IMId'];
                    ?>
                
                <tr>
                    <td><?php echo $row1['IMNature'];?></td>
                    <td><?php echo $row1['IMType'];?></td>
                    <td><?php echo $row1['IMHost'];?></td>
                    <td><?php echo $row1['IMAddress'];?></td>
                    <td><?php echo $row1['IMDateFrom'];?></td>
                    <td><?php echo $row1['IMDateTo'];?></td>
                    <?php $file = $row1['IMTempName']; $download = 'uploads/'.$file;?> 
                    <td><a href="<?php echo $download;?>" download><?php echo $row1['IMFilename'];?></a></td>
                    <?php
                        if($level == 'Dean' && $que == 1)
                        {
                            if($row1['RevStat']== 1)
                            {

                            
                            ?>
                            <td style="text-align:center;">
                               
                                    <input class = "revision" style="text-align:center; padding:0; vertical-align:middle;" type="checkbox" name="revision3" id='revision3' value="<?php echo "24 $rower24"; ?>" onchange="revise(this.value,this)" checked>
                                   
                            </td>
                            <?php
                            }
                            else
                            {
                            ?>
                            
                            <td style="text-align:center;">
                                
                                    <input class = "revision" style="text-align:center; padding:0; vertical-align:middle;" type="checkbox" name="revision3" id='revision3' value="<?php echo "24 $rower24"; ?>" onchange="revise(this.value,this)">
                                    
                            </td>
                        
                            <?php
                            }
                        }
                    ?>
                </tr>
                <?php
                    $i++;}
                }               
                ?>
            </tbody>
        </table> 
        <?php

        if($count25){ ?>
        <table class="table-main">
            <h4>D. Viable Demonstration Projects</h4>
            <thead>
                <tr>
                    <th>Name of Viable Demonstration Projects</th>
                    <th><nobr>Revenues</th>
                    <th><nobr>Cost</th>
                    <th><nobr>Date Started</th>
                    <th>Internal Rate of Return</th>
                    <th>Description of Supporting Documents</th>
                    <?php
                        if($level == 'Dean' && $que == 1)
                        {
                            ?>
                            <th><nobr>Mark for Revision</th>
                            
                            <?php
                        }
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                while($row1 = mysqli_fetch_assoc($query_run25)){
                    $rower25 = $row1['VdId'];
                    ?>
                
                <tr>
                    <td><?php echo $row1['VdName'];?></td>
                    <td><?php echo $row1['VdRevenue'];?></td>
                    <td><?php echo $row1['VdCost'];?></td>
                    <td><?php echo $row1['VdDateStart'];?></td>
                    <td><?php echo $row1['VdRate'];?></td>
                    <?php $file = $row1['VdTempName']; $download = 'uploads/'.$file;?> 
                    <td><a href="<?php echo $download;?>" download><?php echo $row1['VdFilename'];?></a></td>
                    <?php
                        if($level == 'Dean' && $que == 1)
                        {
                            if($row1['RevStat']== 1)
                            {

                            
                            ?>
                            <td style="text-align:center;">
                                
                                    <input class = "revision" style="text-align:center; padding:0; vertical-align:middle;" type="checkbox" name="revision3" id='revision3' value="<?php echo "25 $rower25"; ?>" onchange="revise(this.value,this)" checked>
                                   
                            </td>
                            <?php
                            }
                            else
                            {
                            ?>
                            
                            <td style="text-align:center;">
                               
                                    <input class = "revision" style="text-align:center; padding:0; vertical-align:middle;" type="checkbox" name="revision3" id='revision3' value="<?php echo "25 $rower25"; ?>" onchange="revise(this.value,this)">
                                    
                            </td>
                        
                            <?php
                            }
                        }
                    ?>
                </tr>
                <?php
                    $i++;}
                }               
                ?>
            </tbody>
        </table>   
        <?php

        if($count26){ ?>
        <table class="table-main">
            <h4>E. Awards/ Recognitions Received by Office from Reputable Organization</h4>
            <thead>
                <tr>
                    <th>Name of Award</th>
                    <th>Certifying Body</th>
                    <th>Place</th>
                    <th><nobr>Date Started</th>
                    <th>Level</th>
                    <th>Description of Supporting Documents</th>
                    <?php
                        if($level == 'Dean' && $que == 1)
                        {
                            ?>
                            <th><nobr>Mark for Revision</th>
                            
                            <?php
                        }
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                while($row1 = mysqli_fetch_assoc($query_run26)){
                    $rower26 = $row1['AoId'];
                    ?>
                
                <tr>
                    <td><?php echo $row1['AoName'];?></td>
                    <td><?php echo $row1['AoBody'];?></td>
                    <td><?php echo $row1['AoPlace'];?></td>
                    <td><?php echo $row1['AoDate'];?></td>
                    <td><?php echo $row1['AoLevel'];?></td>
                    <?php $file = $row1['AoTempName']; $download = 'uploads/'.$file;?> 
                    <td><a href="<?php echo $download;?>" download><?php echo $row1['AoFilename'];?></a></td>
                    <?php
                        if($level == 'Dean' && $que == 1)
                        {
                            if($row1['RevStat']== 1)
                            {

                            
                            ?>
                            <td style="text-align:center;">
                               
                                    <input class = "revision" style="text-align:center; padding:0; vertical-align:middle;" type="checkbox" name="revision3" id='revision3' value="<?php echo "26 $rower26"; ?>" onchange="revise(this.value,this)" checked>
                                    
                            </td>
                            <?php
                            }
                            else
                            {
                            ?>
                            
                            <td style="text-align:center;">
                                
                                    <input class = "revision" style="text-align:center; padding:0; vertical-align:middle;" type="checkbox" name="revision3" id='revision3' value="<?php echo "26 $rower26"; ?>" onchange="revise(this.value,this)">
                                    
                            </td>
                        
                            <?php
                            }
                        }
                    ?>
                </tr>
                <?php
                    $i++;}
                }               
                ?>
            </tbody>
        </table>    
        <?php

        if($count27){ ?>
        <table class="table-main">
            <h4>F. Community Relation and Outreach Program</h4>
            <thead>
                <tr>
                    <th>Title of the Program</th>
                    <th>Place</th>
                    <th><nobr>Date</th>
                    <th>Level</th>
                    <th>Description of Supporting Documents</th>
                    <?php
                        if($level == 'Dean' && $que == 1)
                        {
                            ?>
                            <th><nobr>Mark for Revision</th>
                            
                            <?php
                        }
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                while($row1 = mysqli_fetch_assoc($query_run27)){
                    $rower27 = $row1['RapId'];
                    ?>
                
                <tr>
                    <td><?php echo $row1['RapTitle'];?></td>
                    <td><?php echo $row1['RapPlace'];?></td>
                    <td><?php echo $row1['RapDate'];?></td>
                    <td><?php echo $row1['RapLevel'];?></td>
                    <?php $file = $row1['RapTempName']; $download = 'uploads/'.$file;?> 
                    <td><a href="<?php echo $download;?>" download><?php echo $row1['RapFilename'];?></a></td>
                    <?php
                        if($level == 'Dean' && $que == 1)
                        {
                            if($row1['RevStat']== 1)
                            {

                            
                            ?>
                            <td style="text-align:center;">
                                
                                    <input class = "revision" style="text-align:center; padding:0; vertical-align:middle;" type="checkbox" name="revision3" id='revision3' value="<?php echo "27 $rower27"; ?>" onchange="revise(this.value,this)" checked>
                                    
                            </td>
                            <?php
                            }
                            else
                            {
                            ?>
                            
                            <td style="text-align:center;">
                            
                                    <input class = "revision" style="text-align:center; padding:0; vertical-align:middle;" type="checkbox" name="revision3" id='revision3' value="<?php echo "27 $rower27"; ?>" onchange="revise(this.value,this)">
                                   
                            </td>
                        
                            <?php
                            }
                        }
                    ?>
                </tr>
                <?php
                    $i++;}
                }               
                ?>
            </tbody>
        </table> 
    </div>    
    <script>
        
        $('#thisuser').val($('#userId').val());
        $('#num').val($('#call').val());
       
    </script>         

<?php } ?>

