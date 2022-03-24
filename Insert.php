<?php
include("connection.php");
if(isset($_POST["FacultyNumber"]))
{

 $facultynumber = mysqli_real_escape_string($con, $_POST["FacultyNumber"]);
 $userlevel = mysqli_real_escape_string($con, $_POST["UserLevel"]);
 $college = mysqli_real_escape_string($con, $_POST["College"]);
 
 if (strcspn($college, '0123456789') != strlen($college))
  echo "Invalid College Name";
 else
 {

 


 $query = "INSERT INTO faculty (FacultyNumber, UserLevel, College, Status) VALUES('$facultynumber', '$userlevel', '$college','In-Active')";
 if(mysqli_query($con, $query))
 {
  echo 'Data Inserted';
 }
}
}
?>