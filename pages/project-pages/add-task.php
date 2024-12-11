<?php
include '../../server/Employee.php';
include '../../server/Department.php';
include '../../server/Utilities.php';
include '../../server/Project.php';
include '../../server/Task.php';
include '../../Database.php';

$project_id = $_GET["project_id"];


    if(isSet($_POST["add-task"])){
        $name = $_POST["name"];
        $description = $_POST["description"];
        $start_date = date('Y-m-d');
        if($name == "" || $description == ""){
            echo "<script>alert('Invalid value for project name or description')</script>";
        }
        else {
            $toAdd = new Task(-1,$name,$description,$start_date,null);
            $toAdd->task_add_to_database();
            $toAdd->task_add_to_project($project_id);
            echo "<script>
            alert('Added succesfully');
            window.location.href = '../projects.php';
            </script>";
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
            <label for="name">Task Name *</label>
            <input type="text" id="name" name="name" placeholder="Ex. Optimize Database" value="">

            <label for="description">Task Description *</label>
            <input type="text" id="description" name="description" placeholder="Ex. Make indexes to tables" value="">

            <button class="submit" name="add-task" type="submit">Add Task</button>
        </form>

    </div>
</body>

</html>