<?php
include("Data/db.php");
include("function.php");

?>



<!DOCTYPE html>

<html lang="en">

<head>
  <title>Login - EasyManage</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <style>
    <?php
    include './assets/css/style.css';
    ?>
  </style>
</head>

<body>
  <div class="sidenav">
    <div class="login-main-text">
      <img class="logo" src="./assets/img/logo.png">
      <div class="company-brand">EasyManage<br></div>
      <div class="company-slogan">Human Resources Management</div>
      <br><br><br>
      <h5>Login is required to access.</h5>
    </div>
  </div>
  <div class="main">
    <div class="col-md-10 col-sm-12">
      <div class="login-form">
        <form action="" method="post">
          <div class="container">
            <label for="uname"><b>User ID</b></label>
            <input type="text" placeholder="Enter Staff ID" name="userId" required>

            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="password" required>

            <label>
              <input type="checkbox" checked="checked" name="remember"> Remember me
            </label>
            <div>
              <label>
                <a href="http://localhost:8888/candidate/profile.php">You want to apply ? Click here</a>
              </label>
            </div>
            <?php
            if (isset($error)) {
              echo "<div class='alert alert-danger alert-dismissible'>
                        <button type='button' class='close' data-dismiss='alert'>&times;</button>
                        $error
                      </div>";
            }
            ?>
            <br>
            <button type="submit" class="btn btn-dark">Login</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>

</html>