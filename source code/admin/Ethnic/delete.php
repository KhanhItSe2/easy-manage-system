<?php
session_start();
include("../../Data/db.php");

if (isset($_SESSION['is_login_admin'])) {
    $ethnicId = $_GET['id'];
    $error = "";
    $query = "DELETE FROM `ethnic` WHERE ethnicId = '$ethnicId'";
    $run = mysqli_query($conn, $query);

    if ($run) {
?>
        <script type="text/javascript">
            window.location = "./ethnic.php";
        </script>
    <?php
    } else {
    ?>
        <script type="text/javascript">
            alert("Fail to delete!");
            window.location = "./ethnic.php";
        </script>
<?php
    }
}
?>