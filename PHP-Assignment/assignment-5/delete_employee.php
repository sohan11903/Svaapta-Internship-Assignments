 <?php
    include('connect_database.php');
    
    // Get employee ID
    $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
    $sql = "UPDATE user_data SET deleteVal = 0 WHERE id = $id";
    // $sql = "delete from Employee where Employee_ID = $id";
    $result = $conn->query($sql);
    header("Location: display_details.php");
    exit();
?>