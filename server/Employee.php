<?php
// include 'Database.php';

class Employee{
    
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
        $query;
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
    
    public static function return_employee_department($employee_id){
        try {
            $conn = connection();
            if ($conn == null) {
                return null;
            }
            $query = "
            SELECT
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
    
}
?>