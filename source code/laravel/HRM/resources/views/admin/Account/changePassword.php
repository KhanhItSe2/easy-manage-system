<?php
session_start();
include("../../Data/db.php");
?>
<?php

if (isset($_SESSION['is_login_admin'])) {
    if (isset($_POST['save'])) {
        $error = "";

        $userId = mysqli_real_escape_string($conn, $_POST['userId']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']);

        $pass = password_hash($password, PASSWORD_DEFAULT);
        $cpass = password_hash($cpassword, PASSWORD_DEFAULT);

        if (strlen($password) < 6) {
            $error = "Mật khẩu phải có ít nhất 6 ký tự";
        } else if ($password !== $cpassword) {
            $error = "Mật khẩu không trùng khớp";
        } else {
            $sql = "UPDATE `users` SET userPassword = '$pass',
                      cpassword = '$cpass'
                      WHERE userId = '$userId'";

            $result = mysqli_query($conn, $sql);
        
            if ($result) {
                echo "<script>alert('Your Profile Updated')</script>";
                echo "<script>window.open('./account.php?' , '_self')</script>";
            }
        }
    }
} else {
    header("Location: ../index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Thay đổi mật khẩu</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        <?php
        include 'style.css';
        ?>
    </style>
</head>

<body>


    <div class="container text-center">
        <hr>
        <h2>Change Password</h2><br>
        <form class="form-horizontal" action="" method="POST">
            <div class="form-group">
                <label class="control-label col-sm-4" for="userID">User ID</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="userId" id="userId" placeholder="Your User ID" value="<?php echo $_GET['u_id'] ?>" readonly>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-4" for="userName">User Name</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="userName" id="userName" value="<?php echo $_GET['u_name'] ?>" readonly>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-4" for="password">New Password</label>
                <div class="col-sm-4">
                    <input type="password" class="form-control" name="password" id="password" placeholder="New Password" required>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-4" for="cpassword">Import New Password</label>
                <div class="col-sm-4">
                    <input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Import New Password" required>
                </div>
            </div>
            <?php
            if (isset($error)) {
                echo "<div class='alert alert-danger alert-dismissible'>
                        <button type='button' class='close' data-dismiss='alert'>&times;</button>
                        $error
                      </div>";
            }
            ?>
            <div class="form-group">
                <div class="container text-center">
                    <button type="submit" class="btn btn-info" name="save">Save</button>
                </div>
            </div>
        </form>
    </div>
    </div>
    <br>

</body>

</html>