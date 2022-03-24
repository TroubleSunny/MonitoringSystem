<?php

include("connection.php");
include("functions.php");



if(isset($_POST['college']))
{
    
    $year = $_POST['year'];
    $col = $_POST['college'];
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
<?php

if($count4){ ?>
 <input id="college" type="hidden" value="<?php echo $col; ?>">
    <input id="year" type="hidden" value="<?php echo $year; ?>">
    <input id="indexing" type="hidden" value="<?php echo $request; ?>">
<div class="tableContainer">
    <table class="table-main">
    <h4>A.4. Research Citation</h4>
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
                <th>Title of Research/Article Cited</th>
                <th>Title of Article Where Your Research has been cited</th>
                <th>Author/s Who Cited Your Research</th>
                <th>Title of the Journal/Books Where Your Article has been cited</th>
                <th>Volume No. of  the Journal/Book Where Your Article has been cited</th>
                <th>Issue No. of  the Journal/Book Where Your Article has been cited</th>
                <th>Page No. of  the Journal Where Your Article has been cited</th>
                <th>Year of Publication of the Journal Where Your Article has been cited</th>
                <th>Name of Publisher of the Journal Where Your Article has been cited</th>
                <th>Indexing Flatform of the Journal Where Your Article has been cited</th>
                <th>Supporting Documents Submitted</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            $n = null;
            while($row1 = mysqli_fetch_assoc($result4))
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
                $n = $row1['CitationId'];
                $rname = "SELECT RcName FROM rc_name WHERE CitationId = '$n'";
                $resname = mysqli_query($con,$rname);
                $countres = mysqli_num_rows($resname);
                $researcher = mysqli_fetch_all($resname);

                $rword = "SELECT * FROM rc_keywords WHERE CitationId = '$n'";
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
                        <td><?php echo $row1['RcClass'];?></td>
                        <td><?php echo $row1['RcCategory'];?></td>
                        <td><?php echo $row1['RcAgenda'];?></td>
                        <td><?php echo $row1['RcTitle'];?></td>
                        <td><?php echo $researcher[$rescount][0];?></td>
                        
                        
                        
                        <td><?php echo $row1['RcInvolve'];?></td>
                        <td><?php echo $row1['RcType'];?></td>
                        <td><?php echo $rowkey['RcKeyword'];?></td>
                        <td><?php echo $row1['RcFundType'];?></td>
                        <td><?php echo $row1['RcFundAmount'];?></td>
                        <td><?php echo $row1['RcFundAgency'];?></td>
                        <td><?php echo $row1['RcDateStart'];?></td>
                        <td><?php echo $row1['RcDateTarget'];?></td>
                        
                        <td><?php echo $row1['RcDateCompleted'];?></td>
                        <td><?php echo $row1['RcArticleCited'];?></td>
                        <td><?php echo $row1['RcResearchCitedBy'];?></td>
                        <td><?php echo $row1['RcAuthorsCitedBy'];?></td>
                        <td><?php echo $row1['RcJournalsCitedBy'];?></td>
                        <td><?php echo $row1['RcVolNo'];?></td>
                        <td><?php echo $row1['RcJournalIssue'];?></td>
                        <td><?php echo $row1['RcJournalPage'];?></td>
                        <td><?php echo $row1['RcJournalYear'];?></td>
                        <td><?php echo $row1['RcJournalPublisher'];?></td>
                        <td><?php echo $row1['RcJournalIndexing'];?></td>
                        <?php $file = $row1['RcTempName']; $download = 'uploads/'.$file;?> 
                        <td><a href="<?php echo $download;?>" download><?php echo $row1['RcFilename'];?></a></td>
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
                        <td><?php if($rowkey['RcKeyword']!=null){echo $rowkey['RcKeyword'];}?></td>
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
        
        $('#col7').val($('#college').val());
        $('#thisyear7').val($('#year').val());
        $('#indexing7').val($('#indexing').val());
       
    </script> 
<?php } ?>