<!--Connect to database-->
<?php
include("../../Data/db.php");
if (isset($_POST['submit'])) {
    $error = '';
    $roleId   =  mysqli_real_escape_string($conn, $_POST['roleId']);
    $roleName = mysqli_real_escape_string($conn, $_POST['roleName']);
    $userUpdated = $_SESSION['userName'];
    $query = "INSERT INTO role(roleId, roleName,userUpdated) VALUES('$roleId','$roleName','$userUpdated')";
    $execute = mysqli_query($conn, $query);
    if ($execute) { ?>
        <script type="text/javascript">
            alert("Add Successfully");
            window.location = "".$_SERVER['HTTP_REFERER'];
        </script>
    <?php  } else { ?>
        <script type="text/javascript">
            alert("Role has been exsited, please enter another");
            window.location = "".$_SERVER['HTTP_REFERER'];
        </script>
<?php

    }
}
?>