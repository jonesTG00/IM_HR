<?php

class Department{
    private $department_id;
    private $department_name;
    private $department_head;
    private $creation_date;

    function __construct($department_id, $department_name, $department_head, $creation_date){
        $this->department_id = $department_id;
        $this->department_name = $department_name;
        $this->department_head = $department_head;
        $this->creation_date = $creation_date;
        
    }

    public function department_add_to_database(){
        try {
            
            $conn = connection();
            $query = "
            INSERT INTO departments(department_name, department_head, creation_date)
            VALUES
            ('".$this->department_name."',
            '".$this->department_head."',
            '".$this->creation_date."'
            );
            ";
            $this->department_id = Employee::return_latest_id();
            $result = $conn->query($query);
            $conn->close();
            echo "<script>alert('Added Successfully')</script>";
        } catch (\Throwable $th) {
            echo "<script>alert('".$th->getMessage()."')</script>";
        }
        
    }

    public static function return_latest_id(){
        try {
            $query = "SELECT `auto_increment` as 'ID' FROM INFORMATION_SCHEMA.TABLES
            WHERE table_name = 'departments'";
            $conn = connection();
            $result = $conn->query($query);
            $id = $result->fetch_assoc();
            $conn->close();
            return $id["ID"];
            
        } catch (\Throwable $th) {
            echo "<script>alert('".$th->getMessage()."')</script>";
        }
    }

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

    public static function return_department_data($id){
        $conn = connection();
        if ($conn == null) {
            return null;
        }
        $query = "SELECT * FROM departments WHERE department_id = ".$id."";
        $result = $conn->query($query);
        $rows = array();
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
        $conn->close();
        return $rows;
    }

    public static function return_employees_in_department($department_id){
        $conn = connection();
        if ($conn == null) {
            return null;
        }
        $query = "SELECT employee_id FROM employee_departments WHERE department_id = ".$department_id.";";
        $result = $conn->query($query);
        $rows = array();
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
        $conn->close();
        return $rows;
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

    public static function update_department($department_name, $department_head, $department_id){
        $conn = connection();
        if ($conn == null) {
            return null;
        }
        $query = "
        UPDATE departments 
        SET department_name = '".$department_name."', 
        department_head = ".$department_head."
        WHERE department_id = ".$department_id."
        ";
        echo "<script>alert(".$query.")</script>";
        $result = $conn->query($query);
        $conn->close();
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

    public static function return_department_id_with_department_name($department_name){
        $conn = connection();
        if ($conn == null) {
            return null;
        }
        $query = "
        SELECT department_id as 'id' FROM departments WHERE department_name = '".$department_name."';
        ";
        $result = $conn->query($query);
        $id = $result->fetch_assoc();
        $conn->close();
        return $id['id'];
    }

    public static function return_department_pagination($limit, $offset){
        $conn = connection();
        if ($conn == null) {
            return null;
        }
        // SELECT * FROM departments LIMIT 3 OFFSET 0;
        $query = "
        SELECT * FROM departments LIMIT ".$limit." OFFSET ".$offset.";
        ";
        $result = $conn->query($query);
        $rows = array();
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        $conn->close();
        return $rows;
    }

    public static function delete_department($department_id){
        try {
            
            $conn = connection();
            $query = "
            DELETE FROM departments WHERE department_id = ".$department_id."
            ";
            $result = $conn->query($query);
            $conn->close();
        } catch (\Throwable $th) {
            echo "<script>alert('".$th->getMessage()."')</script>";
        }
    }
}

?>