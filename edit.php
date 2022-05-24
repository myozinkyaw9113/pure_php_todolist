<?php

    require 'config.php';
    require 'top.php'; 

    $title = $desc = "";
    $titleErr = $descErr = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["title"])) {
            $titleErr = "* Title is required";
        } else {
            $title = test_input($_POST["title"]);
        }
    
        if (empty($_POST["desc"])) {
            $descErr = "* Description is required";
        } else {
            $desc = test_input($_POST["desc"]);
        }

        $id = test_input($_POST['id']);

        # SQL -> 1) Query, 2) Prepare, 3) Excute
        $sql = "UPDATE todo SET title='$title',description='$desc' WHERE id='$id'";
        $pdo_statement = $conn->prepare($sql);
        $result = $pdo_statement->execute();

        # Success or Fail
        if ($result) {
            echo "<script>alert('Task successfully updated...');window.location.href='index.php';</script>";
        } else {
            echo "<script>alert('Task to update is fail!')</script>";
        }

    } else {
        $pdo_prepare = $conn->prepare("SELECT * FROM todo WHERE id=".$_GET['id']);
        $pdo_prepare->execute();
        $oldResult = $pdo_prepare->fetchAll();
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

?>

<div class="card-header d-flex justify-content-between">
        <h4>Edit Task</h4>
        <a href="index.php" class="btn btn-success btn-sm"><i class="bi bi-arrow-left-circle"></i></a>
    </div>

    <div class="card-body px-5 py-3">
    
        <form action="" method="POST">
            <input type="hidden" name="id" value="<?php echo $oldResult[0]['id']; ?>">
            <div class="mb-3">
                <label for="text" class="form-label">Title</label>
                <input type="text" class="form-control" id="text" name="title" value="<?php echo $oldResult[0]['title']; ?>" placeholder="Title here...">
                <span class="text-danger"><?php echo $titleErr ?></span>
            </div>

            <div class="mb-3">
                <label for="desc" class="form-label">Description</label>
                <textarea class="form-control" id="desc" name="desc" rows="3" placeholder="Description here...">
                <?php echo $oldResult[0]['description']; ?>
                </textarea>
                <span class="text-danger"><?php echo $descErr ?></span>
            </div>

            <div class="mb-3 d-flex justify-content-end">
                <input type="submit" value="Update" name="submit" class="btn btn-sm btn-success">
            </div>

        </form>

    </div>

<?php require 'base.php'; ?>


