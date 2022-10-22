<?php
session_start();
include("php-script.php");
include("../../Data/db.php");
if (!isset($_SESSION['is_login_manager'])) {
    header('Location: ../index.php');
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Recruitment List</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        <?php
        include '../../style.css';
        ?>
    </style>
</head>

<body>
    <?php include '../../header.php'; ?>
    <?php include '../sidebar.php'; ?>
    <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST" class="form" id="form">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
        <div class="form-group">
            <label>Full Name:</label>
            <input type="text" class="form-control" placeholder="Enter Full Name" name="fullName" required>
        </div>
        <div class="form-group">
            <label>Address:</label>
            <input type="text" class="form-control" placeholder="Enter Address" name="address" required>
        </div>
        <div class="form-group">
            <label>Email:</label>
            <input type="text" class="form-control" placeholder="Enter Email" name="email" required>
        </div>
        <div class="form-group">
            <label>Gender:</label>
            <select class="form-control" name="sex" required>
                <option value="">Select gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
            </select>
        </div>
        <div class="form-group">
            <label>Birth Date:</label>
            <input type="date" class="form-control" placeholder="Enter Birth Date" name="bDate" required>
        </div>
        <div class="form-group">
            <label>Phone Number:</label>
            <input type="text" class="form-control" placeholder="Enter Phone Number" name="phone" required>
        </div>
        <div class="form-group">
            <label>Identity Card Number:</label>
            <input type="text" class="form-control" placeholder="Enter ID Number" name="idCard" required>
        </div>
        <div class="form-group">
            <label>Academy:</label>
            <select class="form-control" name="academy" required>
                <option value="">Select academy</option>
                <?php
                if (isset($_SESSION['is_login_manager'])) {
                    $sql = "SELECT * FROM `academic` ";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_num_rows($result);
                    if ($row > 0) {
                        while ($fetch = mysqli_fetch_array($result)) :  ?>

                            <option value="<?php echo $fetch[0]; ?>"><?php echo $fetch[1]; ?></option>
                        <?php endwhile; ?>
                    <?php }
                } else { ?>
                    <?php header('location: ../index.php') ?>
                <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <label>Department:</label>
            <select class="form-control" name="department" required>
                <option value="">Select department</option>
                <?php
                if (isset($_SESSION['is_login_manager'])) {
                    $sql = "SELECT * FROM `department` ";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_num_rows($result);
                    if ($row > 0) {
                        while ($fetch = mysqli_fetch_array($result)) :  ?>

                            <option value="<?php echo $fetch[0]; ?>"><?php echo $fetch[1]; ?></option>
                        <?php endwhile; ?>
                    <?php }
                } else { ?>
                    <?php header('location: ../index.php') ?>
                <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <label>Positon:</label>
            <select class="form-control" name="position" required>
                <option value="">Select positon</option>
                <?php
                if (isset($_SESSION['is_login_manager'])) {
                    $sql = "SELECT * FROM `position` ";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_num_rows($result);
                    if ($row > 0) {
                        while ($fetch = mysqli_fetch_array($result)) :  ?>

                            <option value="<?php echo $fetch[0]; ?>"><?php echo $fetch[1]; ?></option>
                        <?php endwhile; ?>
                    <?php }
                } else { ?>
                    <?php header('location: ../index.php') ?>
                <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <label>Branch:</label>
            <select class="form-control" name="branch" required>
                <option value="">Select positon</option>
                <?php
                if (isset($_SESSION['is_login_manager'])) {
                    $sql = "SELECT * FROM `branch` ";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_num_rows($result);
                    if ($row > 0) {
                        while ($fetch = mysqli_fetch_array($result)) :  ?>

                            <option value="<?php echo $fetch[0]; ?>"><?php echo $fetch[1]; ?></option>
                        <?php endwhile; ?>
                    <?php }
                } else { ?>
                    <?php header('location: ../index.php') ?>
                <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <label>Title:</label>
            <select class="form-control" name="title" required>
                <option value="">Select title</option>
                <?php
                if (isset($_SESSION['is_login_manager'])) {
                    $sql = "SELECT * FROM `title` ";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_num_rows($result);
                    if ($row > 0) {
                        while ($fetch = mysqli_fetch_array($result)) :  ?>

                            <option value="<?php echo $fetch[0]; ?>"><?php echo $fetch[1]; ?></option>
                        <?php endwhile; ?>
                    <?php }
                } else { ?>
                    <?php header('location: ../index.php') ?>
                <?php } ?>
            </select>
        </div>
        <button type="submit" class="btn btn-success" name="regist"><span class="glyphicon glyphicon-floppy-saved"> Save</span></button>
    </form>

    <div class="container-fluid" id="align-table">
        <?php
        if (!empty($_SESSION['is_login_manager'])) {
            if (!empty($_GET['action']) && $_GET['action'] == 'searchR' && !empty($_POST)) {
                $_SESSION['product_filter1'] = $_POST;
            }
            if (!empty($_SESSION['product_filter1'])) {
                $where = "";
                foreach ($_SESSION['product_filter1'] as $field => $value) {
                    if (!empty($value)) {
                        switch ($field) {
                            case 'fullName':
                                $where .= (!empty($where)) ? " AND " . "`" . $field . "` LIKE '%" . $value . "%'" : "`" . $field . "` LIKE '%" . $value . "%'";
                                break;
                            default:
                                $where .= (!empty($where)) ? " AND " . "`" . $field . "` = " . $value . "" : "`" . $field . "` = " . $value . "";
                                break;
                        }
                    }
                }
                extract($_SESSION['product_filter1']);
            }
            $count = mysqli_query($conn, "SELECT COUNT(candidateId) as total FROM `candidate`");
            $data = mysqli_fetch_assoc($count);
            $item_per_page = 12;
            $current_page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
            $offset = ($current_page - 1) * $item_per_page;
            $totalRecords = $data['total'];
            $totalPages = ceil($totalRecords / $item_per_page);
            if (!empty($where)) {
                $sql = "SELECT  * FROM `candidate`  as c
                JOIN `academic` as a ON a.acaId = c.acaId 
                JOIN `position` as p ON p.posId = c.posId
                JOIN `department` as d ON d.deptId = c.deptId 
                JOIN `title` as t ON t.titleId = c.titleId
                JOIN `branch` as b ON b.branchId = c.branchId 
              where (" . $where . ") LIMIT " . $item_per_page . " OFFSET " . $offset;
            } else {
                $sql = "SELECT  * FROM `candidate`  as c
                JOIN `academic` as a ON a.acaId = c.acaId 
                JOIN `position` as p ON p.posId = c.posId
                JOIN `department` as d ON d.deptId = c.deptId 
                JOIN `title` as t ON t.titleId = c.titleId
                JOIN `branch` as b ON b.branchId = c.branchId 
                ORDER BY `candidateId` LIMIT " . $item_per_page . " OFFSET " . $offset;
            }
            $result = mysqli_query($conn, $sql);
        }

        ?>
        <form id="" action="recruitment.php?action=searchR" method="POST">
            <div class="menu">
                <h2>Recruitment List (<?php echo $data['total'] ?>)</h2>
                <div class="float-item">
                    <label>ID: </label>
                    <input type="text" name="candidateId" value="">
                    <label>Name: </label>
                    <input type="text" name="fullName" value="">
                    <button type="submit" class="btn btn-basic"><span class="glyphicon glyphicon-filter"></span> Search</button>
        </form>

        <form id="" action="excel.php" method="POST">
            <button type="submit" class="btn btn-success" name="export_excel"><span class="glyphicon glyphicon-circle-arrow-down"></span> Export</button>
        </form> <button type="button" class="btn btn-info" onclick="openNav()"><span class="glyphicon glyphicon-pencil"></span> Recruit</button>
    </div>
    </div>
    <table class="table table-responsible">
        <thead>
            <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Birth Date</th>
                <th>Nominee</th>
                <th>Title</th>
                <th>Profile Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
            ?>
                <tr>
                    <td><?= $row['candidateId']; ?></td>
                    <td><?= $row['fullName']; ?></td>
                    <td><?= $row['bDate']; ?></td>
                    <td><?= $row['posName']; ?></td>
                    <td><?= $row['titleName']; ?></td>
                    <?php if ($row['status'] == '0') { ?>
                        <td><button class="btn btn-warning">Interviewing</button></td>
                    <?php } else if ($row['status'] == '1') { ?>
                        <td><button type="button" class="btn btn-danger">Rejected</button></td>
                    <?php } else if ($row['status'] == '2') { ?>
                        <td><button type="button" class="btn btn-info">New</button></td>
                    <?php } else { ?>
                        <td><button type="button" class="btn btn-success">Approved</button></td>
                    <?php } ?>


                    <td>
                        <a href="./profile.php?recruitment_id=<?= $row['candidateId'] ?>&recruitmentId_name=<?= $row['fullName'] ?>"><button type="button" class="btn btn-primary" name="detail">Detail</button></a>
                    </td>
                <tr>
                <?php } ?>
        </tbody>
    </table>
    <div id="pagination">
        <?php
        if ($current_page > 3) {
            $first_page = 1;
        ?>
            <a class="page-item" href="?per_page=<?= $item_per_page ?>&page=<?= $first_page ?>">First</a>
        <?php
        }
        if ($current_page > 1) {
            $prev_page = $current_page - 1;
        ?>
            <a class="page-item" href="?per_page=<?= $item_per_page ?>&page=<?= $prev_page ?>">Prev</a>
        <?php }
        ?>
        <?php for ($num = 1; $num <= $totalPages; $num++) { ?>
            <?php if ($num != $current_page) { ?>
                <?php if ($num > $current_page - 3 && $num < $current_page + 3) { ?>
                    <a class="page-item" href="?per_page=<?= $item_per_page ?>&page=<?= $num ?>"><?= $num ?></a>
                <?php } ?>
            <?php } else { ?>
                <strong class="current-page page-item"><?= $num ?></strong>
            <?php } ?>
        <?php } ?>
        <?php
        if ($current_page < $totalPages - 1) {
            $next_page = $current_page + 1;
        ?>
            <a class="page-item" href="?per_page=<?= $item_per_page ?>&page=<?= $next_page ?>">Next</a>
        <?php
        }
        if ($current_page < $totalPages - 3) {
            $end_page = $totalPages;
        ?>
            <a class="page-item" href="?per_page=<?= $item_per_page ?>&page=<?= $end_page ?>">Last</a>
        <?php
        }
        ?>
    </div>
    </div>
    <script>
        function openNav() {
            document.getElementById("form").style.width = "500px";
            document.getElementById("form").style.paddingRight = "30px";
            document.getElementById("form").style.paddingLeft = "30px";
        }

        function closeNav() {
            document.getElementById("form").style.width = "0";
            document.getElementById("form").style.paddingRight = "0";
            document.getElementById("form").style.paddingLeft = "0";
        }
    </script>


</body>

</html>