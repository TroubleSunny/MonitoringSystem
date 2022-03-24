<?php
session_start();

include("connection.php");
include("functions.php");
include("navbar.php");


$user_data = check_login($con);
$test = $user_data['UserId'];
$resul = $con->query("SELECT AwardsId FROM awards WHERE SubmissionId = (SELECT SubmissionId FROM submission WHERE UserId = '$test' AND (SubmissionStatus = 'Ongoing' OR SubmissionStatus = 'Submitted') AND QuarterId = (SELECT QuarterId FROM quarter WHERE QuarterProgress='Ongoing')) ORDER BY AwardsId DESC");
$resul2 = $con->query("SELECT AwardsId FROM awards WHERE SubmissionId = (SELECT SubmissionId FROM submission WHERE UserId = '$test' AND (SubmissionStatus = 'Ongoing' OR SubmissionStatus = 'Submitted') AND QuarterId = (SELECT QuarterId FROM quarter WHERE QuarterProgress='Ongoing'))");
$quarter = $con->query("SELECT QuarterPart FROM quarter WHERE QuarterProgress = 'Ongoing'");
$stat = $con->query("SELECT stat FROM addstat WHERE id = 1");
$quarteryear = $con->query("SELECT SchoolYear FROM schoolyear WHERE YearId = (SELECT YearId FROM quarter WHERE QuarterProgress = 'Ongoing')");
while($qu = $quarter->fetch_assoc())
{
    $q = $qu['QuarterPart'];
}
while($quy = $quarteryear->fetch_assoc())
{
    $qy = $quy['SchoolYear'];
}
while($s = $stat->fetch_assoc())
{
    $addstat = $s['stat'];
}
?>

<section id="inner-headline">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="pageTitle">Quarterly Assessment Report Form</h2>
            </div>
        </div>
    </div>
</section>
<section id="Form-banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="pageTitle">I.Accomplishment Report</h2>
            </div>
        </div>
    </div>
</section>
<section id="part-banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="pageTitle">B. OUTSTANDING ACHIVEMENTS/AWARDS, OFFICERSHIP/MEMBERSHIP IN PROFFESIONAL ORGANIZATIONS, & TRAININGS/SEMINARS ATTENDED</h3>
            </div>
        </div>
    </div>
</section>

<section id="part-banner-specific">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h4 class="pageTitle">B. 1. Administrative Employees Outstanding Achievements/Awards </h4>
                
            </div>
        </div>
    </div>
</section>

<section id="part-banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
            <h4 style="margin:0 auto; padding:0; text-align:center;" class="pageTitle"><?php echo $q; echo "($qy)";?></h4>
            </div>
        </div>
    </div>
</section>
<div class="Form-Group1">
    <form action="" method="GET">
        <div class="form-group">
            
            <div class="col-md-4"style="margin:15px; float:right;">
            
                <label class="col-md-4 control-label" for="Status">Record No.</label>
                <div class="col-lg-3">
                    <select class="form-control input-sm" name="Record" id="Record">
                        <?php
                            $recordcounter = mysqli_num_rows($resul);
                          
                            if($resul->num_rows == 0)
                            {
                                echo "<option value=''>1</option>";
                            }
                            else
                            {
                                $i = 0;
                                $r = 1;
                                $a = 1;
                                if(isset($_GET['Record'])) 
                                {
                                    $idadd = $_GET['Record'];
                                    
                                    while($row1 = mysqli_fetch_assoc($resul2))
                                    {
                                        $thisid = $row1['AwardsId'];
                                        if($thisid != $idadd)
                                        {
                                            $r++;
                                        }
                                        if($thisid == $idadd)
                                        {
                                            
                                            if($a==$recordcounter)
                                            {
                                                $r = $recordcounter;
                                            }
                                            break;
                                        }
                                        $a++;
                                        
                                    }
                                    
                                    
                                    echo " <option value='$idadd'>$r</option>";
                                                          
                                     
                                    while($rows = $resul->fetch_assoc())
                                    {  
                                        $id = $rows['AwardsId'];
                                        
                                        if($i==0)
                                        {
                                            
                                            if($idadd!=$id)
                                            {
                                                echo " <option value='$id'>$recordcounter</option>";
                                            }
                                        }                                     
                                        else
                                        {  
                                            if($idadd!=$id)
                                            {
                                                echo " <option value='$id'>$recordcounter</option>";   
                                            } 
                                           
                                        }
                                        
                                        $i=$i+1;
                                        $recordcounter=$recordcounter-1;
                                      
                                    } 
                                }
                                else
                                {
                                    if($addstat == 1)
                                    {
                                        $pick = "SELECT AwardsId FROM awards ORDER BY AwardsId DESC LIMIT 1";
                                        $picker = mysqli_query($con,$pick);
                                        if(mysqli_num_rows($picker)>0)
                                        {
                                            foreach($picker as $t)
                                            {
                                                $send = $t['AwardsId'] + 1;
                                               
                                            }
                                            $recordcounter ++;
                                            echo " <option value='$send'>$recordcounter</option>";
                                            
                                        }
                                        $recordcounter = $recordcounter-1;
                                        
                                    }
                                   
                                    while($rows = $resul->fetch_assoc())
                                    {
                                        $id = $rows['AwardsId'];
                                        echo " <option value='$id'>$recordcounter</option>";   
                                        $recordcounter = $recordcounter-1;

                                    }
                                }
                            }
                        ?>
                    </select>
                </div>
                <div class="col-lg-2">
                    <button class="btn btn-primary" style="padding:4px; font-size:16px; margin:0 auto;" type="load" onclick="return confirm('Do you want to load this record?');">Load Record</button>
                </div>
            </div>
        </div>
    </form>
    <form action="Insert/AwardsInsert.php" method="POST" enctype="multipart/form-data">
        <?php
            $award = null;
            $classification = null;
            $body = null;
            $level = null;
            $venue = null;  
            $datefrom = null;
            $dateto = null;
            $file = null;
            $change=null;
            
            if(isset($_GET['Record']))
            {
                $stat = ("UPDATE addstat SET stat = 0 WHERE id = 1");
                mysqli_query($con,$stat);
                $record = $_GET['Record'];
                $change = $_GET['Record'];
                    
            }

            else if($addstat == 1)
            {
                $queryr = "SELECT AwardsId FROM awards ORDER BY AwardsId DESC";
                $queryr4 = mysqli_query($con,$queryr);
                if(mysqli_num_rows($queryr4)>0)
                {
                    $count =1;
                    foreach($queryr4 as $t )
                    {
                        if($count==1)
                        {
                            $record = $t['AwardsId']+1;
                        }
                        $count=$count+1;
                        
                    }
  
                }
               
                
            }
            if(!isset($_GET['Record']) && $addstat==0)
            {
               
                if(mysqli_num_rows($resul)>0)
                {
                    $count2=1;
                    foreach($resul as $t)
                    {
                        
                        if($count2==1)
                        {
                            $record = $t['AwardsId'];
                        }
                        $count2=$count2+1;
                    }
                }
                else
                {
                    $record = null;
                }
              
                
            }
            $query = "SELECT * FROM awards WHERE AwardsId = '$record'";
            $query_run = mysqli_query($con,$query);
            
            if(mysqli_num_rows($query_run)>0)
            {
                foreach($query_run as $row)
                {
                    $award = $row['AwAward'];
                    $classification = $row['AwClass'];
                    $body = $row['AwBody'];
                    $level = $row['AwLevel'];
                    $venue = $row['AwVenue'];
                    $datefrom = $row['AwDateFrom'];
                    $dateto = $row['AwDateTo'];
                    $file = $row['AwTempName'];
                    $original = $row['AwFilename'];
                    $change = $row['AwardsId'];
                    
                }
            }
            

        ?>
        <div class="form-group">
            <div class="col-md-11" style="margin:0 auto; text-align:center; float:none;">
                <label class="control-label" for="FNAME" style="margin:0 auto;">Awards of distinction received in recognition of achievement in relevant areas of specialization/profession and/or assignment of Administrative Employee concerned</label>
                <div class="col-md-12" style=" height:36px; font-size:18px;">
                    <input name="change" type="hidden" value="<?php echo $change; ?>">
                    <input name="award" class="form-control input-sm" placeholder="" style="text-align:center; float:none; vertical-align:center; margin:auto; padding:auto;" type="text" value="<?php echo $award; ?>"  onkeyup="javascript:capitalize(this.id, this.value);" autocomplete="on" minlength="3" maxlength="80" required>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-11">
                <label class="col-md-4 control-label" for="FNAME">Classification:</label>
                <div class="col-md-8">
                    <select class="form-control input-sm" name="Classification" id="Classificationeditable" value="<?php echo $classification; ?>" spellcheck="on" minlength="3" maxlength="80" required>
                        <option value=""></option>
                        <option value="Research" >Research</option>
                        <option value="Extension">Extension</option>
                        <option value="Arts/Media/Culture & Sports">Arts/Media/Culture & Sports</option>
                        <option value="Invention">Invention</option>   
                        <option value="Innovation">Innovation</option>  
                        <option value="Profesional">Profesional</option>
                        <option value="Service">Service</option> 
                    </select> 
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-11">
                <label class="col-md-4 control-label" for="FNAME">Award Giving Body:</label>
                <div class="col-md-8">
                    <input name="body" class="form-control input-sm" placeholder="" type="text" value="<?php echo $body; ?>"  onkeyup="javascript:capitalize(this.id, this.value);" autocomplete="off" minlength="3" maxlength="80" required>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-11"style="margin-bottom:15px;">
                <label class="col-md-4 control-label" for="Status">Level:</label>
                <div class="col-md-8">
                    <select class="form-control input-sm" name="level" id="Leveleditable" value="<?php echo $level; ?>" minlength="3" maxlength="80" required>
                        <option value=""></option>
                        <option value="International" >International</option>
                        <option value="National">National</option>
                        <option value="Regional">Regional</option>
                        <option value="Provincial">Provincial/City/Municipal</option>   
                        <option value="Local">Local-PUP</option>   
                    </select> 
                </div>
            </div>
        </div>  
        <div class="form-group">
            <div class="col-md-11">
                <label class="col-md-4 control-label" for="FNAME">Venue:</label>
                <div class="col-md-8">
                    <input name="venue" class="form-control input-sm" placeholder="" type="text" value="<?php echo $venue; ?>" minlength="3" maxlength="50"  onkeyup="javascript:capitalize(this.id, this.value);" autocomplete="on" required>
                </div>
            </div>
        </div>
        <div class= "col-md-12">
            <label>Inclusive Date of Awards</label>
        </div>
        <div class="form-group">
            <div class="rows">
                <div class="col-md-11">                
                    <label class="col-md-4 control-label" for="FNAME">From:</label>
                    <div class="col-md-8">
                        <input name="datefrom"  class="form-control input-sm" placeholder="" type="date" value="<?php echo $datefrom;?>"  onkeyup="javascript:capitalize(this.id, this.value);" autocomplete="off" required>
                    </div>
                </div>
            </div>
        </div> 
        <div class="form-group">
            <div class="rows">
                <div class="col-md-11"> 
                    <label class="col-md-4 control-label" for="FNAME">To:</label>
                    <div class="col-md-8">
                        <input name="dateto" class="form-control input-sm" placeholder="" type="date" value="<?php echo $dateto;?>"  onkeyup="javascript:capitalize(this.id, this.value);" autocomplete="off" required>
                    </div>
                </div>
            </div>
        </div> 
        <?php
            if(mysqli_num_rows($query_run)>0)
            {          
                $download = 'uploads/'.$file; 
                echo "<div class='col-md-11'><label class='col-md-5'>Submitted Document:</label> <a class='col-md-5' href= '".$download."' download>".$original."</a></div>
                <div class='panel-body'>  
                    <div class='col-md-11'>       
                        <label class='col-md-4'>Supporting Documents here:</label>
                        <input class = 'col-md-7' name='file' type='file' value=''> 
                    </div>
                </div>
                ";
                
            }
            else
            {
                echo "<div class='panel-body'>  
                        <div class='col-md-11'>       
                            <label class='col-md-4'>Supporting Documents here:</label>
                            <input class = 'col-md-7' name='file' type='file' value='' required> 
                        </div>
                    </div>";
            }
        ?>
        <div class="Button-group">
            <button class="btn btn-primary" name="submit" value="submit" type="submit" style="font-weight: bold;" onclick="return confirm('Save submission for this segment?');">Save</span></button>
            <?php
        
                  
                if(mysqli_num_rows($query_run)>0)
                {    
                    echo '<button class="btn btn-primary" name="reseter" value="reseter" type="reseter" style="font-weight: bold;" onclick="return confirm(\'This will Delete The Record. Proceed?\');">Clear</span></button>';
                    echo '<button class="btn btn-primary" name="add" value="add" type="add" style="font-weight: bold;" onclick="return confirm(\'Add Another Record?\');">Add</span></button>';
                }
                else
                {
                    echo '<button class="btn btn-primary" name="reset" value="reset" type="reset" style="font-weight: bold;" onclick="return confirm(\'Are you sure?\');">Clear</span></button>';
                }
            
           
            ?>
        </div>
    </form>
</div>


<div class="Button-group">
    <div class="border border-light p-3 mb-4">
        <button id="backbtn" class="btn btn-primarys" name="submit" type="submit" style="font-weight: bold;">Previous</span></button>
        <button id="skipbtn" class="btn btn-primarys" name="submit" type="submit" style="font-weight: bold;">Next</span></button>
    </div>
</div>  
<script type="text/javascript">
    document.getElementById("skipbtn").onclick = function () {
        <?php
            $stat = ("UPDATE addstat SET stat = 0 WHERE id = 1");
            mysqli_query($con,$stat);
        ?>
        location.href = "OutstandingB2.php";
       
    };
</script>
<script type="text/javascript">
    document.getElementById("backbtn").onclick = function () {
        <?php
            $stat = ("UPDATE addstat SET stat = 0 WHERE id = 1");
            mysqli_query($con,$stat);
        ?>
        location.href = "AccomplishmentReportA.php";
    };
</script>

<script>
   $('#Leveleditable').editableSelect();
   $('#Classificationeditable').editableSelect();

</script>
