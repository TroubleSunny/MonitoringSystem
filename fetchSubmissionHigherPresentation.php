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
    <table class="table-main" style="display:block; height:400px; overflow: auto;">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Research Name</th>
                <th scope="col">Date Started</th>
                <th scope="col">Target Date</th>
                <th scope="col">Date Presented</th>
                <th scope="col">Supporting Documents</th>
                </tr>
        </thead>
        <?php 
        if($count2){
        $i=1;
        while($row1 = mysqli_fetch_assoc($result2)){

            ?>
        
        <tr>
            <th scope="row"><?php echo $i; ?></th>
            <td><?php echo $row1['RpresTitle'];?></td>
            <td><?php echo $row1['RpresDateStart'];?></td>
            <td><?php echo $row1['RpresDateTarget'];?></td>
            <td><?php echo $row1['RpresDatePresent'];?></td>
            
            <?php $file = $row1['RpresTempName']; $download = 'uploads/'.$file;?> 
            <td><a href="<?php echo $download;?>" download><?php echo $row1['RpresFilename'];?></a></td>
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
