<?php
include '../../server/Employee.php';
include '../../server/Department.php';
include '../../server/Utilities.php';
include '../../Database.php';

$employee_data = Employee::return_employee_by_id($_GET["employee_id"]);
$employee_department = Employee::return_employee_department($employee_data[0]["employee_id"]);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../styles/employees-style/view-one-employee.css">
    <title>Document</title>
    <style>
    @import url('https://fonts.googleapis.com/css2?family=IBM+Plex+Serif:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
    </style>
</head>

<body>
    <?php
    include "sidebar.php"
    ?>

    <div class="content">
        <p class="page-title">Viewing employee</p>
        <div class="info">
            <div class="division name">
                <p class="label">First Name</p>
                <p class="information">
                    <?php
                echo $employee_data[0]["employee_fname"];
                ?>
                </p>
                <p class="label">Last Name Name</p>
                <p class="information">
                    <?php
                echo $employee_data[0]["employee_lname"];
                ?>
                </p>
                <p class="label">Middle Name</p>
                <p class="information">
                    <?php
                    echo $employee_data[0]["employee_mname"] == "" ? "N/A" : $employee_data[0]["employee_mname"];
                ?>
                </p>
            </div>
            <div class="division contact">
                <p class="label">Phone Number</p>
                <p class="information">
                    <?php
                echo "+63".$employee_data[0]["mobile_number"];
            ?>
                </p>
                <p class="label">Email</p>
                <p class="information">
                    <?php
                echo $employee_data[0]["email"];
            ?>
                </p>
            </div>
            <div class="division address">
                <p class="label">Street / Subdivision</p>
                <p class="information">
                    <?php
                    echo $employee_data[0]["street_subdivision"] == "" ? "N/A" : $employee_data[0]["street_subdivision"];
                ?>
                </p>
                <p class="label">Barangay</p>
                <p class="information">
                    <?php
                    echo $employee_data[0]["barangay"];
                ?>
                </p>
                <p class="label">City</p>
                <p class="information">
                    <?php
                    echo $employee_data[0]["city"];
                ?>
                </p>
                <p class="label">Province</p>
                <p class="information">
                    <?php
                    echo $employee_data[0]["province"];
                ?>
                </p>
            </div>
            <div class="division additional">
                <p class="label">Birthday</p>
                <p class="information">
                    <?php
                    echo formatted_date($employee_data[0]["birthday"]);
                ?>
                </p>
                <p class="label">Marital Status</p>
                <p class="information">
                    <?php
                    echo $employee_data[0]["marital_status"];
                ?>
                </p>
            </div>
            <div class="division job">
                <p class="label">Job Title</p>
                <p class="information">
                    <?php
                    echo $employee_data[0]["job_title"];
                ?>
                </p>
                <p class="label">Department</p>
                <p class="information">
                    <?php
                       echo formatted_employee_departments($employee_department);
                    ?>
                </p>
                <p class="label">Salary</p>
                <p class="information">
                    <?php
                    echo $employee_data[0]["salary"];
                ?>
                </p>
                <p class="label">Hired Date</p>
                <p class="information">
                    <?php
                    echo $employee_data[0]["hired_date"];
                ?>
                </p>
            </div>
            <form action="update-employee.php" method="get">
                <?php
                echo "
                <button value=".$employee_data[0]['employee_id']." name='employee_id' type='submit'
                    class='operation-button'>Update
                    Employee</button>
                "
                ?>

            </form>
        </div>

    </div>
</body>

</html>