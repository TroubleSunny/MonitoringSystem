<?php
session_start();

include("connection.php");
include("functions.php");
include("navbar.php");


$user_data = check_login($con);
$test = $user_data['UserId'];
$resul = $con->query("SELECT EjId FROM extension_journals WHERE SubmissionId = (SELECT SubmissionId FROM submission WHERE UserId = '$test' AND (SubmissionStatus = 'Ongoing' OR SubmissionStatus = 'Submitted') AND QuarterId = (SELECT QuarterId FROM quarter WHERE QuarterProgress='Ongoing')) ORDER BY EjId DESC");
$resul2 = $con->query("SELECT EjId FROM extension_journals WHERE SubmissionId = (SELECT SubmissionId FROM submission WHERE UserId = '$test' AND (SubmissionStatus = 'Ongoing' OR SubmissionStatus = 'Submitted') AND QuarterId = (SELECT QuarterId FROM quarter WHERE QuarterProgress='Ongoing'))");
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
                <h4 class="pageTitle">C.1. Expert Service Rendered</h4>
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
                                        $thisid = $row1['EjId'];
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
                                        $id = $rows['EjId'];
                                        
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
                                        $pick = "SELECT EjId FROM extension_journals ORDER BY EjId DESC LIMIT 1";
                                        $picker = mysqli_query($con,$pick);
                                        if(mysqli_num_rows($picker)>0)
                                        {
                                            foreach($picker as $t)
                                            {
                                                $send = $t['EjId'] + 1;
                                            }
                                            $recordcounter ++;
                                            echo " <option value='$send'>$recordcounter</option>";
                                            
                                        }
                                        
                                    }
                                    while($rows = $resul->fetch_assoc())
                                    {
                                        $id = $rows['EjId'];
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
    <form name="actorInsert" onSubmit="return ValidateActInsert()" action="Insert/ExtensionRendered3Insert.php" method="POST" enctype="multipart/form-data">
        <?php
           
           
            $journal = null;
            $nature = null;
            $publication = null;
            $indexing = null;
            $copyright = null;
            $level = null;
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
                $queryr = "SELECT EjId FROM extension_journals ORDER BY EjId DESC";
                $queryr4 = mysqli_query($con,$queryr);
                if(mysqli_num_rows($queryr4)>0)
                {
                    $count =1;
                    foreach($queryr4 as $t )
                    {
                        if($count==1)
                        {
                            $record = $t['EjId']+1;
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
                            $record = $t['EjId'];
                        }
                        $count2=$count2+1;
                    }
                }
                else
                {
                    $record = null;
                }   
            }
            $query = "SELECT * FROM extension_journals WHERE EjId = '$record'";
            $query_run = mysqli_query($con,$query);
            
            if(mysqli_num_rows($query_run)>0)
            {
                foreach($query_run as $row)
                {
                    $journal = $row['EjJournals'];
                    $nature = $row['EjNature'];
                    $publication = $row['EjPublication'];
                    $indexing = $row['EjIndexing'];
                    $copyright = $row['EjCopyright'];
                    $level = $row['EjLevel'];


                    $file = $row['EjTempName'];
                    $original = $row['EjFilename'];
                    $change = $row['EjId'];
                }
            }
            
        ?>
        <div class="form-group">
            <div class="col-md-11" style="margin-bottom:15px;">
                <label class="col-md-4 control-label" >External Services Rendered in Academic Journals/ Books Publication/ Newsletter/ Creative Work:</label>
                <div class="col-md-8">
                    <input name="change" type="hidden" value="<?php echo $change; ?>">
                    <select class="form-control input-sm" name="journal" id="Externaleditable" value="<?php echo $journal;?>" minlength='3' maxlength='100' required>
                        <option value=""></option>
                        <option value="Trainer" >Academic</option>
                        <option value="Officer" >Journal</option>
                        <option value="Consultant" >Books/Publication</option>
                        <option value="Reviewer" >Newsletter</option>
                        <option value="Editor" >Creative Works</option>
                    </select> 
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-11" style="margin-bottom:15px;">
                <label class="col-md-4 control-label" >Nature of  Services Rendered:</label>
                <div class="col-md-8">
                    <select class="form-control input-sm" name="nature" id="Classificationeditable" value="<?php echo $nature;?>" minlength='3' maxlength='100' required>
                        <option value=""></option>
                        <option value="Trainer" >Member</option>
                        <option value="Officer" >Officer</option>
                        <option value="Consultant" >Consultant</option>
                        <option value="Reviewer" >Reviewer</option>
                        <option value="Editor" >Editor</option>
                        <option value="Technical" >Technical Panel</option>
                        <option value="Coordinator" >Coordinator</option>
                    </select> 
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-11" style="margin-bottom:15px;">
                <label class="col-md-4 control-label" >Publication/ Audio Visual Production :</label>
                <div class="col-md-8">
                    <input class="form-control input-sm" name="publication" placeholder="" type="text" value="<?php echo $publication;?>" minlength='3' maxlength='100' onkeyup="javascript:capitalize(this.id, this.value);" autocomplete="off" required>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-11" style="margin-bottom:15px;">
                <label class="col-md-4 control-label" >Indexing (If any):</label>
                <div class="col-md-8">
                    <select class="form-control input-sm" name="indexing" id="Indexeditable" minlength='3' maxlength='120' value="<?php echo $indexing;?>" required>
                        <option value=""></option>
                        <option value="Scopus" >Scopus</option>
                        <option value="Web">Web of Science</option>
                        <option value="OASUC">OASUC Accredited Journals</option>
                        <option value="CHED">CHED Recognized Journals</option>   
                        <option value="International">International Refereed Journals</option> 
                        <option value="Exellence">Exellence in Research for Australia</option>  
                        <option value="ASEAN">ASEAN Citation Index</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-11" style="margin-bottom:15px;">
                <label class="col-md-4 control-label" >Copyright No. (ISSN No. /E-ISSN/ ISBN):</label>
                <div class="col-md-8">
                    <input name="copyright" class="form-control input-sm" placeholder="" type="text" value="<?php echo $copyright;?>"  onkeyup="javascript:capitalize(this.id, this.value);" autocomplete="off" required>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-11"style="margin-bottom:15px;">
                <label class="col-md-4 control-label" for="Status">Level:</label>
                <div class="col-md-8">
                    <select class="form-control input-sm" minlength='3' maxlength='100' name="level" id="Leveleditable" value="<?php echo $level;?>" required>
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
        <?php
            if(mysqli_num_rows($query_run)>0)
            {          
                $download = 'uploads/'.$file; 
                echo "<div class='col-md-11'><label class='col-md-5'>Submitted Document:</label> <a class='col-md-5' href= '".$download."' download>".$original."</a></div>
                <div class='panel-body'>  
                    <div class='col-md-11'>       
                        <label class='col-md-4'>Supporting Documents (MOA/MOU, Certificate of Recognitions/Appreciations):</label>
                        <input class = 'col-md-7' name='file' type='file' value=''> 
                    </div>
                </div>
                ";
                
            }
            else
            {
                echo "<div class='panel-body'>  
                        <div class='col-md-11'>       
                            <label class='col-md-4'>Supporting Documents (MOA/MOU, Certificate of Recognitions/Appreciations):</label>
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
        location.href = "ExtensionActivity.php";
    };
</script>
<script type="text/javascript">
    document.getElementById("backbtn").onclick = function () {
        <?php
            $stat = ("UPDATE addstat SET stat = 0 WHERE id = 1");
            mysqli_query($con,$stat);
        ?>
        location.href = "ExtensionRendered2.php";
    };
</script>

<script>
    $('#Externaleditable').editableSelect();
    $('#Classificationeditable').editableSelect();
    $('#Indexeditable').editableSelect();
    $('#Leveleditable').editableSelect();
</script>

<script>
    function ValidateActInsert() {
    var specialChars = /[^a-zA-Z0-9 ]/g;
    if (document.actorInsert.journal.value.match(specialChars)) {
        alert ("Special Characters are not allowed")
        return false;
    }
    else if (document.actorInsert.nature.value.match(specialChars)) {
        alert ("Special Characters are not allowed")
        return false;
    }
    else if (document.actorInsert.publication.value.match(specialChars)) {
        alert ("Special Characters are not allowed")
        return false;
    }
    else if (document.actorInsert.indexing.value.match(specialChars)) {
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