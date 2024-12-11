<?php
include '../../server/Employee.php';
include '../../server/Department.php';
include '../../server/Utilities.php';
include '../../Database.php';

$department_id = $_GET["department_id"];
$department_data = Department::return_department_data($department_id);
$head = Employee::return_employee_full_name($department_data[0]["department_head"]);

    if(isSet($_POST["update-department"])){
        $name = $_POST["name"];
        $head = $_POST["head"];
        echo "<script>alert(".$head.")</script>";
        Department::update_department($name,$head,$department_id);
        echo "<script>alert('Updated successfully');window.location.href='../department.php';</script>";
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../styles/department-style/add-department.css">
    <style>
    @import url('https://fonts.googleapis.com/css2?family=IBM+Plex+Serif:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
    </style>
    <title>Document</title>
</head>

<body>
    <?php
    include 'sidebar.php'
    ?>
    <div class="content">
        <form action="" method="post">
            <label for="name">Department Name *</label>
            <?php
            echo "
            <input type='text' id='name' name='name' value=".$department_data[0]["department_name"].">
            "
            ?>


            <label for="head">Department Head *</label>
            <select name="head">
                <?php
                $employees = Employee::return_all_employees();              
                    foreach ($employees as $employee) {
                        echo "<option value='".$employee["employee_id"]." ".$selected."'>".$employee["employee_name"]."</option>";
                    } 
            ?>
            </select>
            <button class="submit" name="update-department" type="submit">Update Department</button>
        </form>

    </div>
</body>

</html>