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
    <table class="table-main" style="display:block; height:400px; overflow: auto;">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Research Name</th>
                <th scope="col">Date Started</th>
                <th scope="col">Target Date</th>
                <th scope="col">Date of Publication</th>
                <th scope="col">Supporting Documents</th>
                </tr>
        </thead>
        <?php 
        if($count3){
        $i=1;
        while($row1 = mysqli_fetch_assoc($result3)){

            ?>
        
        <tr>
            <th scope="row"><?php echo $i; ?></th>
            <td><?php echo $row1['RpTitle'];?></td>
            <td><?php echo $row1['RpDateStart'];?></td>
            <td><?php echo $row1['RpDateTarget'];?></td>
            <td>Completed</td>
            <?php $file = $row1['RpTempName']; $download = 'uploads/'.$file;?> 
            <td><a href="<?php echo $download;?>" download><?php echo $row1['RpFilename'];?></a></td>
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
