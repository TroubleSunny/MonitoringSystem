<?php

include("connection.php");
include("functions.php");



if(isset($_POST['submission_id']))
{   
    
    $val = $_POST['submission_id'];
    $takename = "SELECT RealName FROM user WHERE UserId=(SELECT UserId FROM submission WHERE SubmissionId = '$val')";
    $take = mysqli_query($con,$takename);
    $getname = mysqli_fetch_assoc($take);
    $name = $getname['RealName'];

    $fetchfeed = "SELECT FeedbackDetails,FeedbackId FROM feedback WHERE SubmissionId = '$val'";
    $fetcher = mysqli_query($con,$fetchfeed);
    $fetch = mysqli_fetch_assoc($fetcher);
    if(mysqli_num_rows($fetcher)>0)
    {
        $feedback = $fetch['FeedbackDetails'];
        $updatefeed = $fetch['FeedbackId'];
    }
    else
    {
        $updatefeed = 0;
        $feedback = null;
    }


    $quarter = $con->query("SELECT QuarterPart FROM quarter WHERE QuarterProgress = 'Ongoing'");
    $quarteryear = $con->query("SELECT SchoolYear FROM schoolyear WHERE YearId = (SELECT YearId FROM quarter WHERE QuarterProgress = 'Ongoing')");
    while($qu = $quarter->fetch_assoc())
    {
        $q = $qu['QuarterPart'];
    }
    while($quy = $quarteryear->fetch_assoc())
    {
        $qy = $quy['SchoolYear'];
    }

?>
    <div class="tableContainer">
        <span><?php echo "Member Name: $name"; ?><br> </span>
        <span><?php echo "Submission Year: $qy"; ?> <br> </span>
        <span><?php echo "Submission Quarter: $q"; ?> </span>
        <form action="Insert/insertFeedback.php" method="post">
            <input name="change" type="hidden" value="<?php echo $val; ?>">
            <input name="feed" type="hidden" value="<?php echo $updatefeed; ?>">
            <textarea style="padding:10px" name="feedback" cols="75" rows="20" required><?php echo $feedback; ?></textarea>
            <input style="margin-top:20px; " type="submit" name="submit" class="btn btn-success accept" value="Send Feedback">
        </form>  
    </div>


<?php

}


?>