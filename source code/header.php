<nav class="navbar navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar"></button>
      <a class="navbar-brand" onclick="window.location.reload()" ><span class="glyphicon glyphicon-home"></span> EasyManage</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">OFFICE
            <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href=".."><span class="glyphicon glyphicon-pushpin"></span> Note</a></li>
            <li><a href=".."><span class="glyphicon glyphicon-calendar"></span> Schedule</a></li>
            <li><a href=".."><span class="glyphicon glyphicon-comment"></span> Conversation</a></li>
            <li><a href=".."><span class="glyphicon glyphicon-bullhorn"></span> Notification</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">WORK
            <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href=".."><span class="glyphicon glyphicon-tasks"></span> Tasks</a></li>
            <li><a href=".."><span class="glyphicon glyphicon-sort-by-attributes"></span> Projects/Teams</a></li>
            <li><a href=".."><span class="glyphicon glyphicon-random"></span> Checkflow</a></li>
            <li><a href=".."><span class="glyphicon glyphicon-glyphicon glyphicon-list-alt"></span> Workflow</a></li>
            <hr>
            <li><a href=".."><span class="glyphicon glyphicon-cog"></span> WORK+ Module Management</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">HRM
            <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href=".."><span class="glyphicon glyphicon-folder-close"></span> Recruitment Landing Page</a></li>
            <li><a href=".."><span class="glyphicon glyphicon-bullhorn"></span> Recruitment</a></li>
            <li><a href=".."><span class="glyphicon glyphicon-user"></span> Staff</a></li>
            <hr>
            <li><a href=".."><span class="glyphicon glyphicon-th"></span> HRM+ Module Management</a></li>
          </ul>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <?php
        if (isset($_SESSION['is_login_admin'])) {
          $userId = $_SESSION['userId'];
          $sql = "SELECT * FROM `users` as u JOIN `role` as r ON u.roleId=r.roleId JOIN `employee` as e ON e.empId = u.userId WHERE u.userId = '$userId'";
          $result = mysqli_query($conn, $sql);
          $row = mysqli_num_rows($result);
          if ($row > 0) {
            while ($fetch = mysqli_fetch_assoc($result)) {
        ?>
              <li><a class="nav"><span class="glyphicon glyphicon-user"></span> <?= $fetch['userName'] ?></a></li>
              <li><a class="nav" href="../../logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a> </li>
            <?php }
          }
        } else if (isset($_SESSION['is_login_employer'])) {
          $userId = $_SESSION['userId'];
          $sql = "SELECT * FROM `users` as u JOIN `role` as r ON u.roleId=r.roleId JOIN `employee` as e ON e.empId = u.userId WHERE u.userId = '$userId'";
          $result = mysqli_query($conn, $sql);
          $row = mysqli_num_rows($result);
          if ($row > 0) {
            while ($fetch = mysqli_fetch_assoc($result)) {
            ?>
              <li><a class="nav"><span class="glyphicon glyphicon-user"></span> <?= $fetch['userName'] ?></a></li>
              <li><a class="nav" href="../../logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a> </li>
              <?php }
          } else if (isset($_SESSION['is_login_manager'])) {
            $userId = $_SESSION['userId'];
            $sql = "SELECT * FROM `users` as u JOIN `role` as r ON u.roleId=r.roleId JOIN `employee` as e ON e.empId = u.userId WHERE u.userId = '$userId'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_num_rows($result);
            if ($row > 0) {
              while ($fetch = mysqli_fetch_assoc($result)) {
              ?>
                <li><a class="nav"><span class="glyphicon glyphicon-user"></span> <?= $fetch['userName'] ?></a></li>
                <li><a class="nav" href="../../logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a> </li>
            <?php }
            } ?>
            <?php header('location: ./index.php') ?>
        <?php }
        } ?>
      </ul>
    </div>
  </div>
</nav>