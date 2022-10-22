<?php
session_start();
include('../../Data/db.php');
if ($_SESSION['is_login_employer']) {
    if (isset($_POST['update'])) {
        $rid = $_GET['recruitment_id'];
        $fullName = mysqli_real_escape_string($conn, $_POST['fullName']);
        $ethnicId = mysqli_real_escape_string($conn, $_POST['ethnicId']);
        $address = mysqli_real_escape_string($conn, $_POST['address']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $sex = mysqli_real_escape_string($conn, $_POST['sex']);
        $bDate = mysqli_real_escape_string($conn, $_POST['bDate']);
        $phone = mysqli_real_escape_string($conn, $_POST['phone']);
        $posId = mysqli_real_escape_string($conn, $_POST['posId']);
        $deptId = mysqli_real_escape_string($conn, $_POST['deptId']);
        $idCard = mysqli_real_escape_string($conn, $_POST['idCard']);
        $religionId = mysqli_real_escape_string($conn, $_POST['religionId']);
        $nationId = mysqli_real_escape_string($conn, $_POST['nationId']);
        $academy = mysqli_real_escape_string($conn, $_POST['academy']);
        $branch = mysqli_real_escape_string($conn, $_POST['branch']);
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $job = mysqli_real_escape_string($conn, $_POST['job']);

        $recruitquery = "SELECT * FROM `recruitment` WHERE recruitmentId= '$rid'";
        $query = mysqli_query($conn, $recruitquery);

        $recruitCheck = mysqli_num_rows($query);

        if ($recruitCheck < 0) {
?>
            <script type="text/javascript">
                alert("Recruitment ID is wrong");
                window.location = "".$_SERVER['HTTP_REFERER'];
            </script><?php
                    } else {
                        $insert = "UPDATE `recruitment`
                        INNER JOIN department ON department.deptId = recruitment.department
                        INNER JOIN position ON position.posId = recruitment.position
                        INNER JOIN ethnic ON ethnic.ethnicId = recruitment.ethnic
                        INNER JOIN religion ON religion.religionId = recruitment.religion
                        INNER JOIN nationality ON nationality.nationId = recruitment.nationality
                        SET fullName='$fullName',
                                                address='$address',
                                                email='$email',
                                                sex='$sex',
                                                bDate='$bDate',
                                                phone='$phone',
                                                recruitment.position='$posId',
                                                recruitment.department='$deptId ',
                                                idCard='$idCard',
                                                recruitment.ethnic='$ethnicId',
                                                recruitment.religion='$religionId',
                                                recruitment.nationality='$nationId',
                                                recruitment.academy='$academy',
                                                branch='$branch',
                                                title='$title',
                                                job = '$job' WHERE recruitmentId='$rid'";
                        $iquery = mysqli_query($conn, $insert);
                        if ($iquery) {
                            $recruitmentquery = "SELECT * FROM `recruitment` WHERE recruitmentId = '$rid'  ";
                            $query = mysqli_query($conn, $recruitmentquery);
                            $recruitmentCheck = mysqli_num_rows($query);

                            if ($recruitmentCheck > 0) {

                                while ($fetch = mysqli_fetch_array($query)) {
                                    if ($fetch['avt'] == NULL) {
                                        $u_avt = $_FILES['avt']['name'];
                                        $avt_tmp = $_FILES['avt']['tmp_name'];
                                        $id = $fetch['recruitmentId'];
                                        move_uploaded_file($avt_tmp, "../../user/User Avatar/$u_avt.$id");
                                        $u_avt_query = "UPDATE `recruitment` SET avt='$u_avt.$id' WHERE recruitmentId = '$id'";
                                        $result = mysqli_query($conn, $u_avt_query);

                        ?>
                        <?php

                                    } else { ?>
                            <script type="text/javascript">
                                window.location = "".$_SERVER['HTTP_REFERER'];
                                exit();
                            </script><?php
                                    }
                                }
                            }
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
            } else {
                header("Location: ../index.php");
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

                                            ?> <img src='../../user/User Avatar/<?= $row['avt'] ?>' alt="profile_picture">
                                        </div>
                                        <h5 class="fullname"><?= $row['fullName'] ?></h5>
                                        <h6 class="user-email"><?= $row['email'] ?></h6>

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


                                        <div class="form-group">
                                            <label for="recruitmentId">Recruitment ID<span style="color: red;">*</span></label>
                                            <input type="text" class="form-control" id="exampleInputEmail1" name="recruitmentId" value="<?= $row['recruitmentId'] ?>" readonly="">
                                        </div>
                                        <div class="form-group">
                                            <label for="fullName">Full Name</label>
                                            <input type="text" class="form-control" id="fullName" value="<?= $row['fullName'] ?>" name="fullName">
                                        </div>

                                        <div class="form-group">
                                            <label for="address">Address</label>
                                            <input type="text" class="form-control" id="address" value="<?= $row['address'] ?>" name="address">
                                        </div>
                                    </div>
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label>Nationality</label>
                                            <select class="form-control" name="nationId" required>
                                                <option value="<?= $row['nationId'] ?>"><?= $row['nationName'] ?></option>
                                                <?php
                                                if (isset($_SESSION['is_login_employer'])) {
                                                    $query = "SELECT * FROM `nationality` ";
                                                    $run = mysqli_query($conn, $query);
                                                    $check = mysqli_num_rows($run);
                                                    if ($check > 0) {
                                                        while ($col = mysqli_fetch_array($run)) :  ?>
                                                            <option value="<?php echo $col[0]; ?>"><?php echo $col[1]; ?></option>
                                                        <?php endwhile; ?>
                                                    <?php }
                                                } else { ?>
                                                    <?php header('location: ../index.php') ?>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Academy</label>
                                            <select class="form-control" name="academy" required>
                                                <option value="<?= $row['acaId'] ?>"><?= $row['acaLevel'] ?></option>
                                                <?php
                                                if (isset($_SESSION['is_login_employer'])) {
                                                    $query = "SELECT * FROM `academic` ";
                                                    $run = mysqli_query($conn, $query);
                                                    $check = mysqli_num_rows($run);
                                                    if ($check > 0) {
                                                        while ($col = mysqli_fetch_array($run)) :  ?>
                                                            <option value="<?php echo $col[0]; ?>"><?php echo $col[1]; ?></option>
                                                        <?php endwhile; ?>
                                                    <?php }
                                                } else { ?>
                                                    <?php header('location: ../index.php') ?>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Identity Card Number</label>
                                            <?php if ($row['idCard'] == NULL) { ?>

                                                <input type="text" class="form-control" placeholder="Enter ID card number" name="idCard">
                                            <?php } else { ?>
                                                <input type="text" class="form-control" name="idCard" value="<?= $row['idCard'] ?>">


                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1" name="email" value="<?= $row['email'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Gender</label>
                                            <select class="form-control" name="sex" required>
                                                <option value="<?= $row['sex'] ?>"><?= $row['sex'] ?></option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                                <option value="Other">Other</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Position</label>
                                            <select class="form-control" name="posId" required>
                                                <option value="<?= $row['posId'] ?>"><?= $row['posName'] ?></option>
                                                <?php
                                                if (isset($_SESSION['is_login_employer'])) {
                                                    $query = "SELECT * FROM `position` ";
                                                    $run = mysqli_query($conn, $query);
                                                    $check = mysqli_num_rows($run);
                                                    if ($check > 0) {
                                                        while ($col = mysqli_fetch_array($run)) :  ?>
                                                            <option value="<?php echo $col[0]; ?>"><?php echo $col[1]; ?></option>
                                                        <?php endwhile; ?>
                                                    <?php }
                                                } else { ?>
                                                    <?php header('location: ../index.php') ?>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Branch</label>
                                            <select class="form-control" name="branch" required>
                                                <option value="<?= $row['branchId'] ?>"><?= $row['branchName'] ?></option>
                                                <?php
                                                if (isset($_SESSION['is_login_employer'])) {
                                                    $query = "SELECT * FROM `branch` ";
                                                    $run = mysqli_query($conn, $query);
                                                    $check = mysqli_num_rows($run);
                                                    if ($check > 0) {
                                                        while ($col = mysqli_fetch_array($run)) :  ?>
                                                            <option value="<?php echo $col[0]; ?>"><?php echo $col[1]; ?></option>
                                                        <?php endwhile; ?>
                                                    <?php }
                                                } else { ?>
                                                    <?php header('location: ../index.php') ?>
                                                <?php } ?>
                                            </select>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Birth Date </label>
                                            <input type="date" class="form-control" value="<?= $row['bDate'] ?>" name="bDate">
                                        </div>
                                        <div class="form-group">
                                            <label for="phone">Phone Number</label>
                                            <input type="text" class="form-control" id="phone" value="<?= $row['phone'] ?>" name="phone">
                                        </div>
                                        <div class="form-group">
                                            <label>Job</label>
                                            <select class="form-control" name="job" required>
                                                <option value="<?= $row['job'] ?>"><?= $row['job'] ?></option>
                                                <option value="Part-time">Part-time</option>
                                                <option value="Full-time">Full-time</option>
                                                <option value="Intern">Intern</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Department</label>
                                            <select class="form-control" name="deptId" required>
                                                <option value="<?= $row['deptId'] ?>"><?= $row['deptName'] ?></option>
                                                <?php
                                                if (isset($_SESSION['is_login_employer'])) {
                                                    $query = "SELECT * FROM `department` ";
                                                    $run = mysqli_query($conn, $query);
                                                    $check = mysqli_num_rows($run);
                                                    if ($check > 0) {
                                                        while ($col = mysqli_fetch_array($run)) :  ?>
                                                            <option value="<?php echo $col[0]; ?>"><?php echo $col[1]; ?></option>
                                                        <?php endwhile; ?>
                                                    <?php }
                                                } else { ?>
                                                    <?php header('location: ../index.php') ?>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Ethnic</label>
                                            <select class="form-control" name="ethnicId" required>
                                                <option value="<?= $row['ethnicId'] ?>"><?= $row['ethnicName'] ?></option>
                                                <?php
                                                if (isset($_SESSION['is_login_employer'])) {
                                                    $query = "SELECT * FROM `ethnic` ";
                                                    $run = mysqli_query($conn, $query);
                                                    $check = mysqli_num_rows($run);
                                                    if ($check > 0) {
                                                        while ($col = mysqli_fetch_array($run)) :  ?>
                                                            <option value="<?php echo $col[0]; ?>"><?php echo $col[1]; ?></option>
                                                        <?php endwhile; ?>
                                                    <?php }
                                                } else { ?>
                                                    <?php header('location: ../index.php') ?>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Religion</label>
                                            <select class="form-control" name="religionId" required>
                                                <option value="<?= $row['religionId'] ?>"><?= $row['religionName'] ?></option>
                                                <?php
                                                if (isset($_SESSION['is_login_employer'])) {
                                                    $query = "SELECT * FROM `religion` ";
                                                    $run = mysqli_query($conn, $query);
                                                    $check = mysqli_num_rows($run);
                                                    if ($check > 0) {
                                                        while ($col = mysqli_fetch_array($run)) :  ?>
                                                            <option value="<?php echo $col[0]; ?>"><?php echo $col[1]; ?></option>
                                                        <?php endwhile; ?>
                                                    <?php }
                                                } else { ?>
                                                    <?php header('location: ../index.php') ?>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Title</label>
                                            <select class="form-control" name="title" required>
                                                <option value="<?= $row['titleId'] ?>"><?= $row['titleName'] ?></option>
                                                <?php
                                                if (isset($_SESSION['is_login_employer'])) {
                                                    $query = "SELECT * FROM `title` ";
                                                    $run = mysqli_query($conn, $query);
                                                    $check = mysqli_num_rows($run);
                                                    if ($check > 0) {
                                                        while ($col = mysqli_fetch_array($run)) :  ?>
                                                            <option value="<?php echo $col[0]; ?>"><?php echo $col[1]; ?></option>
                                                        <?php endwhile; ?>
                                                    <?php }
                                                } else { ?>
                                                    <?php header('location: ../index.php') ?>
                                                <?php } ?>
                                            </select>
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
                                            <td> <button type="submit" class="btn btn-primary" name="update">Update</button></td>
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