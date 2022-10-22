<!--Connect to database-->
<?php
include("../../Data/db.php");
if (isset($_POST['submit'])) {
    $error = '';
    $deptId   =  mysqli_real_escape_string($conn, $_POST['deptId']);
    $deptName = mysqli_real_escape_string($conn, $_POST['deptName']);
    $userUpdated = $_SESSION['userName'];
    $query = "INSERT INTO department(deptId, deptName,userUpdated) VALUES('$deptId','$deptName','$userUpdated')";
    $execute = mysqli_query($conn, $query);

    if ($execute) { ?>
        <script type="text/javascript">
            alert("Add Successfully");
            window.location = "".$_SERVER['HTTP_REFERER'];
        </script>
    <?php  } else { ?>
        <script type="text/javascript">
            alert("Department has been exsited, please enter another");
            window.location = "".$_SERVER['HTTP_REFERER'];
        </script>
<?php

    }
}
?>