<?php
session_start();
include("../../Data/db.php");

if (isset($_SESSION['is_login_admin'])) {
    $salaryId = $_GET['id'];
    $error = "";
    $query = "DELETE FROM `salarymethod` WHERE salaryId = '$salaryId'";
    $run = mysqli_query($conn, $query);

    if ($run) {
?>
        <script type="text/javascript">
            window.location = "./salarymethod.php";
        </script>
    <?php
    } else {
    ?>
        <script type="text/javascript">
            alert("Fail to delete!");
            window.location = "./salarymethod.php";
        </script>
<?php
    }
}
?>