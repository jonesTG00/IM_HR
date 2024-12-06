<?php
include '../../server/Employee.php';
include '../../server/Department.php';
include '../../server/Utilities.php';
include '../../Database.php';


    if(isSet($_POST["add-department"])){
        $name = $_POST["name"];
        $head = $_POST["head"];
        $date_added = date("Y-m-d");
        // echo "<script>alert('".$date_added."')</script>";
        $toAdd = new Department(-1,$name,$head,$date_added);
        $toAdd->department_add_to_database();
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
        <form action="add-department.php" method="post">
            <label for="name">Department Name *</label>
            <input type="text" id="name" name="name" placeholder="Ex. Marketing" value="">

            <label for="head">Department Head *</label>
            <select name="head">
                <?php
                $employees = Employee::return_all_employees();              
                    foreach ($employees as $employee) {
                        echo "<option value='".$employee["employee_id"]."'>".$employee["employee_name"]."</option>";
                    } 
            ?>
            </select>
            <button class="submit" name="add-department" type="submit">Add Department</button>
        </form>

    </div>
</body>

</html>