<?php

class Department{
    public static function return_department_count(){
        $conn = connection();
        if ($conn == null) {
            return null;
        }
        $query = "SELECT department_id FROM departments";
        $result = $conn->query($query);
        $conn->close();
        return $result->num_rows;
    }
    
    public static function return_last_department_created(){
        $conn = connection();
        if ($conn == null) {
            return null;
        }
        $query = "SELECT department_id, department_name FROM departments ORDER BY department_id DESC LIMIT 1;";
        $result = $conn->query($query);
        $conn->close();
        return $result->fetch_assoc();;
    }

    public static function return_average_count_per_department(){
        $conn = connection();
        if ($conn == null) {
            return null;
        }
        $query = "SELECT AVG(avgcount) as AVG FROM 
        (SELECT COUNT(department_id) AS avgcount FROM employee_departments GROUP BY department_id) 
        AS subquery;";
        $result = $conn->query($query);
        $conn->close();
        return $result->fetch_assoc();;
    }

    public static function return_department_name(){
        $conn = connection();
        if ($conn == null) {
            return null;
        }
        $query = "SELECT department_name FROM departments;";
        $result = $conn->query($query);
        $rows = array();
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
        $conn->close();
        return $rows;
    }
    
    public static function return_most_populated_department(){
        $conn = connection();
        if ($conn == null) {
            return null;
        }
        $query = "
        SELECT ed.department_id, d.department_name,COUNT(ed.department_id) as counts 
        FROM employee_departments ed
        JOIN departments d
        ON ed.department_id = d.department_id
        GROUP BY ed.department_id
        ORDER BY counts DESC
        LIMIT 1;
        ";
        $result = $conn->query($query);
        $conn->close();
        return $result->fetch_assoc();
    }
}

?>