<?php
include("connection.php");
if(isset($_POST["id"]))
{
 $query = "DELETE FROM faculty WHERE Faculty_id = '".$_POST["id"]."'";
 if(mysqli_query($con, $query))
 {
  echo 'Data Deleted';
 }
}
?>