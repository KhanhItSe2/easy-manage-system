<?php
session_start();
include("../../Data/db.php");

if (isset($_SESSION['is_login_admin'])) {
    $userId = $_GET['u_id'];
    $error = "";
    $query = "DELETE FROM `users` WHERE userId = '$userId'";
    $run = mysqli_query($conn, $query);

    if ($run) {
?>
        <script type="text/javascript">
            alert("Delete Successfull.");
            window.location = "./account.php";
        </script>
    <?php
    } else {
    ?>
        <script type="text/javascript">
            alert("Cannot Delete it");
            window.location = "./account.php";
        </script>
<?php
    }
}
?>