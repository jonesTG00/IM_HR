<?php
// include 'Database.php';

class Employee{

    private $employee_id;
    private $employee_fname;
    private $employee_lname;
    private $employee_mname;
    private $job_title;
    private $salary;
    private $hired_date;
    private $email;
    private $mobile_number;
    private $street_subdivision;
    private $barangay;
    private $city;
    private $province;
    private $birthday;
    private $marital_status;


    function __construct($employee_id,$employee_fname,$employee_lname,$employee_mname,$job_title,$salary,
    $hired_date,$email,$mobile_number,$street_subdivision,$barangay,
    $city,$province,$birthday,$marital_status)
    {
        $this->employee_id = $employee_id;
        $this->employee_fname = $employee_fname;
        $this->employee_lname = $employee_lname;
        $this->employee_mname = $employee_mname;
        $this->job_title = $job_title;
        $this->salary = $salary;
        $this->hired_date = $hired_date;
        $this->email = $email;
        $this->mobile_number = $mobile_number;
        $this->street_subdivision = $street_subdivision;
        $this->barangay = $barangay;
        $this->city = $city;
        $this->province = $province;
        $this->birthday = $birthday;
        $this->marital_status = $marital_status;
    }

    public function employee_add_to_database(){
        $query = 
        "
        INSERT INTO employees
        (employee_fname,employee_lname,employee_mname,job_title,salary,email,mobile_number,street_subdivision,barangay,city, province, birthday,marital_status,hired_date) 
        VALUES
        (
        '".$this->employee_fname."',
        '".$this->employee_lname."',
        '".($this->employee_mname == '' ? null : $this->employee_mname)."',
        '".$this->job_title."',
        ".$this->salary.",
        '".$this->email."',
        '".$this->mobile_number."',
        '".($this->street_subdivision == '' ? null : $this->street_subdivision)."',
        '".$this->barangay."',
        '".$this->city."',
        '".$this->province."',
        '".$this->birthday."',
        '".$this->marital_status."',
        '".$this->hired_date."'
        );
        ";

        try {
            $conn = connection();
            $this->employee_id = Employee::return_latest_id();
            $result = $conn->query($query);
            $conn->close();
            echo "<script>alert('Added Successfully')</script>";
        } catch (\Throwable $th) {
            echo "<script>alert('".$th->getMessage()."')</script>";
        }
        
    }

    public function update_employee(){
        $query = 
        "
        UPDATE employees
        SET
        employee_fname = '".$this->employee_fname."',
        employee_lname = '".$this->employee_lname."',
        employee_mname = '".$this->employee_mname."',
        job_title = '".$this->job_title."',
        salary = ".$this->salary.",
        email = '".$this->email."',
        mobile_number = '".$this->mobile_number."',
        street_subdivision = '".$this->street_subdivision."',
        barangay = '".$this->barangay."',
        city = '".$this->city."',
        province = '".$this->province."',
        birthday = '".$this->birthday."',
        marital_status = '".$this->marital_status."',
        hired_date = '".$this->hired_date."'
        WHERE
        employee_id = ".$this->employee_id.";
        ";

        try {
            $conn = connection();
            $this->employee_id = Employee::return_latest_id();
            $result = $conn->query($query);
            $conn->close();
            echo "<script>alert('Updated Successfully')</script>";
        } catch (\Throwable $th) {
            echo "<script>alert('".$th->getMessage()."')</script>";
        }
        
    }

    public static function delete_employee($id){
        try {
            $conn = connection();
            $query = "DELETE FROM employees WHERE employee_id = ".$id."";
            $result = $conn->query($query);
            $conn->close();
            // echo "<script>alert('Updated Successfully')</script>";
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public static function return_employee_by_id($id){
        try {
            $conn = connection();
            $query = "SELECT * FROM employees WHERE employee_id = ".$id."";
            $result = $conn->query($query);
            $rows = array();
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
            $conn->close();
            return $rows;
        } catch (\Throwable $th) {
            echo "<script>alert('".$th->getMessage()."')</script>";
        }
        
    }

    public function add_employee_to_department($department_name_to_add){
        try {
            $query = "
            INSERT INTO employee_departments (employee_id, department_id, assigned_date)
            VALUES
            (".$this->employee_id.",".Department::return_department_id_with_department_name($department_name_to_add).",'".$this->hired_date."');
            ";
            $conn = connection();
            $result = $conn->query($query);
            $conn->close();
        } catch (\Throwable $th) {
            echo "<script>alert('".$th->getMessage()."')</script>";
        }
    }

    public static function add_employee_to_department_static($employee_id,$department_id){
        try {
            $query = "
            INSERT INTO employee_departments (employee_id, department_id, assigned_date)
            VALUES
            (".$employee_id.",".$department_id.",'".date('Y-m-d')."');
            ";
            $conn = connection();
            $result = $conn->query($query);
            $conn->close();
        } catch (\Throwable $th) {
            echo "<script>alert('".$th->getMessage()."')</script>";
        }
    }

    public static function return_all_employees(){
        $conn = connection();
        if ($conn == null) {
            return null;
        }
        $query = "
        SELECT
        employee_id,
        concat(employee_lname, ', ',employee_fname, ' ', employee_mname) as 'employee_name'
        FROM employees;";
        $result = $conn->query($query); 
        $rows = array();
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        $conn->close();
        return $rows;
    }

    public static function return_latest_id(){
        try {
            $query = "SELECT `auto_increment` as 'ID' FROM INFORMATION_SCHEMA.TABLES
            WHERE table_name = 'employees'";
            $conn = connection();
            $result = $conn->query($query);
            $id = $result->fetch_assoc();
            $conn->close();
            echo "<script>alert(".$id["ID"].")</script>";
            return $id["ID"];
            
        } catch (\Throwable $th) {
            echo "<script>alert('".$th->getMessage()."')</script>";
        }
    }
    
    public static function return_employee_count(){
        $conn = connection();
        if ($conn == null) {
            return null;
        }
        $query = "SELECT employee_id FROM EMPLOYEES;";
        $result = $conn->query($query);
        $conn->close();
        return $result->num_rows;
    }

    public static function return_average_salary(){
        $conn = connection();
        if ($conn == null) {
            return null;
        }
        $query = "SELECT AVG(salary) AS AVGSALARY FROM employees";
        $result = $conn->query($query);
        $conn->close();
        return $result->fetch_assoc();
    }
    
    public static function return_count_greater_than_average_salary(){
        $conn = connection();
        if ($conn == null) {
            return null;
        }
        $query = "SELECT employee_id FROM employees WHERE salary > (SELECT AVG(salary) FROM employees);";
        $result = $conn->query($query);
        $conn->close();
        return $result->num_rows;
    }

    public static function return_last_hired(){
        $conn = connection();
        if ($conn == null) {
            return null;
        }
        $query = "SELECT employee_id, hired_date FROM EMPLOYEES ORDER BY employee_id DESC LIMIT 1;";
        $result = $conn->query($query);
        $conn->close();
        return $result->fetch_assoc();;
    }
    
    public static function return_recent_employees($limit){
        $conn = connection();
        if ($conn == null) {
            return null;
        }
        $query = "
        SELECT
        employee_id,
        concat(employee_lname, ', ', employee_fname) as 'employee_name', 
        job_title,
        hired_date
        FROM employees ORDER BY hired_date DESC LIMIT ". $limit.";";
        $result = $conn->query($query); 
        $rows = array();
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        $conn->close();
        return $rows;
    }

    public static function return_employees_pagination($limit, $offset){
        $conn = connection();
        if ($conn == null) {
            return null;
        }
        $query = "
        SELECT
        employee_id,
        concat(employee_lname, ', ', employee_fname) as 'employee_name', 
        job_title,
        hired_date
        FROM employees ORDER BY hired_date DESC LIMIT ". $limit." OFFSET ".$offset.";";
        $result = $conn->query($query); 
        $rows = array();
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        $conn->close();
        return $rows;
    }
    
    public static function return_employee_department($employee_id){
        try {
            $conn = connection();
            if ($conn == null) {
                return null;
            }
            $query = "
            SELECT
            d.department_id as 'id',
            d.department_name as 'department'
            FROM employee_departments ed
            JOIN departments d
            ON ed.department_id = d.department_id
            WHERE ed.employee_id = ". $employee_id . ";";
            $result = $conn->query($query);
            $rows = array();
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
            $conn->close();
            return $rows;
        } catch (\Throwable $th) {
            echo $th["message"];
        }
    
    }

    public static function return_employee_department_not_included($employee_id){
        try {
            $conn = connection();
            if ($conn == null) {
                return null;
            }
            $query = "
            SELECT d.department_name as 'department', d.department_id as 'id'
            FROM departments d
            WHERE NOT EXISTS (
            SELECT 1
            FROM employee_departments ed
            WHERE ed.employee_id = ".$employee_id." AND ed.department_id = d.department_id);";
            $result = $conn->query($query);
            $rows = array();
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
            $conn->close();
            return $rows;
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    
    }

    public static function return_employee_full_name($id){
        $query = "
        SELECT CONCAT(employee_lname, ', ',employee_fname, ' ', employee_mname) AS 'Full Name'
        FROM employees WHERE employee_id = $id;
        ";
        $conn = connection();
        $result = $conn->query($query);
        $rows = array();
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        $conn->close();
        return $rows;
    }

    public static function remove_employee_from_department($employee_id, $department_id){
        try {
            $query = "
            DELETE FROM employee_departments WHERE employee_id = ".$employee_id." AND department_id = ".$department_id."
            ;";
            $conn = connection();
            $result = $conn->query($query);
            $conn->close();
        } catch (\Throwable $th) {
            echo "<script>alert('".$th->getMessage()."')</script>";
        }
    }
    
}
?>