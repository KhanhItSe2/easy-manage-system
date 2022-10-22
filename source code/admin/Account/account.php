<?php
session_start();
include("php-script.php");
include("../../Data/db.php");
?>
<!DOCTYPE html>
<html>

<head>
    <title>User Account List</title>
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
    <?php include '../adsidebar.php'; ?>
    <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST" class="form" id="form">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
        <div class="form-group">
            <label>Enter User Name:</label>
            <input type="text" class="form-control" placeholder="Enter User Name" name="userName" required>
        </div>
        <div class="form-group">
            <label>Enter User ID:</label>
            <input type="text" class="form-control" placeholder="Enter User ID" name="userId" required>
        </div>
        <div class="form-group">
            <label>Permision:</label>
            <select class="form-control" name="roleId" required>
                <option value="">Select permission</option>
                <?php
                if (isset($_SESSION['is_login_admin'])) {
                    $sql = "SELECT * FROM `role` ";
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
            <label>Enter Password</label>
            <input type="password" class="form-control" placeholder="Enter Password" name="userPassword" required>
        </div>
        <div class="form-group">
            <label>Enter Password Again</label>
            <input type="password" class="form-control" placeholder="Validate Password" name="cpassword" required>
        </div>
        <button type="submit" class="btn btn-success" name="regist"><span class="glyphicon glyphicon-floppy-saved"> Save</span></button>
    </form>

    <div class="container-fluid" id="align-table">
        <?php
        if (!empty($_SESSION['is_login_admin'])) {
            if (!empty($_GET['action']) && $_GET['action'] == 'search' && !empty($_POST)) {
                $_SESSION['product_filter'] = $_POST;
            }
            if (!empty($_SESSION['product_filter'])) {
                $where = "";
                foreach ($_SESSION['product_filter'] as $field => $value) {
                    if (!empty($value)) {
                        switch ($field) {
                            default:
                                $where .= (!empty($where)) ? " AND " . "`" . $field . "` LIKE '%" . $value . "%'" : "`" . $field . "` LIKE '%" . $value . "%'";
                                break;
                        }
                    }
                }
                extract($_SESSION['product_filter']);
            }
            $count = mysqli_query($conn, "SELECT COUNT(userId) as total FROM `users`");
            $data = mysqli_fetch_assoc($count);
            $item_per_page = 12;
            $current_page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
            $offset = ($current_page - 1) * $item_per_page;
            $totalRecords = $data['total'];
            $totalPages = ceil($totalRecords / $item_per_page);
            if (!empty($where)) {
                $sql = "SELECT  * FROM `users` where (" . $where . ") LIMIT " . $item_per_page . " OFFSET " . $offset;
            } else {
                $sql = "SELECT  * FROM `users` ORDER BY `userId` LIMIT " . $item_per_page . " OFFSET " . $offset;
            }
            $result = mysqli_query($conn, $sql);
        }
        ?>
        <form id="" action="account.php?action=search" method="POST">
            <div class="menu">
                <h2>User Account List (<?php echo $data['total'] ?>)</h2>
                <div class="float-item">
                    <label>ID: </label>
                    <input type="text" name="userId" value="">
                    <label>Name: </label>
                    <input type="text" name="userName" value="">
                    <button type="submit" class="btn btn-basic"><span class="glyphicon glyphicon-filter"></span> Search</button>
                    <button type="button" class="btn btn-success" onclick="window.location.reload()"><span class="glyphicon glyphicon-refresh"></span> Refresh</button>
                    <button type="button" class="btn btn-primary" onclick="openNav()"><span class="glyphicon glyphicon-pencil"></span> Register</button>
                </div>
            </div>
        </form>
        <table class="table table-responsible">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Full Name</th>
                    <th>Permission</th>
                    <th>Updated by</th>
                    <th>Updated date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                ?>
                    <tr>
                        <td><?= $row['userId']; ?></td>
                        <td><?= $row['userName']; ?></td>
                        <td><?= $row['roleId']; ?></td>
                        <td><?= $row['userUpdated']; ?></td>
                        <td><?= $row['day']; ?></td>
                        <td><a href="./delete.php?u_id=<?= $row['userId'] ?>"><button type="button" class="btn btn-danger" name="delete">Delete</button></a>
                            <a href="./updateuser.php?u_id=<?= $row['userId'] ?>&u_name=<?= $row['userName'] ?>&roles=<?= $row['roleId'] ?>"><button type="button" class="btn btn-success" name="update">Update</button></a>
                            <a href="./changePassword.php?u_id=<?= $row['userId'] ?>&u_name= <?= $row['userName'] ?>"><button type="button" class="btn btn-info" name="change">Change Password</button></a>
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