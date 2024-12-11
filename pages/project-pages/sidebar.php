<?php
?>

<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="../../styles/sidebar.css">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
    @import url('https://fonts.googleapis.com/css2?family=IBM+Plex+Serif:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
    </style>
    <title>HR</title>
</head>

<body>

    <div class='sidebar'>

        <div class='sidebar-header'>
            <p class='sidebar-title'>Human Resource Management System</p>
        </div>

        <button class='sidebar-option' onClick='GoToHome()'>
            <img src='../../img/home.png' alt='Home'>
            <p class='sidebar-option-text'>Home</p>
        </button>

        <button class='sidebar-option' onClick='GoToEmployees()'>
            <img src='../../img/group.png' alt='Employees'>
            <p class='sidebar-option-text'>Employees</p>
        </button>

        <button class='sidebar-option' onClick='GoToDepartment()'>
            <img src='../../img/department.png' alt='Employees'>
            <p class='sidebar-option-text'>Departments</p>
        </button>

        <button class='sidebar-option' onClick='GoToProjects()'>
            <img src='../../img/building.png' alt='Home'>
            <p class='sidebar-option-text'>Projects</p>
        </button>

        <script>
        function GoToHome() {
            window.location.href = '../index.php';
        }

        function GoToDepartment() {
            window.location.href = '../department.php';
        }

        function GoToEmployees() {
            window.location.href = '../employees.php';
        }

        function GoToProjects() {
            window.location.href = '../projects.php';
        }
        </script>


    </div>

</body>

</html>