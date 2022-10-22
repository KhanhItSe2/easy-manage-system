<div class="wrapper">
    <nav class="sidebar show">
        <div class="sidebar">
            <div class="profile">
                <?php
                if (isset($_SESSION['is_login_admin'])) {
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
                    <a href="#" class="dropdown-btn">
                        <span class="icon"><i class="fas fa-bars"></i></span>
                        <span class="item">Category</span>
                        <span class="fas fa-caret-down first" aria-hidden="true"></span></a>
                    <ul class="dropdown-container">
                        <li><a href="http://localhost:8888/admin/Academic/academic.php">Academic</a></li>
                        <li><a href="http://localhost:8888/admin/Branch/branch.php">Branch</a></li>
                        <li><a href="http://localhost:8888/admin/Department/department.php">Department</a></li>
                        <li><a href="http://localhost:8888/admin/Ethnic/ethnic.php">Ethnic</a></li>
                        <li><a href="http://localhost:8888/admin/Nationality/nationality.php">Nationality</a></li>
                        <li><a href="http://localhost:8888/admin/Position/position.php">Position</a></li>
                        <li><a href="http://localhost:8888/admin/Religion/religion.php">Religion</a></li>
                        <li><a href="http://localhost:8888/admin/Role/role.php">Role</a></li>
                        <li><a href="http://localhost:8888/admin/SalaryMethod/salarymethod.php">Salary method</a></li>
                    </ul>
                </li>
                <li class="active">

                    <a href="http://localhost:8888/admin/Account/account.php?u_id=<?= $fetch['userId'] ?>" class="con-btn">
                        <span class="icon"><i class="fas fa-cog"></i></span>
                        <span class="item">Manage Accounts</span>
                        </span>
                    </a>
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