<?php
    include '../server/Employee.php';
    include '../server/Department.php';
    include '../server/Utilities.php';
    include '../Database.php';
?>
<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="../styles/employees.css">
<style>
@import url('https://fonts.googleapis.com/css2?family=IBM+Plex+Serif:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
</style>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <?php
    include "sidebar.php"
    ?>
    <div class="content">
        <p class="page-title">Employees</p>
        <div class="operations-container">
            <button class="operations-button" onClick=GoToAddEmployee()>
                <p class="operation-name">Add Employee</p>
            </button>
            <button class="operations-button" onClick=GoToUpdateEmployee()>
                <p class="operation-name">Update Employee</p>
            </button>
            <button class="operations-button">
                <p class="operation-name">Update Employee Salary</p>
            </button>
        </div>


        <div class="table-container">
            <p class="table-title">Recently hired employees: </p>
            <table>
                <tr>
                    <th>Employee Name</th>
                    <th>Job Title</th>
                    <th>Department Name</th>
                    <th>Hired Date</th>
                    <th>View Details</th>
                </tr>

                <?php
                    $rows = Employee::return_recent_employees(5);
                    foreach ($rows as $toDisplay) {
                        $departments = Employee::return_employee_department($toDisplay["employee_id"]);
                        $department_string = formatted_employee_departments($departments);
                        echo
                        "<form action='employees-pages/view-one-employee.php' method='get'>".
                        "<tr>".
                        "<td>".$toDisplay['employee_name']."</td>".
                        "<td>".$toDisplay['job_title']."</td>".
                        "<td>".$department_string."</td>".
                        "<td>".$toDisplay['hired_date']."</td>".
                        "<td><button class='view-button type='submit' name='employee_id' value=".$toDisplay["employee_id"]."><p>View</p><button></td>".
                        "</tr>".
                        "</form>";
                    }
                    ?>

            </table>
        </div>

        <button class="view-all" onClick=GoToViewAllEmployees()>
            <p>View All Employees</p>
        </button>

        <script>
        function GoToAddEmployee() {
            window.location.href = 'employees-pages/add-employee.php';
        }

        function GoToUpdateEmployee() {
            window.location.href = 'employees-pages/update-employee.php';
        }

        function GoToProjects() {
            window.location.href = 'projects.php';
        }

        function GoToViewAllEmployees() {
            window.location.href = 'employees-pages/view-all-employee.php'
        }
        </script>

    </div>
</body>

</html>