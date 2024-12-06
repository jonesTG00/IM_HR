<?php
    include '../../server/Employee.php';
    include '../../server/Department.php';
    include '../../server/Utilities.php';
    include '../../Database.php';

    if(isSet($_POST["add-employee"])){
        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $mname = $_POST["mname"];
        $email = $_POST["email"];
        $phone_number = $_POST["phone_number"];
        $barangay = $_POST["barangay"];
        $street_subdivision = $_POST["street_subdivision"];
        $city = $_POST["city"];
        $province = $_POST["province"];
        $birthday = $_POST["birthday"];
        $job_title = $_POST["job_title"];
        $salary = (float) $_POST["salary"];
        $hired_date = $_POST["hired_date"];
        $marital_status;
        if (isSet($_POST["marital_status"])) {
            $marital_status = $_POST["marital_status"];
        }
        $department_name;
        if (isSet($_POST["department_name"])) {
            $department_name = $_POST["department_name"];
        }
        
        if ($fname == "" || $lname=="" || $email == "" || $phone_number == "" || $barangay == "" || $city == "" || $phone_number == ""
        || $province == "" || $job_title == "" || $salary == "" || $marital_status == "") {
            echo "<script>alert('Required fields are empty')</script>";
        } elseif(floatval($salary) == 0){
            echo "<script>alert('Invalid value for salary')</script>"; 
        } elseif (!ctype_digit($phone_number) && strlen($phone_number) != 9) {
            echo "<script>alert('Invalid value for phone number')</script>"; 
        } elseif (strtotime($birthday) >= strtotime('now') || strtotime($hired_date) >= strtotime('now')) {
            echo "<script>alert('Invalid value for birthday')</script>"; 
        } else {
            $toAdd = new Employee(-1,$fname, $lname, $mname, $job_title, floatval($salary), $hired_date
            , $email, $phone_number, $street_subdivision, $barangay, $city, $province, $birthday, $marital_status);
            $toAdd->employee_add_to_database();
            $toAdd->add_employee_to_department($department_name);
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="../../styles/employees-style/add-employee.css">
<style>
@import url('https://fonts.googleapis.com/css2?family=IBM+Plex+Serif:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
</style>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <?php
    include "sidebar.php"
    ?>
    <div class="content">
        <p class="page-title">Add Employee</p>
        <div class="fillup-form">
            <form action="" method="post">
                <div class="employee-name section">

                    <p class="section-title">Employee Name</p>

                    <label for="fname">First Name *</label>
                    <input type="text" id="fname" name="fname" placeholder="Ex. Juan" value="">

                    <label for="lname">Last Name *</label>
                    <input type="text" id="lname" name="lname" placeholder="Ex. Dela Cruz" value="">

                    <label for="mname">Middle Name</label>
                    <input type="text" id="mname" name="mname" placeholder="Ex. Miguelito" value="">

                </div>
                <div class="employee-contact section">

                    <p class="section-title">Contacts</p>

                    <label for="email">Email *</label>
                    <input type="text" id="email" name="email" placeholder="Ex. juan@gmail.com" value="">

                    <label for="phone_number">Phone Number *</label>
                    <div class="contact-number-container">

                        <p class="contact-number">+63</p>
                        <input type="text" id="phone_number" name="phone_number" placeholder="Ex. 987654321" value="">
                    </div>

                </div>
                <div class="address section">

                    <p class="section-title">Address</p>

                    <label for="street_subdivision">Subdivision</label>
                    <input type="text" id="street_subdivision" name="street_subdivision"
                        placeholder="Ex. Mabuhay Subdivision" value="">

                    <label for="barangay">Barangay *</label>
                    <input type="text" id="barangay" name="barangay" placeholder="Ex. Mamatid" value="">

                    <label for="city">City *</label>
                    <input type="text" id="city" name="city" placeholder="Ex. Cabuyao" value="">

                    <label for="province">Province *</label>
                    <input type="text" id="province" name="province" placeholder="Ex. Laguna" value="">

                </div>

                <div class="additional section">

                    <p class="section-title">Additonal *</p>
                    <label for="birthday">Birthday *</label>
                    <input type="date" id="birthday" name="birthday" value="">
                    <p>Marital Status *</p>
                    <div class="marital-status-container">
                        <input type="radio" name="marital_status" value="single" checked="checked"> Single
                        <input type="radio" name="marital_status" value="Married"> Married
                        <input type="radio" name="marital_status" value="Widowed"> Widowed
                        <input type="radio" name="marital_status" value="Seperated"> Seperated
                    </div>
                </div>

                <div class="job-details section">

                    <p class="section-title">Job Details</p>

                    <label for="job-title">Job Title *</label>
                    <input type="text" id="job_title" name="job_title" placeholder="Ex. Software Developer" value="">

                    <label for="salary">Salary *</label>
                    <input type="text" id="salary" name="salary" placeholder="In Peso" value="">


                    <label for="department_name">Department Name *</label>
                    <select name="department_name">
                        <?php
                        $departments = Department::return_department_name();              
                        foreach ($departments as $department) {
                            echo "<option value='".$department["department_name"]."'>".$department["department_name"]."</option>";
                        } 
                        ?>
                    </select>

                    <label for="hired_date">Hired Date *</label>
                    <input type="date" id="hired_date" name="hired_date" value="">

                </div>

                <button type="submit" name="add-employee" class="submit">Submit Button</button>
            </form>
        </div>
    </div>
</body>

</html>