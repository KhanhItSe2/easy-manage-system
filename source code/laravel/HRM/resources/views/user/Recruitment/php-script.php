<?php
include("../../Data/db.php");
if (isset($_POST['regist'])) {
    $error = '';
    $fullName = mysqli_real_escape_string($conn, $_POST['fullName']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $sex = mysqli_real_escape_string($conn, $_POST['sex']);
    $bDate = mysqli_real_escape_string($conn, $_POST['bDate']);
    $branch = mysqli_real_escape_string($conn, $_POST['branch']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $idCard = mysqli_real_escape_string($conn, $_POST['idCard']);
    $ethnic = mysqli_real_escape_string($conn, $_POST['ethnic']);

    $nationality = mysqli_real_escape_string($conn, $_POST['nationality']);
    $academy = mysqli_real_escape_string($conn, $_POST['academy']);
    $position = mysqli_real_escape_string($conn, $_POST['position']);
    $religion = mysqli_real_escape_string($conn, $_POST['religion']);
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $department = mysqli_real_escape_string($conn, $_POST['department']);
    $job = mysqli_real_escape_string($conn, $_POST['job']);

    $userUpdated = $_SESSION['userName'];


    $recruitmentquery = "SELECT * FROM `recruitment` WHERE idCard  ='$idCard' AND email  ='$email'  ";
    $query = mysqli_query($conn, $recruitmentquery);

    $recruitmentCheck = mysqli_num_rows($query);

    if ($recruitmentCheck > 0) {
?>
        <script type="text/javascript">
            alert("Employee has duplicated ID or Email, please check again");
            window.location = "".$_SERVER['HTTP_REFERER'];
        </script><?php
                } else {
                    $insert = "INSERT INTO `recruitment` (recruitmentId, fullName, address, email, sex, bDate, phone, idCard, ethnic, religion, nationality, academy, position,branch, job, status, userUpdated,title,department)
                     VALUES ('','$fullName','$address','$email','$sex','$bDate','$phone','$idCard','$ethnic','$religion','$nationality','$academy','$position','$branch','$job','Processing','$userUpdated','$title','$department')";
                    $iquery = mysqli_query($conn, $insert);
                    if ($iquery) {
                    ?>
            <script type="text/javascript">
                alert("Save Successfully");
                window.location = "".$_SERVER['HTTP_REFERER'];
                exit();
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