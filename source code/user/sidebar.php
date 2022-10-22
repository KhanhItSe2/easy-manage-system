<div class="wrapper">
    <nav class="sidebar show">
        <div class="sidebar">
            <div class="profile">
                <?php
                if (isset($_SESSION['is_login_manager'])) {
                    $userId = $_SESSION['userId'];
                    $sql = "SELECT * FROM `users` as u JOIN `role` as r ON u.roleId=r.roleId JOIN `employee` as e ON e.empId = u.userId WHERE u.userId = '$userId'";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_num_rows($result);
                    if ($row > 0) {
                        while ($fetch = mysqli_fetch_assoc($result)) { ?>
                            <img src='../../user/User Avatar/<?= $fetch['avt'] ?>' alt="profile_picture">
                            <h3><?= $fetch['userName'] ?></h3>
                            <p><?= $fetch['roleName'] ?></p>

            </div>

            <ul>

                <li class="active">
                    <a href="http://localhost:8888/user/Recruitment/recruitment.php?u_id=<?= $fetch['userId'] ?>" class="con-btn">
                        <span class="icon"><i class="fas fa-cog"></i></span>
                        <span class="item">Recruitment List</span>
                        </span>
                    </a>
                    <a href="http://localhost:8888/user/HRM/hrm.php?u_id=<?= $fetch['userId'] ?>" class="con-btn">
                        <span class="icon"><i class="fas fa-cog"></i></span>
                        <span class="item">List of Employee</span>
                        </span>
                    </a>
                    <a href="#" class="dropdown-btn">
                        <span class="icon"><i class="fas fa-bars"></i></span>
                        <span class="item">Position</span>
                        <span class="fas fa-caret-down first" aria-hidden="true"></span></a>
                    <ul class="dropdown-container">
                        <?php
                            $query = "SELECT * FROM `position`";
                            $run = mysqli_query($conn, $query);
                            $check = mysqli_num_rows($run);
                            if ($check > 0) {
                                while ($fetch = mysqli_fetch_assoc($run)) {
                        ?>
                                <li><a href="http://localhost:8888/user/Position/hrm.php?id=<?= $fetch['posId'] ?>"><?= $fetch['posName'] ?></a></li>
                        <?php }
                            } ?>
                    </ul>
                    <a href="#" class="dropdown-btn">
                        <span class="icon"><i class="fas fa-bars"></i></span>
                        <span class="item">Branch</span>
                        <span class="fas fa-caret-down first" aria-hidden="true"></span></a>
                    <ul class="dropdown-container">
                        <?php
                            $query = "SELECT * FROM `branch`";
                            $run = mysqli_query($conn, $query);
                            $check = mysqli_num_rows($run);
                            if ($check > 0) {
                                while ($fetch = mysqli_fetch_assoc($run)) {
                        ?>
                                <li><a href="http://localhost:8888/user/Branch/hrm.php?id=<?= $fetch['branchId'] ?>"><?= $fetch['branchName'] ?></a></li>
                        <?php }
                            } ?>
                    </ul>
                    <a href="#" class="dropdown-btn">
                        <span class="icon"><i class="fas fa-bars"></i></span>
                        <span class="item">Department</span>
                        <span class="fas fa-caret-down first" aria-hidden="true"></span></a>
                    <ul class="dropdown-container">
                        <?php
                            $query = "SELECT * FROM `department`";
                            $run = mysqli_query($conn, $query);
                            $check = mysqli_num_rows($run);
                            if ($check > 0) {
                                while ($fetch = mysqli_fetch_assoc($run)) {
                        ?>
                                <li><a href="http://localhost:8888/user/Department/hrm.php?id=<?= $fetch['deptId'] ?>"><?= $fetch['deptName'] ?></a></li>
                        <?php }
                            } ?>
                    </ul>
                    <a href="#" class="dropdown-btn">
                        <span class="icon"><i class="fas fa-bars"></i></span>
                        <span class="item">Gender</span>
                        <span class="fas fa-caret-down first" aria-hidden="true"></span></a>
                    <ul class="dropdown-container">

                        <li><a href="http://localhost:8888/user/Gender/hrm.php?id=Male">Male</a></li>
                        <li><a href="http://localhost:8888/user/Gender/hrm.php?id=Female">Female</a></li>
                        <li><a href="http://localhost:8888/user/Gender/hrm.php?id=Other">Other</a></li>

                    </ul>


                </li>
        <?php }
                    }
                } else { ?>
        <?php header('location: ../index.php') ?>
    <?php } ?>
            </ul>
        </div>
    </nav>
</div>
<script>
    var dropdown = document.getElementsByClassName("dropdown-btn");
    var i;

    for (i = 0; i < dropdown.length; i++) {
        dropdown[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var dropdownContent = this.nextElementSibling;
            if (dropdownContent.style.display === "block") {
                dropdownContent.style.display = "none";
            } else {
                dropdownContent.style.display = "block";
            }
        });
    }
</script>
</body>

</html>