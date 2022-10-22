<?php
session_start();
include('../../Data/db.php');
if ($_SESSION['is_login_manager']) {
    if (isset($_POST['update'])) {
        $rid = $_GET['id'];
        $empId = mysqli_real_escape_string($conn, $_POST['empId']);
        $fullName = mysqli_real_escape_string($conn, $_POST['fullName']);
        $taxable = mysqli_real_escape_string($conn, $_POST['taxable']);
        $ethnicId = mysqli_real_escape_string($conn, $_POST['ethnicId']);
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
        $insurance = mysqli_real_escape_string($conn, $_POST['insurance']);
        $religionId = mysqli_real_escape_string($conn, $_POST['religionId']);
        $nalId = mysqli_real_escape_string($conn, $_POST['nalId']);
        $academy = mysqli_real_escape_string($conn, $_POST['academy']);
        $branch = mysqli_real_escape_string($conn, $_POST['branch']);
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $status = mysqli_real_escape_string($conn, $_POST['status']);

        $employeequery = "SELECT * FROM `employee` WHERE empId= '$empId'";
        $query = mysqli_query($conn, $employeequery);

        $employeeCheck = mysqli_num_rows($query);

        if ($employeeCheck < 0) {
?>
            <script type="text/javascript">
                alert("Employee ID is wrong");
                window.location = "".$_SERVER['HTTP_REFERER'];
            </script><?php
                    } else {
                        $insert = "UPDATE `employee` 
                        INNER JOIN department ON department.deptId = employee.deptId
                        INNER JOIN position ON position.posId = employee.posId
                        INNER JOIN ethnic ON ethnic.ethnicId = employee.ethnicId
                        INNER JOIN religion ON religion.religionId = employee.religionId
                        INNER JOIN nationality ON nationality.nationId = employee.nalId
                        INNER JOIN salarymethod ON salarymethod.salaryId = employee.salId
                        SET fullName='$fullName',
                        address='$address',
                        email='$email',
                        sex='$sex',																				
                        bDate='$bDate',
                        phone='$phone',
                        employee.posId='$posId',
                        employee.deptId='$deptId',
                        startDate='$startDate',
                        endDate='$endDate',
                        employee.salId='$salId',
                        idCard='$idCard',
                        taxable='$taxable',
                        insurance='$insurance',
                        employee.ethnicId='$ethnicId',
                        employee.religionId='$religionId',
                        employee.nalId='$nalId',
                        employee.academy='$academy',
                        employee.branch='$branch',
                        employee.title='$title',
                        status='$status' WHERE empId='$rid'";
                        $iquery = mysqli_query($conn, $insert);
                        if ($iquery) {
                            $employeequery = "SELECT * FROM `employee` WHERE empId = '$rid'  ";
                            $query = mysqli_query($conn, $employeequery);
                            $employeeCheck = mysqli_num_rows($query);

                            if ($employeeCheck > 0) {

                                while ($fetch = mysqli_fetch_array($query)) {
                                    if ($fetch['avt'] == NULL) {
                                        $u_avt = $_FILES['avt']['name'];
                                        $avt_tmp = $_FILES['avt']['tmp_name'];
                                        $id = $fetch['empId'];
                                        move_uploaded_file($avt_tmp, "../../user/User Avatar/$u_avt.$id");
                                        $u_avt_query = "UPDATE `employee` SET avt='$u_avt.$id' WHERE empId = '$id'";
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
    <title>Staff Profile</title>
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
                                            $id = $_GET["id"];
                                            $sql = "SELECT  * FROM `employee` as emp JOIN `ethnic` as e ON emp.ethnicId = e.ethnicId
                                        JOIN `religion` as re ON emp.religionId = re.religionId 
                                        JOIN `nationality` as n ON n.nationId = emp.nalId
                                        JOIN `academic` as a ON a.acaId = emp.academy 
                                        JOIN `position` as p ON p.posId = emp.posId
                                        JOIN `branch` as b ON b.branchId = emp.branch
                                        JOIN `department` as d ON d.deptId = emp.deptId
                                        JOIN `salarymethod` as s ON s.salaryId = emp.salId 
                                        JOIN `title` as t ON t.titleId = emp.title WHERE empId = '$id'";
                                            $result = mysqli_query($conn, $sql);

                                            while ($row = mysqli_fetch_assoc($result)) {

                                            ?>

                                                <img src='../../user/User Avatar/<?= $row['avt'] ?>' alt="profile_picture">
                                        </div>
                                        <h5 class="fullname"><?= $row['fullName'] ?></h5>
                                        <h6 class="user-email"><?= $row['email'] ?></h6>
                                        <h5 class="user-title">Title: <span class="btn btn-link"><?= $row['titleName'] ?></span></h6>
                                            <h5 class="user-deparment">Department: <span class="btn btn-link"><?= $row['deptName'] ?></span></h6>
                                                <h5 class="user-position">Position: <span class="btn btn-link"><?= $row['posName'] ?></span></h6>

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
                                            <label for="empId">Empoyee ID</label>
                                            <input type="text" class="form-control" id="empId" value="<?= $row['empId'] ?>" name="empId" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="fullName">Full Name</label>
                                            <input type="text" class="form-control" id="fullName" value="<?= $row['fullName'] ?>" name="fullName">
                                        </div>

                                        <div class="form-group">
                                            <label for="address">Address</label>
                                            <input type="text" class="form-control" id="address" value="<?= $row['address'] ?>" name="address">
                                        </div>
                                        <div class="form-group">
                                            <label>Tax</label>
                                            <?php if ($row['taxable'] == NULL) { ?>

                                                <input type="text" class="form-control" placeholder="Enter tax number" name="taxable">
                                            <?php } else { ?>
                                                <input type="text" class="form-control" name="taxable" value="<?= $row['taxable'] ?>">


                                            <?php } ?>
                                        </div>

                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Ethnic</label>
                                            <select class="form-control" name="ethnicId" required>
                                                <option value="<?= $row['ethnicId'] ?>"><?= $row['ethnicName'] ?></option>
                                                <?php
                                                if (isset($_SESSION['is_login_manager'])) {
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
                                                if (isset($_SESSION['is_login_manager'])) {
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
                                            <label>Start Date</label>
                                            <?php if ($row['startDate'] == NULL) { ?>

                                                <input type="date" class="form-control" name="startDate">
                                            <?php } else { ?>
                                                <input type="date" class="form-control" name="startDate" value="<?= $row['startDate'] ?>">


                                            <?php } ?>
                                        </div>
                                        <div class="form-group">
                                            <label>End Date</label>
                                            <?php if ($row['endDate'] == NULL) { ?>

                                                <input type="date" class="form-control" name="endDate">
                                            <?php } else { ?>
                                                <input type="date" class="form-control" name="endDate" value="<?= $row['endDate'] ?>">


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
                                                if (isset($_SESSION['is_login_manager'])) {
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
                                                if (isset($_SESSION['is_login_manager'])) {
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
                                            <label>Nationality</label>
                                            <select class="form-control" name="nalId" required>
                                                <option value="<?= $row['nationId'] ?>"><?= $row['nationName'] ?></option>
                                                <?php
                                                if (isset($_SESSION['is_login_manager'])) {
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
                                                if (isset($_SESSION['is_login_manager'])) {
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
                                        <div class="form-group">
                                            <div class="form-group">
                                                <label>Profile Status</label>
                                                <select class="form-control" name="status" required>

                                                    <option value="<?= $row['status'] ?>"><?php if ($row['status'] == '0') { ?>
                                                            <td><button class="btn btn-success">Working</button></td>
                                                        <?php } else if ($row['status'] == '1') { ?>
                                                            <td><button type="button" class="btn btn-danger">Retired</button></td>
                                                        <?php } else { ?>
                                                            <td><button type="button" class="btn btn-warning">Intermission</button></td>
                                                        <?php } ?>
                                                    </option>
                                                    <option value="0">Working</option>
                                                    <option value="1">Retired</option>
                                                    <option value="2">Intermission</option>
                                                </select>
                                            </div>
                                            <label>Profile Status: <?php if ($row['status'] == '0') { ?>
                                                    <td><button class="btn btn-success">Working</button></td>
                                                <?php } else if ($row['status'] == '1') { ?>
                                                    <td><button type="button" class="btn btn-danger">Retired</button></td>
                                                <?php } else { ?>
                                                    <td><button type="button" class="btn btn-warning">Intermission</button></td>
                                                <?php } ?>
                                            </label>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Salary</label>
                                            <select class="form-control" name="salId" required>
                                                <option value="<?= $row['salId'] ?>"><?= $row['salaryAmount'] ?>/<?= $row['salaryType']  ?> </option>
                                                <?php
                                                if (isset($_SESSION['is_login_manager'])) {
                                                    $query = "SELECT * FROM `salarymethod` ";
                                                    $run = mysqli_query($conn, $query);
                                                    $check = mysqli_num_rows($run);
                                                    if ($check > 0) {
                                                        while ($col = mysqli_fetch_array($run)) :  ?>
                                                            <option value="<?php echo $col[0]; ?>"><?php echo $col[4], '/', $col[1]; ?></option>
                                                        <?php endwhile; ?>
                                                    <?php }
                                                } else { ?>
                                                    <?php header('location: ../index.php') ?>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Department</label>
                                            <select class="form-control" name="deptId" required>
                                                <option value="<?= $row['deptId'] ?>"><?= $row['deptName'] ?></option>
                                                <?php
                                                if (isset($_SESSION['is_login_manager'])) {
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
                                        <div class="form-group">
                                            <label>Title</label>
                                            <select class="form-control" name="title" required>
                                                <option value="<?= $row['titleId'] ?>"><?= $row['titleName'] ?></option>
                                                <?php
                                                if (isset($_SESSION['is_login_manager'])) {
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
                                            <label>Insurance</label>
                                            <?php if ($row['insurance'] == NULL) { ?>

                                                <input type="text" class="form-control" placeholder="Enter insurance number" name="insurance">
                                            <?php } else { ?>
                                                <input type="text" class="form-control" name="insurance" value="<?= $row['insurance'] ?>">


                                            <?php } ?>
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