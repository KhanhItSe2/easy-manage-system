<!--Connect to database-->
<?php
include("../../Data/db.php");
if (isset($_POST['submit'])) {
    $error = '';
    $nationId   = mysqli_real_escape_string($conn, $_POST['nationId']);
    $nationName = mysqli_real_escape_string($conn, $_POST['nationName']);
    $userUpdated = $_SESSION['userName'];
    $query = "INSERT INTO nationality(nationId, nationName,userUpdated) VALUES('$nationId','$nationName','$userUpdated')";
    $execute = mysqli_query($conn, $query);
    if ($execute) { ?>
        <script type="text/javascript">
            alert("Add Successfully");
            window.location = "".$_SERVER['HTTP_REFERER'];
        </script>
    <?php  } else { ?>
        <script type="text/javascript">
            alert("Nationality has been exsited, please enter another");
            window.location = "".$_SERVER['HTTP_REFERER'];
        </script>
<?php

    }
}
?>