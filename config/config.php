<?php
// echo "<pre>";
// print_r($row);
// echo "</pre>";
// die();

class Connection{
    
    protected $conn;
    public function __construct(){
        $this->conn = new mysqli("localhost","root","","task_manager");
    }
}

?>