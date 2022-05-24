<?php

    require 'config.php';
    $pdo_statement = $conn->prepare("DELETE FROM todo WHERE id=".$_GET['id']);
    $result = $pdo_statement->execute();
    // header('Location: index.php');
    # Success or Fail
    if ($result) {
        echo "<script>alert('Task successfully deleted...');window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Task to delete is fail!')</script>";
    }

?>