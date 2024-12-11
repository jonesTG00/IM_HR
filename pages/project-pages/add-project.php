<?php
include '../../server/Employee.php';
include '../../server/Department.php';
include '../../server/Utilities.php';
include '../../server/Project.php';
include '../../Database.php';


    if(isSet($_POST["add-project"])){
        $name = $_POST["name"];
        $start_date = $_POST["start_date"];
        $end_date = $_POST["end_date"];
        if ($start_date == "" || $end_date == "" || $start_date > $end_date) {
            echo "<script>alert('Starting date or end date is invalid')</script>";
        } 
        elseif($name == ""){
            echo "<script>alert('Invalid value for project name')</script>";
        }
        else {
            $toAdd = new Project(-1,$name,$start_date,$end_date);
            $toAdd->project_add_to_database();
        }
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
            <label for="name">Project Name *</label>
            <input type="text" id="name" name="name" placeholder="Ex. Optimize Database" value="">

            <label for="start_date">Start Date *</label>
            <input type="date" id="start_date" name="start_date" value="">

            <label for="end_date">End Date *</label>
            <input type="date" id="end_date" name="end_date" value="">

            <button class="submit" name="add-project" type="submit">Add project</button>
        </form>

    </div>
</body>

</html>