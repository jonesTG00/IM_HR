<?php
include '../../server/Employee.php';
include '../../server/Department.php';
include '../../server/Utilities.php';
include '../../Database.php';

$pagination = isset($_GET['page']) ? $_GET['page']: 0;
$rows = Employee::return_employees_pagination(5,($pagination * 5));
$isLessDisabled = false;
$isAddDisabled = false;
if ($pagination == 0) {
    $isLessDisabled = true;
}

if(ceil(Employee::return_employee_count() / 5) == ($pagination + 1)){
    $isAddDisabled = true;
}

?>

<!DOCTYPE html>
<html lang="en">

<html lang="en">
<link rel="stylesheet" href="../../styles/employees-style/view-all-employee.css">
<style>
@import url('https://fonts.googleapis.com/css2?family=IBM+Plex+Serif:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
</style>

<body>
    <?php
    include "sidebar.php"
    ?>
    <div class="content">
        <p class="section-title">Employee Name</p>

        <div class="table-container">
            <p class="table-title">Recent employees added: </p>
            <table>
                <tr>
                    <th>Employee Name</th>
                    <th>Job Title</th>
                    <th>Departments</th>
                    <th>Hired Date</th>
                    <th>View Details</th>
                </tr>

                <?php
                    foreach ($rows as $toDisplay) {
                        $departments = Employee::return_employee_department($toDisplay["employee_id"]);
                        $department_string = formatted_employee_departments($departments);
                        echo
                        "<form action='view-one-employee.php' method='get'>".
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

        <form action="view-all-employee.php" method="get">
            <div class="pagination-container">
                <p>Page</p>
                <?php
                $disableLess = $isLessDisabled ? 'disabled' : '';
                $disableAdd = $isAddDisabled ? 'disabled' : '';
                echo 
                "<button class='pagination-button' type='submit' name='page' 
                value=".($pagination - 1)." ".$disableLess.">-</button>".
                "<p class='pagination'>". $pagination ."</p>".
                "<button class='pagination-button' type='submit' name='page' 
                value=".($pagination + 1)." ".$disableAdd.">+</button>"
                ?>

            </div>
        </form>
    </div>
</body>

</html>