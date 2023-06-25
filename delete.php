<?php

include("classes/TaskManager.php");
$t1 = new TaskManager();

$id = $_GET['id'];

if(isset($_GET['id'])){
    $t1->destroy($id);
}

?>



