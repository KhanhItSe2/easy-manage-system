<!--Connect to database-->
<?php
include("../../Data/db.php");
if (isset($_POST['submit'])) {
    $error = '';
    $success = '';
    $acaId   =  mysqli_real_escape_string($conn, $_POST['acaId']);
    $acaLevel = mysqli_real_escape_string($conn, $_POST['acaLevel']);
    $userUpdated = $_SESSION['userName'];
    $query = "INSERT INTO academic(acaId, acaLevel,userUpdated) VALUES('$acaId','$acaLevel','$userUpdated')";
    $execute = mysqli_query($conn, $query);


    if ($execute) { ?>
        <script type="text/javascript">
            alert("Add Successfully");
            window.location = "".$_SERVER['HTTP_REFERER'];
        </script>
    <?php  } else { ?>
        <script type="text/javascript">
            alert("Academic has been exsited, please enter another");
            window.location = "".$_SERVER['HTTP_REFERER'];
        </script>
<?php

    }
}
?>