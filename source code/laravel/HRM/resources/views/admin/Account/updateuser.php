<?php
session_start();
include('../../Data/db.php');

?>
<?php
if ($_SESSION['is_login_admin']) {

    if (isset($_POST['update'])) {
        $error = "";

        $userId = $_POST['userId'];
        $userName = $_POST['userName'];
        $role = $_POST['roleId'];
        $userUpdated = $_SESSION['userName'];


        $u_query = "SELECT * FROM users WHERE userId = '$userId'";
        $query = mysqli_query($conn, $u_query);
        $row = mysqli_num_rows($query);
        if ($row > 0) {
            while ($fetch = mysqli_fetch_array($query)) {
                if ($fetch['avt'] !== NULL) {
                    $u_avt = $_FILES['avt']['name'];
                    $avt_tmp = $_FILES['avt']['tmp_name'];
                    $id = $fetch['userId'];


                    move_uploaded_file($avt_tmp, "../../user/User Avatar/$u_avt.$id");
                    $u_avt_query = "UPDATE `users` SET avt='$u_avt.$id', userName = '$userName', userUpdated = '$userUpdated', roleId = '$role', day = now() WHERE userId = '$id'";
                    $result = mysqli_query($conn, $u_avt_query);
                    if ($result) {
                        echo "<script>alert('Your Profile Updated')</script>";
                        echo "<script>window.open('./account.php' , '_self')</script>";
                    }
                } else {
                    if ($fetch['userId'] == $userId) {

                        $name_query = "UPDATE `users` SET userName = '$userName',userUpdated = '$userUpdated', roleId = '$role',day = now() WHERE userId = '$userId'";
                        $run = mysqli_query($conn, $name_query);
                        if ($run) {
                            echo "<script>alert('Your Profile Updated')</script>";
                            echo "<script>window.open('./account.php?' , '_self')</script>";
                        }
                    } else {
                        $error = "Wrong User!";
                    }
                }
            }
        } else {
            $error = "Wrong User!";
        }
    }
} else {
    header("Location: ../index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Update Account</title>
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
        <h2>Update Account </h2><br>
        <?php 

        ?>
        <form class="form-horizontal" enctype="multipart/form-data" action="" method="POST">
            <div class="form-group">
                <label class="control-label col-sm-4" for="userId">User ID</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="userId" id="userId" placeholder="Enter User ID" value="<?php echo $_GET["u_id"] ?>" readonly>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-4" for="roleId">Permission</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="roleId" id="roleId" placeholder="change Permission" value="<?php echo $_GET["roles"] ?>" >
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-4" for="userName">User Name</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="userName" id="userName" placeholder="Enter user name"  value="<?php echo $_GET["u_name"] ?>"required>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-4" for="avt">Avatar Profile</label>
                <div class="col-sm-4">
                    <input type="file" class="form-control" name='avt' size='60'>
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
                    <button type="submit" class="btn btn-success" name="update">Update</button>
                </div>
            </div>
        </form>
    </div>
    <br>

</body>

</html>