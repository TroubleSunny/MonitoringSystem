<?php

include("connection.php");
include("functions.php");



if(isset($_POST['thislevel']))
{   
    $request = $_POST['thislevel'];
    $year = $_POST['thisyear'];
    $col = $_POST['col'];
    

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
    <div class="tableContainer">
    <input id="college" type="hidden" value="<?php echo $col; ?>">
    <input id="year" type="hidden" value="<?php echo $year; ?>">
    <input id="level" type="hidden" value="<?php echo $request; ?>">
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
        <h1 style="font-weight:normal; border:none; height:15px;">&nbsp</h1> 
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
                 header("Content-Disposition:attachment; filename=$col $displayyear Level:$request Research Titles.xls");
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
                            <td style="text-align:left;"><?php echo $row1['RoStatus'];?></td>
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
                ?>
            </tbody>
        </table>
        <?php

        if($count3){ ?>
        <table border="1" style="align-items:center;" class="table-main">
        <h1 style="font-weight:normal; border:none; height:15px;">&nbsp</h1> 
        <h4>A.2. Research Publication</h4>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>College/Section</th>
                    <th>Title of Research</th>
                    <th>Research Classification</th>
                    <th>Category</th>
                    <th>University Research Agenda</th>
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
                    <th>Journal Name</th>
                    <th>Page Number</th>
                    <th>Volume No.</th>
                    <th>Issue No.</th>
                    <th>Indexing Platform</th>
                    <th>Date Published</th>
                    <th>Publisher</th>
                    <th>Editor</th>
                    <th>ISSN/ISBN</th>
                    <th>Level of Publication</th>
                    <th>Supporting Documents Submitted</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                $n = null;
                while($row1 = mysqli_fetch_assoc($result3))
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
                    $n = $row1['RpId'];
                    $rname = "SELECT RpName FROM rp_name WHERE RpId = '$n'";
                    $resname = mysqli_query($con,$rname);
                    $countres = mysqli_num_rows($resname);
                    $researcher = mysqli_fetch_all($resname);

                    $rword = "SELECT * FROM rp_keywords WHERE RpId = '$n'";
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
                            <td><?php echo $row1['RpTitle'];?></td>
                            <td><?php echo $row1['RpClass'];?></td>
                            <td><?php echo $row1['RpCategory'];?></td>
                            <td><?php echo $row1['RpAgenda'];?></td>
                            
                            <td><?php echo $researcher[$rescount][0];?></td>
                            
                            
                            
                            <td><?php echo $row1['RpInvolve'];?></td>
                            <td><?php echo $row1['RpType'];?></td>
                            <td><?php echo $rowkey['RpKeyword'];?></td>
                            <td><?php echo $row1['RpFundType'];?></td>
                            <td style="text-align:left;"><?php echo $row1['RpFundAmount'];?></td>
                            <td><?php echo $row1['RpFundAgency'];?></td>
                            <td style="text-align:left;"><?php echo $row1['RpDateStart'];?></td>
                            <td style="text-align:left;"><?php echo $row1['RpDateTarget'];?></td>
                            <td style="text-align:left;"><?php echo $row1['RpDateCompleted'];?></td>
                            <td style="text-align:left;"><?php echo $row1['RpJournalName'];?></td>
                            <td style="text-align:left;"><?php echo $row1['RpPageNumber'];?></td>
                            <td style="text-align:left;"><?php echo $row1['RpVolumeNo'];?></td>
                            <td style="text-align:left;"><?php echo $row1['RpIssueNo'];?></td>
                            <td><?php echo $row1['RpIndexingPlatform'];?></td>
                            <td style="text-align:left;"><?php echo $row1['RpDatePublished'];?></td>
                            <td><?php echo $row1['RpPublisher'];?></td>
                            <td><?php echo $row1['RpEditor'];?></td>
                            <td style="text-align:left;"><?php echo $row1['RpISSN'];?></td>
                            <td style="text-align:left;"><?php echo $row1['RpLevel'];?></td>
                            <?php $file = $row1['RpTempName']; $download = 'uploads/'.$file;?> 
                            <td><?php echo $row1['RpFilename'];?></td>
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
                            <td><?php if($rowkey['RpKeyword']!=null){echo $rowkey['RpKeyword'];}?></td>
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
                ?>
            </tbody>
        </table>
        <?php

        if($count2){ ?>
        <table border="1" style="align-items:center;" class="table-main">
        <h1 style="font-weight:normal; border:none; height:15px;">&nbsp</h1> 
        <h4>A.3. Research Presentation</h4>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>College/Section</th>
                    <th>Title of Research</th>
                    <th>Research Classification</th>
                    <th>Category</th>
                    <th>University Research Agenda</th>
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
                    <th>Conference Title</th>
                    <th>Organizer</th>
                    <th>Venue</th>
                    <th>Date of Presentation</th>
                    <th>Level</th>
                    <th>Supporting Documents Submitted</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                $n = null;
                while($row1 = mysqli_fetch_assoc($result2))
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
                    $n = $row1['RpresId'];
                    $rname = "SELECT RpresName FROM rpres_name WHERE RpresId = '$n'";
                    $resname = mysqli_query($con,$rname);
                    $countres = mysqli_num_rows($resname);
                    $researcher = mysqli_fetch_all($resname);

                    $rword = "SELECT * FROM rpres_keywords WHERE RpresId = '$n'";
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
                            <td><?php echo $row1['RpresTitle'];?></td>
                            <td><?php echo $row1['RpresClass'];?></td>
                            <td><?php echo $row1['RpresCategory'];?></td>
                            <td><?php echo $row1['RpresAgenda'];?></td>
                            <td><?php echo $researcher[$rescount][0];?></td>
                            
                            
                            
                            <td><?php echo $row1['RpresInvolve'];?></td>
                            <td><?php echo $row1['RpresType'];?></td>
                            <td><?php echo $rowkey['RpresKeyword'];?></td>
                            <td><?php echo $row1['RpresFundType'];?></td>
                            <td style="text-align:left;"><?php echo $row1['RpresFundAmount'];?></td>
                            <td><?php echo $row1['RpresFundAgency'];?></td>
                            <td style="text-align:left;"><?php echo $row1['RpresDateStart'];?></td>
                            <td style="text-align:left;"><?php echo $row1['RpresDateTarget'];?></td>
                            
                            <td style="text-align:left;"><?php echo $row1['RpresDateCompleted'];?></td>
                            <td><?php echo $row1['RpresConTitle'];?></td>
                            <td><?php echo $row1['RpresOrganizer'];?></td>
                            <td style="text-align:left;"><?php echo $row1['RpresVenue'];?></td>
                            <td style="text-align:left;"><?php echo $row1['RpresDatePresent'];?></td>
                            <td><?php echo $row1['RpresLevel'];?></td>
                            <?php $file = $row1['RpresTempName']; $download = 'uploads/'.$file;?> 
                            <td><?php echo $row1['RpresFilename'];?></td>
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
                            <td><?php if($rowkey['RpresKeyword']!=null){echo $rowkey['RpresKeyword'];}?></td>
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
                ?>
            </tbody>
        </table>

        <?php

        if($count4){ ?>
        <table border="1" style="align-items:center;" class="table-main">
        <h1 style="font-weight:normal; border:none; height:15px;">&nbsp</h1> 
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
                            <td style="text-align:left;"><?php echo $row1['RcFundAmount'];?></td>
                            <td><?php echo $row1['RcFundAgency'];?></td>
                            <td style="text-align:left;"><?php echo $row1['RcDateStart'];?></td>
                            <td style="text-align:left;"><?php echo $row1['RcDateTarget'];?></td>
                            
                            <td style="text-align:left;"><?php echo $row1['RcDateCompleted'];?></td>
                            <td style="text-align:left;"><?php echo $row1['RcArticleCited'];?></td>
                            <td><?php echo $row1['RcResearchCitedBy'];?></td>
                            <td><?php echo $row1['RcAuthorsCitedBy'];?></td>
                            <td><?php echo $row1['RcJournalsCitedBy'];?></td>
                            <td style="text-align:left;"><?php echo $row1['RcVolNo'];?></td>
                            <td style="text-align:left;"><?php echo $row1['RcJournalIssue'];?></td>
                            <td style="text-align:left;"><?php echo $row1['RcJournalPage'];?></td>
                            <td style="text-align:left;"><?php echo $row1['RcJournalYear'];?></td>
                            <td style="text-align:left;"><?php echo $row1['RcJournalPublisher'];?></td>
                            <td style="text-align:left;"><?php echo $row1['RcJournalIndexing'];?></td>
                            <?php $file = $row1['RcTempName']; $download = 'uploads/'.$file;?> 
                            <td><?php echo $row1['RcFilename'];?></td>
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
                ?>
            </tbody>
        </table>
        
        <?php

        if($count5){ ?>
        <table border="1" style="align-items:center;" class="table-main">
        <h1 style="font-weight:normal; border:none; height:15px;">&nbsp</h1> 
        <h4>A.5. Research Utilization</h4>
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
                    <th>Agency/Organization that utilized the research output</th>
                    <th>Brief Description of Research Utilization</th>
                    <th>Level of Utilization</th>
                    <th>Supporting Documents Submitted</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                $n = null;
                while($row1 = mysqli_fetch_assoc($result5))
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
                    $n = $row1['UtiId'];
                    $rname = "SELECT RuName FROM ru_name WHERE UtiId = '$n'";
                    $resname = mysqli_query($con,$rname);
                    $countres = mysqli_num_rows($resname);
                    $researcher = mysqli_fetch_all($resname);

                    $rword = "SELECT * FROM ru_keywords WHERE UtiId = '$n'";
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
                            <td><?php echo $row1['RuClass'];?></td>
                            <td><?php echo $row1['RuCategory'];?></td>
                            <td><?php echo $row1['RuAgenda'];?></td>
                            <td><?php echo $row1['RuTitle'];?></td>
                            <td><?php echo $researcher[$rescount][0];?></td>
                            
                            
                            
                            <td><?php echo $row1['RuInvolve'];?></td>
                            <td><?php echo $row1['RuType'];?></td>
                            <td><?php echo $rowkey['RuKeyword'];?></td>
                            <td><?php echo $row1['RuFundType'];?></td>
                            <td style="text-align:left;"><?php echo $row1['RuFundAmount'];?></td>
                            <td><?php echo $row1['RuFundAgency'];?></td>
                            <td style="text-align:left;"><?php echo $row1['RuDateStart'];?></td>
                            <td style="text-align:left;"><?php echo $row1['RuDateTarget'];?></td>
                            
                            <td style="text-align:left;"><?php echo $row1['RuDateCompleted'];?></td>
                            <td><?php echo $row1['RuAgency'];?></td>
                            <td><?php echo $row1['RuDesc'];?></td>
                            <td><?php echo $row1['RuLevel'];?></td>
                            <?php $file = $row1['RuTempName']; $download = 'uploads/'.$file;?> 
                            <td><?php echo $row1['RuFilename'];?></td>
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
                            <td><?php if($rowkey['RuKeyword']!=null){echo $rowkey['RuKeyword'];}?></td>
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
                ?>
            </tbody>
        </table>   
        <?php

        if($count6){ ?>
        <table border="1" style="align-items:center;" class="table-main">
        <h1 style="font-weight:normal; border:none; height:15px;">&nbsp</h1> 
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
                            <td style="text-align:left;"><?php echo $row1['CoCopyrightAgency'];?></td>
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
                if($count==0 && $count2==0 && $count3==0 && $count4==0 && $count5==0 && $count6==0)
                {
                    echo "No record Found";
                }               
                ?>
            </tbody>
        </table>     
    </div>          

<?php } ?>

