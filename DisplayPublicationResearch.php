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
        $query3 = "SELECT * FROM researchpublication WHERE SubmissionId IN(SELECT SubmissionId FROM submission WHERE ValidationStatus='Accepted') ORDER BY RpDateStart DESC";
        $result3 = mysqli_query($con,$query3);
        $count3 = mysqli_num_rows($result3);
    }
    else if($col == 'All' && $request != 'All' && $year == 'All')
    {
        $query3 = "SELECT * FROM researchpublication WHERE SubmissionId IN(SELECT SubmissionId FROM submission WHERE ValidationStatus='Accepted') AND RpLevel = '$request' ORDER BY RpDateStart DESC";
        $result3 = mysqli_query($con,$query3);
        $count3 = mysqli_num_rows($result3);
    }
    else if($col != 'All' && $request == 'All' && $year == 'All')
    {
        $query3 = "SELECT * FROM researchpublication WHERE SubmissionId IN (SELECT SubmissionId FROM submission WHERE ValidationStatus = 'Accepted' AND UserId IN (SELECT UserId FROM user WHERE College='$col')) ORDER BY RpDateStart DESC";
        $result3 = mysqli_query($con,$query3);
        $count3 = mysqli_num_rows($result3);
    }
    else if($col != 'All' && $request != 'All' && $year == 'All')
    {
        $query3 = "SELECT * FROM researchpublication WHERE RpLevel = '$request' AND SubmissionId IN (SELECT SubmissionId FROM submission WHERE ValidationStatus = 'Accepted' AND UserId IN (SELECT UserId FROM user WHERE College='$col')) ORDER BY RpDateStart DESC";
        $result3 = mysqli_query($con,$query3);
        $count3 = mysqli_num_rows($result3);
    }
    else if($col == 'All' && $request == 'All' && $year != 'All')
    {
        $query3 = "SELECT * FROM researchpublication WHERE SubmissionId IN(SELECT SubmissionId FROM submission WHERE ValidationStatus = 'Accepted' AND QuarterId IN(SELECT QuarterId FROM quarter WHERE YearId IN(SELECT YearId FROM schoolyear WHERE SchoolYear = '$year'))) ORDER BY RpDateStart DESC";
        $result3 = mysqli_query($con,$query3);
        $count3 = mysqli_num_rows($result3);
    }
    else if($col == 'All' && $request != 'All' && $year != 'All')
    {
        $query3 = "SELECT * FROM researchpublication WHERE RpLevel = '$request' AND SubmissionId IN(SELECT SubmissionId FROM submission WHERE ValidationStatus = 'Accepted' AND QuarterId IN(SELECT QuarterId FROM quarter WHERE YearId IN(SELECT YearId FROM schoolyear WHERE SchoolYear = '$year'))) ORDER BY RpDateStart DESC";
        $result3 = mysqli_query($con,$query3);
        $count3 = mysqli_num_rows($result3);
    }
    else if($col != 'All' && $request != 'All' && $year != 'All')
    {
        $query3 = "SELECT * FROM researchpublication WHERE RpLevel = '$request' AND SubmissionId IN (SELECT SubmissionId FROM submission WHERE ValidationStatus = 'Accepted' AND UserId IN (SELECT UserId FROM user WHERE College='$col')) AND SubmissionId IN(SELECT SubmissionId FROM submission WHERE QuarterId IN(SELECT QuarterId FROM quarter WHERE YearId IN(SELECT YearId FROM schoolyear WHERE SchoolYear = '$year'))) ORDER BY RpDateStart DESC";
        $result3 = mysqli_query($con,$query3);
        $count3 = mysqli_num_rows($result3);
    }
    else if($col != 'All' && $request == 'All' && $year != 'All')
    {
        $query3 = "SELECT * FROM researchpublication WHERE SubmissionId IN (SELECT SubmissionId FROM submission WHERE ValidationStatus = 'Accepted' AND UserId IN (SELECT UserId FROM user WHERE College='$col')) AND SubmissionId IN(SELECT SubmissionId FROM submission WHERE QuarterId IN(SELECT QuarterId FROM quarter WHERE YearId IN(SELECT YearId FROM schoolyear WHERE SchoolYear = '$year'))) ORDER BY RpDateStart DESC";
        $result3 = mysqli_query($con,$query3);
        $count3 = mysqli_num_rows($result3);
    }
    else
    {
        $count3 = 0;
    }
?>
<?php

if($count3){ ?>
<div class="tableContainer">
    <input id="college" type="hidden" value="<?php echo $col; ?>">
    <input id="year" type="hidden" value="<?php echo $year; ?>">
    <input id="level" type="hidden" value="<?php echo $request; ?>">
    <table class="table-main">
    <h4>A.2. Research Publication</h4>
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
                <th>Journal Name</th>
                <th>Page Number</th>
                <th>Volume No.</th>
                <th>Issue No.</th>
                <th>Indexing Platform</th>
                <th>Date Published</th>
                <th>Publisher</th>
                <th>Editor</th>
                <th>ISSN/ISBN</th>
                <th>Level of Publication</th>
                <th>Supporting Documents Submitted</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            $n = null;
            while($row1 = mysqli_fetch_assoc($result3))
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
                $n = $row1['RpId'];
                $rname = "SELECT RpName FROM rp_name WHERE RpId = '$n'";
                $resname = mysqli_query($con,$rname);
                $countres = mysqli_num_rows($resname);
                $researcher = mysqli_fetch_all($resname);

                $rword = "SELECT * FROM rp_keywords WHERE RpId = '$n'";
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
                        <td><?php echo $row1['RpTitle'];?></td>
                        <td><?php echo $row1['RpClass'];?></td>
                        <td><?php echo $row1['RpCategory'];?></td>
                        <td><?php echo $row1['RpAgenda'];?></td>
                        
                        <td><?php echo $researcher[$rescount][0];?></td>
                        
                        
                        
                        <td><?php echo $row1['RpInvolve'];?></td>
                        <td><?php echo $row1['RpType'];?></td>
                        <td><?php echo $rowkey['RpKeyword'];?></td>
                        <td><?php echo $row1['RpFundType'];?></td>
                        <td><?php echo $row1['RpFundAmount'];?></td>
                        <td><?php echo $row1['RpFundAgency'];?></td>
                        <td><?php echo $row1['RpDateStart'];?></td>
                        <td><?php echo $row1['RpDateTarget'];?></td>
                        <td><?php echo $row1['RpDateCompleted'];?></td>
                        <td><?php echo $row1['RpJournalName'];?></td>
                        <td><?php echo $row1['RpPageNumber'];?></td>
                        <td><?php echo $row1['RpVolumeNo'];?></td>
                        <td><?php echo $row1['RpIssueNo'];?></td>
                        <td><?php echo $row1['RpIndexingPlatform'];?></td>
                        <td><?php echo $row1['RpDatePublished'];?></td>
                        <td><?php echo $row1['RpPublisher'];?></td>
                        <td><?php echo $row1['RpEditor'];?></td>
                        <td><?php echo $row1['RpISSN'];?></td>
                        <td><?php echo $row1['RpLevel'];?></td>
                        <?php $file = $row1['RpTempName']; $download = 'uploads/'.$file;?> 
                        <td><a href="<?php echo $download;?>" download><?php echo $row1['RpFilename'];?></a></td>
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
                        <td><?php if($rowkey['RpKeyword']!=null){echo $rowkey['RpKeyword'];}?></td>
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
        
        $('#col5').val($('#college').val());
        $('#thisyear5').val($('#year').val());
        $('#level5').val($('#level').val());
       
    </script>   
<?php }?>