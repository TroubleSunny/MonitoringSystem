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
        $query2 = "SELECT * FROM researchpresentation WHERE SubmissionId IN(SELECT SubmissionId FROM submission WHERE ValidationStatus = 'Accepted') ORDER BY RpresDateStart DESC";
        $result2 = mysqli_query($con,$query2);
        $count2 = mysqli_num_rows($result2);
    }
    else if($col == 'All' && $request != 'All' && $year == 'All')
    {
        $query2 = "SELECT * FROM researchpresentation WHERE SubmissionId IN(SELECT SubmissionId FROM submission WHERE ValidationStatus = 'Accepted') AND RpresLevel = '$request' ORDER BY RpresDateStart DESC";
        $result2 = mysqli_query($con,$query2);
        $count2 = mysqli_num_rows($result2);
    }
    else if($col != 'All' && $request == 'All' && $year == 'All')
    {
        $query2 = "SELECT * FROM researchpresentation WHERE SubmissionId IN (SELECT SubmissionId FROM submission WHERE ValidationStatus = 'Accepted' AND UserId IN (SELECT UserId FROM user WHERE College='$col')) ORDER BY RpresDateStart DESC";
        $result2 = mysqli_query($con,$query2);
        $count2 = mysqli_num_rows($result2);
    }
    else if($col != 'All' && $request != 'All' && $year == 'All')
    {
        $query2 = "SELECT * FROM researchpresentation WHERE RpresLevel = '$request' AND SubmissionId IN (SELECT SubmissionId FROM submission WHERE ValidationStatus = 'Accepted' AND UserId IN (SELECT UserId FROM user WHERE College='$col')) ORDER BY RpresDateStart DESC";
        $result2 = mysqli_query($con,$query2);
        $count2 = mysqli_num_rows($result2);
    }
    else if($col == 'All' && $request == 'All' && $year != 'All')
    {
        $query2 = "SELECT * FROM researchpresentation WHERE SubmissionId IN(SELECT SubmissionId FROM submission WHERE ValidationStatus = 'Accepted' AND QuarterId IN(SELECT QuarterId FROM quarter WHERE YearId IN(SELECT YearId FROM schoolyear WHERE SchoolYear = '$year'))) ORDER BY RpresDateStart DESC";
        $result2 = mysqli_query($con,$query2);
        $count2 = mysqli_num_rows($result2);
    }
    else if($col == 'All' && $request != 'All' && $year != 'All')
    {
        $query2 = "SELECT * FROM researchpresentation WHERE RpresLevel = '$request' AND SubmissionId IN(SELECT SubmissionId FROM submission WHERE ValidationStatus = 'Accepted' AND QuarterId IN(SELECT QuarterId FROM quarter WHERE YearId IN(SELECT YearId FROM schoolyear WHERE SchoolYear = '$year'))) ORDER BY RpresDateStart DESC";
        $result2 = mysqli_query($con,$query2);
        $count2 = mysqli_num_rows($result2);
    }
    else if($col != 'All' && $request != 'All' && $year != 'All')
    {
        $query2 = "SELECT * FROM researchpresentation WHERE RpresLevel = '$request' AND SubmissionId IN (SELECT SubmissionId FROM submission WHERE ValidationStatus = 'Accepted' AND UserId IN (SELECT UserId FROM user WHERE College='$col')) AND SubmissionId IN(SELECT SubmissionId FROM submission WHERE QuarterId IN(SELECT QuarterId FROM quarter WHERE YearId IN(SELECT YearId FROM schoolyear WHERE SchoolYear = '$year'))) ORDER BY RpresDateStart DESC";
        $result2 = mysqli_query($con,$query2);
        $count2 = mysqli_num_rows($result2);
    }
    else if($col != 'All' && $request == 'All' && $year != 'All')
    {
        $query2 = "SELECT * FROM researchpresentation WHERE SubmissionId IN (SELECT SubmissionId FROM submission WHERE ValidationStatus = 'Accepted' AND UserId IN (SELECT UserId FROM user WHERE College='$col')) AND SubmissionId IN(SELECT SubmissionId FROM submission WHERE QuarterId IN(SELECT QuarterId FROM quarter WHERE YearId IN(SELECT YearId FROM schoolyear WHERE SchoolYear = '$year'))) ORDER BY RpresDateStart DESC";
        $result2 = mysqli_query($con,$query2);
        $count2 = mysqli_num_rows($result2);
    }
    else
    {
        $count2 = 0;
    }
?>
<?php

if($count2){ ?>
<div class="tableContainer">
    <input id="college" type="hidden" value="<?php echo $col; ?>">
    <input id="year" type="hidden" value="<?php echo $year; ?>">
    <input id="level" type="hidden" value="<?php echo $request; ?>">
    <table class="table-main">
    <h4>A.3. Research Presentation</h4>
        <thead>
            <tr>
                <th>Name</th>
                <th>College/Section</th>
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
                <th>Actual Date Started</th>
                <th>Target Date of Completion</th>
                <th>Date Completed</th>
                <th>Conference Title</th>
                <th>Organizer</th>
                <th>Venue</th>
                <th>Date of Presentation</th>
                <th>Level</th>
                <th>Supporting Documents Submitted</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            $n = null;
            while($row1 = mysqli_fetch_assoc($result2))
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
                        <td><?php echo $name;?></td>
                        <td><?php echo $college;?></td>
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
            else
            {
                echo "No record Found";
            }           
            ?>
        </tbody>
    </table>
</div>
<script>
        
        $('#col6').val($('#college').val());
        $('#thisyear6').val($('#year').val());
        $('#level6').val($('#level').val());
       
    </script>   
<?php } ?>