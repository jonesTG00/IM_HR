<?php
?>

<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="styles/sidebar.css">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HR</title>
</head>

<body>

    <div class='sidebar'>

        <div class='sidebar-header'>
            <p class='sidebar-title'>Human Resource Management System</p>
        </div>

        <button class='sidebar-option' onClick='GoToHome()'>
            <img src='./img/home.png' alt='Home'>
            <p class='sidebar-option-text'>Home</p>
        </button>

        <button class='sidebar-option' onClick='GoToEmployees()'>
            <img src='./img/group.png' alt='Employees'>
            <p class='sidebar-option-text'>Employees</p>
        </button>

        <button class='sidebar-option' onClick='GoToProjects()'>
            <img src='./img/building.png' alt='Home'>
            <p class='sidebar-option-text'>Projects</p>
        </button>

        <script>
        function GoToHome() {
            window.location.href = 'index.php';
        }

        function GoToEmployees() {
            window.location.href = 'employees.php';
        }

        function GoToProjects() {
            window.location.href = 'projects.php';
        }
        </script>


    </div>

</body>

</html>