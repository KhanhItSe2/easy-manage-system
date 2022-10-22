<!--Connect to database-->
<?php
include("../../Data/db.php");
if (isset($_POST['submit'])) {
    $error = '';
    $ethnicId   = mysqli_real_escape_string($conn, $_POST['ethnicId']);
    $ethnicName = mysqli_real_escape_string($conn, $_POST['ethnicName']);
    $userUpdated = $_SESSION['userName'];
    $query = "INSERT INTO ethnic(ethnicId, ethnicName,userUpdated) VALUES('$ethnicId','$ethnicName','$userUpdated')";
    $execute = mysqli_query($conn, $query);
    if ($execute) { ?>
        <script type="text/javascript">
            alert("Add Successfully");
            window.location = "".$_SERVER['HTTP_REFERER'];
        </script>
    <?php  } else { ?>
        <script type="text/javascript">
            alert("Ethnic has been exsited, please enter another");
            window.location = "".$_SERVER['HTTP_REFERER'];
        </script>
<?php

    }
}
?>