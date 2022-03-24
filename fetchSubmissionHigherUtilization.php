<?php

include("connection.php");
include("functions.php");



if(isset($_POST['request']))
{
    $request = $_POST['request'];
    $col = $_POST['col'];
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
    <table class="table-main" style="display:block; height:400px; overflow: auto;">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Research Name</th>
                <th scope="col">Date Started</th>
                <th scope="col">Target Date</th>
                <th scope="col">Agency/Organization that utilized the research output</th>
                <th scope="col">Supporting Documents</th>
                </tr>
        </thead>
        <?php 
        if($count5){
        $i=1;
        while($row1 = mysqli_fetch_assoc($result5)){

            ?>
        
        <tr>
            <th scope="row"><?php echo $i; ?></th>
            <td><?php echo $row1['RuTitle'];?></td>
            <td><?php echo $row1['RuDateStart'];?></td>
            <td><?php echo $row1['RuDateTarget'];?></td>
            <td><?php echo $row1['RuAgency'];?></td>
            <?php $file = $row1['RuTempName']; $download = 'uploads/'.$file;?> 
            <td><a href="<?php echo $download;?>" download><?php echo $row1['RuFilename'];?></a></td>
        </tr>
        <?php
            $i++;}
            }
            else
            {
                echo "No record Found";
            }
        ?>
        </tr>
<?php
}
?>
