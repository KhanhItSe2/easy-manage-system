<!--export to excel-->
<?php
include("../../Data/db.php");
$output = '';
if (isset($_POST["export_excel"])) {
    $result = mysqli_query($conn, "SELECT * FROM `employee` as e 
        JOIN `academic` as a ON a.acaId = e.academy
        JOIN `position` as p ON p.posId = e.posId
        JOIN `department` as d ON d.deptId = e.deptId 
        JOIN `title` as t ON t.titleId = e.title
        JOIN `branch` as b ON b.branchId = e.branch 
        JOIN `nationality` as n ON n.nationId = e.nalId
        JOIN `ethnic` as et ON et.ethnicId = e.ethnicId
        JOIN `religion` as r ON r.religionId = e.religionId
        JOIN `salarymethod` as s ON s.salaryId = e.salId
        WHERE status = 0 ORDER BY empID DESC");
    if (mysqli_num_rows($result) > 0) {
        $output .= '
                        <table class="table" bordered="1">
                            <tr>
                                <th>ID</th>
                                <th>Full Name</th>  
                                <th>Birth Date</th>
                                <th>Address</th>
                                <th>Gender</th>
                                <th>Identification Card</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Taxable</th>
                                <th>Insurance Number</th>
                                <th>Position</th>
                                <th>Department</th>
                                <th>Title</th>
                                <th>Salary</th>
                                <th>per</th>
                                <th>Ethnic</th>
                                <th>Religion</th>
                                <th>Nationality</th>
                                <th>Academy</th>
                                <th>Branch</th>
                            </tr>
                    ';
        while ($row = mysqli_fetch_array($result)) {
            $output .= '
                            <tr>
                                <td>' . $row['empId'] . '</td>
                                <td>' . $row['fullName'] . '</td> 
                                <td>' . $row['bDate'] . '</td>
                                <td>' . $row['address'] . '</td>
                                <td>' . $row['sex'] . '</td>
                                <td>' . $row['idCard'] . '</td>
                                <td>' . $row['email'] . '</td>
                                <td>' . $row['phone'] . '</td>
                                <td>' . $row['taxable'] . '</td>
                                <td>' . $row['insurance'] . '</td>
                                <td>' . $row['posName'] . '</td>
                                <td>' . $row['deptName'] . '</td>
                                <td>' . $row['titleName'] . '</td>
                                <td>' . $row['salaryAmount'] . '</td>
                                <td>' . $row['salaryType'] . '</td>
                                <td>' . $row['ethnicName'] . '</td>
                                <td>' . $row['religionName'] . '</td>
                                <td>' . $row['nationName'] . '</td>
                                <td>' . $row['acaLevel'] . '</td>
                                <td>' . $row['branchName'] . '</td>
                            </tr>
                        ';
        }
        $output .= '</table>';
        header("Content-type: application/xls");
        header("Content-Disposition: attachment; filename=ListOfEmployee.xls");
        echo $output;
    }
}
?>