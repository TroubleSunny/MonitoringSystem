<?php
session_start();

include("connection.php");
include("functions.php");
include("navbar.php");


$user_data = check_login($con);
$test = $user_data['UserId'];
$resul = $con->query("SELECT OtId FROM opcrt WHERE SubmissionId = (SELECT SubmissionId FROM submission WHERE UserId = '$test' AND (SubmissionStatus = 'Ongoing' OR SubmissionStatus = 'Submitted') AND QuarterId = (SELECT QuarterId FROM quarter WHERE QuarterProgress='Ongoing')) ORDER BY OtId DESC");
$resul2 = $con->query("SELECT OtId FROM opcrt WHERE SubmissionId = (SELECT SubmissionId FROM submission WHERE UserId = '$test' AND (SubmissionStatus = 'Ongoing' OR SubmissionStatus = 'Submitted') AND QuarterId = (SELECT QuarterId FROM quarter WHERE QuarterProgress='Ongoing')) ");
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
                <h2 class="pageTitle">II.Accomplishment Based on OPCR</h2>
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
                                        $thisid = $row1['OtId'];
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
                                            $id = $rows['OtId'];
                                            
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
                                        $pick = "SELECT OtId FROM opcrt ORDER BY OtId DESC LIMIT 1";
                                        $picker = mysqli_query($con,$pick);
                                        if(mysqli_num_rows($picker)>0)
                                        {
                                            foreach($picker as $t)
                                            {
                                                $send = $t['OtId'] + 1;
                                            }
                                            $recordcounter ++;
                                            echo " <option value='$send'>$recordcounter</option>";
                                            
                                        }
                                        
                                    }
                                    while($rows = $resul->fetch_assoc())
                                    {
                                        $id = $rows['OtId'];
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
    <form name="actorInsert" onSubmit="return ValidateActInsert()" action="Insert/OPCR3Insert.php" method="POST" enctype="multipart/form-data">
        <?php
            $output = null;
            $datefrom = null;
            $dateto = null;
            $desc = null;
            $status = null;
            $remarks = null;
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
                $queryr = "SELECT OtId FROM opcrt ORDER BY OtId DESC";
                $queryr4 = mysqli_query($con,$queryr);
                if(mysqli_num_rows($queryr4)>0)
                {
                    $count =1;
                    foreach($queryr4 as $t )
                    {
                        if($count==1)
                        {
                            $record = $t['OtId']+1;
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
                            $record = $t['OtId'];
                        }
                        $count2=$count2+1;
                    }
                }
                else
                {
                    $record = null;
                }
                
            }

            
            $query = "SELECT * FROM opcrt WHERE OtId = '$record'";
            $query_run = mysqli_query($con,$query);
            
            if(mysqli_num_rows($query_run)>0)
            {
                foreach($query_run as $row)
                {
                    $output = $row['OtOutput'];
                    $datefrom = $row['OtTargetDate'];
                    $dateto = $row['OtActualDate'];
                    $desc = $row['OtDesc'];
                    $status = $row['OtStatus'];
                    $remarks = $row['OtRemarks'];
                    $file = $row['OtTempName'];
                    $original = $row['OtFilename'];
                    $change = $row['OtId'];
                }
            }
            
        ?>
        <div class= "col-md-12">
            <label>Commitment Measurable by Timeliness</label>
        </div>
        <div class="form-group">
            <div class="col-md-11">
                <label class="col-md-4 control-label" for="FNAME">Final Output:</label>
                <div class="col-md-8">
                    <input name="change" type="hidden" value="<?php echo $change; ?>">
                    <input name="output" class="form-control input-sm" placeholder="" type="text" value="<?php echo $output; ?>"  minlength="3" maxlength="80" onkeyup="javascript:capitalize(this.id, this.value);" autocomplete="off" required>
                </div>
            </div>
        </div>   
        <div class= "col-md-12">
            <label>Classification</label>
        </div>
        <div class="form-group">
            <div class="rows">
                <div class="col-md-11">                
                    <label class="col-md-4 control-label" for="FNAME">Target Date:</label>
                    <div class="col-md-8">
                        <input name="datefrom"  class="form-control input-sm" placeholder="" type="date" value="<?php echo $datefrom;?>"  onkeyup="javascript:capitalize(this.id, this.value);" autocomplete="off" required>
                    </div>
                </div>
            </div>
        </div> 
        <div class="form-group">
            <div class="rows">
                <div class="col-md-11"> 
                    <label class="col-md-4 control-label" for="FNAME">Actual Date:</label>
                    <div class="col-md-8">
                        <input name="dateto" class="form-control input-sm" placeholder="" type="date" value="<?php echo $dateto;?>"  onkeyup="javascript:capitalize(this.id, this.value);" autocomplete="off" required>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-11">
                <label class="col-md-4 control-label" for="FNAME">Description of Accomplishment:</label>
                <div class="col-md-8">
                    <input name="desc" class="form-control input-sm" placeholder="" type="text" value="<?php echo $desc;?>"  minlength="3" maxlength="80" onkeyup="javascript:capitalize(this.id, this.value);" autocomplete="off" required>
                </div>
            </div>
        </div>   
        <div class= "col-md-12">
            <label>Proof of Compliance</label>
        </div>
        <div class="form-group">
            <div class="col-md-11"style="margin-bottom:15px;">
                <label class="col-md-4 control-label" for="Status">Status:</label>
                <div class="col-md-8">
                    <select class="form-control input-sm" name="status" id="Status" value="<?php echo $status;?>" minlength="3" maxlength="80" required>
                        <option value=""></option>
                        <option value="Ongoing">Ongoing</option>
                        <option value="Completed">Completed</option>   
                        <option value="Deferred">Deferred</option>   
                    </select> 
                </div>
            </div>
        </div>  
        <div class="form-group">
            <div class="col-md-11">
                <label class="col-md-4 control-label" for="FNAME">Status/Remarks:</label>
                <div class="col-md-8">
                    <input name="remarks" class="form-control input-sm" placeholder="" type="text" value="<?php echo $remarks;?>"  minlength="3" maxlength="80" onkeyup="javascript:capitalize(this.id, this.value);" autocomplete="off" required>
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
        location.href = "AttendanceUniversity.php";
    };
</script>
<script type="text/javascript">
    document.getElementById("backbtn").onclick = function () {
        <?php
            $stat = ("UPDATE addstat SET stat = 0 WHERE id = 1");
            mysqli_query($con,$stat);
        ?>
        location.href = "AccomplishmentOPCR2.php";
    };
</script>
<script>
    $('#Status').editableSelect();
</script>

<script>
    function ValidateActInsert() {
    var specialChars = /[^a-zA-Z0-9 ]/g;
    if (document.actorInsert.output.value.match(specialChars)) {
        alert ("Special Characters are not allowed")
        return false;
    }
    else if (document.actorInsert.desc.value.match(specialChars)) {
        alert ("Special Characters are not allowed")
        return false;
    }
    else if (document.actorInsert.status.value.match(specialChars)) {
        alert ("Special Characters are not allowed")
        return false;
    }
    else if (document.actorInsert.remarks.value.match(specialChars)) {
        alert ("Special Characters are not allowed")
        return false;
    }
    
    return (true);
}
</script>