<?php
include '../../server/Employee.php';
include '../../server/Department.php';
include '../../server/Utilities.php';
include '../../Database.php';

$department_data = Department::return_department_data($_GET["department_id"]);
$employee_list = Department::return_employees_in_department($department_data[0]["department_id"]);
$head = Employee::return_employee_full_name($department_data[0]["department_head"]);

if (isset($_POST["delete_department"])) {
    $department_id = $_POST["delete_department"];
    Department::delete_department($department_id);
    echo "<script>alert('Removed Successfully');
    window.location.href='../department.php';
    </script>";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../../styles/department-style/view-department.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
    @import url('https://fonts.googleapis.com/css2?family=IBM+Plex+Serif:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
    </style>
    <title>Document</title>
</head>

<body>
    <?php include 'sidebar.php' ?>
    <div class="content">
        <p class="page-title">Department Details</p>
        <div class="info">
            <div class="division name">
                <p class="label">Department ID</p>
                <p class="information">
                    <?php
                        echo $department_data[0]["department_id"];
                    ?>
                </p>
                <p class="label">Department Name</p>
                <p class="information">
                    <?php
                        echo $department_data[0]["department_name"];
                    ?>
                </p>
                <p class="label">Department Head</p>
                <p class="information">
                    <?php
                    echo Employee::return_employee_full_name($department_data[0]["department_head"])[0]["Full Name"];
                ?>
                </p>
                <p class="label">Creation Date</p>
                <p class="information">
                    <?php
                    echo formatted_date($department_data[0]["creation_date"]);
                ?>
                </p>
            </div>
        </div>
        <p class="table-title">Employees in the department</p>
        <div class="employee-table">
            <table>
                <tr>
                    <th>Employee ID</th>
                    <th>Employee Name</th>
                    <th>Job Title</th>
                </tr>
                <?php
                foreach ($employee_list as $employee) {
                    $employee_details = Employee::return_employee_by_id($employee["employee_id"]);
                    echo
                    "
                    <tr>
                    <td>".$employee_details[0]['employee_id'].".</td>".
                    "<td>".Employee::return_employee_full_name($employee_details[0]['employee_id'])[0]["Full Name"].".</td>".
                    "<td>".$employee_details[0]["job_title"].".</td>".
                    "</tr>";
                    
                }
                ?>
            </table>
        </div>
        <div class="operation-container">
            <form action="edit-department.php" method="get">
                <?php
                echo "
                <button class='operation-button' type='submit' value=".$_GET["department_id"]." name='department_id'>Update Department</button>
                "
                ?>
            </form>
            <form action="" method="post">
                <?php
                echo "
                <button class='operation-button' type='submit' value=".$_GET["department_id"]." name='delete_department'>Delete Department</button>
                "
                ?>
            </form>
        </div>
    </div>

</body>

</html>