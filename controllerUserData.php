<?php 
session_start();
require "connection.php";
$email = "";
$facultynumber = "";
$name = "";
$errors = array();




    //if user click continue button in forgot password form
    if(isset($_POST['check-email'])){
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $facultynumber = mysqli_real_escape_string($con, $_POST['facultynumber']);
        $check_email = "SELECT * FROM user WHERE UserEmail='$email' OR UserName='$email'";
        $run_sql = mysqli_query($con, $check_email);
        $sql2 = "SELECT * FROM faculty WHERE FacultyNumber='$facultynumber' ";
		$result2 = mysqli_query($con, $sql2);
		$fetch = mysqli_fetch_assoc($result2);
        
        
        if (mysqli_num_rows($result2) <= 0) {
            $errors['facultynumber'] = "Faculty Does not exist";
        }
        else{
            $facultynum = $fetch['FacultyNumber'];
            $stat = $fetch['Status'];
            $id = $fetch['Faculty_id'];
            $checkthis = "SELECT * FROM user WHERE Faculty_id='$id' AND UserEmail='$email'";
            $run_sql2 = mysqli_query($con, $checkthis);

            if(mysqli_num_rows($run_sql2) > 0){
                if($fetch['FacultyNumber']==$facultynumber && $fetch['Status']=='Active')
                {
                    if(mysqli_num_rows($run_sql) > 0){
                        $row = mysqli_fetch_assoc($run_sql);
                        $row2 = $row['UserEmail'];
                        $code = rand(999999, 111111);
                        $insert_code = "UPDATE user SET code = $code WHERE UserEmail = '$email' OR UserName='$email'";
                        $run_query =  mysqli_query($con, $insert_code);
                        if($run_query){
                            $subject = "Password Reset Code";
                            $message = "Your password reset code is $code";
                            $sender = "From: hikawasayo24@gmail.com";
                            if(mail($row2, $subject, $message, $sender)){
                                $info = "We've sent a password reset code to your email - $email";
                                $_SESSION['info'] = $info;
                                $_SESSION['email'] = $email;
                                header('location: reset-code.php');
                                exit();
                            }else{
                                $errors['otp-error'] = "Failed while sending code!";
                            }
                        }else{
                            $errors['db-error'] = "Something went wrong!";
                        }
                    }else{
                        $errors['email'] = "This email address does not exist!";
                    }
                }
            }
            
            else
            {
                $errors['facultynumber'] = "Email/User Name does not match the credentials of the Faculty Number";
            }
        }
    }

    //if user click check reset otp button
    if(isset($_POST['check-reset-otp'])){
        $_SESSION['info'] = "";
        $otp_code = mysqli_real_escape_string($con, $_POST['otp']);
        $check_code = "SELECT * FROM user WHERE code = '$otp_code'";
        $code_res = mysqli_query($con, $check_code);
        if(mysqli_num_rows($code_res) > 0){
            $fetch_data = mysqli_fetch_assoc($code_res);
            $email = $fetch_data['UserEmail'];
            $_SESSION['UserEmail'] = $email;
            $info = "Please create a new password that you don't use on any other site.";
            $_SESSION['info'] = $info;
            header('location: new-password.php');
            exit();
        }else{
            $errors['otp-error'] = "You've entered incorrect code!";
        }
    }

    
    if(isset($_POST['change-password'])){
        $_SESSION['info'] = "";
        $password = mysqli_real_escape_string($con, $_POST['password']);
        $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
        if($password !== $cpassword){
            $errors['password'] = "Confirm password not matched!";
        }else{
            $code = 0;
            $email = $_SESSION['email'];
            
            $update_pass = "UPDATE user SET code = $code, UserPassword = '$cpassword' WHERE UserEmail = '$email'";
            $run_query = mysqli_query($con, $update_pass);
            if($run_query){
                $info = "Your password changed. Now you can login with your new password.";
                $_SESSION['info'] = $info;
                header('Location: password-changed.php');
            }else{
                $errors['db-error'] = "Failed to change your password!";
            }
        }
    }
    
  
    if(isset($_POST['login-now'])){
        header('Location: Login.php');
    }
?>