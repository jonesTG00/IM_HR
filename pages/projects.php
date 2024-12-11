<?php
include '../server/Employee.php';
include '../server/Department.php';
include '../server/Utilities.php';
include '../Database.php';
include '../server/Project.php';

$pagination = isset($_GET['page']) ? $_GET['page']: 0;
$rows = Project::return_project_pagination(5,($pagination * 5));
$isLessDisabled = false;
$isAddDisabled = false;
if ($pagination == 0) {
    $isLessDisabled = true;
}

if(ceil(Project::return_project_count() / 5) == ($pagination + 1)){
    $isAddDisabled = true;
}

?>

<!DOCTYPE html>
<html lang="en">

<html lang="en">
<link rel="stylesheet" href="../styles/projects.css">
<style>
@import url('https://fonts.googleapis.com/css2?family=IBM+Plex+Serif:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
</style>

<body>
    <?php
    include "sidebar.php"
    ?>
    <div class="content">
        <p class="section-title">Projects</p>

        <div class="table-container">
            <p class="table-title">Recent employees added: </p>
            <table>
                <tr>
                    <th>Project ID</th>
                    <th>Project Name</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>View Tasks</th>
                </tr>

                <?php
                    foreach ($rows as $toDisplay) {
                        echo
                        "<form action='project-pages/view-project.php' method='get'>".
                        "<tr>".
                        "<td>".$toDisplay['project_id']."</td>".
                        "<td>".$toDisplay['project_name']."</td>".
                        "<td>".formatted_date($toDisplay['start_date'])."</td>".
                        "<td>".formatted_date($toDisplay['end_date'])."</td>".
                        "<td><button class='view-button type='submit' name='project_id' value=".$toDisplay["project_id"]."><p>View</p><button></td>".
                        "</tr>".
                        "</form>";
                    }
                    ?>

            </table>
        </div>

        <form action="projects.php" method="get">
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

        <button class="add-button" onCLick=GoToAddProject()>Add Project</button>
    </div>
</body>

<script>
function GoToAddProject() {
    window.location.href = 'project-pages/add-project.php';
}
</script>

</html>