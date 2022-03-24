<?php

include("connection.php");

$columns = array('FacultyNumber');

$query = "SELECT * FROM faculty ";

if(isset($_POST["search"]["value"]))
{
 $query .= '
 WHERE FacultyNumber LIKE "%'.$_POST["search"]["value"].'%" 
 ';
}

if(isset($_POST["order"]))
{
 $query .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' 
 ';
}
else
{
 $query .= 'ORDER BY Faculty_id ASC ';
}

$query1 = '';

if($_POST["length"] != -1)
{
 $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$number_filter_row = mysqli_num_rows(mysqli_query($con, $query));

$result = mysqli_query($con, $query . $query1);

$data = array();

while($row = mysqli_fetch_array($result))
{
  $sub_array = array();
  $sub_array[] = '<div class="update" data-id="'.$row["Faculty_id"].'" data-column="Faculty_id">' . $row["Faculty_id"] . '</div>';
  $sub_array[] = '<div contenteditable class="update" data-id="'.$row["Faculty_id"].'" data-column="FacultyNumber">' . $row["FacultyNumber"] . '</div>';
  $sub_array[] = '<div contenteditable class="update" data-id="'.$row["Faculty_id"].'" data-column="UserLevel">' . $row["UserLevel"] . '</div>';
  $sub_array[] = '<div contenteditable class="update" data-id="'.$row["Faculty_id"].'" data-column="College">' . $row["College"] . '</div>';
   $sub_array[] = '<div class="update" data-id="'.$row["Faculty_id"].'" data-column="Status">' . $row["Status"] . '</div>';
  
  
 $sub_array[] = '<button type="button" name="delete" class="btn btn-danger btn-xs delete" id="'.$row["Faculty_id"].'">Delete</button>';
 $data[] = $sub_array;
}

function get_all_data($con)
{
 $query = "SELECT * FROM faculty";
 $result = mysqli_query($con, $query);
 return mysqli_num_rows($result);
}

$output = array(
 "draw"    => intval($_POST["draw"]),
 "recordsTotal"  =>  get_all_data($con),
 "recordsFiltered" => $number_filter_row,
 "data"    => $data
);

echo json_encode($output);

?>