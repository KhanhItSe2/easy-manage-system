<?php
session_start();
include("../../Data/db.php");
?>
<!DOCTYPE html>
<html>

<head>
    <title>Branch</title>
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

    <div class="container-fluid" id="align-table">
        <?php
        if (!empty($_SESSION['is_login_manager'])) {
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
            $id = $_GET['id'];
            $count = mysqli_query($conn, "SELECT COUNT(empId) as total FROM `employee` WHERE branch = '$id'");
            $data = mysqli_fetch_assoc($count);
            $item_per_page = 12;
            $current_page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
            $offset = ($current_page - 1) * $item_per_page;
            $totalRecords = $data['total'];
            $totalPages = ceil($totalRecords / $item_per_page);
            if (!empty($where)) {
                $sql = "SELECT  * FROM `employee` WHERE branch = '$id' where (" . $where . ") LIMIT " . $item_per_page . " OFFSET " . $offset;
            } else {
                $sql = "SELECT  * FROM `employee` WHERE branch = '$id' ORDER BY `empId` LIMIT " . $item_per_page . " OFFSET " . $offset;
            }
            $result = mysqli_query($conn, $sql);
        }
        ?>
        <form id="" action="hrm.php?action=search&id=<?= $id ?>" method="POST">
            <div class="menu">
                <h2>List of Employee (<?php echo $data['total'] ?>)</h2>
                <div class="float-item">
                    <label>ID: </label>
                    <input type="text" name="empId" value="">
                    <label>Name: </label>
                    <input type="text" name="fullName" value="">
                    <button type="submit" class="btn btn-basic"><span class="glyphicon glyphicon-filter"></span> Search</button>
                    <button type="button" class="btn btn-success" onclick="window.location.reload()"><span class="glyphicon glyphicon-refresh"></span> Refresh</button>
                </div>
            </div>
        </form>
        <table class="table table-responsible">
            <thead>
                <tr>
                <th>ID</th>
                    <th>Name</th>
                    <th>Sex</th>
                    <th>Birthdate</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                ?>
                    <tr>
                        <td><?= $row['empId']; ?></td>
                        <td><?= $row['fullName']; ?></td>
                        <td><?= $row['sex']; ?></td>
                        <td><?= $row['bDate']; ?></td>
                        <td><?= $row['phone']; ?></td>
                        <td><?= $row['email']; ?></td>
                        <?php if ($row['status'] == '0') { ?>
                            <td><button class="btn btn-success">Working</button></td>
                        <?php } else if ($row['status'] == '1') { ?>
                            <td><button type="button" class="btn btn-danger">Retired</button></td>
                        <?php } else { ?>
                            <td><button type="button" class="btn btn-warning">Intermission</button></td>
                        <?php } ?>
                        <td><a href="./profile.php?id=<?= $row['empId'] ?>"><button type="button" class="btn btn-link" name="detail">Details</button></a></td>
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
            document.getElementById("form").style.width = "750px";
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