<?php
    include 'methods.php';
?>

<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="styles/index.css">
<style>
@import url('https://fonts.googleapis.com/css2?family=IBM+Plex+Serif:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
</style>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <?php
        include 'sidebar.php';
    ?>
    <div class="content">
        <div class="quick-analytics">
            <button class="data">
                <p class="view-message">View<br>Employees > </p>
                <img class="data-img" src='./img/group.png' alt='Group'>
                <div>
                    <p class="main-title">Employee Count :</p>
                    <p class="main-data">
                        <?php
                        $row = return_employee_count();
                        echo $row;
                    ?>
                    </p>

                    <p class="additional-data">Last Hire :
                        <?php
                        $last_hired = return_last_hired();
                        echo formatted_date($last_hired["hired_date"]);
                     ?>
                    </p>
                </div>

            </button>

            <button class="data">
                <p class="view-message">View<br>Departments > </p>
                <img class="data-img" src='./img/building.png' alt='Departments'>
                <div>
                    <p class="main-title">Department Count :</p>
                    <p class="main-data">
                        <?php
                        $row = return_department_count();
                        echo $row;
                    ?>
                    </p>

                    <p class="additional-data">Last Department Created :
                        <?php
                        $last_created = return_last_department_created();
                        echo $last_created["department_name"];
                     ?>
                    </p>
                </div>
            </button>

            <button class="data">
                <p class="view-message">View<br>History > </p>
                <img class="data-img" src='./img/department.png' alt='Average_count_per_department'>
                <div>
                    <p class="main-title">Average Count per Department:</p>
                    <p class="main-data">
                        <?php
                        $row = return_average_count_per_department();
                        echo round($row["AVG"]);
                    ?>
                    </p>

                    <p class="additional-data">Department with most population :
                        <?php
                        $most_populated = return_most_populated_department();
                        echo $most_populated["department_name"];
                     ?>
                    </p>
                </div>
            </button>

            <button class="data">
                <p class="view-message">View<br>Employees > </p>
                <img class="data-img" src='./img/dollar-currency-symbol.png' alt='Average_salary'>
                <div>
                    <p class="main-title">Average Salary:</p>
                    <p class="main-data">
                        <?php
                        $row = return_average_salary();
                        echo round($row["AVGSALARY"],2);
                    ?>
                    </p>

                    <p class="additional-data">Department with most population :
                        <?php
                        $count = return_count_greater_than_average_salary();
                        echo $count;
                     ?>
                    </p>
                </div>
            </button>
        </div>
    </div>
</body>
<?php
    
    // CheckConnection();
?>

</html>