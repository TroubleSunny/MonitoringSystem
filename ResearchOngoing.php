<?php
session_start();

include("connection.php");
include("functions.php");
include("navbar.php");


$user_data = check_login($con);
$test = $user_data['UserId'];
$resul = $con->query("SELECT RoId FROM researchongoing WHERE SubmissionId = (SELECT SubmissionId FROM submission WHERE UserId = '$test' AND (SubmissionStatus = 'Ongoing' OR SubmissionStatus = 'Submitted') AND QuarterId = (SELECT QuarterId FROM quarter WHERE QuarterProgress='Ongoing')) ORDER BY RoId DESC");
$resul2 = $con->query("SELECT RoId FROM researchongoing WHERE SubmissionId = (SELECT SubmissionId FROM submission WHERE UserId = '$test' AND (SubmissionStatus = 'Ongoing' OR SubmissionStatus = 'Submitted') AND QuarterId = (SELECT QuarterId FROM quarter WHERE QuarterProgress='Ongoing'))");
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
                <h3 class="pageTitle">A. Research & Book Chapter (Production, Citation, Presentation)</h3>
            </div>
        </div>
    </div>
</section>
<section id="part-banner-specific">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h4 class="pageTitle">A. 1. Research Ongoing /Completed</h4>
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
                                        $thisid = $row1['RoId'];
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
                                        $id = $rows['RoId'];
                                        
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
                                        $pick = "SELECT RoId FROM researchongoing ORDER BY RoId DESC LIMIT 1";
                                        $picker = mysqli_query($con,$pick);
                                        if(mysqli_num_rows($picker)>0)
                                        {
                                            foreach($picker as $t)
                                            {
                                                $send = $t['RoId'] + 1;
                                            }
                                            $recordcounter ++;
                                            echo " <option value='$send'>$recordcounter</option>";
                                            
                                        }
                                        
                                    }
                                    while($rows = $resul->fetch_assoc())
                                    {
                                        $id = $rows['RoId'];
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
    <form name="actorInsert" onSubmit="return ValidateActInsert()" action="Insert/ResearchOngoingInsert.php" method="POST" enctype="multipart/form-data">
        <?php
            $title = null;
            $class = null;
            $category = null;
            $agenda = null;
            $researcher = null;
            $involve = null;
            $type = null;
            $keyword = null;
            $fundtype = null;
            $fundamount = null;
            $fundagency = null;
            $datestart = null;
            $datetarget = null;
            $datecomplete = null;
            $status = null;
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
                $queryr = "SELECT RoId FROM researchongoing ORDER BY RoId DESC";
                $queryr4 = mysqli_query($con,$queryr);
                if(mysqli_num_rows($queryr4)>0)
                {
                    $count =1;
                    foreach($queryr4 as $t )
                    {
                        if($count==1)
                        {
                            $record = $t['RoId']+1;
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
                            $record = $t['RoId'];
                        }
                        $count2=$count2+1;
                    }
                }
                else
                {
                    $record = null;
                }
                
            }
            $query = "SELECT * FROM researchongoing WHERE RoId = '$record'";
            $query_run = mysqli_query($con,$query);
            $tracker = mysqli_num_rows($query_run);
            
            if(mysqli_num_rows($query_run)>0)
            {
                foreach($query_run as $row)
                {
                    $title = $row['RoTitle'];
                    $class =  $row['RoClass'];
                    $category =  $row['RoCategory'];
                    $agenda =  $row['RoAgenda'];
                    $involve =  $row['RoInvolve'];
                    $type =  $row['RoType'];
                    $fundtype =  $row['RoFundType'];
                    $fundamount =  $row['RoFundAmount'];
                    $fundagency =  $row['RoFundAgency'];
                    $datestart = $row['RoDateStart'];
                    $datetarget = $row['RoDateTarget'];
                    $datecomplete = $row['RoDateCompleted'];
                    $status = $row['RoStatus'];
                    $file = $row['RoTempName'];
                    $original = $row['RoFilename'];
                    $change = $row['RoId'];
                }
            }
            
        ?>
        <div class="form-group">
            <div class="col-md-11">
                <label class="col-md-4 control-label" for="Status">Title of Research (Choose if existing):</label>
                <div class="col-md-8">
                    <input name="change" type="hidden" value="<?php echo $change; ?>">
                    <select onchange='getval(this);' class="form-control input-sm" name="title" id="Titleeditable1" value="<?php echo $title; ?>" minlength="10" maxlength="100" required>
                        <?php
                            $choose = "SELECT RoTitle FROM researchongoing WHERE SubmissionId IN(SELECT SubmissionId FROM submission WHERE ValidationStatus = 'Accepted' AND UserId = $test)";
                            $anothertitle = mysqli_query($con,$choose);

                            if(mysqli_num_rows($anothertitle)>0)
                            {
                                foreach($anothertitle as $choosetitle)
                                {
                                    $pick = $choosetitle['RoTitle'];
                                    echo "<option>$pick</option>";
                                }
                            }
                            else
                            {
                                echo "<option value=''></option>";
                            }
                        ?>
                    </select> 
                </div>
            </div>
        </div>  
        <div class="form-group">
            <div class="col-md-11">
                <label class="col-md-4 control-label" for="FNAME">Research Classification:</label>
                <div class="col-md-8">
                    <select class="form-control input-sm" name="class" id="Classificationeditable1" value="<?php echo $class; ?>" minlength="3" maxlength="80" required>
                        <option value=""></option>
                        <option value="Program" >Program</option>
                        <option value="Project" >Project</option>
                        <option value="Study" >Study</option>
                    </select> 
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-11">
                <label class="col-md-4 control-label" for="FNAME">Category:</label>
                <div class="col-md-8">
                    <select class="form-control input-sm" name="category" id="Categoryeditable" value="<?php echo $category; ?>" minlength="3" maxlength="80"  required>
                        <option value=""></option>
                        <option value="Poverty" >Research</option>
                        <option value="Peace" >Book Chapter</option>
                    </select> 
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-11">
                <label class="col-md-4 control-label" for="FNAME">University Research Agenda:</label>
                <div class="col-md-8">
                    <select class="form-control input-sm" name="agenda" id="Agendaeditable1" value="<?php echo $agenda; ?>" minlength="3" maxlength="80" required>
                        <option value=""></option>
                        <option value="Poverty" >Poverty Reduction</option>
                        <option value="Peace" >Peace and Security</option>
                        <option value="Accelerating" >Accelerating Infrastructure Development through Science and Technology</option>
                        <option value="Competitive" > Competitive Industry and Entrepreneurship</option>
                        <option value="Environmental" >Environmental Conservation</option>
                        <option value="Protection" >Protection and Rehabilitation towards Sustainable Development</option>
                    </select> 
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-11">
                <label class="col-md-4 control-label" for="FNAME">Researcher/s (Surname, First Name, M.I.):</label>
                <div class="col-md-8">
                    <table class="table table-bordered" id="dynamic_field">
                        <tr>
                            <?php
                            
                            if($tracker>0)
                            { 
                                $c=0;
                                $fecthname = $con->query("SELECT RoName FROM ro_name WHERE RoId = '$record'");
                                while($var = $fecthname->fetch_assoc())
                                {  
                                    $researchersname = $var['RoName'];
                                    if($c==0)
                                    {
                                        echo "  <td style='text-align:center;'><input value = '".$researchersname."' type='text' name='name[]' placeholder='Enter Name' class='form-control name_list' minlength='5' maxlength='80'  required/></td>  
                                        <td><button type='button' name='add1' id='add1' class='btn btn-success'>Add More</button></td>";
                                    }
                                    else
                                    {   

                                        echo '<tr id="row'.$c.'"><td><input type="text" value="'.$researchersname.'" name="name[]" placeholder="Enter Name" class="form-control name_list" /></td><td><button type="button" name="remove" id='.$c.' class="btn btn-danger btn_remove">X</button></td></tr>';
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
        <div class="form-group">
            <div class="col-md-11"style="margin-bottom:15px;">
                <label class="col-md-4 control-label" for="FNAME">Nature of Involvement:</label>
                <div class="col-md-8">
                    <select class="form-control input-sm" name="involve" id="Involvementeditable1" value="<?php echo $involve; ?>" minlength="3" maxlength="80"  required>
                        <option value=""></option>
                        <option value="Independent" >Independent Researcher</option>
                        <option value="Lead" >Lead Researcher</option>
                        <option value="CoLead" >Co-Lead Researcher</option>
                        <option value="Associate" >Associate Lead Researcher</option>
                    </select> 
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-11">
                <label class="col-md-4 control-label" for="FNAME">Type of Research:</label>
                <div class="col-md-8">
                    <select class="form-control input-sm" name="type" id="Typeeditable1" value="<?php echo $type; ?>" minlength="3" maxlength="80" required>
                        <option value=""></option>
                        <option value="Basic" >Basic Research </option>
                        <option value="Applied" >Applied Research </option>
                        <option value="Creative Work" >Creative Work </option>
                        <option value="BasicGAD" >Basic Research (GAD Related)</option>
                        <option value="BasicDiversity" >Basic Research (Diversity and Incluvisity Related)</option>
                        <option value="BasicGADDiversity" >Basic Research (GAD Related & Diversity and Incluvisity Related)</option>
                        <option value="AppliedGAD" >Applied Research (GAD Related)</option>
                        <option value="AppliedDiversity" >Applied Research (Diversity and Incluvisity Related)</option>
                        <option value="AppliedGADDiversity" >Applied Research (GAD Related & Diversity and Incluvisity Related)</option>
                    </select> 
                </div>
            </div>
        </div>
        <div class="form-group">
            <p></p>
        </div>
        <div class="form-group">
            <div class="col-md-11">
                <label class="col-md-4 control-label" for="FNAME">Keywords ( Five (5) keywords):</label>
                <div class="col-md-8" style="margin-bottom:15px;">	
                    <?php
                        
                        if(mysqli_num_rows($query_run)>0)
                        {          
                            $fecthwords = $con->query("SELECT RoKeyword FROM ro_keywords WHERE RoId = '$record'");
                            while($rows = $fecthwords->fetch_assoc())
                            {  
                                $words = $rows['RoKeyword'];
                                echo "<input name = 'keyword[]' class='form-control input-sm' type='text' value='".$words."'  onkeyup='javascript:capitalize(this.id, this.value);' autocomplete='off' minlength='3' maxlength='80'  required>";
                            }
                            
                        }
                        else
                        {
                            echo "  <input name = 'keyword[]' class='form-control input-sm' type='text' value=''  onkeyup='javascript:capitalize(this.id, this.value);' autocomplete='off' minlength='3' maxlength='80'  required>
                                    <input name = 'keyword[]' class='form-control input-sm' type='text' value=''  onkeyup='javascript:capitalize(this.id, this.value);' autocomplete='off' minlength='3' maxlength='80' required>
                                    <input name = 'keyword[]' class='form-control input-sm' type='text' value=''  onkeyup='javascript:capitalize(this.id, this.value);' autocomplete='off' minlength='3' maxlength='80' required>
                                    <input name = 'keyword[]' class='form-control input-sm' type='text' value=''  onkeyup='javascript:capitalize(this.id, this.value);' autocomplete='off' minlength='3' maxlength='80' required>
                                    <input name = 'keyword[]' class='form-control input-sm' type='text' value=''  onkeyup='javascript:capitalize(this.id, this.value);' autocomplete='off' minlength='3' maxlength='80' required>
                                ";
                        }        
                    ?>	        
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-11" style="margin-bottom:15px;">
                <label class="col-md-4 control-label" for="FNAME">Type of Funding:</label>
                <div class="col-md-8">
                    <select class="form-control input-sm" name="fundtype" id="Fundeditable1" value="<?php echo $fundtype; ?>" minlength="5" maxlength="80" required>
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
                <label class="col-md-4 control-label" for="FNAME">Amount of Funding:</label>
                <div class="col-md-8">
                    <input name="fundamount" class="form-control input-sm" placeholder="" type="number" step="0.01" value="<?php echo $fundamount; ?>"  onkeyup="javascript:capitalize(this.id, this.value);" autocomplete="off" required>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-11"style="margin-bottom:15px;">
                <label class="col-md-4 control-label" for="FNAME">Funding Agency:</label>
                <div class="col-md-8">
                    <input name="fundagency" class="form-control input-sm" placeholder="" type="text" value="<?php echo $fundagency; ?> "minlength="3" maxlength="80"  onkeyup="javascript:capitalize(this.id, this.value);" autocomplete="off">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="rows">
                <div class="col-md-11">                
                    <label class="col-md-4 control-label" for="FNAME">Actual Date Started:</label>
                    <div class="col-md-8">
                        <input name="datestart" class="form-control input-sm" placeholder="" type="date" value="<?php echo $datestart;?>"  onkeyup="javascript:capitalize(this.id, this.value);" autocomplete="off" required>
                    </div>
                </div>
            </div>
        </div> 
        <div class="form-group">
            <div class="rows">
                <div class="col-md-11"> 
                    <label class="col-md-4 control-label" for="FNAME">Target Date of Completion:</label>
                    <div class="col-md-8">
                        <input name="datetarget" class="form-control input-sm" placeholder="" type="date" value="<?php echo $datetarget;?>"  onkeyup="javascript:capitalize(this.id, this.value);" autocomplete="off" required>
                    </div>
                </div>
            </div>
        </div> 
        <div class="form-group">
            <div class="col-md-11"style="margin-bottom:15px;">
                <label class="col-md-4 control-label" for="Status">Ongoing Study Status:</label>
                <div class="col-md-8">
                    <select class="form-control input-sm" name="status" id="Status" value="<?php echo $status;?>" minlength="3" maxlength="80"  required>
                        <option value="<?php echo $status;?>" ><?php echo $status;?></option>
                        <option value="Ongoing">Ongoing</option>
                        <option value="Completed">Completed</option>   
                        <option value="Deferred">Deferred</option>   
                    </select> 
                </div>
            </div>
        </div>  
        <div class="form-group">
            <div class="rows">
                <div class="col-md-11">                
                    <label class="col-md-4 control-label" for="FNAME">Date Completed (If Completed):</label>
                    <div class="col-md-8">
                        <input name="datecomplete"  class="form-control input-sm" placeholder="" type="date" value="<?php echo $datecomplete;?>"  onkeyup="javascript:capitalize(this.id, this.value);" autocomplete="off" >
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
        location.href = "ResearchPublication.php";
    };
</script>
<script type="text/javascript">
    document.getElementById("backbtn").onclick = function () {
        <?php
            $stat = ("UPDATE addstat SET stat = 0 WHERE id = 1");
            mysqli_query($con,$stat);
        ?>
        location.href = "SpecialTasks.php";
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
    function getval(sel)
    {
        alert(sel.value);
    };
</script>

<script>
    $('#Titleeditable1').editableSelect();
    $('#Classificationeditable1').editableSelect();
    $('#Agendaeditable1').editableSelect();
    $('#Involvementeditable1').editableSelect();
    $('#Typeeditable1').editableSelect();
    $('#Fundeditable1').editableSelect();
    $('#Status1').editableSelect();
    $('#Categoryeditable').editableSelect();
</script>

<script>
    function ValidateActInsert() {
    var specialChars = /[^a-zA-Z0-9 ]/g;
    if (document.actorInsert.class.value.match(specialChars)) {
        alert ("Special Characters are not allowed")
        return false;
    }
    else if (document.actorInsert.category.value.match(specialChars)) {
        alert ("Special Characters are not allowed")
        return false;
    }
    else if (document.actorInsert.agenda.value.match(specialChars)) {
        alert ("Special Characters are not allowed")
        return false;
    }
    else if (document.actorInsert.involve.value.match(specialChars)) {
        alert ("Special Characters are not allowed")
        return false;
    }
    else if (document.actorInsert.fundtype.value.match(specialChars)) {
        alert ("Special Characters are not allowed")
        return false;
    }
    else if (document.actorInsert.fundagency.value.match(specialChars)) {
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