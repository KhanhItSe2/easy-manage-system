<?php
session_start();
include("../../Data/db.php");

if (isset($_SESSION['is_login_admin'])) {
    $posId = $_GET['id'];
    $error = "";
    $query = "DELETE FROM `position` WHERE posId = '$posId'";
    $run = mysqli_query($conn, $query);
    if ($run) {
?>
        <script type="text/javascript">
            window.location = "./position.php";
        </script>
    <?php
    } else {
    ?>
        <script type="text/javascript">
            alert("Fail to delete!");
            window.location = "./position.php";
        </script>
<?php
    }
}
?>