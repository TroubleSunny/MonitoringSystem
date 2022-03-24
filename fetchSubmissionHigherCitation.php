<?php

include("connection.php");
include("functions.php");



if(isset($_POST['col']))
{
    $year = $_POST['year'];
    $col = $_POST['col'];
    $request = $_POST['indexing'];

    if($col == 'All' && $request == 'All' && $year == 'All')
    {
        $query4 = "SELECT * FROM researchcitation WHERE SubmissionId IN(SELECT SubmissionId FROM submission WHERE ValidationStatus = 'Accepted') ORDER BY RcDateStart DESC";
        $result4 = mysqli_query($con,$query4);
        $count4 = mysqli_num_rows($result4);
    }
    else if($col == 'All' && $request != 'All' && $year == 'All')
    {     
        $query4 = "SELECT * FROM researchcitation WHERE SubmissionId IN(SELECT SubmissionId FROM submission WHERE ValidationStatus = 'Accepted') AND RcJournalIndexing = '$request' ORDER BY RcDateStart DESC";
        $result4 = mysqli_query($con,$query4);
        $count4 = mysqli_num_rows($result4);
    }
    else if($col != 'All' && $request == 'All' && $year == 'All')
    {
        $query4 = "SELECT * FROM researchcitation WHERE SubmissionId IN (SELECT SubmissionId FROM submission WHERE ValidationStatus = 'Accepted' AND UserId IN (SELECT UserId FROM user WHERE College='$col')) ORDER BY RcDateStart DESC";
        $result4 = mysqli_query($con,$query4);
        $count4 = mysqli_num_rows($result4);
    }
    else if($col != 'All' && $request != 'All' && $year == 'All')
    {
        $query4 = "SELECT * FROM researchcitation WHERE RcJournalIndexing = '$request' AND SubmissionId IN (SELECT SubmissionId FROM submission WHERE ValidationStatus='Accepted' AND UserId IN (SELECT UserId FROM user WHERE College='$col')) ORDER BY RcDateStart DESC";
        $result4 = mysqli_query($con,$query4);
        $count4 = mysqli_num_rows($result4);
    }
    else if($col == 'All' && $request == 'All' && $year != 'All')
    {
        $query4 = "SELECT * FROM researchcitation WHERE SubmissionId IN(SELECT SubmissionId FROM submission WHERE ValidationStatus='Accepted' AND QuarterId IN(SELECT QuarterId FROM quarter WHERE YearId IN(SELECT YearId FROM schoolyear WHERE SchoolYear = '$year'))) ORDER BY RcDateStart DESC";
        $result4 = mysqli_query($con,$query4);
        $count4 = mysqli_num_rows($result4);
    }
    else if($col == 'All' && $request != 'All' && $year != 'All')
    {
        $query4 = "SELECT * FROM researchcitation WHERE  RcJournalIndexing = '$request' AND SubmissionId IN(SELECT SubmissionId FROM submission WHERE ValidationStatus='Accepted' AND QuarterId IN(SELECT QuarterId FROM quarter WHERE YearId IN(SELECT YearId FROM schoolyear WHERE SchoolYear = '$year'))) ORDER BY RcDateStart DESC";
        $result4 = mysqli_query($con,$query4);
        $count4 = mysqli_num_rows($result4);
        
    }
    else if($col != 'All' && $request != 'All' && $year != 'All')
    {
        $query4 = "SELECT * FROM researchcitation WHERE RcJournalIndexing = '$request' AND SubmissionId IN (SELECT SubmissionId FROM submission WHERE ValidationStatus='Accepted' AND QuarterId IN(SELECT QuarterId FROM quarter WHERE YearId IN(SELECT YearId FROM schoolyear WHERE SchoolYear = '$year')) AND UserId IN (SELECT UserId FROM user WHERE College='$col')) ORDER BY RcDateStart DESC";
        $result4 = mysqli_query($con,$query4);
        $count4 = mysqli_num_rows($result4);
    }
    else if($col != 'All' && $request == 'All' && $year != 'All')
    {
        $query4 = "SELECT * FROM researchcitation WHERE SubmissionId IN (SELECT SubmissionId FROM submission WHERE ValidationStatus='Accepted' AND QuarterId IN(SELECT QuarterId FROM quarter WHERE YearId IN(SELECT YearId FROM schoolyear WHERE SchoolYear = '$year')) AND UserId IN (SELECT UserId FROM user WHERE College='$col')) ORDER BY RcDateStart DESC";
        $result4 = mysqli_query($con,$query4);
        $count4 = mysqli_num_rows($result4);
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
            <th scope="col">Date Completed</th>
            <th scope="col">Date Completed</th>
        </tr>
    </thead>
    <tbody>
    <?php 
        if($count4){
        $i=1;
        while($row1 = mysqli_fetch_assoc($result4)){

            ?>
            
        <tr>
            <th scope="row"><?php echo $i; ?></th>
            <td><?php echo $row1['RcTitle'];?></td>
            <td><?php echo $row1['RcDateStart'];?></td>
            <td><?php echo $row1['RcDateTarget'];?></td>
            <td><?php echo $row1['RcDateCompleted'];?></td>
            <?php $file = $row1['RcTempName']; $download = 'uploads/'.$file;?> 
            <td><a href="<?php echo $download;?>" download><?php echo $row1['RcFilename'];?></a></td>
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
    </tbody>

<?php 
}
?>