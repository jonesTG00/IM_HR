<?php
    include '../../server/Employee.php';
    include '../../server/Department.php';
    include '../../server/Utilities.php';
    include '../../Database.php';

    $id = $_GET["employee_id"];

    if (isset($_POST["delete_employee"])) {
        try {
            $department_id = $_POST["delete_employee"];
            Employee::remove_employee_from_department($id, $department_id);
            echo "<script>
            alert('Removed successfully');
            window.location.href = '../employees.php';
            </script>";
            
        } catch (\Throwable $th) {
            echo "<script>alert(".$th->getMessage().")</script>";
            
        }
    }

    if (isset($_POST["add_employee"])) {
        try {
            $department_id = $_POST["add_employee"];
            Employee::add_employee_to_department_static($id, $department_id);
            
            echo "<script>
            alert('Added successfully');
            window.location.href = '../employees.php';
            </script>";
            
        } catch (\Throwable $th) {
            echo "<script>alert(".$th->getMessage().")</script>";
            
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../styles/employees-style/update-employee-department.css">
    <title>Document</title>
    <style>
    @import url('https://fonts.googleapis.com/css2?family=IBM+Plex+Serif:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
    </style>
</head>

<body>
    <?php
    include "sidebar.php";
    ?>

    <div class="content">
        <div class="update-tables">
            <p class="table-title" style="color:green">Remove Department <br>(Department currently employee is included)
            </p>
            <?php
            $departments = Employee::return_employee_department($id);
            foreach($departments as $department){
                echo"
                <form action='' method='POST'>
                <button class='department-button' type='submit' name='delete_employee' value=".$department["id"].">
                ".$department["department"]."
                </button>
                </form>
                ";
            }
            ?>
        </div>
        <div class="update-tables">
            <p class="table-title" style="color:red">Add Department <br>(Department currently employee is not included)
            </p>
            <?php
            $departments_not_included = Employee::return_employee_department_not_included($id);
            foreach($departments_not_included as $department){
                echo"
                <form action='' method='POST'>
                <button class='department-button' type='submit' name='add_employee' value=".$department["id"].">
                ".$department["department"]."
                </button>
                </form>
                ";
            }
            ?>
        </div>
    </div>
</body>

</html>