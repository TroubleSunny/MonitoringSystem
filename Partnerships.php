<?php
session_start();

include("connection.php");
include("functions.php");
include("navbar.php");


$user_data = check_login($con);
$test = $user_data['UserId'];
$resul = $con->query("SELECT PartnershipId FROM partnership WHERE SubmissionId = (SELECT SubmissionId FROM submission WHERE UserId = '$test' AND (SubmissionStatus = 'Ongoing' OR SubmissionStatus = 'Submitted') AND QuarterId = (SELECT QuarterId FROM quarter WHERE QuarterProgress='Ongoing')) ORDER BY PartnershipId DESC");
$resul2 = $con->query("SELECT PartnershipId FROM partnership WHERE SubmissionId = (SELECT SubmissionId FROM submission WHERE UserId = '$test' AND (SubmissionStatus = 'Ongoing' OR SubmissionStatus = 'Submitted') AND QuarterId = (SELECT QuarterId FROM quarter WHERE QuarterProgress='Ongoing'))");
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
                <h4 class="pageTitle">C.3.Partnership/Linkages/Network</h4>
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
                <label class="col-md-4 control-label" for="Status">Record No.:</label>
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
                                        $thisid = $row1['PartnershipId'];
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
                                        $id = $rows['PartnershipId'];
                                        
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
                                        $pick = "SELECT PartnershipId FROM partnership ORDER BY PartnershipId DESC LIMIT 1";
                                        $picker = mysqli_query($con,$pick);
                                        if(mysqli_num_rows($picker)>0)
                                        {
                                            foreach($picker as $t)
                                            {
                                                $send = $t['PartnershipId'] + 1;
                                            }
                                            $recordcounter ++;
                                            echo " <option value='$send'>$recordcounter</option>";
                                            
                                        }
                                        
                                    }
                                    while($rows = $resul->fetch_assoc())
                                    {
                                        $id = $rows['PartnershipId'];
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
    <form name="actorInsert" onSubmit="return ValidateActInsert()" action="Insert/PartnsershipInsert.php" method="POST" enctype="multipart/form-data">
        <?php
            
            $partnershiptitle = null;
            $type = null;
            $nature = null;
            $deliverable = null;
            $target = null;
            $level = null;
            
            $datefrom = null;
            $dateto = null;
                            
            $contactname = null;
            $contacttel = null;
            $address = null;

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
                $queryr = "SELECT PartnershipId FROM partnership ORDER BY PartnershipId DESC";
                $queryr4 = mysqli_query($con,$queryr);
                if(mysqli_num_rows($queryr4)>0)
                {
                    $count =1;
                    foreach($queryr4 as $t )
                    {
                        if($count==1)
                        {
                            $record = $t['PartnershipId']+1;
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
                            $record = $t['PartnershipId'];
                        }
                        $count2=$count2+1;
                    }
                }
                else
                {
                    $record = null;
                }
                
            }
            
            $query = "SELECT * FROM partnership WHERE PartnershipId = '$record'";
            $query_run = mysqli_query($con,$query);
            
            if(mysqli_num_rows($query_run)>0)
            {
                foreach($query_run as $row)
                {
                    $partnershiptitle = $row['PartnershipTitle'];
                    $type = $row['PartnershipType'];
                    $nature = $row['PartnershipNature'];
                    $deliverable = $row['PartnershipDeliverable'];
                    $target = $row['PartnershipBeneficiaries'];
                    $level = $row['PartnershipLevel'];
                    
                    $datefrom = $row['PartnershipDateFrom'];
                    $dateto = $row['PartnershipDateTo'];
                    
                    $contactname = $row['PartnershipContact'];
                    $contacttel = $row['PartnershipTel'];
                    $address = $row['PartnershipAddress'];

                    $file = $row['PartnershipTempName'];
                    $original = $row['PartnershipFilename'];
                    $change = $row['PartnershipId'];
                }
            }
            
        ?>
        <div class="form-group">
            <div class="col-md-11"style="margin-bottom:15px;">
                <label class="col-md-4 control-label" >Title:</label>
                <div class="col-md-8">
                    <input name="change" type="hidden" value="<?php echo $change; ?>">
                    <input name = "partnershiptitle" class="form-control input-sm" placeholder="" type="text" value="<?php echo $partnershiptitle; ?>" minlength="5" maxlength="100" onkeyup="javascript:capitalize(this.id, this.value);" autocomplete="off" required>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-11"style="margin-bottom:15px;">
                <label class="col-md-4 control-label" >Type of Partner Institution :</label>
                <div class="col-md-8">
                    <select class="form-control input-sm" name="type" value="<?php echo $type; ?>" id="Typeeditable" minlength="3" maxlength="100" required>
                        <option value=""></option>
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
                <label class="col-md-4 control-label">Nature of Collaboration:</label>
                <div class="col-md-8">
                    <select class="form-control input-sm" name="nature" id="Natureeditable" value="<?php echo $nature; ?>" minlength="3" maxlength="100" required>
                        <option value=""></option>
                        <option value="BPO" >BPO</option>
                        <option value="Educational" >Educational Institution</option>
                        <option value="Food" >Food Service</option>
                        <option value="Government" >Government Agency</option>
                        <option value="Hotel" >Hotel and Hospitality Service</option>
                        <option value="Medic" >Medical Service</option>
                        <option value="Non-Government" >Non-Governmental Organization (NGO)</option>
                        <option value="Professional" >Professional Organization</option>
                        <option value="Telecommunication" >Telecommunication</option>
                        <option value="Travel" >Travel Agency</option>
                    </select> 
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-11"style="margin-bottom:15px;">
                <label class="col-md-4 control-label" >Deliverable/Desired Output:</label>
                <div class="col-md-8">
                    <select class="form-control input-sm" name="deliverable" id="Deliverableeditable" value="<?php echo $deliverable; ?>" minlength="3" maxlength="100" required>
                        <option value=""></option>
                        <option value="Technology" >Technology Transfer</option>
                        <option value="Training" >Training/Instruction conducted</option>
                        <option value="Information" >Information</option>
                        <option value="Education" >Education and Communication</option>
                        <option value="Research" >Research</option>
                        <option value="Consultancy" >Consultancy</option>
                        <option value="Linkages" >Linkages</option>
                        <option value="Network" >Network</option>
                    </select> 
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-11"style="margin-bottom:15px;">
                <label class="col-md-4 control-label" >Target Beneficiaries:</label>
                <div class="col-md-8">
                    <select class="form-control input-sm" name="target" id="Targeteditable" value="<?php echo $target; ?>" minlength="3" maxlength="100" required>
                        <option value=""></option>
                        <option value="Administrative" >Administrative</option>
                        <option value="Employee" >Employee</option>
                        <option value="Community" >Community</option>
                        <option value="Students" >Students</option>
                        <option value="HEI" >HEI Administrators</option>
                    </select> 
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-11"style="margin-bottom:15px;">
                <label class="col-md-4 control-label" >Level:</label>
                <div class="col-md-8">
                    <select class="form-control input-sm" name="level" id="Leveleditable" value="<?php echo $level; ?>" minlength="3" maxlength="100" required>
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
                <label>Validity Period (Indicate inclusive period, start and end)</label>
            </div>
        </div>  
        <div class="form-group">
            <div class="rows">
                <div class="col-md-11">                
                    <label class="col-md-4 control-label" >From:</label>
                    <div class="col-md-8">
                        <input name="datefrom"  class="form-control input-sm" placeholder="" type="date" value="<?php echo $datefrom;?>" minlength="3" maxlength="100" onkeyup="javascript:capitalize(this.id, this.value);" autocomplete="off" required>
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
        <div class="form-group" style="padding-bottom:5px;">
            <div class="col-md-12" style="margin-bottom:15px;">
                <label>Contact Person</label>
            </div>
        </div> 
        <div class="form-group">
            <div class="col-md-11"style="margin-bottom:15px;">
                <label class="col-md-4 control-label" >Name:</label>
                <div class="col-md-8">
                    <input name="contactname" class="form-control input-sm" placeholder="" type="text" minlength="3" maxlength="100" value="<?php echo $contactname; ?>"  onkeyup="javascript:capitalize(this.id, this.value);" autocomplete="off" required>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-11"style="margin-bottom:15px;">
                <label class="col-md-4 control-label">Telephone No.:</label>
                <div class="col-md-8">
                    <input name="contacttel" class="form-control input-sm" placeholder="" type="number" value="<?php echo $contacttel; ?>"  onkeyup="javascript:capitalize(this.id, this.value);" autocomplete="off" required>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-11"style="margin-bottom:15px;">
                <label class="col-md-4 control-label" >Address:</label>
                <div class="col-md-8">
                    <input name="address" class="form-control input-sm" minlength="3" maxlength="100" placeholder="" type="text" value="<?php echo $address; ?>"  onkeyup="javascript:capitalize(this.id, this.value);" autocomplete="off" required>
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
        location.href = "InvolvementMobility.php";
    };
</script>
<script type="text/javascript">
    document.getElementById("backbtn").onclick = function () {
        <?php
            $stat = ("UPDATE addstat SET stat = 0 WHERE id = 1");
            mysqli_query($con,$stat);
        ?>
        location.href = "ExtensionActivity.php";
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
    $('#Typeeditable').editableSelect();
    $('#Targeteditable').editableSelect();
    $('#Leveleditable').editableSelect();
    $('#Deliverableeditable').editableSelect();
</script>

<script>
    function ValidateActInsert() {
    var specialChars = /[^a-zA-Z0-9 ]/g;
    if (document.actorInsert.partnershiptitle.value.match(specialChars)) {
        alert ("Special Characters are not allowed")
        return false;
    }
    else if (document.actorInsert.type.value.match(specialChars)) {
        alert ("Special Characters are not allowed")
        return false;
    }
    else if (document.actorInsert.nature.value.match(specialChars)) {
        alert ("Special Characters are not allowed")
        return false;
    }
    else if (document.actorInsert.deliverable.value.match(specialChars)) {
        alert ("Special Characters are not allowed")
        return false;
    }
    else if (document.actorInsert.target.value.match(specialChars)) {
        alert ("Special Characters are not allowed")
        return false;
    }
    else if (document.actorInsert.level.value.match(specialChars)) {
        alert ("Special Characters are not allowed")
        return false;
    }
    else if (document.actorInsert.contactname.value.match(specialChars)) {
        alert ("Special Characters are not allowed")
        return false;
    }
    return (true);
}
</script>  