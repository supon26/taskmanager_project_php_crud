<?php
include("classes/TaskManager.php");
$t1 = new TaskManager();

if(isset($_POST['save'])){
    $t1->store($_POST);
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Task Manager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- fontawesome cdn link   -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="container">
        <div class="row py-4">
            <div class="col-lg-8 offset-lg-2 shadow p-5">
                <div class="title">
                    <h2 class="display-3 text-primary">Task Manager</h2>
                    <p class="lead">This is a simple project.We are going to use html,bootstrap,PHP and MYSQL</p><hr class="w-50 text-center">
                </div>
                <div class="allTask py-4">
                    <table class="table table-striped text-center">
                        <h2 class="display-5 text-primary">All Tasks </h2>
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Task</th>
                                <th>Image</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $data = $t1->show();
                            $i = 1;
                            while($row = mysqli_fetch_assoc($data)){?>
                                <tr>
                                    <td><?= $i++;?></td>
                                    <td><?= $row['task_name']?></td>
                                    <td>
                                        <img src="uploads/<?= $row['task_image']; ?>" width="80" height="50"
                                            alt="Image_task">
                                    </td>
                                    <td><?=  date("d-D-M-Y",strtotime($row['task_date']));?></td>
                                    <td>
                                        <a href="edit.php?id=<?= $row['id']?>" class="btn btn-sm btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>
                                        <a href="delete.php?id=<?= $row['id']?>" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i></a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="addTask">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <h2 class="display-5 text-primary">Add Task</h2>
                        <!-- Display Massage -->
                        <?php
                        
                        if(isset($_SESSION['massage'])){?>
                            <div class="alert alert-<?php echo $_SESSION['type'];?> alert-dismissible fade show" role="alert">
                                <?php echo $_SESSION['massage'];?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        <?php unset($_SESSION['massage']); } ?>
                        
                        <div class="form-group mb-3">
                            <label for="addTask" class="form-label">Add Task</label>
                            <input type="text" name="add_task" class="form-control shadow-none rounded-0" id="addTask"
                                placeholder="Enter Task Details">
                        </div>
                        <div class="form-group mb-3">
                            <label for="taskImage" class="form-label">Task Image</label>
                            <input type="file" name="task_image" class="form-control shadow-none rounded-0" id="taskImage">
                        </div>
                        <div class="form-group mb-3">
                            <label for="addDate" class="form-label">Add Date</label>
                            <input type="date" name="add_date" class="form-control shadow-none rounded-0" id="addDate">
                        </div>
                        <div class="form-group mb-3">
                            <input type="submit" name="save" class="shadow-none rounded-0 btn btn-dark" value="Add Task">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <!-- fontawesome js cdn link -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"
        integrity="sha512-fD9DI5bZwQxOi7MhYWnnNPlvXdp/2Pj3XSTRrFs5FQa4mizyGLnJcN6tuvUS6LbmgN1ut+XGSABKvjN0H6Aoow=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>

</html>