<?php

include("connection.php");

$query = ("SELECT RoId FROM researchongoing WHERE SubmissionId IN (SELECT SubmissionId FROM submission WHERE ValidationStatus = 'Accepted')");
$result = mysqli_query($con,$query);
$count = mysqli_num_rows($result);


$i = 0;
$char_data = '';
$yearquery = ("SELECT SchoolYear FROM schoolyear ORDER BY SchoolYear ASC");
$yearresult = mysqli_query($con,$yearquery);
while($row = mysqli_fetch_assoc($yearresult))
{
    $school = $row['SchoolYear'];
    $yearAR[$i] = $school;
    
    $rquery = ("SELECT RoId FROM researchongoing WHERE SubmissionId IN (SELECT SubmissionId FROM submission WHERE ValidationStatus = 'Accepted' AND QuarterId IN (SELECT QuarterId FROM quarter WHERE YearId IN (SELECT YearId FROM schoolyear WHERE SchoolYear = '$school')))");
    $Rresult = mysqli_query($con,$rquery);
    $rcount = mysqli_num_rows($Rresult);
    $countAR[$i] = $rcount;
    

    $char_data .= "{Titles:'".$countAR[$i]."',year:".$row['SchoolYear']."},";
    
}


$i = $i-1;
while($i>=0)
{
    echo $yearAR[$i];
    echo "-->";
    
    echo $countAR[$i];
    echo "                        ";
    $i--;
}

?>
<!DOCTYPE html>
<html>
    <head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/html2canvas@1.0.0-rc.1/dist/html2canvas.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css" rel="stylesheet"/>
    </head>
    
        <div class="container" style="width:900px;">
            <h2 align="center">PUP Completed Research Titles Data</h2>
            
            <div id = "chart"></div>
        </div>
   

</html>

<script>
Morris.Bar({
    element : 'chart',
    data: [<?php echo $char_data; ?>],
    xkey:'year',
    ykeys:['Titles'],
    labels:['Completed Research'],
    hideHover:'auto'
});
</script>