<?php
session_start();

include("connection.php");
include("functions.php");
include("navbar.php");


$user_data = check_login($con);
$test = $user_data['UserId'];
$resul = $con->query("SELECT iicwId FROM iicw WHERE SubmissionId = (SELECT SubmissionId FROM submission WHERE UserId = '$test' AND (SubmissionStatus = 'Ongoing' OR SubmissionStatus = 'Submitted') AND QuarterId = (SELECT QuarterId FROM quarter WHERE QuarterProgress='Ongoing')) ORDER BY iicwId DESC");
$resul2 = $con->query("SELECT iicwId FROM iicw WHERE SubmissionId = (SELECT SubmissionId FROM submission WHERE UserId = '$test' AND (SubmissionStatus = 'Ongoing' OR SubmissionStatus = 'Submitted') AND QuarterId = (SELECT QuarterId FROM quarter WHERE QuarterProgress='Ongoing'))");
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
                <h3 class="pageTitle">B. Inventions, Innovation, and Creative Works</h3>
            </div>
        </div>
    </div>
</section>
<section id="part-banner-specific">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h4 class="pageTitle">B.1 Administrative Employee Invention, Innovation and Creative Works Commitment</h4>
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
                                        $thisid = $row1['iicwId'];
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
                                        $id = $rows['iicwId'];
                                        
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
                                        $pick = "SELECT iicwId FROM iicw ORDER BY iicwId DESC LIMIT 1";
                                        $picker = mysqli_query($con,$pick);
                                        if(mysqli_num_rows($picker)>0)
                                        {
                                            foreach($picker as $t)
                                            {
                                                $send = $t['iicwId'] + 1;
                                            }
                                            $recordcounter ++;
                                            echo " <option value='$send'>$recordcounter</option>";
                                            
                                        }
                                        
                                    }
                                    while($rows = $resul->fetch_assoc())
                                    {
                                        $id = $rows['iicwId'];
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
    <form name="actorInsert" onSubmit="return ValidateActInsert()" action="Insert/InventionsBInsert.php" method="POST" enctype="multipart/form-data">
        <?php
            
            $title = null;
            $class = null;
            $StartDay = null;
            $datestart = null;
            $datetarget = null;
            $nature = null;
            $status = null;
            $agency = null;
            $fundingtype = null;
            $fundingamount = null;

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
                $queryr = "SELECT iicwId FROM iicw ORDER BY iicwId DESC";
                $queryr4 = mysqli_query($con,$queryr);
                if(mysqli_num_rows($queryr4)>0)
                {
                    $count =1;
                    foreach($queryr4 as $t )
                    {
                        if($count==1)
                        {
                            $record = $t['iicwId']+1;
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
                            $record = $t['iicwId'];
                        }
                        $count2=$count2+1;
                    }
                }
                else
                {
                    $record = null;
                }
                
            }
            $query = "SELECT * FROM iicw WHERE iicwId = '$record'";
            $query_run = mysqli_query($con,$query);
            $tracker = mysqli_num_rows($query_run);
            
            if(mysqli_num_rows($query_run)>0)
            {
                foreach($query_run as $row)
                {
                    $title = $row['ITitle'];
                    $class = $row['IClass'];
                    $datestart = $row['IDurationFrom'];
                    $datetarget = $row['IDurationTo'];
                    $nature = $row['INature'];
                    $status = $row['IStatus'];
                    $agency = $row['IAgency'];
                    $fundingtype = $row['IFundingType'];
                    $fundingamount = $row['IFundingAmount'];
                    
                    $file = $row['ITempName'];
                    $original = $row['IFilename'];
                    $change = $row['iicwId'];
                }
            }
            
        ?>
        <div class="form-group">
            <div class="col-md-11">
                <label class="col-md-4 control-label" >Title of the Invention, Innovation & Creative Works:</label>
                <div class="col-md-8">
                    <input name="change" type="hidden" value="<?php echo $change; ?>">
                    <input name="title" class="form-control input-sm" placeholder="" type="text" value="<?php echo $title; ?>" minlength='5' maxlength='100' onkeyup="javascript:capitalize(this.id, this.value);" autocomplete="off" required>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-11">
                <label class="col-md-4 control-label">Classification:</label>
                <div class="col-md-8">
                    <select name="class" class="form-control input-sm" value="<?php echo $class; ?>" id="Classificationeditable1" minlength='3' maxlength='80' required>
                        <option value=""></option>
                        <option value="Invention" >Invention</option>
                        <option value="Innvoation" >Innovation</option>
                        <option value="Creative" >Creative Works</option>
                    </select> 
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-11">
                <label class="col-md-4 control-label" >Name of collaborators:</label>
                <div class="col-md-8">
                    <table class="table table-bordered" id="dynamic_field">
                        <tr>
                            <?php
                            
                            if($tracker>0)
                            { 
                                $c=0;
                                $fecthname = $con->query("SELECT collaborator FROM collaborators WHERE iicwId = '$record'");
                                while($var = $fecthname->fetch_assoc())
                                {  
                                    $researchersname = $var['collaborator'];
                                    if($c==0)
                                    {
                                        echo "  <td><input value = '".$researchersname."' type='text' name='name[]' placeholder='Enter Name' class='form-control name_list' minlength='5' maxlength='80' required/></td>  
                                        <td><button type='button' name='add1' id='add1' class='btn btn-success'>Add More</button></td>";
                                    }
                                    else
                                    {   

                                        echo '<tr id="row'.$c.'"><td><input type="text" value="'.$researchersname.'" name="name[]" placeholder="Enter Name" class="form-control name_list" minlength="5" maxlength="80" /></td><td><button type="button" name="remove" id='.$c.' class="btn btn-danger btn_remove">X</button></td></tr>';
                                    }                    
                                    $c++;
                                }
                            }
                            else if($tracker==0)
                            {
                                echo "  <tr id='row' ><td><input type='text' name='name[]' placeholder='Enter Name' class='form-control name_list' minlength='5' maxlength='80' required/></td>  
                                <td><button type='button' name='add1' id='add1' class='btn btn-success'>Add More</button></td><tr>";
                            }
                            else
                            {
                                echo "  <tr id='row' ><td><input type='text' name='name[]' placeholder='Enter Name' class='form-control name_list' minlength='5' maxlength='80' required/></td>  
                                        <td><button type='button' name='add1' id='add1' class='btn btn-success'>Add More</button></td><tr>";
                            }
                            ?>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="form-group" style="padding-bottom:5px;">
            <label>Project Duration</label>
        </div>  
        <div class="form-group">
            <div class="rows">
                <div class="col-md-11">                
                    <label class="col-md-4 control-label" for="FNAME">From:</label>
                    <div class="col-md-8">
                        <input name="datestart"  class="form-control input-sm" placeholder="" type="date" value="<?php echo $datestart;?>" onkeyup="javascript:capitalize(this.id, this.value);" autocomplete="off" required>
                    </div>
                </div>
            </div>
        </div> 
        <div class="form-group">
            <div class="rows">
                <div class="col-md-11"> 
                    <label class="col-md-4 control-label" for="FNAME">To:</label>
                    <div class="col-md-8">
                        <input name="datetarget" class="form-control input-sm" placeholder="" type="date" value="<?php echo $datetarget;?>"  onkeyup="javascript:capitalize(this.id, this.value);" autocomplete="off" required>
                    </div>
                </div>
            </div>
        </div> 
        <div class="form-group">
            <div class="col-md-11"style="margin-bottom:15px;">
                <label class="col-md-4 control-label">Nature of Inventions (IT Products, Equipments, Machinery, etc.:</label>
                <div class="col-md-8">
                    <input name="nature" class="form-control input-sm" placeholder="" type="text" value="<?php echo $nature; ?>" minlength='3' maxlength='80' onkeyup="javascript:capitalize(this.id, this.value);" autocomplete="off" required>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-11"style="margin-bottom:15px;">
                <label class="col-md-4 control-label" for="Status">Ongoing Study Status:</label>
                <div class="col-md-8">
                    <select class="form-control input-sm" name="status" id="Status" value="<?php echo $status;?>" minlength='3' maxlength='80' required>
                        <option value="<?php echo $status;?>" ><?php echo $status;?></option>
                        <option value="Ongoing">Ongoing</option>
                        <option value="Completed">Completed</option>   
                        <option value="Deferred">Deferred</option>   
                    </select> 
                </div>
            </div>
        </div>  
        <div class="form-group">
            <div class="col-md-11" style="margin-bottom:15px;">
                <label class="col-md-4 control-label">Funding Agency:</label>
                <div class="col-md-8">
                    <input name="agency" class="form-control input-sm" placeholder="" type="text" value="<?php echo $agency; ?>" minlength='3' maxlength='80' onkeyup="javascript:capitalize(this.id, this.value);" autocomplete="off" required>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-11" style="margin-bottom:15px;">
                <label class="col-md-4 control-label">Type of Funding:</label>
                <div class="col-md-8">
                    <select class="form-control input-sm" name="fundingtype" value="<?php echo $fundingtype; ?>" minlength='3' maxlength='80' id="Fundeditable1" required>
                        <option value=""></option>
                        <option value="University" >University Funded</option>
                        <option value="Self">Self Funded</option>
                        <option value="Externally Funded">Externally Funded</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-11" style="margin-bottom:15px;">
                <label class="col-md-4 control-label" >Amount of Fund:</label>
                <div class="col-md-8">
                    <input name="fundingamount" class="form-control input-sm" placeholder="" type="number" step = "0.01" value="<?php echo $fundingamount; ?>"  onkeyup="javascript:capitalize(this.id, this.value);" autocomplete="off" required>
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
        location.href = "ExtensionRendered.php";
    };
</script>
<script type="text/javascript">
    document.getElementById("backbtn").onclick = function () {
        <?php
            $stat = ("UPDATE addstat SET stat = 0 WHERE id = 1");
            mysqli_query($con,$stat);
        ?>
        location.href = "CopyrightedOutput.php";
    };
</script>
<script>
    $(document).ready(function(){
        var i = 1;
        $('#add1').click(function(){
            i++;
            $('#dynamic_field').append('<tr id="row'+i+'"><td><input type="text" name="name[]" placeholder="Enter Name" class="form-control name_list" minlength="5" maxlength="80" required/></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');  
        });
        $(document).on('click','.btn_remove',function(){
            var button_id = $(this).attr("id");
            $('#row'+button_id+'').remove();
        });
    });
</script>
<script>
    $('#Status').editableSelect();
    $('#Fundeditable1').editableSelect();
    $('#Classificationeditable1').editableSelect();
</script>

<script>
    function ValidateActInsert() {
    var specialChars = /[^a-zA-Z0-9 ]/g;
    if (document.actorInsert.title.value.match(specialChars)) {
        alert ("Special Characters are not allowed")
        return false;
    }
    else if (document.actorInsert.class.value.match(specialChars)) {
        alert ("Special Characters are not allowed")
        return false;
    }
    else if (document.actorInsert.nature.value.match(specialChars)) {
        alert ("Special Characters are not allowed")
        return false;
    }
    else if (document.actorInsert.status.value.match(specialChars)) {
        alert ("Special Characters are not allowed")
        return false;
    }
    else if (document.actorInsert.agency.value.match(specialChars)) {
        alert ("Special Characters are not allowed")
        return false;   
    }
    else if (document.actorInsert.fundingtype.value.match(specialChars)) {
        alert ("Special Characters are not allowed")
        return false;
    }
    return (true);
}
</script>   
