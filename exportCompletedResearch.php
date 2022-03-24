<?php

include("connection.php");
include("functions.php");



if(isset($_POST['col3']))
{
    $year = $_POST['thisyear3'];
    $col = $_POST['col3'];
    if($col == 'All' && $year=='All')
    {
        $query = "SELECT * FROM researchongoing WHERE SubmissionId IN(SELECT SubmissionId FROM submission WHERE ValidationStatus='Accepted') AND RoStatus = 'Completed' ORDER BY RoDateStart DESC";
        $result = mysqli_query($con,$query);
        $count = mysqli_num_rows($result);
    }
    else if($col != 'All' && $year=='All')
    {      
        $query = "SELECT * FROM researchongoing WHERE RoStatus = 'Completed' AND SubmissionId IN (SELECT SubmissionId FROM submission WHERE ValidationStatus = 'Accepted' AND UserId IN (SELECT UserId FROM user WHERE College='$col')) ORDER BY RoDateStart DESC";
        $result = mysqli_query($con,$query);
        $count = mysqli_num_rows($result);
    }
    else if($col != 'All' && $year!='All')
    {
        $query = "SELECT * FROM researchongoing WHERE RoStatus = 'Completed' AND SubmissionId IN (SELECT SubmissionId FROM submission WHERE ValidationStatus = 'Accepted' AND QuarterId IN(SELECT QuarterId FROM quarter WHERE YearId IN(SELECT YearId FROM schoolyear WHERE SchoolYear = '$year')) AND UserId IN (SELECT UserId FROM user WHERE College='$col')) ORDER BY RoDateStart DESC";
        $result = mysqli_query($con,$query);
        $count = mysqli_num_rows($result);
    }
    else if($col == 'All' && $year!='All')
    {
        $query = "SELECT * FROM researchongoing WHERE RoStatus = 'Completed' AND SubmissionId IN(SELECT SubmissionId FROM submission WHERE ValidationStatus='Accepted' AND QuarterId IN(SELECT QuarterId FROM quarter WHERE YearId IN(SELECT YearId FROM schoolyear WHERE SchoolYear = '$year'))) ORDER BY RoDateStart DESC";
        $result = mysqli_query($con,$query);
        $count = mysqli_num_rows($result);
    }
    else
    {
        $count = 0;
    }
    
    


?>

<div class="tableContainer">
    <input id="college" type="hidden" value="<?php echo $col; ?>">
    <input id="year" type="hidden" value="<?php echo $year; ?>">
        <?php
        if($year=='All')
        {
            $displayyear = '';
        }
        else
        {
            $displayyear = $year;
        }

        if($count){ ?>
        <table border="1" style="align-items:center;" class="table-main">
        <h4 style="margin:0 auto; align-items:center; justify-content:center; text-align:center;">VI. Other Accomplishments (If Any)</h4>
        <h3>A. Research & Book Chapter (Production, Citation, Presentation)</h3>
        <h4>A. 1. Research Ongoing /Completed</h4>
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
                    <th>Status</th>
                    <th>Date Completed</th>
                    <th>Supporting Documents Submitted</th>
                </tr>
            </thead>
            <tbody>
                <?php
                 header('Pragma: public');
                 header("Content-Type: application/vnd.ms-excel");
                 header("Content-Disposition:attachment; filename= $col $displayyear Research Completed Titles.xls");
                $i = 1;
                $n = null;
                while($row1 = mysqli_fetch_assoc($result))
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
                    $n = $row1['RoId'];
                    $rname = "SELECT RoName FROM ro_name WHERE RoId = '$n'";
                    $resname = mysqli_query($con,$rname);
                    $countres = mysqli_num_rows($resname);
                    $researcher = mysqli_fetch_all($resname);

                    $rword = "SELECT * FROM ro_keywords WHERE RoId = '$n'";
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
                            <td><?php echo $row1['RoClass'];?></td>
                            <td><?php echo $row1['RoCategory'];?></td>
                            <td><?php echo $row1['RoAgenda'];?></td>
                            <td><?php echo $row1['RoTitle'];?></td>
                            <td><?php echo $researcher[$rescount][0];?></td>
                            
                            
                            
                            <td><?php echo $row1['RoInvolve'];?></td>
                            <td><?php echo $row1['RoType'];?></td>
                            <td><?php echo $rowkey['RoKeyword'];?></td>
                            <td><?php echo $row1['RoFundType'];?></td>
                            <td style="text-align:left;"><?php echo $row1['RoFundAmount'];?></td>
                            <td><?php echo $row1['RoFundAgency'];?></td>
                            <td style="text-align:left;"><?php echo $row1['RoDateStart'];?></td>
                            <td style="text-align:left;"><?php echo $row1['RoDateTarget'];?></td>
                            <td><?php echo $row1['RoStatus'];?></td>
                            <td style="text-align:left;"><?php echo $row1['RoDateCompleted'];?></td>
                            <?php $file = $row1['RoTempName']; $download = 'uploads/'.$file;?> 
                            <td><?php echo $row1['RoFilename'];?></td>
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
                            <td><?php if($rescount < $countres) {echo $researcher[$rescount][0];}?></td>
                            

                            <td></td>
                            <td></td>
                            <td><?php if($rowkey['RoKeyword']!=null){echo $rowkey['RoKeyword'];}?></td>
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
                else{
                    echo "No record found";
                }           
                ?>
            </tbody>
        </table>
    </div>
<?php } ?>