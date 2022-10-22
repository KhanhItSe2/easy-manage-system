<!--Connect to database-->
<?php
include("../../Data/db.php");
if (isset($_POST['submit'])) {
    $error = '';
    $religionId   =  mysqli_real_escape_string($conn, $_POST['religionId']);
    $religionName = mysqli_real_escape_string($conn, $_POST['religionName']);
    $userUpdated = $_SESSION['userName'];
    $query = "INSERT INTO religion(religionId, religionName,userUpdated) VALUES('$religionId','$religionName','$userUpdated')";
    $execute = mysqli_query($conn, $query);
    if ($execute) { ?>
        <script type="text/javascript">
            alert("Add Successfully");
            window.location = "".$_SERVER['HTTP_REFERER'];
        </script>
    <?php  } else { ?>
        <script type="text/javascript">
            alert("Religion has been exsited, please enter another");
            window.location = "".$_SERVER['HTTP_REFERER'];
        </script>
<?php

    }
}
?>