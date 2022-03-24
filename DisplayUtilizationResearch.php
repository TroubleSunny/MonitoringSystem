<?php

include("connection.php");
include("functions.php");



if(isset($_POST['level']))
{
    $request = $_POST['level'];
    $col = $_POST['college'];
    $year = $_POST['year'];
   

    if($col == 'All' && $request == 'All' && $year == 'All')
    {
        $query5 = "SELECT * FROM researchutilization WHERE SubmissionId IN(SELECT SubmissionId FROM submission WHERE ValidationStatus = 'Accepted') ORDER BY RuDateStart DESC";
        $result5 = mysqli_query($con,$query5);
        $count5 = mysqli_num_rows($result5);
    }
    else if($col == 'All' && $request != 'All' && $year == 'All')
    {
        $query5 = "SELECT * FROM researchutilization WHERE RuLevel = '$request' ORDER BY RuDateStart DESC";
        $result5 = mysqli_query($con,$query5);
        $count5 = mysqli_num_rows($result5);
    }
    else if($col != 'All' && $request == 'All' && $year == 'All')
    {
        $query5 = "SELECT * FROM researchutilization WHERE SubmissionId IN (SELECT SubmissionId FROM submission WHERE ValidationStatus = 'Accepted' AND UserId IN (SELECT UserId FROM user WHERE College='$col')) ORDER BY RuDateStart DESC";
        $result5 = mysqli_query($con,$query5);
        $count5 = mysqli_num_rows($result5);
    }
    else if($col != 'All' && $request != 'All' && $year == 'All')
    {
        $query5 = "SELECT * FROM researchutilization WHERE RuLevel = '$request' AND SubmissionId IN (SELECT SubmissionId FROM submission WHERE ValidationStatus = 'Accepted' AND UserId IN (SELECT UserId FROM user WHERE College='$col')) ORDER BY RuDateStart DESC";
        $result5 = mysqli_query($con,$query5);
        $count5 = mysqli_num_rows($result5);
    }
    else if($col == 'All' && $request == 'All' && $year != 'All')
    {
        $query5 = "SELECT * FROM researchutilization WHERE SubmissionId IN(SELECT SubmissionId FROM submission WHERE ValidationStatus = 'Acceted' AND QuarterId IN(SELECT QuarterId FROM quarter WHERE YearId IN(SELECT YearId FROM schoolyear WHERE SchoolYear = '$year'))) ORDER BY RuDateStart DESC";
        $result5 = mysqli_query($con,$query5);
        $count5 = mysqli_num_rows($result5);
    }
    else if($col == 'All' && $request != 'All' && $year != 'All')
    {
        $query5 = "SELECT * FROM researchutilization WHERE RuLevel = '$request' AND SubmissionId IN(SELECT SubmissionId FROM submission WHERE ValidationStatus = 'Accepted' AND QuarterId IN(SELECT QuarterId FROM quarter WHERE YearId IN(SELECT YearId FROM schoolyear WHERE SchoolYear = '$year'))) ORDER BY RuDateStart DESC";
        $result5 = mysqli_query($con,$query5);
        $count5 = mysqli_num_rows($result5);
    }
    else if($col != 'All' && $request != 'All' && $year != 'All')
    {
        $query5 = "SELECT * FROM researchutilization WHERE RuLevel = '$request' AND  SubmissionId IN (SELECT SubmissionId FROM submission WHERE ValidationStatus = 'Accepted' AND UserId IN (SELECT UserId FROM user WHERE College='$col')) AND SubmissionId IN(SELECT SubmissionId FROM submission WHERE QuarterId IN(SELECT QuarterId FROM quarter WHERE YearId IN(SELECT YearId FROM schoolyear WHERE SchoolYear = '$year'))) ORDER BY RuDateStart DESC";
        $result5 = mysqli_query($con,$query5);
        $count5 = mysqli_num_rows($result5);
    }
    else if($col != 'All' && $request == 'All' && $year != 'All')
    {
        $query5 = "SELECT * FROM researchutilization WHERE SubmissionId IN (SELECT SubmissionId FROM submission WHERE ValidationStatus = 'Accepted' AND UserId IN (SELECT UserId FROM user WHERE College='$col')) AND SubmissionId IN(SELECT SubmissionId FROM submission WHERE QuarterId IN(SELECT QuarterId FROM quarter WHERE YearId IN(SELECT YearId FROM schoolyear WHERE SchoolYear = '$year'))) ORDER BY RuDateStart DESC";
        $result5 = mysqli_query($con,$query5);
        $count5 = mysqli_num_rows($result5);
    }
    else
    {
        $count5 = 0;
    }
?>
 <?php

if($count5){ ?>
<div class="tableContainer">
    <input id="college" type="hidden" value="<?php echo $col; ?>">
    <input id="year" type="hidden" value="<?php echo $year; ?>">
    <input id="level" type="hidden" value="<?php echo $request; ?>">
    <table class="table-main">
    <h4>A.5. Research Utilization</h4>
        <thead>
            <tr>
                <th>Name</th>
                <th>College/Section</th>
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
                <th>Actual Date Started</th>
                <th>Target Date of Completion</th>
                <th>Date Completed</th>
                <th>Agency/Organization that utilized the research output</th>
                <th>Brief Description of Research Utilization</th>
                <th>Level of Utilization</th>
                <th>Supporting Documents Submitted</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            $n = null;
            while($row1 = mysqli_fetch_assoc($result5))
            {
                $sub = $row1['SubmissionId'];
                $takename = "SELECT RealName,College FROM user WHERE UserId IN(SELECT UserId FROM submission WHERE SubmissionId = '$sub')";
                $take = mysqli_query($con,$takename);
                $getname = mysqli_fetch_assoc($take);
                $name = $getname['RealName'];
                $college = $getname['College'];
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
                        <td><?php echo $name;?></td>
                        <td><?php echo $college;?></td>
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
            else
            {
                echo "No record Found";
            }              
            ?>
        </tbody>
    </table>   
</div>
<script>
        
        $('#col8').val($('#college').val());
        $('#thisyear8').val($('#year').val());
        $('#level8').val($('#level').val());
       
    </script> 
<?php } ?>