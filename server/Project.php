<!-- private $project_id;
    private $project_name;
    private $start_date;
    private $end_date; -->
<?php

class Project{
    private $project_id;
    private $project_name;
    private $start_date;
    private $end_date;

    function __construct($project_id, $project_name, $start_date, $end_date){
        $this->project_id = $project_id;
        $this->project_name = $project_name;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
        
    }

    public function project_add_to_database(){
        try {
            $conn = connection();
            $query = "
            INSERT INTO projects(project_name, start_date, end_date)
            VALUES
            ('". $this->project_name ."',
            '". $this->start_date ."',
            '". $this->end_date ."'
            );
            ";
            $result = $conn->query($query);
            $conn->close();
            echo "<script>alert('Added Successfully')</script>";
        } catch (\Throwable $th) {
            echo "<script>alert('".$th->getMessage()."')</script>";
        }
        
    }

    public function update_project($new_name, $new_start, $new_end){
        try {
            $conn = connection();
            $query = "
            UPDATE projects SET
            project_name = 
            '". $new_name ."',
            start_date = 
            '". $new_start ."',
            end_date = 
            '". $new_end ."'
            WHERE project_id = ".$this->project_id."
            ;";
            $result = $conn->query($query);
            $conn->close();
        } catch (\Throwable $th) {
            echo "<script>alert('".$th->getMessage()."')</script>";
        }
        
    }

    public static function return_project_data($id){
        $conn = connection();
        if ($conn == null) {
            return null;
        }
        $query = "SELECT * FROM projects WHERE project_id = ".$id."";
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
            WHERE table_name = 'projects'";
            $conn = connection();
            $result = $conn->query($query);
            $id = $result->fetch_assoc();
            $conn->close();
            return $id["ID"];
            
        } catch (\Throwable $th) {
            echo "<script>alert('".$th->getMessage()."')</script>";
        }
    }

    public static function return_project_pagination($limit, $offset){
        $conn = connection();
        if ($conn == null) {
            return null;
        }
        $query = "
        SELECT * FROM projects ORDER BY start_date DESC LIMIT ". $limit." OFFSET ".$offset.";";
        $result = $conn->query($query); 
        $rows = array();
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        $conn->close();
        return $rows;
    }

    public static function return_project_count(){
        $conn = connection();
        if ($conn == null) {
            return null;
        }
        $query = "SELECT project_id FROM projects;";
        $result = $conn->query($query);
        $conn->close();
        return $result->num_rows;
    }

    public static function return_recent_projects($limit){
        $conn = connection();
        if ($conn == null) {
            return null;
        }
        $query = "
        SELECT
        project_id as 'id',
        project_name as 'name', 
        start_date as 'start',
        end_date as 'end'
        FROM projects ORDER BY start_date DESC LIMIT ". $limit.";";
        $result = $conn->query($query); 
        $rows = array();
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        $conn->close();
        return $rows;
    }

    public static function delete_project($project_id){
        try {
            
            $conn = connection();
            $query = "
            DELETE FROM projects WHERE project_id = ".$project_id."
            ";
            $result = $conn->query($query);
            $conn->close();
        } catch (\Throwable $th) {
            echo "<script>alert('".$th->getMessage()."')</script>";
        }
    }
}

?>