<?php
session_start();
include("../Data/db.php");
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
    $academy = mysqli_real_escape_string($conn, $_POST['academy']);
    $position = mysqli_real_escape_string($conn, $_POST['posId']);
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $department = mysqli_real_escape_string($conn, $_POST['deptId']);

    $recruitmentquery = "SELECT * FROM `candidate` WHERE idCard  ='$idCard' AND email  ='$email'  ";
    $query = mysqli_query($conn, $recruitmentquery);

    $recruitmentCheck = mysqli_num_rows($query);

    if ($recruitmentCheck > 0) {
?>
        <script type="text/javascript">
            alert("Your email is exist. Please check again");
            window.location = "".$_SERVER['HTTP_REFERER'];
        </script><?php
                } else {
                    echo $fullName,
                    $address,
                    $email,
                    $sex,
                    $bDate,
                    $branch,
                    $phone,
                    $idCard,
                    $academy,
                    $position,
                    $title,
                    $department;
                    $insert = "INSERT INTO `candidate` (candidateId, fullName, address, email, sex, bDate, phone, idCard, acaId, posId,branchId,status,titleId,deptId)
                     VALUES ('','$fullName','$address','$email','$sex','$bDate','$phone','$idCard','$academy','$position','$branch','2','$title','$department')";
                    $iquery = mysqli_query($conn, $insert);
                    if ($iquery) {
                        $recruitmentquery = "SELECT * FROM `candidate` WHERE idCard  ='$idCard' AND email  ='$email'   ";
                        $query = mysqli_query($conn, $recruitmentquery);
                        $recruitmentCheck = mysqli_num_rows($query);
                        if ($recruitmentCheck > 0) {
                            while ($fetch = mysqli_fetch_array($query)) {
                                if ($fetch['avt'] == NULL) {
                                    $u_avt = $_FILES['avt']['name'];
                                    echo $u_avt;
                                    $avt_tmp = $_FILES['avt']['tmp_name'];
                                    echo $avt_tmp;
                                    $id = $fetch['candidateId'];
                                    echo $id;
                                    move_uploaded_file($avt_tmp, "../user/User Avatar/$u_avt.$id");
                                    $u_avt_query = "UPDATE `candidate` SET avt='$u_avt.$id' WHERE candidateId = '$id'";
                                    echo $u_avt_query;
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
            ?>
            <script type="text/javascript">
                alert("Save Successfully. We will contact you soon!");
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
<!DOCTYPE html>
<html lang="en">

<head itemscope="" itemtype="http://schema.org/WebSite">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Application Form</title>
    <script src="/cache-js/cache-1635427806-97135bbb13d92c11d6b2a92f6a36685a.js" type="text/javascript"></script>
</head>

<body>
    <h1 style="text-align: center"> APPLICATION FORM </h1>
    <div id="snippetContent">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
        <div class="container">
            <div class="row gutters">
                <div class="col">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="row gutters">
                                <div class="col">
                                    <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST" class="form" id="form">
                                        <div class="form-group">
                                            <label for="fullName">Full Name</label>
                                            <input type="text" class="form-control" id="fullName" placeholder="Enter your full name" value="" name="fullName" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="address">Address</label>
                                            <input type="text" class="form-control" id="address" value="" placeholder="Enter your address" name="address" required>
                                        </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Academy</label>
                                        <select class="form-control" name="academy" required>
                                            <option value="">Select Academy</option>
                                            <?php
                                            $query = "SELECT * FROM `academic` ";
                                            $run = mysqli_query($conn, $query);
                                            $check = mysqli_num_rows($run);
                                            if ($check > 0) {
                                                while ($col = mysqli_fetch_array($run)) :  ?>
                                                    <option value="<?php echo $col[0]; ?>"><?php echo $col[1]; ?></option>
                                                <?php endwhile; ?>
                                            <?php }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Identity Card Number</label>
                                        <input type="text" class="form-control" placeholder="Enter ID card number" name="idCard" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter your email" name="email" value="" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Gender</label>
                                        <select class="form-control" name="sex" required>
                                            <option value="">Select Gender</option>
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
                                            <option value="">Select Position</option>
                                            <?php
                                            $query = "SELECT * FROM `position` ";
                                            $run = mysqli_query($conn, $query);
                                            $check = mysqli_num_rows($run);
                                            if ($check > 0) {
                                                while ($col = mysqli_fetch_array($run)) :  ?>
                                                    <option value="<?php echo $col[0]; ?>"><?php echo $col[1]; ?></option>
                                                <?php endwhile; ?>
                                            <?php }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Branch</label>
                                        <select class="form-control" name="branch" required>
                                            <option value="">Select Branch</option>
                                            <?php
                                            $query = "SELECT * FROM `branch` ";
                                            $run = mysqli_query($conn, $query);
                                            $check = mysqli_num_rows($run);
                                            if ($check > 0) {
                                                while ($col = mysqli_fetch_array($run)) :  ?>
                                                    <option value="<?php echo $col[0]; ?>"><?php echo $col[1]; ?></option>
                                                <?php endwhile; ?>
                                            <?php }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Birth Date </label>
                                        <input type="date" class="form-control" value="" name="bDate" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">Phone Number</label>
                                        <input type="text" class="form-control" placeholder="Enter your phone number" id="phone" value="" name="phone" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Department</label>
                                        <select class="form-control" name="deptId" required>
                                            <option value="">Select Department</option>
                                            <?php
                                            $query = "SELECT * FROM `department` ";
                                            $run = mysqli_query($conn, $query);
                                            $check = mysqli_num_rows($run);
                                            if ($check > 0) {
                                                while ($col = mysqli_fetch_array($run)) :  ?>
                                                    <option value="<?php echo $col[0]; ?>"><?php echo $col[1]; ?></option>
                                                <?php endwhile; ?>
                                            <?php }
                                            ?>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Title</label>
                                        <select class="form-control" name="title" required>
                                            <option value="">Select Title</option>
                                            <?php
                                            $query = "SELECT * FROM `title` ";
                                            $run = mysqli_query($conn, $query);
                                            $check = mysqli_num_rows($run);
                                            if ($check > 0) {
                                                while ($col = mysqli_fetch_array($run)) :  ?>
                                                    <option value="<?php echo $col[0]; ?>"><?php echo $col[1]; ?></option>
                                                <?php endwhile; ?>
                                            <?php }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="avt">Avatar Profile</label>
                                        <input type="file" class="form-control" name='avt' size='60'>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="container text-center">
                                        <td><button type="button" class="btn btn-secondary" onclick="goBack()" name="goback">Go Back</button></td>
                                        <td> <button type="submit" class="btn btn-primary" name="regist">Send</button></td>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
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