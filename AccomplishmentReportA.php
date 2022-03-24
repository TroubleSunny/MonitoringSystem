<?php
session_start();

include("connection.php");
include("functions.php");
include("navbar.php");


$user_data = check_login($con);
$test = $user_data['UserId'];
$resultchoice = $con->query("SELECT * FROM ongoingstudy WHERE SubmissionId = (SELECT SubmissionId FROM submission WHERE UserId ='$test' AND (SubmissionStatus = 'Ongoing' OR SubmissionStatus = 'Submitted') AND QuarterId = (SELECT QuarterId FROM quarter WHERE QuarterProgress='Ongoing')) ORDER BY OngoingId DESC");
$quarter = $con->query("SELECT QuarterPart FROM quarter WHERE QuarterProgress = 'Ongoing'");
$quarteryear = $con->query("SELECT SchoolYear FROM schoolyear WHERE YearId = (SELECT YearId FROM quarter WHERE QuarterProgress = 'Ongoing')");
while($qu = $quarter->fetch_assoc())
{
    $q = $qu['QuarterPart'];
}
while($quy = $quarteryear->fetch_assoc())
{
    $qy = $quy['SchoolYear'];
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
                <h3 class="pageTitle">A. ONGOING ADVANCED PROFESSIONAL STUDY</h3>
            </div>
        </div>
    </div>
</section>
<section id="part-banner-specific">
    <div class="container">
    <div class="col-lg-12">
        <p></p>
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
    <form name="actorInsert" action="Insert/OngoingInsert.php" method="POST" enctype="multipart/form-data" onSubmit="return ValidateActInsert()">
        <?php
            $deg = null;
            $schoolname = null;
            $schoollevel = null;
            $support = null;
            $sponsor = null;
            $amount = null;  
            $datefrom = null;
            $dateto = null;
            $ongoingstatus = null;
            $units = null;
            $enrolled = null;
            $file = null;
            $change=null;
                
            if(mysqli_num_rows($resultchoice)>0)
            {
                foreach($resultchoice as $row)
                {
                    $deg = $row['Deg'];
                    $schoolname = $row['SchoolName'];
                    $schoollevel = $row['SchoolLevel'];
                    $support = $row['SupportType'];
                    $sponsor = $row['SponsorName'];
                    $amount = $row['Amount'];
                    $datefrom = $row['OngoingFrom'];
                    $dateto = $row['OngoingTo'];
                    $ongoingstatus = $row['OngoingStatus'];
                    $units = $row['NumUnits'];
                    $enrolled = $row['NumEnrolled'];
                    $file = $row['OngoingTempName'];
                    $original = $row['OngoingFilename'];
                    $change = $row['OngoingId'];
                }
            }
            

        ?>
        <div class="form-group">
            <div class="col-md-11">
                <label class="col-md-4 control-label" for="FNAME">Degree/Program:</label>
                <div class="col-md-8">
                    <input name="Degree" class="form-control input-sm" placeholder="" type="text" value="<?php echo $deg; ?>"  onkeyup="javascript:capitalize(this.id, this.value);" autocomplete="on" spellcheck="value" minlength="3" maxlength="80" required>
                    <input name="change" type="hidden" value="<?php echo $change; ?>">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-11">
                <label class="col-md-4 control-label" for="FNAME">School Name:</label>
                <div class="col-md-8">
                    <input name="schoolname" class="form-control input-sm" placeholder="" type="text" value="<?php echo $schoolname;?>"  onkeyup="javascript:capitalize(this.id, this.value);" autocomplete="off" minlength="3" maxlength="80" required>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-11">
                <label class="col-md-4 control-label" for="FNAME">School Program Accreditation Level/World Ranking/COE or COD:</label>
                <div class="col-md-8">
                    <select class="form-control input-sm" name="level" id="Accreditationeditable" value="<?php echo $schoollevel;?>" minlength="3" maxlength="80" required>
                        <option value="" ></option>
                        <option value="International" >Level I</option>
                        <option value="National">Level II</option>
                        <option value="National">Level III</option>
                        <option value="National">Level IV</option>
                        <option value="National">COD</option>
                        <option value="National">COE</option>
                        <option value="Local">Top 1000 University Ranking</option>   
                    </select> 
                </div>
            </div>
        </div>
        <div class= "col-md-12">
            <label>Means of Educational Support:</label>
        </div>
        <div class="form-group">
            <div class="col-md-11">
                <label class="col-md-4 control-label" for="FNAME">Type of Support</label>
                <div class="col-md-8">
                    <select class="form-control input-sm" name="typesupport" id="Supporteditable" value="<?php echo $support;?>" minlength="3" maxlength="80" required>
                        <option value="none" ></option>
                        <option value="International" >Financial Aid</option>
                        <option value="National">Scholarship</option>
                        <option value="National">Tuition Fee Discount</option>
                        <option value="National">Self Funded</option>
                    </select> 
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-11">
                <label class="col-md-4 control-label" for="FNAME">Name of Sponsor/Agency/Organization:</label>
                <div class="col-md-8">                    
                    <input  name="sponsor" spellcheck="true" class="form-control input-sm" placeholder="" type="text" value="<?php echo $sponsor;?>"  onkeyup="javascript:capitalize(this.id, this.value);" autocomplete="off" minlength="3" maxlength="80" required>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-11">
                <label class="col-md-4 control-label" for="FNAME">Amount:</label>
                <div class="col-md-8">
                    <input name="amount"  class="form-control input-sm" placeholder="" type="number" step="0.01" value="<?php echo $amount;?>"  onkeyup="javascript:capitalize(this.id, this.value);" autocomplete="off" required>
                </div>
            </div>
        </div>
        <div class= "col-md-12">
            <label>Duration of the Study</label>
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
        <div class="form-group">
            <div class="col-md-11">
                <label class="col-md-4 control-label" for="Status">Ongoing Study Status:</label>
                <div class="col-md-8">
                    <select class="form-control input-sm" name="studystatus" id="Statuseditable" value="<?php echo $ongoingstatus;?>" minlength="5" maxlength="30" required>
                        <option value=""></option>
                        <option value="International" >Currently Enrolled(New Student)</option>
                        <option value="National">Currently Enrolled(Old Student)</option>
                        <option value="National">Leave of Absence</option>
                        <option value="National">Completed Academic Requirement</option>
                        <option value="National">Passed Comprehensive Exam</option>
                        <option value="National">Currently Enrolled for Thesis Writing</option>
                        <option value="National">Currently Enrolled for Dissertation Writing</option>
                    </select> 
                </div>
            </div>
        </div>  
        <div class="form-group">
            <div class="col-md-11">
                <label class="col-md-4 control-label" for="FNAME">Number of Units Earned:</label>
                <div class="col-md-8">
                    <input name="numunits" class="form-control input-sm" placeholder="" type="number" value="<?php echo $units;?>"  onkeyup="javascript:capitalize(this.id, this.value);" autocomplete="off" required>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-11">
                <label class="col-md-4 control-label" for="FNAME">Number of Units Currently Enrolled:</label>
                <div class="col-md-8">
                    <input name="numcurrent" class="form-control input-sm" placeholder="" type="number" value="<?php echo $enrolled;?>"  onkeyup="javascript:capitalize(this.id, this.value);" autocomplete="off" required>
                </div>
            </div>
        </div>
        <?php
        if(mysqli_num_rows($resultchoice)>0)
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
        
                 
        if(mysqli_num_rows($resultchoice)>0)
        {    
            echo '<button class="btn btn-primary" name="reseter" value="reseter" type="reseter" style="font-weight: bold;" onclick="return confirm(\'This will Delete The Record. Proceed?\');">Clear</span></button>';
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
        location.href = "OutstandingB.php";
    };
</script>
<script type="text/javascript">
    document.getElementById("backbtn").onclick = function () {
        location.href = "FacultyAccount.php";
    };
</script>

<script>
   $('#Accreditationeditable').editableSelect();
   $('#Supporteditable').editableSelect();
   $('#Statuseditable').editableSelect();

</script>

<script>
    function ValidateActInsert() {
    var specialChars = /[^a-zA-Z0-9 ]/g;
    if (document.actorInsert.Degree.value.match(specialChars)) {
        alert ("Special Characters are not allowed")
        return false;
    }
    else if (document.actorInsert.schoolname.value.match(specialChars)) {
        alert ("Special Characters are not allowed")
        return false;
    }
    else if (document.actorInsert.level.value.match(specialChars)) {
        alert ("Special Characters are not allowed")
        return false;
    }
    else if (document.actorInsert.typesupport.value.match(specialChars)) {
        alert ("Special Characters are not allowed")
        return false;
    }
    else if (document.actorInsert.sponsor.value.match(specialChars)) {
        alert ("Special Characters are not allowed")
        return false;
    }
    return (true);
}
</script>