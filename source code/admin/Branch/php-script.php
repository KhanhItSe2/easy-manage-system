<!--Connect to database-->
<?php
include("../../Data/db.php");
if (isset($_POST['submit'])) {
    $error = '';
    $branchId   =  mysqli_real_escape_string($conn, $_POST['branchId']);
    $branchName = mysqli_real_escape_string($conn, $_POST['branchName']);
    $userUpdated = $_SESSION['userName'];
    $query = "INSERT INTO branch(branchId, branchName,userUpdated) VALUES('$branchId','$branchName','$userUpdated')";
    $execute = mysqli_query($conn, $query);
    if ($execute) { ?>
        <script type="text/javascript">
            alert("Add Successfully");
            window.location = "".$_SERVER['HTTP_REFERER'];
        </script>
    <?php  } else { ?>
        <script type="text/javascript">
            alert("Branch has been exsited, please enter another");
            window.location = "".$_SERVER['HTTP_REFERER'];
        </script>
<?php

    }
}
?>