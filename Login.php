<?php
session_start();

  include("connection.php");
  include("functions.php");
  $errors = array();
  if($_SERVER['REQUEST_METHOD'] == "POST")
  {
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];

    if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
    {
      $query = "select * from user where UserName = '$user_name' limit 1";
      $result = mysqli_query($con, $query);

      if($result)
      {
        if($result && mysqli_num_rows($result)>0)
        {
          $user_data = mysqli_fetch_assoc($result);
          
          if($user_data['UserPassword'] === $password && $user_data['UserLevel']=='Faculty Member')
          {
            $_SESSION['UserId'] = $user_data['UserId'];
            header("Location: FacultyAccount.php");
            die;
          }
          if($user_data['UserPassword'] === $password && $user_data['UserLevel']=='Dean')
          {
            $_SESSION['UserId'] = $user_data['UserId'];
            header("Location: FacultyAccount.php");
            die;
          }
          if($user_data['UserPassword'] === $password && $user_data['UserLevel']=='Researcher')
          {
            $_SESSION['UserId'] = $user_data['UserId'];
            header("Location: FacultyAccount.php");
            die;
          }
          else
          {
            $errors['password']='Incorrect Password';
          }

        }
        else
        {
          $errors['user_name']='User Name/Email Does not exist';
        }
      }
     
    }
    else
    {
      echo "Enter Valid Credentials";
    }
  }
?>
<head>
  <meta charset="utf-8">
  <title></title>
  <link rel="stylesheet" href="style.css">
</head>
<body class="login">
  <div class="login-box">
    <form method="post">
      <h1>Login</h1>
      <div class="textboxlogin">
        <i class="fas fa-user"></i>
        <input type="text" placeholder="Username" name="user_name">
      </div>

      <div class="textboxlogin">
        <i class="fas fa-lock"></i>
        <input type="password" placeholder="Password" name="password" required>
      </div>
      <?php
          if(count($errors) > 0){
              ?>
              <div class="alert alert-danger text-center">
                  <?php 
                      foreach($errors as $error){
                          echo $error;
                      }
                  ?>
              </div>
              <?php
          }
      ?>
      <input id = "button" type="submit" class="loginbtn" value="Login" >
    </form>
    
    <a href="signup.php" style="color:#800000; padding:20px; Font-weight:bold;" class="ca">Sign Up</a>
    <a href="forgot-password.php" style="color:#800000; padding:17px; Font-weight:bold;" class="ca">Forgot Password?</a>
  </div>
</body>