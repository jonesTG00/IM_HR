<?php
function connection(){
    include "db.php";
    try {
        return new mysqli($servername, $username, $password, $db);
    } catch (\Throwable $th) {
        echo '<script>alert("Connection to database error occured'.$th[message].'");</script>';
        
    }
    return null;
}
?>