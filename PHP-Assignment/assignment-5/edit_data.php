<?php
// Database connection
include('connect_database.php');

// Get form data
ini_set('display_errors', 1);
error_reporting(E_ALL);

$id = $_POST['id'];
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$email = $_POST['email'];
$gender = $_POST['gender'];
$address1 = $_POST['address1'];
$address2 = $_POST['address2'];
$technologies = $_POST['technologies'];  
$username = $_POST['username'];
$isValid = true;

// Check if uploads directory exists and is writable
if (empty($_FILES['profilePic']['name'])) {
    // Fetch the current profile picture if no new one is uploaded
    $sql = "SELECT profile_pic FROM user_data WHERE id = $id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $profile_picture = $row['profile_pic'];
    } else {
        $profile_picture = '';
    }
  
} else {
    $uploadDir = 'uploads/';
    $dest_path = "";
    // Handle file upload
    $fileTmpPath = $_FILES['profilePic']['tmp_name'];
    $fileName = $_FILES['profilePic']['name'];
    $fileSize = $_FILES['profilePic']['size'];
    $fileType = $_FILES['profilePic']['type'];

    $uploadDir = 'uploads/';
    $dest_path = $uploadDir . $fileName;
    $profile_picture = $dest_path;

}
// Ensure $_POST['technologies'] is an array
if (!is_array($technologies)) {
    $technologies = explode(',', $technologies); // If it's a string, convert it into an array
}

// Convert array to comma-separated string
$techString = implode(",", $technologies);

// Prepare the SQL statement to update user data, including technologies
$stmt = $conn->prepare("UPDATE user_data 
                        SET first_name = ?, 
                            last_name = ?, 
                            email = ?, 
                            gender = ?, 
                            address1 = ?, 
                            address2 = ?, 
                            technology = ?, 
                            username = ?, 
                            profile_pic = ? 
                        WHERE id = ?");

$stmt->bind_param("sssssssssi", 
    $firstName, $lastName, $email, $gender, $address1, $address2, 
    $techString, $username, $profile_picture, $id);

if ($stmt->execute()) {
    // Success message
    echo "success"; // Send success message back to AJAX
} else {
    echo "Error updating record: " . $stmt->error;
}

    // No file uploaded, use existing profile picture from DB
    

$stmt->close();
$conn->close();
?>
