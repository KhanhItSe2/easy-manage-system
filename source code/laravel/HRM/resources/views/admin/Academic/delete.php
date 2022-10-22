<?php
session_start();
include("../../Data/db.php");

if (isset($_SESSION['is_login_admin'])) {
    $acaId = $_GET['id'];
    $error = "";
    $query = "DELETE FROM `academic` WHERE acaId = '$acaId'";
    $run = mysqli_query($conn, $query);

    if ($run) {
?>
        <script type="text/javascript">
            alert("Delete Successfull.");
            window.location = "./academic.php";
        </script>
    <?php
    } else {
    ?>
        <script type="text/javascript">
            alert("Cannot Delete it");
            window.location = "./academic.php";
        </script>
<?php
    }
}
?>