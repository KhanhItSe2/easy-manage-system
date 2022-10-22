<?php
session_start();
include("../../Data/db.php");

if (isset($_SESSION['is_login_admin'])) {
    $branchId = $_GET['id'];
    $error = "";
    $query = "DELETE FROM `branch` WHERE branchId = '$branchId'";
    $run = mysqli_query($conn, $query);
    if ($run) {
?>
        <script type="text/javascript">
            window.location = "./branch.php";
        </script>
    <?php
    } else {
    ?>
        <script type="text/javascript">
            alert("Fail to delete!");
            window.location = "./branch.php";
        </script>
<?php
    }
}
?>