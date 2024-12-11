<?php
include '../../server/Employee.php';
include '../../server/Department.php';
include '../../server/Utilities.php';
include '../../server/Project.php';
include '../../server/Task.php';
include '../../Database.php';
// $department_data = Department::return_department_data($_GET["department_id"]);
$project_data = Project::return_project_data($_GET["project_id"]);
// $employee_list = Department::return_employees_in_department($department_data[0]["department_id"]);
$task_list = Task::return_tasks_in_project($_GET["project_id"]);
// $head = Employee::return_employee_full_name($department_data[0]["department_head"]);

if (isset($_POST["delete_project"])) {
    $project_id = $_POST["delete_project"];
    Project::delete_project($project_id);
    echo "<script>alert('Removed Successfully');
    window.location.href='../projects.php';
    </script>";
}

if (isset($_POST["delete_task"])) {
    $task_id = $_POST["delete_task"];
    Task::delete_task($task_id);
    echo "<script>alert('Removed Successfully');
    window.location.href='../projects.php';
    </script>";
}

if (isset($_POST["set_accomplished"])) {
    $task_id = $_POST["set_accomplished"];
    Task::set_task_accomplished($task_id);
    echo "<script>alert('Updated Successfully');
    window.location.href='../projects.php';
    </script>";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../../styles/project-style/view-project.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
    @import url('https://fonts.googleapis.com/css2?family=IBM+Plex+Serif:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
    </style>
    <title>Document</title>
</head>

<body>
    <?php include 'sidebar.php' ?>
    <div class="content">
        <p class="page-title">Project Details</p>
        <div class="info">
            <div class="division name">
                <p class="label">Project ID</p>
                <p class="information">
                    <?php
                        echo $project_data[0]["project_id"];
                    ?>
                </p>
                <p class="label">Project Name</p>
                <p class="information">
                    <?php
                        echo $project_data[0]["project_name"];
                    ?>
                </p>
                <p class="label">Start Date</p>
                <p class="information">
                    <?php
                    echo formatted_date($project_data[0]["start_date"]);
                ?>
                </p>
                <p class="label">End Date</p>
                <p class="information">
                    <?php
                    echo formatted_date($project_data[0]["end_date"]);
                ?>
                </p>
            </div>
        </div>

        <p class="table-title">Task</p>
        <div class="task-table">
            <table>
                <tr>
                    <th>Task ID</th>
                    <th>Task Name</th>
                    <th>Task Description</th>
                    <th>Start Date</th>
                    <th>Accomplished</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                <?php
                foreach ($task_list as $task) {
                    $task_details = Task::return_task_by_id($task["task_id"]);
                    $accomplished = $task_details[0]["date_accomplished"] != null ? formatted_date($task_details[0]["date_accomplished"]):
                        "<form action='' method='post'><button class='table-operation' name='set_accomplished' value=".$task_details[0]['task_id'].">Set to accomplished</button></form>";
                    echo
                    "
                    <tr>
                    <td>".$task_details[0]['task_id']."</td>".
                    "<td>".$task_details[0]['task_name']."</td>".
                    "<td>".$task_details[0]['task_description']."</td>".
                    "<td>".formatted_date($task_details[0]['date_added'])."</td>".
                    "<td>".$accomplished."</td>".
                    "<td><form action='edit-task.php' method='get'><button class='table-operation' name='task_id' value=".$task_details[0]['task_id'].">Edit Task</button></form></td>".
                    "<td><form action='' method='post'><button class='table-operation' name='delete_task' value=".$task_details[0]['task_id']." 
                    style='background-color: #7d3232;'>Delete Task</button></form></td>".
                    "</tr>";
                    
                }
                ?>
            </table>
        </div>
        <div class="operation-container">
            <form action="add-task.php" method="get">
                <?php
                echo "
                <button class='operation-button' type='submit' value=".$_GET["project_id"]." name='project_id'>Add Task</button>
                "
                ?>
            </form>
            <form action="update-project.php" method="get">
                <?php
                echo "
                <button class='operation-button' type='submit' value=".$_GET["project_id"]." name='project_id'>Update Project</button>
                "
                ?>
            </form>
            <form action="" method="post">
                <?php
                echo "
                <button class='operation-button' type='submit' value=".$_GET["project_id"]." name='delete_project'>Delete Project</button>
                "
                ?>
            </form>
        </div>

    </div>

</body>

</html>