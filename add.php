<?php

    require 'config.php';
    require 'top.php'; 

    $title = $desc = "";
    $titleErr = $descErr = "";

    // if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //     $title = ($_POST["title"]);
    //     $desc = ($_POST["desc"]);
    //     echo $title . $desc;
    // }

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

        # SQL -> 1) Query, 2) Prepare, 3) Excute
        $sql = "INSERT INTO todo(title, description) VALUES (:title, :description)"; # 1) SQL Query
        $pdo_prepare = $conn->prepare($sql); # 2) SQL Prepare
        $result = $pdo_prepare->execute(
            array(
                ':title' => $title,
                ':description' => $desc
            )
        );

        # Success or Fail
        if ($result) {
            echo "<script>alert('New Task successfully created...');window.location.href='index.php';</script>";
        } else {
            echo "<script>alert('New Task creation fail!')</script>";
        }
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

?>

    <div class="card-header d-flex justify-content-between">
        <h4>New Task</h4>
        <a href="index.php" class="btn btn-success btn-sm"><i class="bi bi-arrow-left-circle"></i></a>
    </div>

    <div class="card-body px-5 py-3">
    
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">

            <div class="mb-3">
                <label for="text" class="form-label">Title</label>
                <input type="text" class="form-control" id="text" name="title" placeholder="Title here...">
                <span class="text-danger"><?php echo $titleErr ?></span>
            </div>

            <div class="mb-3">
                <label for="desc" class="form-label">Description</label>
                <textarea class="form-control" id="desc" rows="3" name="desc" placeholder="Description here..."></textarea>
                <span class="text-danger"><?php echo $descErr ?></span>
            </div>

            <div class="mb-3 d-flex justify-content-end">
                <input type="submit" value="Add" name="submit" class="btn btn-sm btn-success">
            </div>

        </form>

    </div>

<?php require 'base.php'; ?>


