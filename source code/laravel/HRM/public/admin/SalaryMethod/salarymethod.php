<?php
session_start();
include("php-script.php");
include("../../Data/db.php");
?>
<!DOCTYPE html>
<html>

<head>
    <title>Salary Method List</title>
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
            <label>Method ID:</label>
            <input type="text" class="form-control" placeholder="Enter method ID" name="salaryId" required>
        </div>
        <div class="form-group">
            <label>Period:</label>
            <select class="form-control" name="salaryType">
                <option selected disabled="disabled">Select method</option>
                <option value="per Hour">per Hour</option>
                <option value="per Day">per Day</option>
                <option value="per Week">per Week</option>
                <option value="per Month">per Month</option>
            </select>
        </div>
        <div class="form-group">
            <label>Amount:</label>
            <input type="text" class="form-control" placeholder="Enter amount of salary" name="salaryAmount" required>
        </div>
        <button type="submit" class="btn btn-success" name="submit"><span class="glyphicon glyphicon-floppy-saved"> Save</span></button>
    </form>
    <div class="container-fluid" id="align-table">
        <?php
        $sql = "SELECT  * FROM `salarymethod`";
        $result = mysqli_query($conn, $sql);
        $count = mysqli_query($conn, "SELECT COUNT(salaryId) as total FROM `salarymethod`");
        $data = mysqli_fetch_assoc($count);
        ?>
        <div class="menu">
            <h2>Salary Method List (<?php echo $data['total'] ?>)</h2>
            <button type="button" class="btn btn-info" onclick="openNav()"><span class="glyphicon glyphicon-plus"></span> Add</button>
            <button type="button" class="btn btn-success" onclick="window.location.reload()"><span class="glyphicon glyphicon-refresh"></span> Refresh</button>
        </div>
        <table class="table table-responsible">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Amount</th>
                    <th>Method</th>
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
                        <td><?= $row['salaryId']; ?></td>
                        <td><?= $row['salaryAmount']; ?></td>
                        <td><?= $row['salaryType']; ?></td>
                        <td><?= $row['userUpdated']; ?></td>
                        <td><?= $row['day']; ?></td>
                        <td><a href="./delete.php?id=<?= $row['salaryId'] ?>"><button type="button" class="btn btn-danger" name="delete">Delete</button></a></td>
                    <tr>
                    <?php } ?>
            </tbody>
        </table>
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