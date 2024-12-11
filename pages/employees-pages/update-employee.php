<?php
include '../../server/Employee.php';
include '../../server/Department.php';
include '../../server/Utilities.php';
include '../../Database.php';

$id = $_GET["employee_id"];
$employee_details = Employee::return_employee_by_id($id);
// echo $employee_details[0]["job_title"];

if (isset($_POST["update-employee"])) {
    // try {
    // $fname = $_POST["fname"];
    // $lname = $_POST["lname"];
    // $mname = $_POST["mname"];
    // $email = $_POST["email"];
    // $mobile_number = $_POST["mobile_number"];
    // $barangay = $_POST["barangay"];
    // $street_subdivision = $_POST["street_subdivision"];
    // $city = $_POST["city"];
    // $province = $_POST["province"];
    // $birthday = $_POST["birthday"];
    // $job_title = $_POST["job_title"];
    // $salary = (float) $_POST["salary"];
    // $hired_date = $_POST["hired_date"];
    // $marital_status;
    // if (isset($_POST["marital_status"])) {
    //     $marital_status = $_POST["marital_status"];
    // }

    // // echo "<script>alert(".$employee_details[0]["job_title"].")</script>";

    // if ($fname == "" || $lname == "" || $email == "" || $mobile_number == "" || $barangay == "" || $city == ""
    //     || $province == "" || $job_title == "" || $salary == "" || $marital_status == "") {
    //     echo "<script>alert('Required fields are empty')</script>";
    // } elseif (floatval($salary) == 0) {
    //     echo "<script>alert('Invalid value for salary')</script>";
    // } elseif (!ctype_digit($mobile_number) || strlen($mobile_number) != 9) {
    //     echo "<script>alert('Invalid value for phone number')</script>";
    // } elseif (strtotime($birthday) >= strtotime('now') || strtotime($hired_date) >= strtotime('now')) {
    //     echo "<script>alert('Invalid value for birthday')</script>";
    // } else {  
    //     // $toAdd = new Employee($id, $fname, $lname, $mname, $job_title, floatval($salary), $hired_date
    //     // , $email, $mobile_number, $street_subdivision, $barangay, $city, $province, $birthday, $marital_status);
    //     echo "<script>alert(".$employee_details[0]["job_title"].")</script>";
    // } 
        
    //     // $toAdd->update_employee();
        
    // }
    // catch (\Throwable $th) {
    //     echo $th->getMessage();
    // }

    $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $mname = $_POST["mname"];
        $email = $_POST["email"];
        $mobile_number = $_POST["mobile_number"];
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
        
        if ($fname == "" || $lname=="" || $email == "" || $mobile_number == "" || $barangay == "" || $city == "" || $mobile_number == ""
        || $province == "" || $job_title == "" || $salary == "" || $marital_status == "") {
            echo "<script>alert('Required fields are empty')</script>";
        } elseif(floatval($salary) == 0){
            echo "<script>alert('Invalid value for salary')</script>"; 
        } elseif (!ctype_digit($mobile_number) && strlen($mobile_number) != 9) {
            echo "<script>alert('Invalid value for phone number')</script>"; 
        } elseif (strtotime($birthday) >= strtotime('now') || strtotime($hired_date) >= strtotime('now')) {
            echo "<script>alert('Invalid value for birthday')</script>"; 
        } else {
                    $toAdd = new Employee($id, $fname, $lname, $mname, $job_title, floatval($salary), $hired_date
        , $email, $mobile_number, $street_subdivision, $barangay, $city, $province, $birthday, $marital_status);
        $toAdd->update_employee();
        echo "<script>window.location.href = '../employees.php'</script>";
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
                    <?php
echo "<input type='text' id='fname' name='fname'
                        value='" . $employee_details[0]['employee_fname'] . "'>"
?>

                    <label for="lname">Last Name *</label>
                    <?php
echo "<input type='text' id='lname' name='lname'
                        value='" . $employee_details[0]['employee_lname'] . "'>"
?>


                    <label for="mname">Middle Name</label>
                    <?php
echo "<input type='text' id='mname' name='mname'
                        value='" . $employee_details[0]['employee_mname'] . "'>"
?>
                </div>
                <div class="employee-contact section">

                    <p class="section-title">Contacts</p>

                    <label for="email">Email *</label>
                    <?php
echo "<input type='text' id='email' name='email'
                        value='" . $employee_details[0]['email'] . "'>"
?> <label for="phone_number">Phone Number *</label>
                    <div class="contact-number-container">

                        <p class="contact-number">+63</p>
                        <?php
echo "<input type='text' id='mobile_number' name='mobile_number'
                        value='" . $employee_details[0]['mobile_number'] . "'>"
?>
                    </div>

                </div>
                <div class="address section">

                    <p class="section-title">Address</p>

                    <label for="street_subdivision">Subdivision</label>
                    <?php
echo "<input type='text' id='street_subdivision' name='street_subdivision'
                        value='" . $employee_details[0]['street_subdivision'] . "'>"
?>

                    <label for="barangay">Barangay *</label>
                    <?php
echo "<input type='text' id='barangay' name='barangay'
                        value='" . $employee_details[0]['barangay'] . "'>"
?>

                    <label for="city">City *</label>
                    <?php
echo "<input type='text' id='city' name='city'
                        value='" . $employee_details[0]['city'] . "'>"
?>

                    <label for="province">Province *</label>
                    <?php
echo "<input type='text' id='province' name='province'
                        value='" . $employee_details[0]['province'] . "'>"
?>

                </div>

                <div class="additional section">

                    <p class="section-title">Additonal *</p>
                    <label for="birthday">Birthday *</label>
                    <?php
echo "<input type='date' id='birthday' name='birthday'
                        value='" . $employee_details[0]['birthday'] . "'>"
?>
                    <p>Marital Status *</p>
                    <div class="marital-status-container">
                        <?php
                                $singlechecked = ($employee_details[0]["marital_status"] == "Single") ? "checked":"";
                                $marriedchecked = ($employee_details[0]["marital_status"] == "Married") ? "checked":"";
                                $widowedchecked = ($employee_details[0]["marital_status"] == "Widowed") ? "checked":"";
                                $seperatedchecked = ($employee_details[0]["marital_status"] == "Seperated") ? "checked":"";
                                ?>
                        <input type='radio' name='marital_status' value='single' <?php echo $singlechecked?>>
                        Single
                        <input type='radio' name='marital_status' value='Married' <?php echo $marriedchecked?>>
                        Married
                        <input type='radio' name='marital_status' value='Widowed' <?php echo $widowedchecked?>>
                        Widowed
                        <input type='radio' name='marital_status' value='Seperated' <?php echo $seperatedchecked?>>
                        Seperated
                    </div>
                </div>

                <div class="job-details section">

                    <p class="section-title">Job Details</p>

                    <label for="job-title">Job Title *</label>
                    <?php
echo "<input type='text' id='job_title' name='job_title'
                        value='" . $employee_details[0]['job_title'] . "'>"
?>

                    <label for="salary">Salary *</label>
                    <?php
echo "<input type='text' id='salary' name='salary'
                        value='" . $employee_details[0]['salary'] . "'>"
?>

                    <label for="hired_date">Hired Date *</label>
                    <?php
echo "<input type='date' id='hired_date' name='hired_date'
                        value='" . $employee_details[0]['hired_date'] . "'>"
?>


                </div>

                <button type="submit" name="update-employee" class="submit">Update Employee</button>
            </form>
        </div>
    </div>
</body>

</html>