<?php

include("connection.php");
include("functions.php");



if(isset($_POST['request']))
{
    $request = $_POST['request'];
    $col = $_POST['col'];

    if($col == 'All')
    {
        $query = "SELECT * FROM submission WHERE QuarterId = '$request' AND ValidationStatus='Accepted'";
        $result = mysqli_query($con,$query);
        $count = mysqli_num_rows($result);
        
    }
    else
    {
        $query = "SELECT * FROM submission WHERE QuarterId = '$request' AND ValidationStatus='Accepted' AND UserId IN (SELECT UserId FROM user WHERE College = '$col')";
        $result = mysqli_query($con,$query);
        $count = mysqli_num_rows($result);
        
    }
?>

<table class="table-main">
    <?php

    if($count){

    ?>
    <thead>
        
        <tr>
            <th scope="col">#</th>
            <th scope="col">Member Name</th>
            <th scope="col">Date Submitted</th>
            <th scope="col">Validation Status</th>
            <th style="text-align:center;"scope="col">View Submission</th>
    
        </tr>
        <?php
            }
            else
            {
                echo "no record";
            }
        ?>
    </thead>
    <tbody>
        <?php 
            
            $i = 1;
            while($row = mysqli_fetch_assoc($result)){
                
                ?>
            <tr>
                <th scope="row"><?php echo $i; ?></th>
                <td><?php
                    if($row['ValidationStatus']==null)
                    {
                        $valstatus = 'Pending';
                    }
                    else
                    {
                        $valstatus = $row['ValidationStatus'];
                    }
                    $take = $row['UserId'];
                    $name = "SELECT RealName FROM user WHERE UserId = $take";
                    $fetchname = mysqli_query($con,$name);
                    $membername = mysqli_fetch_assoc($fetchname);
                    echo $membername['RealName']?>
                </td>
                <td><?php echo $row['DateSubmitted']?></td>
                <td><?php echo $valstatus; ?></td>
                <form action="" method="post">
                    <th style="text-align:center; ">
                    <input type="button" name="View" value="view" id="<?php echo $row['SubmissionId'];?>" class="btn btn-info view_data">
                    </th>
                </form>
            </tr>
            <?php
                $i++;
            }
        ?>
    </tbody>
</table>
<?php
}
?>

<script>
    $(document).ready(function(){
        $('.view_data').click(function(){
            var submission_id = $(this).attr("id");

            $.ajax({
                url:"DisplayIndividualQAR.php",
                method:"post",
                data:{submission_id:submission_id},
                success:function(data){
                    $('#submission_detail').html(data);
                    $('#dataModal').modal("show");
                }
            });
        });
    });
</script>