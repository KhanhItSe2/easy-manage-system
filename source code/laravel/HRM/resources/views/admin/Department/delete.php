<?php
session_start();
include("../../Data/db.php");

if (isset($_SESSION['is_login_admin'])) {
    $deptId = $_GET['id'];
    $error = "";
    $query = "DELETE FROM `department` WHERE deptId = '$deptId'";
    $run = mysqli_query($conn, $query);

    if ($run) {
?>
        <script type="text/javascript">
            window.location = "./department.php";
        </script>
    <?php
    } else {
    ?>
        <script type="text/javascript">
            alert("Fail to delete!");
            window.location = "./department.php";
        </script>
<?php
    }
}
?>