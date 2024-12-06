<?php
include '../server/Employee.php';
include '../server/Department.php';
include '../server/Utilities.php';
include '../Database.php';

$pagination = isset($_GET['page']) ? $_GET['page']: 0;
$rows = Department::return_department_pagination(5,($pagination * 5));
$isLessDisabled = false;
$isAddDisabled = false;
if ($pagination == 0) {
    $isLessDisabled = true;
}

if(ceil(Department::return_department_count() / 5) == ($pagination + 1)){
    $isAddDisabled = true;
}

?>

<!DOCTYPE html>
<html lang="en">

<html lang="en">
<link rel="stylesheet" href="../styles/department.css">
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
                    <th>Department ID</th>
                    <th>Department Name</th>
                    <th>Department Head</th>
                    <th>Date Created</th>
                    <th>View Details</th>
                </tr>

                <?php
                    foreach ($rows as $toDisplay) {
                        $head = Employee::return_employee_full_name($toDisplay["department_head"]);
                        echo
                        "<form action='department-pages/view-department.php' method='get'>".
                        "<tr>".
                        "<td>".$toDisplay['department_id']."</td>".
                        "<td>".$toDisplay['department_name']."</td>".
                        "<td>".$head[0]['Full Name']."</td>".
                        "<td>".$toDisplay['creation_date']."</td>".
                        "<td><button class='view-button type='submit' name='department_id' value=".$toDisplay["department_id"]."><p>View</p><button></td>".
                        "</tr>".
                        "</form>";
                    }
                    ?>

            </table>
        </div>
        <form action="department.php" method="get">
            <div class="pagination-container">
                <p>Page</p>
                <?php
                $disableLess = $isLessDisabled ? 'disabled' : '';
                $disableAdd = $isAddDisabled ? 'disabled' : '';
                echo 
                "<button class='pagination-button' type='submit' name='page' 
                value=".($pagination - 1)." ".$disableLess.">-</button>".
                "<p class='pagination'>". $pagination + 1 ."</p>".
                "<button class='pagination-button' type='submit' name='page' 
                value=".($pagination + 1)." ".$disableAdd.">+</button>"
                ?>

            </div>
        </form>
        <button class="add-button" onCLick=GoToAddDepartment()>Add Department</button>

    </div>


</body>
<script>
function GoToAddDepartment() {
    window.location.href = 'department-pages/add-department.php';
}
</script>

</html>