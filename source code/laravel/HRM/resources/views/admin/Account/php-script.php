<?php
include("../../Data/db.php");
if (isset($_POST['regist'])) {
    $error = '';
    $userName = mysqli_real_escape_string($conn, $_POST['userName']);
    $userId = mysqli_real_escape_string($conn, $_POST['userId']);
    $password = mysqli_real_escape_string($conn, $_POST['userPassword']);
    $cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']);
    $roleId = mysqli_real_escape_string($conn, $_POST['roleId']);
    $userUpdated = $_SESSION['userName'];

    $pass = password_hash($password, PASSWORD_DEFAULT);
    $cpass = password_hash($cpassword, PASSWORD_DEFAULT);


    $userIdquery = "SELECT * FROM `users` WHERE userId  ='$userId' ";
    $query = mysqli_query($conn, $userIdquery);

    $userIdCheck = mysqli_num_rows($query);

    if ($userIdCheck > 0) {
?>
        <script type="text/javascript">
            alert("User Id has been registered, please enter another id");
            window.location = "".$_SERVER['HTTP_REFERER'];
        </script><?php
                } else {
                    if (strlen($password) < 6) { ?>
            <script type="text/javascript">
                alert("Passwords must be at least 6 characters");
                window.location = "".$_SERVER['HTTP_REFERER'];
            </script><?php
                    } else if ($password === $cpassword) {
                        $insert = "INSERT INTO `users` (userId,userName,userPassword,cpassword,roleId,avt,userUpdated) VALUES ('$userId','$userName','$pass','$cpass','$roleId','','$userUpdated')";
                        $iquery = mysqli_query($conn, $insert);
                        if ($iquery) {
                        ?>
                <script type="text/javascript">
                    alert("Register Successfully");
                    window.location = "".$_SERVER['HTTP_REFERER'];
                </script>
            <?php
                        } else {
            ?>
                <script type="text/javascript">
                    alert("User Id has not been registered by Company, please contact Manager!");
                    window.location = "".$_SERVER['HTTP_REFERER'];
                </script>
            <?php
                        }
                    } else {

            ?>
            <script type="text/javascript">
                alert("Password does not match");
                window.location = "".$_SERVER['HTTP_REFERER'];
            </script><?php
                    }
                }
            }
                        ?>