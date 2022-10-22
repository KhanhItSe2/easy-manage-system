<?php
session_start();
include("../../Data/db.php");

if (isset($_SESSION['is_login_admin'])) {
    $religionId = $_GET['id'];
    $error = "";
    $query = "DELETE FROM `religion` WHERE religionId = '$religionId'";
    $run = mysqli_query($conn, $query);

    if ($run) {
?>
        <script type="text/javascript">
            window.location = "./religion.php";
        </script>
    <?php
    } else {
    ?>
        <script type="text/javascript">
            alert("Fail to delete!");
            window.location = "./religion.php";
        </script>
<?php
    }
}
?>