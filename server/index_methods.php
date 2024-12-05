<?php



// QUERIES
function return_employee_count(){
    $conn = connection();
    if ($conn == null) {
        return null;
    }
    $query = "SELECT employee_id FROM EMPLOYEES;";
    $result = $conn->query($query);
    $conn->close();
    return $result->num_rows;
}

function return_last_hired(){
    $conn = connection();
    if ($conn == null) {
        return null;
    }
    $query = "SELECT employee_id, hired_date FROM EMPLOYEES ORDER BY employee_id DESC LIMIT 1;";
    $result = $conn->query($query);
    $conn->close();
    return $result->fetch_assoc();;
}

function return_department_count(){
    $conn = connection();
    if ($conn == null) {
        return null;
    }
    $query = "SELECT department_id FROM departments";
    $result = $conn->query($query);
    $conn->close();
    return $result->num_rows;
}

function return_last_department_created(){
    $conn = connection();
    if ($conn == null) {
        return null;
    }
    $query = "SELECT department_id, department_name FROM departments ORDER BY department_id DESC LIMIT 1;";
    $result = $conn->query($query);
    $conn->close();
    return $result->fetch_assoc();;
}

function return_average_count_per_department(){
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

function return_most_populated_department(){
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

function return_average_salary(){
    $conn = connection();
    if ($conn == null) {
        return null;
    }
    $query = "SELECT AVG(salary) AS AVGSALARY FROM employees";
    $result = $conn->query($query);
    $conn->close();
    return $result->fetch_assoc();
}

function return_count_greater_than_average_salary(){
    $conn = connection();
    if ($conn == null) {
        return null;
    }
    $query = "SELECT employee_id FROM employees WHERE salary > (SELECT AVG(salary) FROM employees);";
    $result = $conn->query($query);
    $conn->close();
    return $result->num_rows;
}

function last_three_employees(){
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
    FROM employees ORDER BY hired_date DESC LIMIT 3;";
    $result = $conn->query($query); 
    $rows = array();
    while ($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }
    $conn->close();
    return $rows;
}

function return_employee_department($employee_id){
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



// UTILITIES
function formatted_date($toFormat){
    $date = new DateTime($toFormat);
    return $date->format('F j, Y');
}

function  formatted_employee_departments(array $department_list){

    $toReturn = "";
    foreach($department_list as $x){
        $toReturn = $toReturn.$x["department"].", ";
    }

    return substr($toReturn, 0, -2);
}

// function CheckConnection(){
//     $conn = connection();
//     if ($conn->connect_errno) {
//         echo "<p>error on connecting</p>";
//         return;
//     }

//     echo "<p>connected man</p>";
// }

?>