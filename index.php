<?php include 'db.php'; ?>
<?php
    if(isset($_POST['add_post'])){
        $task_name = $connection -> real_escape_string($_POST['task_name']);
        $query = mysqli_query($connection,"INSERT INTO tasks (task_name,task_status,task_date) VALUES ('$task_name','pending',now()) ");
        header("location: index.php");
    }
    if(isset($_GET['edit'])){
        $task_id = $_GET['edit'];
        $query = mysqli_query($connection, "UPDATE tasks SET task_status='selesai' WHERE task_id='$task_id' ");
    }
    if(isset($_GET['delete'])){
        $task_id = $_GET['delete'];
        $query = mysqli_query($connection, "DELETE FROM tasks WHERE task_id = '$task_id' ");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center">TODOLIST-APP</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card shadow-lg border-0">
                    <div class="card-body">
                        <h3>Form Tambah Tugas</h3>
                        <form method="post">
                            <div class="form-group">
                                <input type="text" class="form-control" name="task_name" placeholder="Input nama tugas">
                            </div>
                            <div class="form-group">
                                <button type="submit" name="add-post" class="btn btn-primary btn-block">Tambah Tugas </button>
                            </div>
                        </form>
                        <h3>List Panding Tugas</h3>
                        <ul class="list-group">
                            <?php
                                $query = mysqli_query($connection,"SELECT * FROM tasks WHERE task_status='pending' ");
                                while ($row = mysqli_fetch_array($query)) {
                                    $task_id = $row['task_id']; 
                                    $task_name = $row['task_name'];
                                
                            ?>
                            <li class="list-group-item">
                            <?php echo $task_name; ?>
                                <div class="float-right">
                                <a href="index.php?edit=<?php echo $task_id ?>" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Tandai sudah selesai">
                                        <i class="bi bi-check-circle"></i>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                        <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
                                        </svg>
                                    </a>
                                    <!-- Icon trash -->
                                    <a href="index.php?delete=<?php echo $task_id ?> " class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Hapus Tugas">
                                        <i class="bi bi-trash"></i>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                        </svg>
                                    </a>
                                </div>
                            </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card shadow-lg border-0">
                    <div class="card-body">
                        <h3>List Tugas Selesai</h3>
                        <ul class="list-group">
                            <?php
                                $query = mysqli_query($connection, "SELECT * FROM tasks WHERE task_status = 'selesai'");
                                while ($row = mysqli_fetch_array($query)) {
                                    # code...
                            
                            ?>
                            <li class="list-group-item">
                                <?php echo $row['task_name']; ?>

                                <div class="float-right">
                                    <span class="badge badge-primary"><?php echo $row['task_status'];?></span>
                                </div>
                            </li>
                            <?php
                                }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<script>$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})</script>

</body>
</html>