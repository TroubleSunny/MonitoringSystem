<?php

include("connection.php");
include("functions.php");



if(isset($_POST['col']))
{
    
    $year = $_POST['year'];
    $col = $_POST['col'];
    if($col == 'All' && $year=='All')
    {
        $query = "SELECT * FROM researchongoing WHERE RoStatus = 'Deferred' AND SubmissionId IN(SELECT SubmissionId FROM submission WHERE ValidationStatus = 'Accepted') ORDER BY RoDateStart DESC";
        $result = mysqli_query($con,$query);
        $count = mysqli_num_rows($result);
    }
    else if($col != 'All' && $year=='All')
    {      
        $query = "SELECT * FROM researchongoing WHERE RoStatus = 'Deferred' AND SubmissionId IN (SELECT SubmissionId FROM submission WHERE ValidationStatus = 'Accepted' AND UserId IN (SELECT UserId FROM user WHERE College='$col')) ORDER BY RoDateStart DESC";
        $result = mysqli_query($con,$query);
        $count = mysqli_num_rows($result);
    }
    else if($col != 'All' && $year!='All')
    {
        $query = "SELECT * FROM researchongoing WHERE RoStatus = 'Deferred' AND SubmissionId IN (SELECT SubmissionId FROM submission WHERE ValidationStatus = 'Accepted' AND UserId IN (SELECT UserId FROM user WHERE College='$col')) AND SubmissionId IN(SELECT SubmissionId FROM submission WHERE QuarterId IN(SELECT QuarterId FROM quarter WHERE YearId IN(SELECT YearId FROM schoolyear WHERE SchoolYear = '$year'))) ORDER BY RoDateStart DESC";
        $result = mysqli_query($con,$query);
        $count = mysqli_num_rows($result);
    }

    else if($col == 'All' && $year!='All')
    {
        $query = "SELECT * FROM researchongoing WHERE RoStatus = 'Deferred' AND SubmissionId IN(SELECT SubmissionId FROM submission WHERE ValidationStatus = 'Accepted' AND QuarterId IN(SELECT QuarterId FROM quarter WHERE YearId IN(SELECT YearId FROM schoolyear WHERE SchoolYear = '$year'))) ORDER BY RoDateStart DESC";
        $result = mysqli_query($con,$query);
        $count = mysqli_num_rows($result);
    }
    else
    {
        $count = 0;
    }
    
    


?>
    <table class="table-main" style="display:block; height:400px; overflow: auto;">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Research Name</th>
            <th scope="col">Date Started</th>
            <th scope="col">Target Date</th>
            <th scope="col">Research Status</th>
            <th scope="col">Supporting Documents</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        if($count){
        $i = 1;
        while($row1 = mysqli_fetch_assoc($result)){

            ?>
        
        <tr>
            <th scope="row"><?php echo $i; ?></th>
            <td><?php echo $row1['RoTitle'];?></td>
            <td><?php echo $row1['RoDateStart'];?></td>
            <td><?php echo $row1['RoDateTarget'];?></td>
            <td><?php echo $row1['RoStatus'];?></td>
            <?php $file = $row1['RoTempName']; $download = 'uploads/'.$file;?> 
            <td><a href="<?php echo $download;?>" download><?php echo $row1['RoFilename'];?></a></td>
        </tr>
        <?php
            $i++;}
            }
            else
            {
                echo "No Record Found";
            }
        ?>
        </tr>
    </tbody>

<?php 
}
?>