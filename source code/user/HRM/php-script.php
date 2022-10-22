<?php
include("../../Data/db.php");
if (isset($_POST['regist'])) {
    $error = '';
    $fullName = mysqli_real_escape_string($conn, $_POST['fullName']);
    $empId = mysqli_real_escape_string($conn, $_POST['empId']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $sex = mysqli_real_escape_string($conn, $_POST['sex']);
    $bDate = mysqli_real_escape_string($conn, $_POST['bDate']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $posId = mysqli_real_escape_string($conn, $_POST['posId']);
    $deptId = mysqli_real_escape_string($conn, $_POST['deptId']);
    $startDate = mysqli_real_escape_string($conn, $_POST['startDate']);
    $endDate = mysqli_real_escape_string($conn, $_POST['endDate']);
    $salId = mysqli_real_escape_string($conn, $_POST['salId']);
    $idCard = mysqli_real_escape_string($conn, $_POST['idCard']);
    $ethnicId = mysqli_real_escape_string($conn, $_POST['ethnicId']);
    $religionId = mysqli_real_escape_string($conn, $_POST['religionId']);
    $nalId = mysqli_real_escape_string($conn, $_POST['nalId']);
    $academy = mysqli_real_escape_string($conn, $_POST['academy']);
    $branch = mysqli_real_escape_string($conn, $_POST['branch']);
    $title = mysqli_real_escape_string($conn, $_POST['title']);

    $employeequery = "SELECT * FROM `employee` WHERE empId= '$empId' AND idCard  ='$idCard' AND email  ='$email'  ";
    $query = mysqli_query($conn, $employeequery);

    $employeeCheck = mysqli_num_rows($query);

    if ($employeeCheck > 0) {
?>
        <script type="text/javascript">
            alert("Employee has duplicated ID or Email, please check again");
            window.location = "".$_SERVER['HTTP_REFERER'];
        </script><?php
                } else {
                    $insert = "INSERT INTO `employee` (empId, fullName, address, email, sex, bDate, phone, posId, deptId, startDate, endDate, salId, idCard,ethnicId, religionId, nalId, academy, branch,title)
                     VALUES ('$empId','$fullName','$address','$email','$sex','$bDate','$phone','$posId','$deptId','$startDate','$endDate', '$salId', '$idCard','$ethnicId', '$religionId', '$nalId', '$academy', '$branch','$title')";
                    $iquery = mysqli_query($conn, $insert);
                    if ($iquery) {
                    ?>
            <script type="text/javascript">
                alert("Save Successfully");
                window.location = "".$_SERVER['HTTP_REFERER'];
            </script>
        <?php
                    } else {
        ?>
            <script type="text/javascript">
                alert("Save Failure");
                window.location = "".$_SERVER['HTTP_REFERER'];
            </script>
<?php
                    }
                }
            }
?>