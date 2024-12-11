<?php
    include '../server/Employee.php';
    include '../server/Department.php';
    include '../server/Utilities.php';
    include '../server/Project.php';
    include '../Database.php';
?>

<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="../styles/index.css">
<style>
@import url('https://fonts.googleapis.com/css2?family=IBM+Plex+Serif:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
</style>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <?php
        include "sidebar.php";
    ?>
    <div class="content">
        <p class="section-title">Quick Analytics</p>
        <div class="quick-analytics">
            <button class="data">
                <p class="view-message">View<br>Employees > </p>
                <img class="data-img" src='../img/group.png' alt='Group'>
                <div>
                    <p class="main-title">Employee Count :</p>
                    <p class="main-data">
                        <?php
                        $row = Employee::return_employee_count();
                        echo $row;
                    ?>
                    </p>

                    <p class="additional-data">Last Hire :
                        <?php
                        $last_hired = Employee::return_last_hired();
                        echo formatted_date($last_hired["hired_date"]);
                     ?>
                    </p>
                </div>

            </button>

            <button class="data">
                <p class="view-message">View<br>Departments > </p>
                <img class="data-img" src='../img/building.png' alt='Departments'>
                <div>
                    <p class="main-title">Department Count :</p>
                    <p class="main-data">
                        <?php
                        $row = Department::return_department_count();
                        echo $row;
                    ?>
                    </p>

                    <p class="additional-data"> Last Department Created :
                        <?php
                        $last_created = Department::return_last_department_created();
                        echo $last_created["department_name"];
                     ?>
                    </p>
                </div>
            </button>

            <button class="data">
                <p class="view-message">View<br>History > </p>
                <img class="data-img" src='../img/department.png' alt='Average_count_per_department'>
                <div>
                    <p class="main-title">Average Count per Department:</p>
                    <p class="main-data">
                        <?php
                        $row = Department::return_average_count_per_department();
                        echo round($row["AVG"]);
                    ?>
                    </p>

                    <p class="additional-data"> Department with most population :
                        <?php
                        $most_populated = Department::return_most_populated_department();
                        echo $most_populated["department_name"];
                     ?>
                    </p>
                </div>
            </button>

            <button class="data">
                <p class="view-message">View<br>Employees > </p>
                <img class="data-img" src='../img/dollar-currency-symbol.png' alt='Average_salary'>
                <div>
                    <p class="main-title">Average Salary:</p>
                    <p class="main-data">
                        <?php
                        $row = Employee::return_average_salary();
                        echo round($row["AVGSALARY"],2);
                    ?>
                    </p>

                    <p class="additional-data">Employees with salary higher than average :
                        <?php
                        $count = Employee::return_count_greater_than_average_salary();
                        echo $count;
                     ?>
                    </p>
                </div>
            </button>
        </div>


        <div class="tables">
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
                    $rows = Employee::return_recent_employees(3);
                    foreach ($rows as $toDisplay) {
                        $departments = Employee::return_employee_department($toDisplay["employee_id"]);
                        $department_string = formatted_employee_departments($departments);
                        echo
                        "<tr>".
                        "<td>".$toDisplay['employee_name']."</td>".
                        "<td>".$toDisplay['job_title']."</td>".
                        "<td>".$department_string."</td>".
                        "<td>".$toDisplay['hired_date']."</td>".
                        "<td><button class='view-button'><p>View</p><button></td>".
                        "</tr>";
                    }
                    ?>

                </table>
            </div>
            </form>
            <div class="table-container">
                <p class="table-title">Recent projects added: </p>
                <table>
                    <tr>
                        <th>Project ID</th>
                        <th>Project Name</th>
                        <th>Date Started</th>
                        <th>Date Finished</th>
                        <th>View Details</th>
                    </tr>



                    <?php
                        $rows = Project::return_recent_projects(3);
                        foreach ($rows as $toDisplay) {
                            echo
                            "<form action='project-pages/view-project.php' method=''get''>".
                            "<tr>".
                            "<td>".$toDisplay['id']."</td>".
                            "<td>".$toDisplay['name']."</td>".
                            "<td>".$toDisplay['start']."</td>".
                            "<td>".$toDisplay['end']."</td>".
                            "<td><button class='view-button type='submit' name='project_id' value=".$toDisplay["id"]."><p>View</p><button></td>".
                            "</tr>".
                            "</form>";
                        }
                    ?>

                </table>
            </div>
        </div>




    </div>
</body>
<?php
    
    // CheckConnection();
?>

</html>