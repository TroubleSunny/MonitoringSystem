<?php
session_start();
include("connection.php");
include("functions.php");


$user_data = check_login($con);
$usercollege = $user_data['College'];
$querycol = "SELECT CollegeName FROM college WHERE College = '$usercollege'";
$resultcol = mysqli_query($con,$querycol);
$collegename = mysqli_fetch_assoc($resultcol);
$usercol = $collegename['CollegeName'];
$deanname = $user_data['UserName'];

if(isset($_POST['request']))
{
    $request = $_POST['request'];
   


    $query = "SELECT * FROM submission WHERE QuarterId = '$request' AND UserId IN(SELECT UserId FROM user WHERE College='$usercollege')";
    $result = mysqli_query($con,$query);
    $count = mysqli_num_rows($result);
    $query2 = "SELECT QuarterProgress FROM quarter WHERE QuarterId = '$request'";
    $result2 = mysqli_query($con,$query2);
    $fetchprogress = mysqli_fetch_assoc($result2);
    
        
    
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
            <th style="text-align:center;"scope="col">Send Feedback on Submission</th>
    
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
                <td><?php echo $valstatus;?></td>
                <form action="" method="post">
                    <?php 
                        if($fetchprogress['QuarterProgress']=='Finished')
                        {
                            ?>
                            <th style="text-align:center; ">
                            <input type="button" name="View" value="view" id="<?php echo $row['SubmissionId'];?>" class="btn btn-info view_data">
                        <?php
                        }
                        else
                        {
                            ?>
                             <th style="text-align:center; ">
                                <input type="button" name="Accept" id="<?php echo $row['SubmissionId'];?>" class="btn btn-success accept" value="Accept">
                                <input type="button" name="remove" id="<?php echo $row['SubmissionId'];?>" class="btn btn-warning send_feedback" value="Send Feedback">
                                <input type="button" name="View" value="view" id="<?php echo $row['SubmissionId'];?>" class="btn btn-info view_data">
                            </th>
                        <?php } ?> 
                   
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

<script>
    $(document).ready(function(){
        $('.accept').click(function(){
            var submission_id = $(this).attr("id");

            $.ajax({
                url:"AcceptConfirmation.php",
                method:"post",
                data:{submission_id:submission_id},
                success:function(data){
                    $('#accept_detail').html(data);
                    $('#dataModalaccept').modal("show");
                }
            });
        });
    });
</script>

<script>
    $(document).ready(function(){
        $('.send_feedback').click(function(){
            var submission_id = $(this).attr("id");

            $.ajax({
                url:"SubmitFeedback.php",
                method:"post",
                data:{submission_id:submission_id},
                success:function(data){
                    $('#feedback_detail').html(data);
                    $('#dataModalfeedback').modal("show");
                }
            });
        });
    });
</script>