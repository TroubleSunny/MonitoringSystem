<?php
session_start();

include("connection.php");
include("functions.php");
include("navbar.php");


$user_data = check_login($con);
$test = $user_data['UserId'];
$resul = $con->query("SELECT EpId FROM extensionprogram WHERE SubmissionId = (SELECT SubmissionId FROM submission WHERE UserId = '$test' AND (SubmissionStatus = 'Ongoing' OR SubmissionStatus = 'Submitted') AND QuarterId = (SELECT QuarterId FROM quarter WHERE QuarterProgress='Ongoing')) ORDER BY EpId DESC");
$resul2 = $con->query("SELECT EpId FROM extensionprogram WHERE SubmissionId = (SELECT SubmissionId FROM submission WHERE UserId = '$test' AND (SubmissionStatus = 'Ongoing' OR SubmissionStatus = 'Submitted') AND QuarterId = (SELECT QuarterId FROM quarter WHERE QuarterProgress='Ongoing'))");
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
                <h2 class="pageTitle">VI. Other Accomplishments (If Any)</h2>
            </div>
        </div>
    </div>
</section>
<section id="part-banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="pageTitle">C. Extension Program and Expert Service Rendered</h3>
            </div>
        </div>
    </div>
</section>
<section id="part-banner-specific">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h4 class="pageTitle">C.2. Extension Program, Project and Activity (Ongoing and Completed)</h4>
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
                <label class="col-md-4 control-label" for="Status">Record No:</label>
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
                                        $thisid = $row1['EpId'];
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
                                        $id = $rows['EpId'];
                                        
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
                                        $pick = "SELECT EpId FROM extensionprogram ORDER BY EpId DESC LIMIT 1";
                                        $picker = mysqli_query($con,$pick);
                                        if(mysqli_num_rows($picker)>0)
                                        {
                                            foreach($picker as $t)
                                            {
                                                $send = $t['EpId'] + 1;
                                            }
                                            $recordcounter ++;
                                            echo " <option value='$send'>$recordcounter</option>";
                                            
                                        }
                                        
                                    }
                                    while($rows = $resul->fetch_assoc())
                                    {
                                        $id = $rows['EpId'];
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
    <form name="actorInsert" onSubmit="return ValidateActInsert()" action="Insert/ExtensionActivityInsert.php" method="POST" enctype="multipart/form-data">
        <?php
           
           
            $program = null;
            $project = null;
            $activity = null;
            $nature = null;
            $fundsource = null;
            $fundamount = null;
            $class = null;
            $partnership = null;

            $datefrom = null;
            $dateto = null;

            $status = null;
            $venue = null;
            $traineenum = null;
            $traineeclass = null;
            $hours = null;

            $qPoor = null;
            $qFair = null;
            $qSatisfactory = null;
            $qVery = null;
            $qOutstanding = null;

            $tPoor = null;
            $tFair = null;
            $tSatisfactory = null;
            $tVery = null;
            $tOutstanding = null;

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
                $queryr = "SELECT EpId FROM extensionprogram ORDER BY EpId DESC";
                $queryr4 = mysqli_query($con,$queryr);
                if(mysqli_num_rows($queryr4)>0)
                {
                    $count =1;
                    foreach($queryr4 as $t )
                    {
                        if($count==1)
                        {
                            $record = $t['EpId']+1;
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
                            $record = $t['EpId'];
                        }
                        $count2=$count2+1;
                    }
                }
                else
                {
                    $record = null;
                }    
            }
            $query = "SELECT * FROM extensionprogram WHERE EpId = '$record'";
            $query1 = "SELECT * FROM timeliness_rate WHERE EpId = '$record'";
            $query2 = "SELECT * FROM quality_rate WHERE EpId = '$record'";
            $query_run = mysqli_query($con,$query);
            $query_run1 = mysqli_query($con,$query1);
            $query_run2 = mysqli_query($con,$query2);

            if(mysqli_num_rows($query_run1)>0)
            {
                foreach($query_run1 as $row1)
                {
                    $tPoor = $row1['TRPoor'];
                    $tFair = $row1['TRFair'];
                    $tSatisfactory = $row1['TRSatisfactory'];
                    $tVery = $row1['TRVery'];
                    $tOutstanding = $row1['TROutstanding'];

                }
            }
            if(mysqli_num_rows($query_run2)>0)
            {
                foreach($query_run2 as $row2)
                {
                    $qPoor = $row2['QRPoor'];
                    $qFair = $row2['QRFair'];
                    $qSatisfactory = $row2['QRSatisfactory'];
                    $qVery = $row2['QRVery'];
                    $qOutstanding = $row2['QROutstanding'];

                }
            }
            if(mysqli_num_rows($query_run)>0)
            {
                foreach($query_run as $row)
                {
                    $program = $row['EPProgramTitle'];
                    $project = $row['EPProjectTitle'];
                    $activity = $row['EPActivityTitle'];
                    $nature = $row['EPNature'];
                    $fundsource = $row['EPFundSource'];
                    $fundamount = $row['EPFundAmount'];
                    $class = $row['EPClass'];
                    $partnership = $row['EPPartnership'];

                    $datefrom = $row['EPDateFrom'];
                    $dateto = $row['EPDateTo'];

                    $status = $row['EPStatus'];
                    $venue = $row['EPVenue'];
                    $traineenum = $row['EPTraineeNum'];
                    $traineeclass = $row['EPTraineeClass'];
                    $hours = $row['EPHours'];

                    $file = $row['EPTempName'];
                    $original = $row['EPFilename'];
                    $change = $row['EpId'];
                }
            }
            
        ?>
        <div class="form-group">
            <div class="col-md-11"style="margin-bottom:15px;">
                <label class="col-md-4 control-label" >Title of Extension Program:</label>
                <div class="col-md-8">
                    <input name="change" type="hidden" value="<?php echo $change; ?>">
                    <input name="program" class="form-control input-sm" placeholder="" type="text" value="<?php echo $program; ?>" minlength='3' maxlength='100' onkeyup="javascript:capitalize(this.id, this.value);" autocomplete="off" required>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-11"style="margin-bottom:15px;">
                <label class="col-md-4 control-label" >Title of Extension Project:</label>
                <div class="col-md-8">
                    <input name="project" class="form-control input-sm" placeholder="" type="text" value="<?php echo $project; ?>" minlength='3' maxlength='100' onkeyup="javascript:capitalize(this.id, this.value);" autocomplete="off" required>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-11"style="margin-bottom:15px;">
                <label class="col-md-4 control-label" >Title of Extension Activity:</label>
                <div class="col-md-8">
                    <input name="activity" class="form-control input-sm" placeholder="" type="text" value="<?php echo $activity; ?>" minlength='3' maxlength='100' onkeyup="javascript:capitalize(this.id, this.value);" autocomplete="off" required>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-11"style="margin-bottom:15px;">
                <label class="col-md-4 control-label" >Nature of Involvement:</label>
                <div class="col-md-8">
                    <select class="form-control input-sm" name="nature" value="<?php echo $nature; ?>" minlength='3' maxlength='100' id="Natureeditable">
                        <option value="none"></option>
                        <option value="Facilitator" >Facilitator</option>
                        <option value="Resource" >Resource Speaker</option>
                        <option value="Organizer" >Organizer</option>
                        <option value="Extensionist" >Extensionist</option>
                    </select> 
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-11"style="margin-bottom:15px;">
                <label class="col-md-4 control-label" >Source of Fund:</label>
                <div class="col-md-8">
                    <select class="form-control input-sm" name="fundsource" value="<?php echo $fundsource; ?>" minlength='3' maxlength='100' id="Fundeditable" required>
                        <option value=""></option>
                        <option value="University" >University Funded</option>
                        <option value="Self">Self Funded</option>
                        <option value="Externally Funded">Externally Funded</option>
                    </select> 
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-11"style="margin-bottom:15px;">
                <label class="col-md-4 control-label" >Amount of Fund:</label>
                <div class="col-md-8">
                    <input name="fundamount" class="form-control input-sm" placeholder="" type="number" step="0.01" value="<?php echo $fundamount; ?>" onkeyup="javascript:capitalize(this.id, this.value);" autocomplete="off" required>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-11"style="margin-bottom:15px;">
                <label class="col-md-4 control-label" >Classification of the Extension Activity:</label>
                <div class="col-md-8">
                    <select class="form-control input-sm" name="class" value="<?php echo $class; ?>" minlength='3' maxlength='100' id="Classificationeditable" required>
                        <option value=""></option>
                        <option value="Livelihood" >Livelihood Development</option>
                        <option value="Health">Health</option>
                        <option value="Educational">Educational and Cultural Exchange</option>
                        <option value="Technology">Technology Transfer</option>
                        <option value="Knowledge">Knowledge Transfer</option>
                        <option value="Local">Local Governance</option>
                        <option value="Information">Information Technology</option>
                    </select> 
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-11"style="margin-bottom:15px;">
                <label class="col-md-4 control-label" for="FNAME">Partnership Levels:</label>
                <div class="col-md-8">
                    <select class="form-control input-sm" name="partnership" value="<?php echo $partnership; ?>" minlength='3' maxlength='100' id="Leveleditable">
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
        <div class="form-group" style="padding-bottom:5px;">
            <div class="col-md-12" style="margin-bottom:15px;">
                <label>Project Duration</label>
            </div>
        </div>  
        <div class="form-group">
            <div class="rows">
                <div class="col-md-11">                
                    <label class="col-md-4 control-label" >From:</label>
                    <div class="col-md-8">
                        <input name="datefrom"  class="form-control input-sm" placeholder="" type="date" value="<?php echo $datefrom;?>"  onkeyup="javascript:capitalize(this.id, this.value);" autocomplete="off" required>
                    </div>
                </div>
            </div>
        </div> 
        <div class="form-group">
            <div class="rows">
                <div class="col-md-11"> 
                    <label class="col-md-4 control-label" >To:</label>
                    <div class="col-md-8">
                        <input name="dateto" class="form-control input-sm" placeholder="" type="date" value="<?php echo $dateto;?>"  onkeyup="javascript:capitalize(this.id, this.value);" autocomplete="off" required>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-11"style="margin-bottom:15px;">
                <label class="col-md-4 control-label" >Status:</label>
                <div class="col-md-8">
                    <select class="form-control input-sm" minlength='3' maxlength='100' name="status" value="<?php echo $status; ?>"id="Statuseditable" required>
                        <option value="" ></option>
                        <option value="Ongoing">Ongoing</option>
                        <option value="Completed">Completed</option>   
                        <option value="Deferred">Deferred</option>   
                    </select> 
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-11"style="margin-bottom:15px;">
                <label class="col-md-4 control-label" >Place/Venue:</label>
                <div class="col-md-8">
                    <input class="form-control input-sm" minlength='3' maxlength='100' placeholder="" name="venue" type="text" value="<?php echo $venue; ?>"  onkeyup="javascript:capitalize(this.id, this.value);" autocomplete="off" required>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-11"style="margin-bottom:15px;">
                <label class="col-md-4 control-label" >No of Trainees:</label>
                <div class="col-md-8">
                    <input class="form-control input-sm" placeholder="" name="traineenum" type="number" value="<?php echo $traineenum; ?>"  onkeyup="javascript:capitalize(this.id, this.value);" autocomplete="off" required>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-11"style="margin-bottom:15px;">
                <label class="col-md-4 control-label" >Classification of Trainees:</label>
                <div class="col-md-8">
                    <input class="form-control input-sm" placeholder="" name="traineeclass" minlength='3' maxlength='100'  type="text" value="<?php echo $traineeclass; ?>"  onkeyup="javascript:capitalize(this.id, this.value);" autocomplete="off" required>
                </div>
            </div>
        </div>
        <div class="form-group" style="padding-bottom:5px;">
            <div class="col-md-12" style="margin-bottom:15px;">
                
            </div>
        </div>  
        <div class="col-xs-6 form-group">
            <label>Total No. of Trainees/ Beneficiaries who rated the quality of extension service </label>
            <div class="col-md-11"style="margin-bottom:15px;">
                <label class="col-md-7 control-label" >Poor:</label>
                <div class="col-md-4">                   
                    <input class="form-control input-sm" name=" qPoor" placeholder="" type="number" value="<?php echo $qPoor;?>"  onkeyup="javascript:capitalize(this.id, this.value);" autocomplete="off" required>
                </div>
                <label class="col-md-7 control-label" >Fair:</label>
                <div class="col-md-4">                   
                    <input class="form-control input-sm" name="qFair" placeholder="" type="number" value="<?php echo $qFair;?>"  onkeyup="javascript:capitalize(this.id, this.value);" autocomplete="off" required>
                </div>
                <label class="col-md-7 control-label" >Satisfactory:</label>
                <div class="col-md-4">                   
                    <input class="form-control input-sm" name="qSatisfactory" placeholder="" type="number" value="<?php echo $qSatisfactory;?>"  onkeyup="javascript:capitalize(this.id, this.value);" autocomplete="off" required>
                </div>
                <label class="col-md-7 control-label" >Very Satisfactory:</label>
                <div class="col-md-4">
                    <input class="form-control input-sm" name="qVery" placeholder="" type="number" value="<?php echo $qVery;?>"  onkeyup="javascript:capitalize(this.id, this.value);" autocomplete="off" required>
                </div>
                <label class="col-md-7 control-label" >Outstanding:</label>
                <div class="col-md-4">
                    <input class="form-control input-sm" name="qOutstanding" placeholder="" type="number" value="<?php echo $qOutstanding;?>"  onkeyup="javascript:capitalize(this.id, this.value);" autocomplete="off" required>
                </div>
            </div>
        </div>
        <div class="col-xs-6 form-group">
            <label>Total No. of Trainees/ Beneficiaries who rated the timeliness of extension service</label>
            <div class="col-md-11"style="margin-bottom:15px;">
                <label class="col-md-7 control-label" >Poor:</label>
                <div class="col-md-4">                   
                    <input class="form-control input-sm" name=" tPoor" placeholder="" type="number" value="<?php echo $tPoor;?>"  onkeyup="javascript:capitalize(this.id, this.value);" autocomplete="off" required>
                </div>
                <label class="col-md-7 control-label" >Fair:</label>
                <div class="col-md-4">                   
                    <input class="form-control input-sm" name="tFair" placeholder="" type="number" value="<?php echo $tFair;?>"  onkeyup="javascript:capitalize(this.id, this.value);" autocomplete="off" required>
                </div>
                <label class="col-md-7 control-label" >Satisfactory:</label>
                <div class="col-md-4">                   
                    <input class="form-control input-sm" name="tSatisfactory" placeholder="" type="number" value="<?php echo $tSatisfactory;?>"  onkeyup="javascript:capitalize(this.id, this.value);" autocomplete="off" required>
                </div>
                <label class="col-md-7 control-label" >Very Satisfactory:</label>
                <div class="col-md-4">
                    <input class="form-control input-sm" name="tVery" placeholder="" type="number" value="<?php echo $tVery;?>"  onkeyup="javascript:capitalize(this.id, this.value);" autocomplete="off" required>
                </div>
                <label class="col-md-7 control-label" >Outstanding:</label>
                <div class="col-md-4">
                    <input class="form-control input-sm" name="tOutstanding" placeholder="" type="number" value="<?php echo $tOutstanding;?>"  onkeyup="javascript:capitalize(this.id, this.value);" autocomplete="off" required>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-11"style="margin-bottom:15px;">
                <label class="col-md-4 control-label" >Number of Hours:</label>
                <div class="col-md-8">
                    <input name="hours" class="form-control input-sm" placeholder="" type="number" value="<?php echo $hours; ?>"  onkeyup="javascript:capitalize(this.id, this.value);" autocomplete="off" required>
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
        location.href = "Partnerships.php";
    };
</script>
<script type="text/javascript">
    document.getElementById("backbtn").onclick = function () {
        <?php
            $stat = ("UPDATE addstat SET stat = 0 WHERE id = 1");
            mysqli_query($con,$stat);
        ?>
        location.href = "ExtensionRendered3.php";
    };
</script>
<script>
    $(document).ready(function(){
        var i = 1;
        $('#add').click(function(){
            i++;
            $('#dynamic_field').append('<tr id="row'+i+'"><td><input type="text" name="name[]" placeholder="Enter Name" class="form-control name_list" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');  
        });
        $(document).on('click','.btn_remove',function(){
            var button_id = $(this).attr("id");
            $('#row'+button_id+'').remove();
        });
    });
</script>
<script>
    $('#Natureeditable').editableSelect();
    $('#Fundeditable').editableSelect();
    $('#Classificationeditable').editableSelect();
    $('#Leveleditable').editableSelect();
    $('#Statuseditable').editableSelect();
</script>

<script>
    function ValidateActInsert() {
    var specialChars = /[^a-zA-Z0-9 ]/g;
    if (document.actorInsert.program.value.match(specialChars)) {
        alert ("Special Characters are not allowed")
        return false;
    }
    else if (document.actorInsert.project.value.match(specialChars)) {
        alert ("Special Characters are not allowed")
        return false;
    }
    else if (document.actorInsert.activity.value.match(specialChars)) {
        alert ("Special Characters are not allowed")
        return false;
    }
    else if (document.actorInsert.nature.value.match(specialChars)) {
        alert ("Special Characters are not allowed")
        return false;
    }
    else if (document.actorInsert.fundsource.value.match(specialChars)) {
        alert ("Special Characters are not allowed")
        return false;
    }
    else if (document.actorInsert.class.value.match(specialChars)) {
        alert ("Special Characters are not allowed")
        return false;
    }
    else if (document.actorInsert.partnership.value.match(specialChars)) {
        alert ("Special Characters are not allowed")
        return false;
    }
    else if (document.actorInsert.traineeclass.value.match(specialChars)) {
        alert ("Special Characters are not allowed")
        return false;
    }
    else if (document.actorInsert.status.value.match(specialChars)) {
        alert ("Special Characters are not allowed")
        return false;
    }
    return (true);
}
</script>  