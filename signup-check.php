<?php 
session_start(); 
include "connection.php";

if (isset($_POST['uname']) && isset($_POST['password'])
    && isset($_POST['name']) && isset($_POST['re_password']) && isset($_POST['FacultyNumber']) && isset($_POST['email'])) {

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	$uname = validate($_POST['uname']);
	$pass = validate($_POST['password']);

	$re_pass = validate($_POST['re_password']);
	$name = validate($_POST['name']);
	$email = $_POST['email'];
	$facultynumber = $_POST['FacultyNumber'];

	$user_data = 'uname='. $uname. '&name='. $name. '&email='. $email. '&FacultyNumber='. $facultynumber;


	if (empty($uname)) {
		header("Location: signup.php?error=User Name is required&$user_data");
	    exit();
	}else if(empty($pass)){
        header("Location: signup.php?error=Password is required&$user_data");
	    exit();
	}
	else if(empty($re_pass)){
        header("Location: signup.php?error=Confirm Password is required&$user_data");
	    exit();
	}

	else if(empty($name)){
        header("Location: signup.php?error=Name is required&$user_data");
	    exit();
	}

	else if(empty($email)){
        header("Location: signup.php?error=Email is required&$user_data");
	    exit();
	}

	else if(empty($facultynumber)){
        header("Location: signup.php?error=Faculty Number is required&$user_data");
	    exit();
	}

	else if($pass !== $re_pass){
        header("Location: signup.php?error=The confirmation password  does not match&$user_data");
	    exit();
	}

	else{

		// hashing the password
        $pass = md5($pass);

	    $sql = "SELECT * FROM user WHERE UserName='$uname' ";
		$result = mysqli_query($con, $sql);

		$sql5 = "SELECT * FROM user WHERE UserEmail='$email' ";
		$result5 = mysqli_query($con, $sql5);

		$sql6 = "SELECT * FROM user WHERE RealName='$name' ";
		$result6 = mysqli_query($con, $sql6);

		$sql2 = "SELECT * FROM faculty WHERE FacultyNumber='$facultynumber' ";
		$result2 = mysqli_query($con, $sql2);
		$fetch = mysqli_fetch_assoc($result2);

		if (mysqli_num_rows($result2) <= 0) {
			header("Location: signup.php?error=The Faculty Number does not exist &$user_data");
	        exit();
		}
		if (mysqli_num_rows($result5) > 0) {
			header("Location: signup.php?error=The Email Address is already registered &$user_data");
	        exit();
		}
		if (mysqli_num_rows($result6) > 0) {
			header("Location: signup.php?error=The Name is already registered &$user_data");
	        exit();
		}
		if ($fetch['Status']=='Active') {
			header("Location: signup.php?error=The Faculty Number already has an account&$user_data");
	        exit();
		}
		
		if (mysqli_num_rows($result) > 0) {
			header("Location: signup.php?error=The username is taken try another&$user_data");
	        exit();
		}else {
			$UserLevel = $fetch['UserLevel'];
			$College = $fetch['College'];
			$Faculty_id = $fetch['Faculty_id'];
           $sql2 = "INSERT INTO user(UserName, UserPassword,UserLevel,RealName,College,Faculty_id,UserEmail) VALUES('$uname', '$pass','$UserLevel','$name','$College','$Faculty_id','$email')";
           $result2 = mysqli_query($con, $sql2);

		   $sql3 = "UPDATE faculty SET Status = 'Active' WHERE Faculty_id = '$Faculty_id'";
		   $result3 = mysqli_query($con, $sql3);
           if ($result2) {
           	 header("Location: signup.php?success=Your account has been created successfully");
	         exit();
           }else {
	           	header("Location: signup.php?error=unknown error occurred&$user_data");
		        exit();
           }
		}
	}
	
}else{
	header("Location: signup.php");
	exit();
}
