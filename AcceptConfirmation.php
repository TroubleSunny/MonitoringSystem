<?php

include("connection.php");
include("functions.php");


if(isset($_POST['submission_id']))
{   
    $val = $_POST['submission_id'];
?>
<span style="Font-size:20px; mar">Accept Submission?</span>
<form action="insert/Accept.php" method="Post">
    <div class="wrapper" style=" width: 100%; display:flex;   align-items: center; justify-content: center;">
    
    <input name="change" type="hidden" value="<?php echo $val; ?>">
    
    <input style="margin:10px;" type="submit" name="submit" class="btn btn-success accept" value="Accept">
    <button style="margin:10px;" type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
</div>
</form>
<?php } ?>