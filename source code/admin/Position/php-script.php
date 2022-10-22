<!--Connect to database-->
<?php
include("../../Data/db.php");
if (isset($_POST['submit'])) {
    $error = '';
    $posId   =  mysqli_real_escape_string($conn, $_POST['posId']);
    $posName = mysqli_real_escape_string($conn, $_POST['posName']);
    $userUpdated = $_SESSION['userName'];
    $query = "INSERT INTO position(posId, posName,userUpdated) VALUES('$posId','$posName','$userUpdated')";
    $execute = mysqli_query($conn, $query);
    if ($execute) { ?>
        <script type="text/javascript">
            alert("Add Successfully");
            window.location = "".$_SERVER['HTTP_REFERER'];
        </script>
    <?php  } else { ?>
        <script type="text/javascript">
            alert("Position has been exsited, please enter another");
            window.location = "".$_SERVER['HTTP_REFERER'];
        </script>
<?php

    }
}
?>