<?php
session_start();
include('../../Data/db.php');
if ($_SESSION['is_login_employer']) {
    if (isset($_POST['update'])) {
        $rid = $_GET['recruitment_id'];

        $recruitmentquery = "SELECT * FROM `recruitment` WHERE recruitmentId = '$rid'  ";
        $query = mysqli_query($conn, $recruitmentquery);
        $recruitmentCheck = mysqli_num_rows($query);

        if ($recruitmentCheck > 0) {

            while ($fetch = mysqli_fetch_array($query)) {
                if ($fetch['avt'] !== NULL) {
                    $u_avt = $_FILES['avt']['name'];
                    $avt_tmp = $_FILES['avt']['tmp_name'];
                    $id = $fetch['recruitmentId'];
                    move_uploaded_file($avt_tmp, "../../user/User Avatar/$u_avt.$id");
                    $u_avt_query = "UPDATE `recruitment` SET avt='$u_avt' WHERE recruitmentId = '$id'";
                    $result = mysqli_query($conn, $u_avt_query);
                    if ($result) {
?>
                        <script type="text/javascript">
                            alert("Save Successfully");
                            window.location = "".$_SERVER['HTTP_REFERER'];
                            exit();
                        </script> <?php
                                }
                            } else { ?>
                    <script type="text/javascript">
                        alert("AVT exist");
                        window.location = "".$_SERVER['HTTP_REFERER'];
                        exit();
                    </script><?php
                            }
                        }
                    }
                }
            } else {
                header("Location: ../index.php");
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
            <form class="form-vertical" enctype="multipart/form-data" action="" method="POST">
                <div class="form-group">
                    <label class="control-label col-sm-4" for="recruitmentId">Recruitment Id</label>
                    <input type="text" class="form-control" name="recruitmentId" value="<?= $row['recruitmentId'] ?>" readonly>
                </div>
                <?php if (isset($_POST['approved'])) {
                ?>
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="empId">Employee Id</label>
                        <input type="text" class="form-control" name="empId" required>
                    </div> <?php
                        } ?>

                <div class="form-group">
                    <label>Full Name:<?= $row['fullName'] ?></label>
                    <input type="hidden" class="form-control" value="<?= $row['fullName'] ?>" name="fullName" readonly>
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
                    <label>Address:<?= $row['address'] ?></label>
                    <input type="hidden" class="form-control" value="<?= $row['address'] ?>" name="address" readonly>
                </div>
                <div class="form-group">
                    <label>Email:<?= $row['email'] ?></label>
                    <input type="hidden" class="form-control" value="<?= $row['email'] ?>" name="email" readonly>
                </div>
                <div class="form-group">
                    <label>Gender:<?= $row['sex'] ?></label>
                    <input type="hidden" class="form-control" value="<?= $row['sex'] ?>" name="gender" readonly>
                </div>
                <div class="form-group">
                    <label>Birth Date:<?= $row['bDate'] ?></label>
                    <input type="hidden" class="form-control" value="<?= $row['bDate'] ?>" name="bDate" readonly>
                </div>
                <div class="form-group">
                    <label>Phone Number:<?= $row['phone'] ?></label>
                    <input type="hidden" class="form-control" value="<?= $row['phone'] ?>" name="phone" readonly>
                </div>
                <div class="form-group">
                    <label>Identity Card Number:<?= $row['idCard'] ?></label>
                    <input type="hidden" class="form-control" value="<?= $row['idCard'] ?>" name="idCard" readonly>
                </div>
                <div class="form-group">
                    <label>Ethnic: <?= $row['ethnicName'] ?></label>
                    <input type="hidden" class="form-control" value="<?= $row['ethnicId'] ?>" name="ethnic" readonly>
                </div>

                <div class="form-group">
                    <label>Religion:<?= $row['religionName'] ?></label>
                    <input type="hidden" class="form-control" value="<?= $row['religionId'] ?>" name="religion" readonly>
                </div>
                <div class="form-group">
                    <label>Nationality:<?= $row['nationName'] ?></label>
                    <input type="hidden" class="form-control" value="<?= $row['nationId'] ?>" name="nationality" readonly>

                </div>

                <div class="form-group">
                    <label>Academy:<?= $row['acaLevel'] ?></label>
                    <input type="hidden" class="form-control" value="<?= $row['acaId'] ?>" name="academy" readonly>

                </div>
                <div class="form-group">
                    <label>Positon:<?= $row['posName'] ?></label>
                    <input type="hidden" class="form-control" value="<?= $row['posId'] ?>" name="position" readonly>

                </div>
                <div class="form-group">
                    <label>Branch:<?= $row['branchName'] ?></label>
                    <input type="hidden" class="form-control" placeholder="<?= $row['branchName'] ?>" value="<?= $row['branchId'] ?>" name="branch" readonly>

                </div>
                <div class="form-group">
                    <label>Job:<?= $row['job'] ?></label>
                    <input type="hidden" class="form-control" value="<?= $row['job'] ?>" name="job" readonly>

                </div>
                <div class="form-group">
                    <label>Profile Status:<?php if ($row['status'] == 'Processing') { ?>
                        <td><button class="btn btn-warning"><?= $row['status']; ?></button></td>
                    <?php } else if ($row['status'] == 'Approved') { ?>
                        <td><button type="button" class="btn btn-success"><?= $row['status']; ?></button></td>
                    <?php } else { ?>
                        <td><button type="button" class="btn btn-danger"><?= $row['status']; ?></button></td>
                    <?php } ?> By <?= $row['approved'] ?>
                    </label>


                </div>
                <?php
                if (isset($error)) {
                    echo "<div class='alert alert-danger alert-dismissible'>
                        <button type='button' class='close' data-dismiss='alert'>&times;</button>
                        $error
                      </div>";
                }
                ?>
                <div class="form-group">
                    <div class="container text-center">
                        <td><button type="button" class="btn btn-secondary" onclick="goBack()" name="goback">Go Back</button></td>
                        <button type="submit" class="btn btn-success" name="update">Update</button>

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