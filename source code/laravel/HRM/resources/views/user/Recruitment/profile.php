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
        $department =  $_POST['department'];
        $title =  $_POST['title'];


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
            $insert = "INSERT INTO `employee` (empId, fullName, address, email, sex, bDate, phone, posId, idCard, ethnicId, religionId, nalId, academy, branch,title,deptId)
                     VALUES ('$empId','$fullName','$address','$email','$sex',
                     '$bDate','$phone','$position','$idCard','$ethnic','$religion',
                     '$nationality','$academy','$branch','$title','$department')";
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

<head itemscope="" itemtype="http://schema.org/WebSite">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Candidate Profile</title>
    <script src="/cache-js/cache-1635427806-97135bbb13d92c11d6b2a92f6a36685a.js" type="text/javascript"></script>
</head>

<body>
    <div id="snippetContent">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
        <form enctype="multipart/form-data" action="" method="POST">
            <div class="container">
                <div class="row gutters">
                    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="account-settings">
                                    <div class="user-profile">
                                        <div class="user-avatar">
                                            <?php
                                            if (isset($_SESSION['is_login_employer'])) {
                                                $userId = $_GET['recruitment_id'];
                                                $sql = "SELECT * FROM `recruitment` WHERE recruitmentId = '$userId'";
                                                $result = mysqli_query($conn, $sql);
                                                $row = mysqli_num_rows($result);
                                                if ($row > 0) {
                                                    while ($fetch = mysqli_fetch_assoc($result)) { ?>
                                                        <img src='../../user/User Avatar/<?= $fetch['avt'] ?>' alt="profile_picture">
                                        </div>
                                        <h5 class="fullname"><?= $fetch['fullName'] ?></h5>
                                        <h6 class="user-email"><?= $fetch['email'] ?></h6>
                                <?php }
                                                }
                                            } else { ?>
                                <?php header('location: ../index.php') ?>
                            <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="row gutters">

                                    <div class="col">
                                        <?php
                                        $id = $_GET["recruitment_id"];
                                        $sql = "SELECT  * FROM `recruitment` as r JOIN `ethnic` as e ON r.ethnic = e.ethnicId
        JOIN `religion` as re ON r.religion = re.religionId 
        JOIN `nationality` as n ON n.nationId = r.nationality 
        JOIN `academic` as a ON a.acaId = r.academy 
        JOIN `position` as p ON p.posId = r.position
        JOIN `branch` as b ON b.branchId = r.branch
        JOIN `department` as d ON d.deptId = r.department 
        JOIN `title` as t ON t.titleId = r.title WHERE recruitmentId = $id";
                                        $result = mysqli_query($conn, $sql);

                                        while ($row = mysqli_fetch_assoc($result)) {

                                        ?>

                                            <div class="form-group">
                                                <label for="recruitmentId">Recruitment ID</label>
                                                <input type="text" class="form-control" id="recruitmentId" name="recruitmentId" value="<?= $row['recruitmentId'] ?>" readonly="">
                                            </div>
                                            <div class="form-group">
                                                <label for="fullName">Full Name</label>
                                                <input type="text" class="form-control" id="fullName" value="<?= $row['fullName'] ?>" readonly name="fullName">
                                            </div>

                                            <div class="form-group">
                                                <label for="address">Address</label>
                                                <input type="text" class="form-control" id="address" value="<?= $row['address'] ?>" name="address" readonly>
                                            </div>
                                    </div>
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label>Nationality</label>
                                            <input type="hidden" class="form-control" value="<?= $row['nationId'] ?>" name="nationality" readonly>
                                            <input type="text" class="form-control" value="<?= $row['nationName'] ?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>Academy</label>
                                            <input type="hidden" class="form-control" value="<?= $row['acaId'] ?>" name="academy" readonly>
                                            <input type="text" class="form-control" value="<?= $row['acaLevel'] ?>" readonly>

                                        </div>
                                        <div class="form-group">
                                            <label>Identity Card Number</label>
                                            <input type="hidden" class="form-control" value="<?= $row['idCard'] ?>" name="idCard" readonly>
                                            <input type="text" class="form-control" value="<?= $row['idCard'] ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="text" class="form-control" id="email" name="email" value="<?= $row['email'] ?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="gender">Gender</label>
                                            <input type="text" class="form-control" value="<?= $row['sex'] ?>" name="gender" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Positon</label>
                                            <input type="text" class="form-control" value="<?= $row['posName'] ?>" readonly>
                                            <input type="hidden" class="form-control" value="<?= $row['posId'] ?>" name="position" readonly>

                                        </div>
                                        <div class="form-group">
                                            <label>Branch</label>
                                            <input type="text" class="form-control" value="<?= $row['branchName'] ?>" readonly>
                                            <input type="hidden" class="form-control" value="<?= $row['branchId'] ?>" name="branch" readonly>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Birth Date </label>
                                            <input type="text" class="form-control" value="<?= $row['bDate'] ?>" name="bDate" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="phone">Phone Number</label>
                                            <input type="text" class="form-control" id="phone" value="<?= $row['phone'] ?>" name="phone" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>Job</label>
                                            <input type="text" class="form-control" value="<?= $row['job'] ?>" name="job" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>Department</label>
                                            <input type="text" class="form-control" value="<?= $row['deptName'] ?>" readonly>
                                            <input type="hidden" class="form-control" value="<?= $row['deptId'] ?>" name="department">
                                        </div>
                                        <div class="form-group">
                                            <label>Employee ID </label>
                                            <input type="text" placeholder="(Enter if approvement)" class="form-control" name="empId">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Ethnic </label>
                                            <input type="text" class="form-control" id="ethnic" value="<?= $row['ethnicName'] ?>" readonly>
                                            <input type="hidden" class="form-control" id="ethnic" value="<?= $row['ethnicId'] ?>" name="ethnic">
                                        </div>
                                        <div class="form-group">
                                            <label>Religion</label>
                                            <input type="text" class="form-control" value="<?= $row['religionName'] ?>" readonly>
                                            <input type="hidden" class="form-control" value="<?= $row['religionId'] ?>" name="religion">
                                        </div>
                                        <div class="form-group">
                                            <label>Title</label>
                                            <input type="text" class="form-control" value="<?= $row['titleName'] ?>" readonly>
                                            <input type="hidden" class="form-control" value="<?= $row['titleId'] ?>" name="title" readonly>
                                        </div>
                                        <?php if ($row['avt'] == NULL) { ?>
                                            <div class="form-group">
                                                <label for="avt">Avatar Profile</label>
                                                <input type="file" class="form-control" name='avt' size='60'>
                                            </div><?php } else { ?>
                                            <div class="form-group">
                                                <label for="avt">Avatar Profile <?= $row['avt'] ?></label>
                                                <input type="hidden" class="form-control" value="<?= $row['avt'] ?>" name="avt" readonly>
                                            </div>
                                        <?php } ?>
                                        <div class="form-group">
                                            <label>Profile Status<?php if ($row['status'] == 'Processing') { ?>
                                                <td><button class="btn btn-warning"><?= $row['status']; ?></button></td>
                                            <?php } else if ($row['status'] == 'Approved') { ?>
                                                <td><button type="button" class="btn btn-success"><?= $row['status']; ?></button></td>
                                            <?php } else { ?>
                                                <td><button type="button" class="btn btn-danger"><?= $row['status']; ?></button></td>
                                            <?php } ?> By <?= $row['approved'] ?>
                                            </label>
                                        </div>


                                    </div>


                                    <div class="form-group">
                                        <div class="container text-center">
                                            <td><button type="button" class="btn btn-secondary" onclick="goBack()" name="goback">Go Back</button></td>

                                            <button type="submit" class="btn btn-success" name="approved">Approved</button>
                                            <td><button type="submit" class="btn btn-danger" name="rejected">Rejected</button></td>


                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
        </form>
    <?php } ?>
    </div>
    </div>

    <style type="text/css">
        body {
            margin: 0;
            padding-top: 40px;
            color: #2e323c;
            background: #f5f6fa;
            position: relative;
            height: 100%;
        }

        .account-settings .user-profile {
            margin: 0 0 1rem 0;
            padding-bottom: 1rem;
            text-align: center;
        }

        .account-settings .user-profile .user-avatar {
            margin: 0 0 1rem 0;
        }

        .account-settings .user-profile .user-avatar img {
            width: 90px;
            height: 90px;
            -webkit-border-radius: 100px;
            -moz-border-radius: 100px;
            border-radius: 100px;
        }

        .account-settings .user-profile h5.user-name {
            margin: 0 0 0.5rem 0;
        }

        .account-settings .user-profile h6.user-email {
            margin: 0;
            font-size: 0.8rem;
            font-weight: 400;
            color: #9fa8b9;
        }

        .account-settings .about {
            margin: 2rem 0 0 0;
            text-align: center;
        }

        .account-settings .about h5 {
            margin: 0 0 15px 0;
            color: #007ae1;
        }

        .account-settings .about p {
            font-size: 0.825rem;
        }

        .form-control {
            border: 1px solid #cfd1d8;
            -webkit-border-radius: 2px;
            -moz-border-radius: 2px;
            border-radius: 2px;
            font-size: .825rem;
            background: #ffffff;
            color: #2e323c;
        }

        .card {
            background: #ffffff;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
            border: 0;
            margin-bottom: 1rem;
        }
    </style>
    <script type="text/javascript"></script>
    </div>
</body>
<script>
    function goBack() {
        window.history.back();
    }
</script>

</html>