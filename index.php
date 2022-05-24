<?php 

    require 'config.php';
    require 'top.php'; 

    $pdo_prepare = $conn->prepare("SELECT * FROM todo ORDER BY id DESC"); # SQL Query + Prepare
    $pdo_prepare->execute(); # SQL Excute
    $result = $pdo_prepare->fetchAll(); # SQL Excute Data Fetching

?>

    <div class="card-header d-flex justify-content-between">
        <h4>To Do List</h4>
        <a href="add.php" class="btn btn-success btn-sm"><i class="bi bi-plus-circle"></i></a>
    </div>

    <div class="card-body">
    
        <?php
            $i = 1;
            if ($result) {
                foreach ($result as $value) {
        ?>           

            <div class="d-flex justify-content-between align-item-center border-bottom p-2 gap-3">

                <div>
                    <h5> <?php echo $i . '. '; echo $value['title'] ?></h5>
                    <p><?php echo $value['description'] ?></p>
                </div>

                <div>
                    <small><u><?php echo date('Y-m-d', strtotime($value['created_at'])) ?></u></small>
                    <div class="d-flex justify-content-end gap-1 mt-2">
                        <a href="edit.php?id=<?php echo $value['id']; ?>" class="btn btn-warning btn-sm"><i class="bi bi-pen"></i></a>
                        <a href="delete.php?id=<?php echo $value['id']; ?>" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></a>
                    </div>
                </div>

            </div>

        <?php
                    $i++;
                }
            } else {
        ?>
                <h4>No record yet!s</h4>
        <?php
            }
        ?>

    </div>
            
<?php require 'base.php'; ?>