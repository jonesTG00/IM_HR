<?php
include '../../server/Employee.php';
include '../../server/Department.php';
include '../../server/Utilities.php';
include '../../server/Project.php';
include '../../server/Task.php';
include '../../Database.php';

$task_id = $_GET["task_id"];
$task = Task::return_task_by_id($task_id);


    if(isSet($_POST["edit-task"])){
        $name = $_POST["name"];
        $description = $_POST["description"];
        if($name == "" || $description == ""){
            echo "<script>alert('Invalid value for project name or description')</script>";
        }
        else {
            Task::update_task($name,$description,$task_id);
            echo "<script>
            alert('Updated successfully');
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
            <input type="text" id="name" name="name" placeholder="Ex. Optimize Database"
                value='<?php echo $task[0]["task_name"]?>'>

            <label for="description">Task Description *</label>
            <input type="text" id="description" name="description" placeholder="Ex. Make indexes to tables"
                value='<?php echo $task[0]["task_description"]?>'>

            <button class="submit" name="edit-task" type="submit">Update Task</button>
        </form>

    </div>
</body>

</html>