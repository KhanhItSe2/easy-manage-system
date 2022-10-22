<!--Connect to database-->
<?php
include ("db.php");
/*$server = "localhost";
$user = "root";
$password = "";
$data = "hmr_db";

$conn = mysqli_connect($server, $user, $password, $data);
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}


$db = $conn; 

$acaId   =  mysqli_real_escape_string($db, $_POST['acaId']);
$acaLevel = mysqli_real_escape_string($db, $_POST['acaLevel']);

if (isset($acaId) && isset($acaLevel)){
    insert_academic($acaId, $acaLevel);
}

function insert_academic($acaId, $acaLevel)
{

    global $db;
  
    $query = "INSERT INTO academic(acaId, acaLevel) VALUES('$acaId','$acaLevel')";
    $execute = mysqli_query($db, $query);
    if ($execute) {
        echo "".$acaId;
        echo "".$acaLevel;
        echo "<script type='text/javascript'>alert('Successfully added!');</script>";
    }else{
        echo "<script type='text/javascript'>alert('Fail added!');</script>";
    }
} */

if (isset($_POST['submit'])){
    $error = '';
    $acaId   =  mysqli_real_escape_string($conn, $_POST['acaId']);
    $acaLevel = mysqli_real_escape_string($conn, $_POST['acaLevel']);
    $userUpdated = $_SESSION['userName'];
    $query = "INSERT INTO academic(acaId, acaLevel,userUpdated,day) VALUES('$acaId','$acaLevel','$userUpdated',now())";
    $execute = mysqli_query($conn, $query);
    if ($execute) {
        $error = 'success';
    }else{
        $error = 'fail';
    }
}
?>