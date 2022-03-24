<?php

include("connection.php");
include("functions.php");



if(isset($_POST['level9']))
{
    $request = $_POST['level9'];
    $col = $_POST['col9'];
    $year = $_POST['thisyear9'];
   

    if($col == 'All' && $request == 'All' && $year == 'All')
    {
        $query6 = "SELECT * FROM copyrightedoutput WHERE SubmissionId IN(SELECT SubmissionId FROM submission WHERE ValidationStatus='Accepted') ORDER BY CoDateStart DESC";
        $result6 = mysqli_query($con,$query6);
        $count6 = mysqli_num_rows($result6);
    }
    else if($col == 'All' && $request != 'All' && $year == 'All')
    {
        $query6 = "SELECT * FROM copyrightedoutput WHERE SubmissionId IN(SELECT SubmissionId FROM submission WHERE ValidationStatus='Accepted') AND CoLevel = '$request' ORDER BY CoDateStart DESC";
        $result6 = mysqli_query($con,$query6);
        $count6 = mysqli_num_rows($result6);
    }
    else if($col != 'All' && $request == 'All' && $year == 'All')
    {
        $query6 = "SELECT * FROM copyrightedoutput WHERE SubmissionId IN (SELECT SubmissionId FROM submission WHERE UserId IN (SELECT UserId FROM user WHERE College='$col')) ORDER BY CoDateStart DESC";
        $result6 = mysqli_query($con,$query6);
        $count6 = mysqli_num_rows($result6);
    }
    else if($col != 'All' && $request != 'All' && $year == 'All')
    {
        $query6 = "SELECT * FROM copyrightedoutput WHERE CoLevel = '$request' AND SubmissionId IN (SELECT SubmissionId FROM submission WHERE ValidationStatus='Accepted' AND UserId IN (SELECT UserId FROM user WHERE College='$col')) ORDER BY CoDateStart DESC";
        $result6 = mysqli_query($con,$query6);
        $count6 = mysqli_num_rows($result6);
    }
    else if($col == 'All' && $request == 'All' && $year != 'All')
    {
        $query6 = "SELECT * FROM copyrightedoutput WHERE SubmissionId IN(SELECT SubmissionId FROM submission WHERE ValidationStatus='Accepted' AND QuarterId IN(SELECT QuarterId FROM quarter WHERE YearId IN(SELECT YearId FROM schoolyear WHERE SchoolYear = '$year'))) ORDER BY CoDateStart DESC";
        $result6 = mysqli_query($con,$query6);
        $count6 = mysqli_num_rows($result6);
    }
    else if($col == 'All' && $request != 'All' && $year != 'All')
    {
        $query6 = "SELECT * FROM copyrightedoutput WHERE CoLevel = '$request' AND SubmissionId IN(SELECT SubmissionId FROM submission WHERE ValidationStatus='Accepted' AND QuarterId IN(SELECT QuarterId FROM quarter WHERE YearId IN(SELECT YearId FROM schoolyear WHERE SchoolYear = '$year'))) ORDER BY CoDateStart DESC";
        $result6 = mysqli_query($con,$query6);
        $count6 = mysqli_num_rows($result6);
    }
    else if($col != 'All' && $request != 'All' && $year != 'All')
    {
        $query6 = "SELECT * FROM copyrightedoutput WHERE CoLevel = '$request' AND SubmissionId IN (SELECT SubmissionId FROM submission WHERE ValidationStatus='Accepted' AND UserId IN (SELECT UserId FROM user WHERE College='$col')) AND SubmissionId IN(SELECT SubmissionId FROM submission WHERE QuarterId IN(SELECT QuarterId FROM quarter WHERE YearId IN(SELECT YearId FROM schoolyear WHERE SchoolYear = '$year'))) ORDER BY CoDateStart DESC";
        $result6 = mysqli_query($con,$query6);
        $count6 = mysqli_num_rows($result6);
    }
    else if($col != 'All' && $request == 'All' && $year != 'All')
    {
        $query6 = "SELECT * FROM copyrightedoutput WHERE SubmissionId IN (SELECT SubmissionId FROM submission WHERE ValidationStatus='Accepted' AND UserId IN (SELECT UserId FROM user WHERE College='$col')) AND SubmissionId IN(SELECT SubmissionId FROM submission WHERE QuarterId IN(SELECT QuarterId FROM quarter WHERE YearId IN(SELECT YearId FROM schoolyear WHERE SchoolYear = '$year'))) ORDER BY CoDateStart DESC";
        $result6 = mysqli_query($con,$query6);
        $count6 = mysqli_num_rows($result6);
    }
    else
    {
        $count6 = 0;
    }
?>

    <?php

    if($count6){ ?>
<div class="tableContainer">
    <input id="college" type="hidden" value="<?php echo $col; ?>">
    <input id="year" type="hidden" value="<?php echo $year; ?>">
    <input id="level" type="hidden" value="<?php echo $request; ?>">
    <table border="1" style="align-items:center;" class="table-main">
    <h4>A.6. Copyrighted Research Output</h4>
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
                <th>Copyright Number</th>
                <th>Copyright Agency</th>
                <th>Year the research copyrighted</th>
                <th>Level</th>
                <th>Supporting Documents Submitted</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if($year=='All')
            {
                $displayyear = '';
            }
            else
            {
                $displayyear = $year;
            }
            header('Pragma: public');
            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition:attachment; filename= $col $displayyear Level:$request Copyrighted Research Outputs.xls");
            $i = 1;
            $n = null;
            while($row1 = mysqli_fetch_assoc($result6))
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
                $n = $row1['CoId'];
                $rname = "SELECT CoName FROM co_name WHERE CoId = '$n'";
                $resname = mysqli_query($con,$rname);
                $countres = mysqli_num_rows($resname);
                $researcher = mysqli_fetch_all($resname);

                $rword = "SELECT * FROM co_keywords WHERE CoId = '$n'";
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
                        <td><?php echo $row1['CoClass'];?></td>
                        <td><?php echo $row1['CoCategory'];?></td>
                        <td><?php echo $row1['CoAgenda'];?></td>
                        <td><?php echo $row1['CoTitle'];?></td>
                        <td><?php echo $researcher[$rescount][0];?></td>
                        
                        
                        
                        <td><?php echo $row1['CoInvolve'];?></td>
                        <td><?php echo $row1['CoType'];?></td>
                        <td><?php echo $rowkey['CoKeywords'];?></td>
                        <td><?php echo $row1['CoFundType'];?></td>
                        <td style="text-align:left;"><?php echo $row1['CoFundAmount'];?></td>
                        <td><?php echo $row1['CoFundAgency'];?></td>
                        <td style="text-align:left;"><?php echo $row1['CoDateStart'];?></td>
                        <td style="text-align:left;"><?php echo $row1['CoDateTarget'];?></td>
                        
                        <td style="text-align:left;"><?php echo $row1['CoDateCompleted'];?></td>
                        <td style="text-align:left;"><?php echo $row1['CoCopyrightNum'];?></td>
                        <td><?php echo $row1['CoCopyrightAgency'];?></td>
                        <td style="text-align:left;"><?php echo $row1['CoCopyrightYear'];?></td>
                        <td><?php echo $row1['CoLevel'];?></td>
                        <?php $file = $row1['CoTempName']; $download = 'uploads/'.$file;?> 
                        <td><?php echo $row1['CoFilename'];?></td>
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
                        <td><?php if($rowkey['CoKeywords']!=null){echo $rowkey['CoKeywords'];}?></td>
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

<?php } ?>