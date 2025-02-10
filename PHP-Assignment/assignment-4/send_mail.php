<?php
// Start the session to store form data
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load PHPMailer
require __DIR__ . '/vendor/autoload.php';
        
$errors = [];
$first_name = $middle_name = $last_name = $year_born = $email = $password = $confirm_password = $profile_picture = "";

// Function to validate inputs
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($errors)) {
        // Show only the first error
        $first_error = reset($errors);
        echo "<p style='color: red; font-weight: bold;'>$first_error</p>";
    }
    // Collect form data and sanitize
    $first_name = trim($_POST['first_name']);
    $middle_name = trim($_POST['middle_name']);
    $last_name = trim($_POST['last_name']);
    $year_born = trim($_POST['year_born']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // 1. All fields are mandatory except middle name
    if (empty($first_name)) {
        $errors['first_name'] = "First Name is required.";
    } elseif (!preg_match("/^[a-zA-Z]*$/", $first_name)) {
        $errors['first_name'] = "First Name should not contain special characters or spaces.";
    }

    if (!empty($middle_name) && !preg_match("/^[a-zA-Z]*$/", $middle_name)) {
        $errors['middle_name'] = "Middle Name should not contain special characters or spaces.";
    }

    if (empty($last_name)) {
        $errors['last_name'] = "Last Name is required.";
    } elseif (!preg_match("/^[a-zA-Z]*$/", $last_name)) {
        $errors['last_name'] = "Last Name should not contain special characters or spaces.";
    }

    if (empty($year_born)) {
        $errors['year_born'] = "Year Born is required.";
    }

    if (empty($email)) {
        $errors['email'] = "Email Address is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email format.";
    }

    if (empty($password)) {
        $errors['password'] = "Password is required.";
    } elseif (strlen($password) < 8) {
        $errors['password'] = "Password must be at least 8 characters.";
    }

    if ($password !== $confirm_password) {
        $errors['confirm_password'] = "Passwords do not match.";
    }

    // 2. Profile picture validation
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
        $profile_picture = $_FILES['profile_picture'];
        $target_directory = "uploads/";
        $target_file = $target_directory . basename($profile_picture["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if file is an image
        $check = getimagesize($profile_picture["tmp_name"]);
        if ($check === false) {
            $errors['profile_picture'] = "File is not an image.";
        }

        // Check file size (1 MB max)
        if ($profile_picture["size"] > 1048576) {
            $errors['profile_picture'] = "Sorry, your file is too large. Maximum allowed size is 1 MB.";
        }

        // Allow only JPG, JPEG, PNG file formats
        if ($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png") {
            $errors['profile_picture'] = "Only JPG, JPEG, PNG files are allowed.";
        }
    } else {
        $errors['profile_picture'] = "Profile Picture is required.";
    }
    date_default_timezone_set('Asia/Kolkata');
    $submission_time = date("Y-m-d H:i:s"); 
    // If there are no errors, process the form and store data in session
    if (empty($errors)) {
        // Store data in the session
        $_SESSION['form_data'] = [
            'first_name' => $first_name,
            'middle_name' => $middle_name,
            'last_name' => $last_name,
            'year_born' => $year_born,
            'email' => $email,
            'password' => $password,
            'profile_picture' => $target_file,
            'submit_time' => $submission_time,
        ];
        // Redirect or show success message (you can also store form data in a database here)
        echo "Registration successful!";
        $password = trim(file_get_contents('my.txt'));
        $mail = new PHPMailer(true);

        try {
            // SMTP Configuration
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com'; // Gmail SMTP Server
            $mail->SMTPAuth   = true;
            $mail->Username   = 'sohan11903@gmail.com'; // Your Gmail
            $mail->Password   = $password; // Use Gmail App Password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // SSL
            $mail->Port       = 465;

            // Sender and recipient
            $mail->setFrom('sohan11903@gmail.com', 'Sohan');
            $mail->addAddress($email, $first_name . ' ' . $last_name);
            $mail->addReplyTo('sohan11903@gmail.com', 'Sohan');

            // Email content
            $mail->isHTML(true);
            $mail->Subject = 'Registration Successful';
            $mail->Body = '<h3>Hello ' . htmlspecialchars($first_name) . ',</h3>
               <p>Thank you for registering with us. Here are your registration details:</p>
               <ul>
                   <li><b>Full Name:</b> ' . htmlspecialchars($first_name) . ' ' . (!empty($middle_name) ? htmlspecialchars($middle_name) : " ") . ' ' . htmlspecialchars($last_name) . '</li>
                   <li><b>Email:</b> ' . htmlspecialchars($email) . '</li>
                   <li><b>Year Born:</b> ' . htmlspecialchars($year_born) . '</li>
                   </li><li><b>registrationtime:</b> ' . htmlspecialchars($submission_time) . '</li>
               </ul>
               <h4>Login Information:</h4>
               <p>You can log in to your account using the following credentials:</p>
               <ul>
                   <li><b>Email:</b> ' . htmlspecialchars($email) . '</li>
                   <li><b>Password:</b> (Hidden for security reasons)</li>
               </ul>
               <p>Click below to log in:</p>
               <p><a href="http://localhost/assignment-4/index.php" style="background-color: #4CAF50; color: white; padding: 10px 20px; text-decoration: none; display: inline-block;">Login Now</a></p>
               <p>If you did not register, please ignore this email.</p>
               <p>Best Regards,<br> Sohan Prajapati</p>';
            $mail->AltBody = 'Hello ' . $first_name . ', Thank you for registering with us.';
            // Send email
            $mail->send();
            // Success message
            echo 'Registration successful! A confirmation email has been sent.';
            
        } catch (Exception $e) {
            echo "Error: {$mail->ErrorInfo}";
        }
        header("Location: display_details.php");
            exit();
    }
}
?>
