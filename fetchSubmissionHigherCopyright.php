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
        $query6 = "SELECT * FROM copyrightedoutput WHERE SubmissionId IN (SELECT SubmissionId FROM submission WHERE ValidationStatus = 'Accepted' AND UserId IN (SELECT UserId FROM user WHERE College='$col')) ORDER BY CoDateStart DESC";
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
    <table class="table-main" style="display:block; height:400px; overflow: auto;">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Research Name</th>
                <th scope="col">Date Started</th>
                <th scope="col">Target Date</th>
                <th scope="col">Year the research is copyrighted</th>
                <th scope="col">Supporting Documents</th>
                </tr>
        </thead>
        <?php 
        if($count6){
        $i=1;
        while($row1 = mysqli_fetch_assoc($result6)){

            ?>
        
        <tr>
            <th scope="row"><?php echo $i; ?></th>
            <td><?php echo $row1['CoTitle'];?></td>
            <td><?php echo $row1['CoDateStart'];?></td>
            <td><?php echo $row1['CoDateTarget'];?></td>
            <td><?php echo $row1['CoCopyrightYear'];?></td>
            <?php $file = $row1['CoTempName']; $download = 'uploads/'.$file;?> 
            <td><a href="<?php echo $download;?>" download><?php echo $row1['CoFilename'];?></a></td>
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
