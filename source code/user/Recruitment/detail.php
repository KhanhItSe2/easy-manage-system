<?php
session_start();
include('../../Data/db.php');
?>
<?php
if ($_SESSION['is_login_manager']) {

    if (isset($_POST['approved'])) {
        $recruitmentId = $_POST['recruitmentId'];
        $empId = $_POST['empId'];
        $fullName =  $_POST['fullName'];
        $address =  $_POST['address'];
        $email =  $_POST['email'];
        $sex =  $_POST['gender'];
        $branch =  $_POST['branch'];
        $bDate =  $_POST['bDate'];
        $phone =  $_POST['phone'];
        $idCard =  $_POST['idCard'];
        $ethnic =  $_POST['ethnic'];

        $nationality =  $_POST['nationality'];
        $academy =  $_POST['academy'];
        $position =  $_POST['position'];
        $religion =  $_POST['religion'];


        $userUpdated = $_SESSION['userName'];


        $recruitmentquery = "SELECT * FROM `employee` WHERE empId  ='$empId' ";
        $query = mysqli_query($conn, $recruitmentquery);

        $recruitmentCheck = mysqli_num_rows($query);

        if ($recruitmentCheck > 0) {
?>
            <script type="text/javascript">
                alert("Employee ID has been registered, please check again");
                window.location = "".$_SERVER['HTTP_REFERER'];
            </script>
            <?php
        } else {
            $insert = "INSERT INTO `employee` (empId, fullName, address, email, sex, bDate, phone, posId, idCard, ethnicId, religionId, nalId, academy, branch)
                     VALUES ('$empId','$fullName','$address','$email',
                     '$sex','$bDate','$phone','$position',
                     '$idCard','$ethnic','$religion',
                     '$nationality','$academy','$branch')";
            $update = "UPDATE `recruitment` SET status='Approved',  approved= '$userUpdated' WHERE recruitmentId= '$recruitmentId'";
            $iquery = mysqli_query($conn, $insert);
            if ($iquery) {
                $uquery = mysqli_query($conn, $update);

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
}
?>
<?php
if ($_SESSION['is_login_manager']) {

    if (isset($_POST['rejected'])) {
        $recruitmentId = $_POST['recruitmentId'];
        $userUpdated = $_SESSION['userName'];

        $email =  $_POST['email'];


        $recruitmentquery = "SELECT * FROM `employee` WHERE email  ='$email' ";
        $query = mysqli_query($conn, $recruitmentquery);

        $recruitmentCheck = mysqli_num_rows($query);
        if ($recruitmentCheck > 0) {
?>
            <script type="text/javascript">
                alert("Profile has been approved, please check again");
                window.location = "".$_SERVER['HTTP_REFERER'];
            </script>
            <?php
        } else {

            $update = "UPDATE `recruitment` SET status='Rejected', approved= '$userUpdated' WHERE recruitmentId= '$recruitmentId'";
            $uquery = mysqli_query($conn, $update);
            if ($uquery) {
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
                    exit();
                </script>
<?php
            }
        }
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Profile</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        <?php
        include 'style.css';
        ?>
    </style>
</head>

<body>


    <div class="container text-center">
        <hr>
        <h2>Candidate Profile </h2><br>

        <?php
        $id = $_GET["recruitment_id"];
        $sql = "SELECT  * FROM `recruitment` as r JOIN `ethnic` as e ON r.ethnic = e.ethnicId
        JOIN `religion` as re ON r.religion = re.religionId 
        JOIN `nationality` as n ON n.nationId = r.nationality 
        JOIN `academic` as a ON a.acaId = r.academy 
        JOIN `position` as p ON p.posId = r.position
        JOIN `branch` as b ON b.branchId = r.branch WHERE recruitmentId = $id";
        $result = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_assoc($result)) {

        ?>
            <form class="form-horizontal" enctype="multipart/form-data" action="" method="POST">
                <div class="form-group">
                    <label class="control-label col-sm-4" for="recruitmentId">Recruitment Id</label>
                    <input type="text" class="form-control" name="recruitmentId" value="<?= $row['recruitmentId'] ?>" readonly>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-4" for="empId">Employee Id</label>
                    <input type="text" class="form-control" name="empId">
                </div>

                <div class="form-group">
                    <label>Full Name:<?= $row['fullName'] ?></label>
                    <input type="text" class="form-control" value="<?= $row['fullName'] ?>" name="fullName" readonly>
                </div>
                <div class="form-group">
                    <label>Address:<?= $row['address'] ?></label>
                    <input type="text" class="form-control" value="<?= $row['address'] ?>" name="address" readonly>
                </div>
                <div class="form-group">
                    <label>Email:<?= $row['email'] ?></label>
                    <input type="text" class="form-control" value="<?= $row['email'] ?>" name="email" readonly>
                </div>
                <div class="form-group">
                    <label>Gender:<?= $row['sex'] ?></label>
                    <input type="text" class="form-control" value="<?= $row['sex'] ?>" name="gender" readonly>
                </div>
                <div class="form-group">
                    <label>Birth Date:<?= $row['bDate'] ?></label>
                    <input type="text" class="form-control" value="<?= $row['bDate'] ?>" name="bDate" readonly>
                </div>
                <div class="form-group">
                    <label>Phone Number:<?= $row['phone'] ?></label>
                    <input type="text" class="form-control" value="<?= $row['phone'] ?>" name="phone" readonly>
                </div>
                <div class="form-group">
                    <label>Identity Card Number:<?= $row['idCard'] ?></label>
                    <input type="text" class="form-control" value="<?= $row['idCard'] ?>" name="idCard" readonly>
                </div>
                <div class="form-group">
                    <label>Ethnic: <?= $row['ethnicName'] ?></label>
                    <input type="text" class="form-control" value="<?= $row['ethnicId'] ?>" name="ethnic" readonly>
                </div>

                <div class="form-group">
                    <label>Religion:<?= $row['religionName'] ?></label>
                    <input type="text" class="form-control" value="<?= $row['religionId'] ?>" name="religion" readonly>
                </div>
                <div class="form-group">
                    <label>Nationality:<?= $row['nationName'] ?></label>
                    <input type="text" class="form-control" value="<?= $row['nationId'] ?>" name="nationality" readonly>

                </div>

                <div class="form-group">
                    <label>Academy:<?= $row['acaLevel'] ?></label>
                    <input type="text" class="form-control" value="<?= $row['acaId'] ?>" name="academy" readonly>

                </div>
                <div class="form-group">
                    <label>Positon:<?= $row['posName'] ?></label>
                    <input type="text" class="form-control" value="<?= $row['posId'] ?>" name="position" readonly>

                </div>
                <div class="form-group">
                    <label>Branch:<?= $row['branchName'] ?></label>
                    <input type="text" class="form-control" placeholder="<?= $row['branchName'] ?>" value="<?= $row['branchId'] ?>" name="branch" readonly>

                </div>
                <div class="form-group">
                    <label>Job:<?= $row['job'] ?></label>
                    <input type="text" class="form-control" value="<?= $row['job'] ?>" name="job" readonly>

                </div>
                <div class="form-group">
                    <div class="container text-center">
                        <button type="submit" class="btn btn-success" name="approved">Approved</button>
                        <td><button type="submit" class="btn btn-danger" name="rejected">Rejected</button></td>
                        <td><button type="button" class="btn btn-secondary" onclick="goBack()" name="goback">Go Back</button></td>


                    </div>
                </div>
            </form>
        <?php } ?>
    </div>
    <br>

</body>
<script>
    function goBack() {
        window.history.back();
    }
</script>

</html>