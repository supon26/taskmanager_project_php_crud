<?php
session_start();
include("config/config.php");

class TaskManager extends Connection{
    // Add Task
    public function store($allData){
        $taskName = $allData['add_task'];

        $imageName = $_FILES['task_image']['name'];
        $temImageName = $_FILES['task_image']['tmp_name'];

        $taskDate = $allData['add_date'];

        $sql = "INSERT INTO `task`(`task_name`, `task_image`, `task_date`) VALUES('$taskName','$imageName','$taskDate')";
        $result = $this->conn->query($sql);
        if($result){
            $_SESSION['massage'] = "Data Inserted Successfully";
            $_SESSION['type']    = "success";
            move_uploaded_file($temImageName,"uploads/".$imageName);
        }
        else{
            $_SESSION['massage'] = "Data Not Inserted !";
            $_SESSION['type'] = "danger";
        }
    }
    // Show Task
    public function show(){
        return $this->conn->query("SELECT * FROM `task`");
    }
    // Delete Task
    public function destroy($t_id){

        // Image delete from uploads directory
        $imgdl = $this->conn->query("SELECT * FROM `task` WHERE id='$t_id'");
        if($imgdl){
            $row = mysqli_fetch_assoc($imgdl);
            $imgTask = $row['task_image'];
            unlink("uploads/".$imgTask);
        }
        // Delete task from database
        $sql = "DELETE FROM `task` WHERE id='$t_id'";
        $result = $this->conn->query($sql);

        if($result){
            header("location:index.php");
        }
    }

    // Edit Task
    public function edit($t_id){
        $res = $this->conn->query("SELECT * FROM `task` WHERE id='$t_id'");
        return $res;
    }

    // Update Task
    public function update($allData,$t_id){
         $newTaskName = $allData['new_task'];
         $newTaskDate = $allData['new_date'];
        
        $old_imageName = $allData['old_image'];

        $newImage_name    = $_FILES['task_image']['name'];
        $newImage_temName = $_FILES['task_image']['tmp_name'];
        
        if($newImage_name != ""){
            $update_image_name = $newImage_name;
        }
        else{
            $update_image_name = $old_imageName;
        }

        if(file_exists("/uploads".$newImage_name)){
            $sql = "UPDATE `task` SET `task_name`='$newTaskName',`task_image`='$update_image_name',`task_date`='$newTaskName' WHERE
            id='$t_id'";

            $result = $this->conn->query($sql);
            header("location:index.php");
        }else{

            $sql = "UPDATE `task` SET `task_name`='$newTaskName',`task_image`='$update_image_name',`task_date`='$newTaskDate' WHERE
            id='$t_id'";
            $result = $this->conn->query($sql);
            
            if($result){
                if($newImage_name != ""){

                    move_uploaded_file($newImage_temName,"uploads/".$newImage_name);
                    unlink("uploads/".$old_imageName);

                    $_SESSION['massage'] = "Data Updated Successfully";
                    $_SESSION['type'] = "success";

                    header("location:index.php");
                }
                else{
                    $_SESSION['massage'] = "Data Not Updated!";
                    $_SESSION['type'] = "danger";

                    header("location:index.php");
                }
            }
        }

    }
}    

?>