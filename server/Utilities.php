<?php
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
?>