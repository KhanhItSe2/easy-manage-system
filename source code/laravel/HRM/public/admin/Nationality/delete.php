<?php
session_start();
include("../../Data/db.php");

if (isset($_SESSION['is_login_admin'])) {
    $nationId = $_GET['id'];
    $error = "";
    $query = "DELETE FROM `nationality` WHERE nationId = '$nationId'";
    $run = mysqli_query($conn, $query);

    if ($run) {
?>
        <script type="text/javascript">
            window.location = "./nationality.php";
        </script>
    <?php
    } else {
    ?>
        <script type="text/javascript">
            alert("Fail to delete!");
            window.location = "./nationality.php";
        </script>
<?php
    }
}
?>