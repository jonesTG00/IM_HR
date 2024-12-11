<!-- private $project_id;
    private $project_name;
    private $start_date;
    private $end_date; -->
<?php

class Task{
    private $task_id;
    private $task_name;
    private $task_description;
    private $date_added;
    private $date_accomplished;

    function __construct($task_id, $task_name, $task_description, $date_added, $date_accomplished){
        $this->task_id = $task_id;
        $this->task_name = $task_name;
        $this->task_description = $task_description;
        $this->date_added = $date_added;
        $this->date_accomplished = $date_accomplished;
        
    }

    public function task_add_to_database(){
        try {
            $conn = connection();
            $query = "
            INSERT INTO tasks(task_name, task_description ,date_added, date_accomplished)
            VALUES
            ('". $this->task_name ."',
            '". $this->task_description ."',
            '". $this->date_added ."',
            null
            );
            ";
            $this->task_id = Task::return_latest_id();
            $result = $conn->query($query);
            $conn->close();
        } catch (\Throwable $th) {
            echo "<script>alert('".$th->getMessage()."')</script>";
        }
        
    }

    public function task_add_to_project($project_id){
        try {
            $conn = connection();
            $query = 
            "INSERT INTO project_tasks (project_id,task_id)
            VALUES (".$project_id.",".$this->task_id.");";

            // var_dump($query);
            $result = $conn->query($query);
            $conn->close();
        } catch (\Throwable $th) {
            echo "<script>alert('".$th->getMessage()."')</script>";
        }
        
    }

    public static function return_tasks_in_project($id){
        $conn = connection();
        if ($conn == null) {
            return null;
        }
        $query = "SELECT task_id FROM project_tasks WHERE project_id = ".$id.";";
        $result = $conn->query($query);
        $rows = array();
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
        $conn->close();
        return $rows;
    }

    public static function return_task_by_id($id){
        try {
            $conn = connection();
            $query = "SELECT * FROM tasks WHERE task_id = ".$id."";
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

    public static function return_latest_id(){
        try {
            $query = "SELECT `auto_increment` as 'ID' FROM INFORMATION_SCHEMA.TABLES
            WHERE table_name = 'tasks'";
            $conn = connection();
            $result = $conn->query($query);
            $id = $result->fetch_assoc();
            $conn->close();
            return $id["ID"];
            
        } catch (\Throwable $th) {
            echo "<script>alert('".$th->getMessage()."')</script>";
        }
    }

    public static function delete_task($task_id){
        try {
            
            $conn = connection();
            $query = "
            DELETE FROM tasks WHERE task_id = ".$task_id."
            ";
            $result = $conn->query($query);
            $conn->close();
        } catch (\Throwable $th) {
            echo "<script>alert('".$th->getMessage()."')</script>";
        }
    }

    public static function update_task($name,$description,$task_id){
        try {
            
            $conn = connection();
            $query = "
            UPDATE tasks SET task_name = '".$name."', task_description = '".$description."' WHERE task_id = ".$task_id."
            ";
            $result = $conn->query($query);
            $conn->close();
        } catch (\Throwable $th) {
            echo "<script>alert('".$th->getMessage()."')</script>";
        }
    }

    public static function set_task_accomplished($task_id){
        try {
            
            $conn = connection();
            $query = "
            UPDATE tasks SET date_accomplished = '".date('Y-m-d')."'  WHERE task_id = ".$task_id."
            ";
            $result = $conn->query($query);
            $conn->close();
        } catch (\Throwable $th) {
            echo "<script>alert('".$th->getMessage()."')</script>";
        }
    }


}

?>