<?php
session_start();
include("../../Data/db.php");

if (isset($_SESSION['is_login_admin'])) {
    $roleId = $_GET['id'];
    $error = "";
    $query = "DELETE FROM `role` WHERE roleId = '$roleId'";
    $run = mysqli_query($conn, $query);

    if ($run) {
?>
        <script type="text/javascript">
            window.location = "./role.php";
        </script>
    <?php
    } else {
    ?>
        <script type="text/javascript">
            alert("Fail to delete!");
            window.location = "./role.php";
        </script>
<?php
    }
}
?>