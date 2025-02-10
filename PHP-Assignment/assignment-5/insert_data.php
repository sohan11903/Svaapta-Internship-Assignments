<?php
// Database connection
include('connect_database.php');
// Get form data
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$email = $_POST['email'];
$gender = $_POST['gender'];
$password = $_POST['password'];
$address1 = $_POST['address1'];
$address2 = $_POST['address2'];
$country = $_POST['country'];
$state = $_POST['state'];
$city = $_POST['city'];
$technologies = $_POST['technologies'];  
$username = $_POST['username'];

$uploadDir = 'uploads/';
$dest_path = "";

if (empty($gender)) {
    $gender = 'Other';
}
// echo $gender; die();
// Handle file upload with error checking
if (isset($_FILES['profilePic']) && $_FILES['profilePic']['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['profilePic']['tmp_name'];
    $fileName = $_FILES['profilePic']['name'];
    $fileSize = $_FILES['profilePic']['size'];
    $fileType = $_FILES['profilePic']['type'];

    $uploadDir = 'uploads/';
    $dest_path = $uploadDir . $fileName;
} else {
    if($gender === 'Male'){
        $dest_path = 'uploads/male.jpeg';
    }
    elseif ($gender === 'Female') {
        $dest_path = 'uploads/female.jpeg';
    }
    else{
        $dest_path = 'uploads/none.png';
    }
}


$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
// echo $technologies; die();
$stmt = $conn->prepare("INSERT INTO user_data (first_name, last_name, email, gender, password, address1, address2, country, state, city, technology, username, profile_pic) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ? ,?)");

$stmt->bind_param("sssssssssssss", $firstName,$lastName, $email, $gender, $hashedPassword, $address1, $address2, $country, $state, $city, $technologies , $username, $dest_path);

if ($stmt->execute()) {
    echo "success"; 
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();

$conn->close();
?>
