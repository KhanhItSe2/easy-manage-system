<!--Connect to database-->
<?php
include("../../Data/db.php");
if (isset($_POST['submit'])) {
    $error = '';
    $salaryId   = mysqli_real_escape_string($conn, $_POST['salaryId']);
    $salaryType = mysqli_real_escape_string($conn, $_POST['salaryType']);
    $salaryAmount = mysqli_real_escape_string($conn, $_POST['salaryAmount']);
    $userUpdated = $_SESSION['userName'];
    $query = "INSERT INTO salarymethod(salaryId, salaryType, salaryAmount, userUpdated) VALUES('$salaryId','$salaryType','$salaryAmount','$userUpdated')";
    $execute = mysqli_query($conn, $query);
    if ($execute) { ?>
        <script type="text/javascript">
            alert("Add Successfully");
            window.location = "".$_SERVER['HTTP_REFERER'];
        </script>
    <?php  } else { ?>
        <script type="text/javascript">
            alert("method of salary has been exsited, please enter another");
            window.location = "".$_SERVER['HTTP_REFERER'];
        </script>
<?php

    }
}
?>