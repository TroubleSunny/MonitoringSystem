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
        $query = "SELECT * FROM researchongoing WHERE SubmissionId IN(SELECT SubmissionId FROM submission WHERE ValidationStatus = 'Accepted') ORDER BY RoDateStart DESC";
        $result = mysqli_query($con,$query);
        $count = mysqli_num_rows($result);

        $query2 = "SELECT * FROM researchpresentation WHERE SubmissionId IN(SELECT SubmissionId FROM submission WHERE ValidationStatus = 'Accepted') ORDER BY RpresDateStart DESC";
        $result2 = mysqli_query($con,$query2);
        $count2 = mysqli_num_rows($result2);

        $query3 = "SELECT * FROM researchpublication WHERE SubmissionId IN(SELECT SubmissionId FROM submission WHERE ValidationStatus = 'Accepted') ORDER BY RpDateStart DESC";
        $result3 = mysqli_query($con,$query3);
        $count3 = mysqli_num_rows($result3);

        $query4 = "SELECT * FROM researchcitation WHERE SubmissionId IN(SELECT SubmissionId FROM submission WHERE ValidationStatus = 'Accepted') ORDER BY RcDateStart DESC";
        $result4 = mysqli_query($con,$query4);
        $count4 = mysqli_num_rows($result4);

        $query5 = "SELECT * FROM researchutilization WHERE SubmissionId IN(SELECT SubmissionId FROM submission WHERE ValidationStatus = 'Accepted') ORDER BY RuDateStart DESC";
        $result5 = mysqli_query($con,$query5);
        $count5 = mysqli_num_rows($result5);

        $query6 = "SELECT * FROM copyrightedoutput WHERE SubmissionId IN(SELECT SubmissionId FROM submission WHERE ValidationStatus = 'Accepted') ORDER BY CoDateStart DESC";
        $result6 = mysqli_query($con,$query6);
        $count6 = mysqli_num_rows($result6);
        
    }
    else if($col == 'All' && $request != 'All' && $year == 'All')
    {
        $query = "SELECT * FROM researchongoing WHERE SubmissionId IN(SELECT SubmissionId FROM submission WHERE ValidationStatus = 'Accepted') ORDER BY RoDateStart DESC";
        $result = mysqli_query($con,$query);
        $count = mysqli_num_rows($result);

        $query2 = "SELECT * FROM researchpresentation WHERE RpresLevel = '$request' AND SubmissionId IN(SELECT SubmissionId FROM submission WHERE ValidationStatus = 'Accepted') ORDER BY RpresDateStart DESC";
        $result2 = mysqli_query($con,$query2);
        $count2 = mysqli_num_rows($result2);

        $query3 = "SELECT * FROM researchpublication WHERE RpLevel = '$request' AND SubmissionId IN(SELECT SubmissionId FROM submission WHERE ValidationStatus = 'Accepted') ORDER BY RpDateStart DESC";
        $result3 = mysqli_query($con,$query3);
        $count3 = mysqli_num_rows($result3);

        $query4 = "SELECT * FROM researchcitation WHERE SubmissionId IN(SELECT SubmissionId FROM submission WHERE ValidationStatus = 'Accepted') ORDER BY RcDateStart DESC";
        $result4 = mysqli_query($con,$query4);
        $count4 = mysqli_num_rows($result4);

        $query5 = "SELECT * FROM researchutilization WHERE RuLevel = '$request' AND SubmissionId IN(SELECT SubmissionId FROM submission WHERE ValidationStatus = 'Accepted') ORDER BY RuDateStart DESC";
        $result5 = mysqli_query($con,$query5);
        $count5 = mysqli_num_rows($result5);

        $query6 = "SELECT * FROM copyrightedoutput WHERE CoLevel = '$request' AND SubmissionId IN(SELECT SubmissionId FROM submission WHERE ValidationStatus = 'Accepted') ORDER BY CoDateStart DESC";
        $result6 = mysqli_query($con,$query6);
        $count6 = mysqli_num_rows($result6);
        
    }
    else if($col != 'All' && $request == 'All' && $year == 'All')
    {
        
        $query = "SELECT * FROM researchongoing WHERE SubmissionId IN (SELECT SubmissionId FROM submission WHERE ValidationStatus = 'Accepted' AND UserId IN (SELECT UserId FROM user WHERE College='$col')) ORDER BY RoDateStart DESC";
        $result = mysqli_query($con,$query);
        $count = mysqli_num_rows($result);

        $query2 = "SELECT * FROM researchpresentation WHERE SubmissionId IN (SELECT SubmissionId FROM submission WHERE ValidationStatus = 'Accepted' AND UserId IN (SELECT UserId FROM user WHERE College='$col')) ORDER BY RpresDateStart DESC";
        $result2 = mysqli_query($con,$query2);
        $count2 = mysqli_num_rows($result2);

        $query3 = "SELECT * FROM researchpublication WHERE SubmissionId IN (SELECT SubmissionId FROM submission WHERE ValidationStatus = 'Accepted' AND UserId IN (SELECT UserId FROM user WHERE College='$col')) ORDER BY RpDateStart DESC";
        $result3 = mysqli_query($con,$query3);
        $count3 = mysqli_num_rows($result3);

        $query4 = "SELECT * FROM researchcitation WHERE SubmissionId IN (SELECT SubmissionId FROM submission WHERE ValidationStatus = 'Accepted' AND  UserId IN (SELECT UserId FROM user WHERE College='$col')) ORDER BY RcDateStart DESC";
        $result4 = mysqli_query($con,$query4);
        $count4 = mysqli_num_rows($result4);

        $query5 = "SELECT * FROM researchutilization WHERE SubmissionId IN (SELECT SubmissionId FROM submission WHERE ValidationStatus = 'Accepted' AND UserId IN (SELECT UserId FROM user WHERE College='$col')) ORDER BY RuDateStart DESC";
        $result5 = mysqli_query($con,$query5);
        $count5 = mysqli_num_rows($result5);

        $query6 = "SELECT * FROM copyrightedoutput WHERE SubmissionId IN (SELECT SubmissionId FROM submission WHERE ValidationStatus = 'Accepted' AND  UserId IN (SELECT UserId FROM user WHERE College='$col')) ORDER BY CoDateStart DESC";
        $result6 = mysqli_query($con,$query6);
        $count6 = mysqli_num_rows($result6);
        
    }
    else if($col != 'All' && $request != 'All' && $year == 'All')
    {
          
        $query = "SELECT * FROM researchongoing WHERE SubmissionId IN (SELECT SubmissionId FROM submission WHERE ValidationStatus = 'Accepted' AND UserId IN (SELECT UserId FROM user WHERE College='$col')) ORDER BY RoDateStart DESC";
        $result = mysqli_query($con,$query);
        $count = mysqli_num_rows($result);

        $query2 = "SELECT * FROM researchpresentation WHERE RpresLevel = '$request' AND SubmissionId IN (SELECT SubmissionId FROM submission WHERE ValidationStatus = 'Accepted' AND UserId IN (SELECT UserId FROM user WHERE College='$col')) ORDER BY RpresDateStart DESC";
        $result2 = mysqli_query($con,$query2);
        $count2 = mysqli_num_rows($result2);

        $query3 = "SELECT * FROM researchpublication WHERE RpLevel = '$request' AND SubmissionId IN (SELECT SubmissionId FROM submission WHERE ValidationStatus = 'Accepted' AND UserId IN (SELECT UserId FROM user WHERE College='$col')) ORDER BY RpDateStart DESC";
        $result3 = mysqli_query($con,$query3);
        $count3 = mysqli_num_rows($result3);

        $query4 = "SELECT * FROM researchcitation WHERE SubmissionId IN (SELECT SubmissionId FROM submission WHERE ValidationStatus = 'Accepted' AND UserId IN (SELECT UserId FROM user WHERE College='$col')) ORDER BY RcDateStart DESC";
        $result4 = mysqli_query($con,$query4);
        $count4 = mysqli_num_rows($result4);

        $query5 = "SELECT * FROM researchutilization WHERE RuLevel = '$request' AND SubmissionId IN (SELECT SubmissionId FROM submission WHERE ValidationStatus = 'Accepted' AND UserId IN (SELECT UserId FROM user WHERE College='$col')) ORDER BY RuDateStart DESC";
        $result5 = mysqli_query($con,$query5);
        $count5 = mysqli_num_rows($result5);

        $query6 = "SELECT * FROM copyrightedoutput WHERE CoLevel = '$request' AND SubmissionId IN (SELECT SubmissionId FROM submission WHERE ValidationStatus = 'Accepted' AND UserId IN (SELECT UserId FROM user WHERE College='$col')) ORDER BY CoDateStart DESC";
        $result6 = mysqli_query($con,$query6);
        $count6 = mysqli_num_rows($result6);
        
    }
    else if($col == 'All' && $request == 'All' && $year != 'All')
    {
        $query = "SELECT * FROM researchongoing WHERE SubmissionId IN(SELECT SubmissionId FROM submission WHERE ValidationStatus = 'Accepted' AND QuarterId IN(SELECT QuarterId FROM quarter WHERE YearId IN(SELECT YearId FROM schoolyear WHERE SchoolYear = '$year'))) ORDER BY RoDateStart DESC";
        $result = mysqli_query($con,$query);
        $count = mysqli_num_rows($result);

        $query2 = "SELECT * FROM researchpresentation WHERE SubmissionId IN(SELECT SubmissionId FROM submission WHERE ValidationStatus = 'Accepted' AND QuarterId IN(SELECT QuarterId FROM quarter WHERE YearId IN(SELECT YearId FROM schoolyear WHERE SchoolYear = '$year'))) ORDER BY RpresDateStart DESC";
        $result2 = mysqli_query($con,$query2);
        $count2 = mysqli_num_rows($result2);

        $query3 = "SELECT * FROM researchpublication WHERE SubmissionId IN(SELECT SubmissionId FROM submission WHERE ValidationStatus = 'Accepted' AND QuarterId IN(SELECT QuarterId FROM quarter WHERE YearId IN(SELECT YearId FROM schoolyear WHERE SchoolYear = '$year'))) ORDER BY RpDateStart DESC";
        $result3 = mysqli_query($con,$query3);
        $count3 = mysqli_num_rows($result3);

        $query4 = "SELECT * FROM researchcitation WHERE SubmissionId IN(SELECT SubmissionId FROM submission WHERE ValidationStatus = 'Accepted' AND QuarterId IN(SELECT QuarterId FROM quarter WHERE YearId IN(SELECT YearId FROM schoolyear WHERE SchoolYear = '$year'))) ORDER BY RcDateStart DESC";
        $result4 = mysqli_query($con,$query4);
        $count4 = mysqli_num_rows($result4);

        $query5 = "SELECT * FROM researchutilization WHERE SubmissionId IN(SELECT SubmissionId FROM submission WHERE ValidationStatus = 'Accepted' AND QuarterId IN(SELECT QuarterId FROM quarter WHERE YearId IN(SELECT YearId FROM schoolyear WHERE SchoolYear = '$year'))) ORDER BY RuDateStart DESC";
        $result5 = mysqli_query($con,$query5);
        $count5 = mysqli_num_rows($result5);

        $query6 = "SELECT * FROM copyrightedoutput WHERE SubmissionId IN(SELECT SubmissionId FROM submission WHERE ValidationStatus = 'Accepted' AND QuarterId IN(SELECT QuarterId FROM quarter WHERE YearId IN(SELECT YearId FROM schoolyear WHERE SchoolYear = '$year'))) ORDER BY CoDateStart DESC";
        $result6 = mysqli_query($con,$query6);
        $count6 = mysqli_num_rows($result6);

    }
    else if($col == 'All' && $request != 'All' && $year != 'All')
    {
        $query = "SELECT * FROM researchongoing WHERE SubmissionId IN(SELECT SubmissionId FROM submission WHERE ValidationStatus = 'Accepted' AND QuarterId IN(SELECT QuarterId FROM quarter WHERE YearId IN(SELECT YearId FROM schoolyear WHERE SchoolYear = '$year'))) ORDER BY RoDateStart DESC";
        $result = mysqli_query($con,$query);
        $count = mysqli_num_rows($result);

        $query2 = "SELECT * FROM researchpresentation WHERE RpresLevel = '$request' AND SubmissionId IN(SELECT SubmissionId FROM submission WHERE ValidationStatus = 'Accepted' AND QuarterId IN(SELECT QuarterId FROM quarter WHERE YearId IN(SELECT YearId FROM schoolyear WHERE SchoolYear = '$year'))) ORDER BY RpresDateStart DESC";
        $result2 = mysqli_query($con,$query2);
        $count2 = mysqli_num_rows($result2);

        $query3 = "SELECT * FROM researchpublication WHERE RpLevel = '$request' AND SubmissionId IN(SELECT SubmissionId FROM submission WHERE ValidationStatus = 'Accepted' AND QuarterId IN(SELECT QuarterId FROM quarter WHERE YearId IN(SELECT YearId FROM schoolyear WHERE SchoolYear = '$year'))) ORDER BY RpDateStart DESC";
        $result3 = mysqli_query($con,$query3);
        $count3 = mysqli_num_rows($result3);

        $query4 = "SELECT * FROM researchcitation WHERE SubmissionId IN(SELECT SubmissionId FROM submission WHERE ValidationStatus = 'Accepted' AND QuarterId IN(SELECT QuarterId FROM quarter WHERE YearId IN(SELECT YearId FROM schoolyear WHERE SchoolYear = '$year'))) ORDER BY RcDateStart DESC";
        $result4 = mysqli_query($con,$query4);
        $count4 = mysqli_num_rows($result4);

        $query5 = "SELECT * FROM researchutilization WHERE RuLevel = '$request' AND SubmissionId IN(SELECT SubmissionId FROM submission WHERE ValidationStatus = 'Accepted' AND QuarterId IN(SELECT QuarterId FROM quarter WHERE YearId IN(SELECT YearId FROM schoolyear WHERE SchoolYear = '$year'))) ORDER BY RuDateStart DESC";
        $result5 = mysqli_query($con,$query5);
        $count5 = mysqli_num_rows($result5);

        $query6 = "SELECT * FROM copyrightedoutput WHERE CoLevel = '$request' AND SubmissionId IN(SELECT SubmissionId FROM submission WHERE ValidationStatus = 'Accepted' AND QuarterId IN(SELECT QuarterId FROM quarter WHERE YearId IN(SELECT YearId FROM schoolyear WHERE SchoolYear = '$year'))) ORDER BY CoDateStart DESC";
        $result6 = mysqli_query($con,$query6);
        $count6 = mysqli_num_rows($result6);

    }
    else if($col != 'All' && $request != 'All' && $year != 'All')
    {
        $query = "SELECT * FROM researchongoing WHERE SubmissionId IN (SELECT SubmissionId FROM submission WHERE ValidationStatus = 'Accepted' AND QuarterId IN(SELECT QuarterId FROM quarter WHERE YearId IN(SELECT YearId FROM schoolyear WHERE SchoolYear = '$year')) AND UserId IN (SELECT UserId FROM user WHERE College='$col')) ORDER BY RoDateStart DESC";
        $result = mysqli_query($con,$query);
        $count = mysqli_num_rows($result);

        $query2 = "SELECT * FROM researchpresentation WHERE RpresLevel = '$request' AND SubmissionId IN (SELECT SubmissionId FROM submission WHERE ValidationStatus = 'Accepted' AND UserId IN (SELECT UserId FROM user WHERE College='$col')) AND SubmissionId IN(SELECT SubmissionId FROM submission WHERE QuarterId IN(SELECT QuarterId FROM quarter WHERE YearId IN(SELECT YearId FROM schoolyear WHERE SchoolYear = '$year'))) ORDER BY RpresDateStart DESC";
        $result2 = mysqli_query($con,$query2);
        $count2 = mysqli_num_rows($result2);

        $query3 = "SELECT * FROM researchpublication WHERE RpLevel = '$request' AND SubmissionId IN (SELECT SubmissionId FROM submission WHERE ValidationStatus = 'Accepted' AND UserId IN (SELECT UserId FROM user WHERE College='$col')) AND SubmissionId IN(SELECT SubmissionId FROM submission WHERE QuarterId IN(SELECT QuarterId FROM quarter WHERE YearId IN(SELECT YearId FROM schoolyear WHERE SchoolYear = '$year'))) ORDER BY RpDateStart DESC";
        $result3 = mysqli_query($con,$query3);
        $count3 = mysqli_num_rows($result3);

        $query4 = "SELECT * FROM researchcitation WHERE SubmissionId IN (SELECT SubmissionId FROM submission WHERE ValidationStatus = 'Accepted' AND UserId IN (SELECT UserId FROM user WHERE College='$col')) AND SubmissionId IN(SELECT SubmissionId FROM submission WHERE QuarterId IN(SELECT QuarterId FROM quarter WHERE YearId IN(SELECT YearId FROM schoolyear WHERE SchoolYear = '$year'))) ORDER BY RcDateStart DESC";
        $result4 = mysqli_query($con,$query4);
        $count4 = mysqli_num_rows($result4);

        $query5 = "SELECT * FROM researchutilization WHERE RuLevel = '$request' AND  SubmissionId IN (SELECT SubmissionId FROM submission WHERE ValidationStatus = 'Accepted' AND UserId IN (SELECT UserId FROM user WHERE College='$col')) AND SubmissionId IN(SELECT SubmissionId FROM submission WHERE QuarterId IN(SELECT QuarterId FROM quarter WHERE YearId IN(SELECT YearId FROM schoolyear WHERE SchoolYear = '$year'))) ORDER BY RuDateStart DESC";
        $result5 = mysqli_query($con,$query5);
        $count5 = mysqli_num_rows($result5);

        $query6 = "SELECT * FROM copyrightedoutput WHERE CoLevel = '$request' AND SubmissionId IN (SELECT SubmissionId FROM submission WHERE ValidationStatus = 'Accepted' AND UserId IN (SELECT UserId FROM user WHERE College='$col')) AND SubmissionId IN(SELECT SubmissionId FROM submission WHERE QuarterId IN(SELECT QuarterId FROM quarter WHERE YearId IN(SELECT YearId FROM schoolyear WHERE SchoolYear = '$year'))) ORDER BY CoDateStart DESC";
        $result6 = mysqli_query($con,$query6);
        $count6 = mysqli_num_rows($result6);

    }
    else if($col != 'All' && $request == 'All' && $year != 'All')
    {
        $query = "SELECT * FROM researchongoing WHERE SubmissionId IN (SELECT SubmissionId FROM submission WHERE ValidationStatus = 'Accepted' AND UserId IN (SELECT UserId FROM user WHERE College='$col')) AND SubmissionId IN(SELECT SubmissionId FROM submission WHERE QuarterId IN(SELECT QuarterId FROM quarter WHERE YearId IN(SELECT YearId FROM schoolyear WHERE SchoolYear = '$year'))) ORDER BY RoDateStart DESC";
        $result = mysqli_query($con,$query);
        $count = mysqli_num_rows($result);

        $query2 = "SELECT * FROM researchpresentation WHERE SubmissionId IN (SELECT SubmissionId FROM submission WHERE ValidationStatus = 'Accepted' AND UserId IN (SELECT UserId FROM user WHERE College='$col')) AND SubmissionId IN(SELECT SubmissionId FROM submission WHERE QuarterId IN(SELECT QuarterId FROM quarter WHERE YearId IN(SELECT YearId FROM schoolyear WHERE SchoolYear = '$year'))) ORDER BY RpresDateStart DESC";
        $result2 = mysqli_query($con,$query2);
        $count2 = mysqli_num_rows($result2);

        $query3 = "SELECT * FROM researchpublication WHERE SubmissionId IN (SELECT SubmissionId FROM submission WHERE ValidationStatus = 'Accepted' AND UserId IN (SELECT UserId FROM user WHERE College='$col')) AND SubmissionId IN(SELECT SubmissionId FROM submission WHERE QuarterId IN(SELECT QuarterId FROM quarter WHERE YearId IN(SELECT YearId FROM schoolyear WHERE SchoolYear = '$year'))) ORDER BY RpDateStart DESC";
        $result3 = mysqli_query($con,$query3);
        $count3 = mysqli_num_rows($result3);

        $query4 = "SELECT * FROM researchcitation WHERE SubmissionId IN (SELECT SubmissionId FROM submission WHERE ValidationStatus = 'Accepted' AND UserId IN (SELECT UserId FROM user WHERE College='$col')) AND SubmissionId IN(SELECT SubmissionId FROM submission WHERE QuarterId IN(SELECT QuarterId FROM quarter WHERE YearId IN(SELECT YearId FROM schoolyear WHERE SchoolYear = '$year'))) ORDER BY RcDateStart DESC";
        $result4 = mysqli_query($con,$query4);
        $count4 = mysqli_num_rows($result4);

        $query5 = "SELECT * FROM researchutilization WHERE SubmissionId IN (SELECT SubmissionId FROM submission WHERE ValidationStatus = 'Accepted' AND UserId IN (SELECT UserId FROM user WHERE College='$col')) AND SubmissionId IN(SELECT SubmissionId FROM submission WHERE QuarterId IN(SELECT QuarterId FROM quarter WHERE YearId IN(SELECT YearId FROM schoolyear WHERE SchoolYear = '$year'))) ORDER BY RuDateStart DESC";
        $result5 = mysqli_query($con,$query5);
        $count5 = mysqli_num_rows($result5);

        $query6 = "SELECT * FROM copyrightedoutput WHERE SubmissionId IN (SELECT SubmissionId FROM submission WHERE ValidationStatus = 'Accepted' AND UserId IN (SELECT UserId FROM user WHERE College='$col')) AND SubmissionId IN(SELECT SubmissionId FROM submission WHERE QuarterId IN(SELECT QuarterId FROM quarter WHERE YearId IN(SELECT YearId FROM schoolyear WHERE SchoolYear = '$year'))) ORDER BY CoDateStart DESC";
        $result6 = mysqli_query($con,$query6);
        $count6 = mysqli_num_rows($result6);
    }

    else
    {
        $count = 0;
        $count2 = 0;
        $count3 = 0;
        $count4 = 0;
        $count5 = 0;
        $count6 = 0;
    }
    
    
?>

<table class="table-main" style="display:block; height:400px; overflow: auto;">    
    <thead>
        <tr style="position:sticky; top:0; background-color:white; border-color:red;">
            <th scope="col">#</th>
            <th scope="col">Research Name</th>
            <th scope="col">Date Started</th>
            <th scope="col">Target Date</th>
            <th scope="col">Status</th>
            <th scope="col">Supporting Documents</th>
        </tr>
    </thead>
        
    <tbody>
        <?php 
        $i = 1;
        if($count){
        
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
        ?>
            </tr>
        <?php 
        if($count2){
        
        while($row1 = mysqli_fetch_assoc($result2)){

            ?>
        
        <tr>
            <th scope="row"><?php echo $i; ?></th>
            <td><?php echo $row1['RpresTitle'];?></td>
            <td><?php echo $row1['RpresDateStart'];?></td>
            <td><?php echo $row1['RpresDateTarget'];?></td>
            <td>Completed</td>
            <?php $file = $row1['RpresTempName']; $download = 'uploads/'.$file;?> 
            <td><a href="<?php echo $download;?>" download><?php echo $row1['RpresFilename'];?></a></td>
        </tr>
        <?php
            $i++;}
            }
        ?>
        </tr>
        <?php 
        if($count3){
        
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
        ?>
        </tr>
        <?php 
        if($count4){
        
        while($row1 = mysqli_fetch_assoc($result4)){

            ?>
            
        <tr>
            <th scope="row"><?php echo $i; ?></th>
            <td><?php echo $row1['RcTitle'];?></td>
            <td><?php echo $row1['RcDateStart'];?></td>
            <td><?php echo $row1['RcDateTarget'];?></td>
            <td>Completed</td>
            <?php $file = $row1['RcTempName']; $download = 'uploads/'.$file;?> 
            <td><a href="<?php echo $download;?>" download><?php echo $row1['RcFilename'];?></a></td>
        </tr>
        <?php
            $i++;}
            }
        ?>
        </tr>
        <?php 
        if($count5){
        
        while($row1 = mysqli_fetch_assoc($result5)){

            ?>
            
        <tr>
            <th scope="row"><?php echo $i; ?></th>
            <td><?php echo $row1['RuTitle'];?></td>
            <td><?php echo $row1['RuDateStart'];?></td>
            <td><?php echo $row1['RuDateTarget'];?></td>
            <td>Completed</td>
            <?php $file = $row1['RuTempName']; $download = 'uploads/'.$file;?> 
            <td><a href="<?php echo $download;?>" download><?php echo $row1['RuFilename'];?></a></td>
        </tr>
        <?php
            $i++;}
            }
        ?>
        </tr>
        <?php 
        if($count6){
        
        while($row1 = mysqli_fetch_assoc($result6)){

            ?>
            
        <tr>
            <th scope="row"><?php echo $i; ?></th>
            <td><?php echo $row1['CoTitle'];?></td>
            <td><?php echo $row1['CoDateStart'];?></td>
            <td><?php echo $row1['CoDateTarget'];?></td>
            <td>Completed</td>
            <?php $file = $row1['CoTempName']; $download = 'uploads/'.$file;?> 
            <td><a href="<?php echo $download;?>" download><?php echo $row1['CoFilename'];?></a></td>
        </tr>
        <?php
            $i++;}
            }
            if($count==0 && $count2==0 && $count3==0 && $count4==0 && $count5==0 && $count6==0)
            {
                echo "No record found";
            }
        ?>
        </tr>

    </tbody>
</table>
<?php
}
?>