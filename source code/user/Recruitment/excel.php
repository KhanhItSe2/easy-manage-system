<!--export to excel-->
<?php
include("../../Data/db.php");
$output = '';
if (isset($_POST["export_excel"])) {
    $result = mysqli_query($conn, "SELECT * FROM `candidate` as c 
        JOIN `position` as p ON p.posId = c.posId
        JOIN `title` as t ON t.titleId = c.titleId
        WHERE status = 0 ORDER BY interviewDate ASC");
    if (mysqli_num_rows($result) > 0) {
        $output .= '
                        <table class="table" bordered="1">
                            <tr>
                                <th>Interview Date</th>
                                <th>ID</th>
                                <th>Full Name</th>                               
                                <th>Nominee</th>
                                <th>Title</th>
                                <th>Birth Date</th>
                                <th>Address</th>
                                <th>Gender</th>
                                <th>Identification Card</th>
                                <th>Email</th>
                                <th>Phone</th>
                            </tr>
                    ';
        while ($row = mysqli_fetch_array($result)) {
            $output .= '
                            <tr>
                                <td>' . $row['interviewDate'] . '</td>
                                <td>' . $row['candidateId'] . '</td>
                                <td>' . $row['fullName'] . '</td>                                
                                <td>' . $row['posName'] . '</td>
                                <td>' . $row['titleName'] . '</td>
                                <td>' . $row['bDate'] . '</td>
                                <td>' . $row['address'] . '</td>
                                <td>' . $row['sex'] . '</td>
                                <td>' . $row['idCard'] . '</td>
                                <td>' . $row['email'] . '</td>
                                <td>' . $row['phone'] . '</td>
                            </tr>
                        ';
        }
        $output .= '</table>';
        header("Content-type: application/xls");
        header("Content-Disposition: attachment; filename=ListInterview.xls");
        echo $output;
    }
}
?>