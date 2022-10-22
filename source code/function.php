<?php
session_start();
include("Data/db.php");
if (isset($_POST['userId'])) {
  $error = "";

  $userId = stripslashes($_POST['userId']);
  $userId = mysqli_real_escape_string($conn, $userId);
  $password = stripslashes($_POST['password']);
  $password = mysqli_real_escape_string($conn, $password);

  $query = " SELECT * FROM `users` WHERE userId = '$userId' ";

  $result = mysqli_query($conn, $query);
  $rows = mysqli_num_rows($result);
  if ($rows == 1) {
    while ($fetch = mysqli_fetch_assoc($result)) {
      if (password_verify($password, $fetch['userPassword'])) {
        $_SESSION['userId'] = $fetch['userId'];
        $_SESSION['userName'] = $fetch['userName'];
        $_SESSION['roleId'] = $fetch['roleId'];
        if ($fetch['roleId'] === '1') {
          $_SESSION['is_login_employer'] = false;
          $_SESSION['is_login_manager'] = false;
          $_SESSION['is_login_admin'] = true;
          header('location: http://localhost:8888/admin/Account/account.php?u_id=' . $fetch['userId']);
        } else if ($fetch['roleId'] === '3') {
          $_SESSION['is_login_employer'] = true;
          $_SESSION['is_login_manager'] = false;
          $_SESSION['is_login_admin'] = false;
          header('location: http://localhost:8888/employer/Recruitment/recruitment.php?u_id=' . $fetch['userId']);
        } else {
          $_SESSION['is_login_manager'] = true;
          $_SESSION['is_login_admin'] = false;
          $_SESSION['is_login_employer'] = false;

          header('location: http://localhost:8888/user/Recruitment/recruitment.php?u_id=' . $fetch['userId']);
        }
      } else {
        $_SESSION = [];
        session_destroy();
        $error = "Your ID or Password are incorrect!";
      }
    }
  } else {
    $error = "Your ID or Password are incorrect!";
  }
}
