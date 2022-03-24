<?php
session_start();

  include("connection.php");
  include("functions.php");

  if($_SERVER['REQUEST_METHOD'] == "POST")
  {
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];

    if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
    {
      $query = "select * from admin where Admin_UserName = '$user_name' limit 1";
      $result = mysqli_query($con, $query);

      if($result)
      {
        if($result && mysqli_num_rows($result)>0)
        {
          $user_data = mysqli_fetch_assoc($result);
          
          if($user_data['Admin_password'] === $password)
          {
            $_SESSION['admin_id'] = $user_data['admin_id'];
            header("Location: mainadmin.php");
            die;
          }

        }
      }
      echo "Please Re-Enter Credentials";
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
      <h1>Admin Login</h1>
      <div class="textboxlogin">
        <i class="fas fa-user"></i>
        <input type="text" placeholder="Username" name="user_name">
      </div>

      <div class="textboxlogin">
        <i class="fas fa-lock"></i>
        <input type="password" placeholder="Password" name="password" required>
      </div>

      <input id = "button" type="submit" class="loginbtn" value="Login" >
    </form>
   
  </div>
</body>