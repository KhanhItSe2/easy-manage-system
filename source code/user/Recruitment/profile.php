<?php
session_start();
include('../../Data/db.php');
?>
<?php
if ($_SESSION['is_login_manager']) {

    if (isset($_POST['approved'])) {
        $recruitmentId = $_POST['recruitmentId'];
        $fullName =  $_POST['fullName'];
        $address =  $_POST['address'];
        $tax = $_POST['tax'];
        $email =  $_POST['email'];
        $sex =  $_POST['sex'];
        $bDate =  $_POST['bDate'];
        $phone =  $_POST['phone'];
        $nationality  =  $_POST['nalId'];
        $academy =  $_POST['academy'];
        $idCard =  $_POST['idCard'];
       

        $empId = $_POST['empId'];

        $ethnic =  $_POST['ethnicId'];
        $religion =  $_POST['religionId'];
        $startDate = $_POST['startDate'];
        $endDate = $_POST['endDate'];
        $position =  $_POST['posId'];
        $branch =  $_POST['branch'];
        $salary = $_POST['salary'];
        $department =  $_POST['deptId'];
        $title =  $_POST['title'];
        $avt = $_POST['avt'];
        $insurance = $_POST['insurance'];


        $userUpdated = $_POST['managerId'];


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
            $insert = "INSERT INTO `employee` (empId, fullName, avt, address, email, sex, bDate, phone, posId,
             deptId, startDate, endDate, salId, idCard, taxable, insurance, ethnicId, religionId, nalId, 
             academy, branch, title, status, managerId)
                     VALUES ('$empId','$fullName','$avt','$address','$email','$sex',
                     '$bDate','$phone','$position','$department','$startDate','$endDate',
                     '$salary','$idCard','$tax','$insurance','$ethnic','$religion',
                     '$nationality','$academy','$branch','$title','0','$userUpdated')";

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
                                            if (isset($_SESSION['is_login_manager'])) {
                                                $userId = $_GET['recruitment_id'];
                                                $sql = "SELECT * FROM `candidate` WHERE candidateId = '$userId'";
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
                                        $sql = "SELECT  * FROM `candidate` as c
                                        JOIN `academic` as a ON a.acaId = c.acaId  
                                        JOIN `position` as p ON p.posId = c.posId
                                        JOIN `department` as d ON d.deptId = c.deptId 
                                        JOIN `title` as t ON t.titleId = c.titleId
                                        JOIN `branch` as b ON b.branchId = c.branchId  WHERE candidateId = $id";
                                        $result = mysqli_query($conn, $sql);

                                        while ($row = mysqli_fetch_assoc($result)) {

                                        ?>

                                            <div class="form-group">
                                                <label for="recruitmentId">Recruitment ID</label>
                                                <input type="text" class="form-control" id="recruitmentId" name="recruitmentId" value="<?= $row['candidateId'] ?>" readonly>
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
                                                <input type="text" class="form-control" placeholder="Enter tax number" name="tax">
                                            </div>
                                    </div>
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label>Ethnic</label>
                                            <select class="form-control" name="ethnicId" required>
                                                <option value="">Select Ethnic</option>
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
                                                <option value="">Select Religion</option>
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
                                            <input type="date" class="form-control" name="startDate">
                                        </div>
                                        <div class="form-group">
                                            <label>End Date</label>
                                            <input type="date" class="form-control" name="endDate">
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
                                                <option value="">Select Nationality</option>
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
                                            <input type="hidden" class="form-control" name="managerId" value="<?= $row['empId'] ?>" readonly />

                                            <label>Recruitment Profile Status: <?php if ($row['status'] == '0') { ?>
                                                    <td><button class="btn btn-warning">Interviewing by <?= $row['empId'] ?></button></td>

                                                <?php } else if ($row['status'] == '1') { ?>
                                                    <td><button type="button" class="btn btn-danger">Rejected by <?= $row['empId'] ?></button></td>
                                                <?php } else if ($row['status'] == '2') { ?>
                                                    <td><button type="button" class="btn btn-info">New</button></td>
                                                <?php } else { ?>
                                                    <td><button type="button" class="btn btn-success">Approved by <?= $row['empId'] ?></button></td>
                                                <?php } ?>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Salary</label>
                                            <select class="form-control" name="salary" required>
                                                <option value="">Select Salary</option>
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
                                            <input type="text" class="form-control" placeholder="Enter insurance number" name="insurance">
                                        </div>
                                        <div class="form-group">
                                            <label>Employee ID </label>
                                            <input type="text" placeholder="(Enter if approvement)" class="form-control" name="empId">
                                        </div>
                                        <div class="form-group">
                                            <?php
                                            if (isset($_SESSION['is_login_manager'])) {
                                                $userId = $_GET['recruitmentId_name'];
                                                $sql = "SELECT  * FROM `employee` as emp JOIN `ethnic` as e ON emp.ethnicId = e.ethnicId
                                                JOIN `religion` as re ON emp.religionId = re.religionId 
                                                JOIN `nationality` as n ON n.nationId = emp.nalId
                                                JOIN `academic` as a ON a.acaId = emp.academy 
                                                JOIN `position` as p ON p.posId = emp.posId
                                                JOIN `branch` as b ON b.branchId = emp.branch
                                                JOIN `department` as d ON d.deptId = emp.deptId
                                                JOIN `salarymethod` as s ON s.salaryId = emp.salId 
                                                JOIN `title` as t ON t.titleId = emp.title WHERE fullName = '$userId'";

                                                $query = mysqli_query($conn, $sql);
                                                $run = mysqli_num_rows($query);
                                                if ($run > 0) {
                                                    while ($fetch = mysqli_fetch_assoc($query)) { ?>
                                                        <label>Employee Profile Status: <?php if ($fetch['status'] == '0') { ?>
                                                                <td><button class="btn btn-success">Working</button></td>
                                                            <?php } else if ($run['status'] == '1') { ?>
                                                                <td><button type="button" class="btn btn-danger">Retired</button></td>
                                                            <?php } else { ?>
                                                                <td><button type="button" class="btn btn-warning">Intermission</button></td>
                                                            <?php } ?>
                                                        </label>
                                                <?php }
                                                }
                                            } else { ?>
                                                <?php header('location: ../index.php') ?>
                                            <?php } ?>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <div class="container text-center">
                                            <td><button type="button" class="btn btn-secondary" onclick="goBack()" name="goback">Go Back</button></td>

                                            <button type="submit" class="btn btn-primary" name="approved">Update</button>



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