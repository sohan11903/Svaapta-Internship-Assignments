<?php
    include('connect_database.php');
    
    // Get employee ID
    $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
    $sql = "UPDATE Employee SET deletedata = 0 WHERE Employee_ID = $id";
    // $sql = "delete from Employee where Employee_ID = $id";
    $result = $conn->query($sql);
    header("Location: employee_list.php");
    exit();
?>