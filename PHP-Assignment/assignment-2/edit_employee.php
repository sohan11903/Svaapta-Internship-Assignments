<?php
session_start();

include('connect_database.php');

// Get employee ID
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Initialize variables and errors
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $departmentID = $_POST['department'];
    $isValid = true;
    $errors = [];

    // Validate input fields
    if (empty($firstName)) {
        $errors[] = "First name is required.";
        $isValid = false;
    } elseif (!preg_match("/^[a-zA-Z]+$/", $firstName)) {
        $errors[] = "First name can only contain letters without spaces.";
        $isValid = false;
    }

    if (empty($lastName)) {
        $errors[] = "Last name is required.";
        $isValid = false;
    } elseif (!preg_match("/^[a-zA-Z]+$/", $lastName)) {
        $errors[] = "Last name can only contain letters without spaces.";
        $isValid = false;
    }

    // Validate Email
    if (empty($email)) {
        $errors[] = "Email is required.";
        $isValid = false;
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
        $isValid = false;
    }

    // Validate Phone Number (optional but must be exactly 10 digits if provided)
    if (!empty($phone) && !preg_match("/^[0-9]{10}$/", $phone)) {
        $errors[] = "Phone number must be exactly 10 digits.";
        $isValid = false;
    }

    // Handle Profile Picture upload
    if (empty($_FILES['profile_picture']['name'])) {
        // Fetch the current profile picture if no new one is uploaded
        $sql = "SELECT Profile_Picture FROM Employee WHERE Employee_ID = $id";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $profile_picture = $row['Profile_Picture'];
        } else {
            $profile_picture = '';
        }
    } else {
        // Handle file upload
        $allowedExtensions = ['jpg', 'jpeg', 'png'];
        $maxSize = 2 * 1024 * 1024; // 2MB

        $fileSize = $_FILES['profile_picture']['size'];
        $fileTmp = $_FILES['profile_picture']['tmp_name'];
        $fileExt = strtolower(pathinfo($_FILES['profile_picture']['name'], PATHINFO_EXTENSION));

        if (!in_array($fileExt, $allowedExtensions)) {
            $errors[] = "Invalid file type. Only JPG, JPEG, and PNG are allowed.";
            $isValid = false;
        } elseif ($fileSize > $maxSize) {
            $errors[] = "File size exceeds the 2MB limit.";
            $isValid = false;
        } else {
            // Upload the file
            $destinationFolder = 'uploads/';
            if (!is_dir($destinationFolder)) {
                mkdir($destinationFolder, 0777, true);
            }

            $fileName = time() . "_" . uniqid() . "." . $fileExt;
            $destinationPath = $destinationFolder . $fileName;

            if (move_uploaded_file($fileTmp, $destinationPath)) {
                $profile_picture = $destinationPath; // Set the new path if upload is successful
            } else {
                $errors[] = "Error uploading the file.";
                $isValid = false;
            }
        }
    }

    // Proceed with the update if everything is valid
    if ($isValid) {
        $sql = "UPDATE Employee 
        SET First_Name = '$firstName', 
            Last_Name='$lastName', 
            Email='$email', 
            Phone_Number='$phone', 
            Department_ID='$departmentID', 
            Profile_Picture='$profile_picture' 
        WHERE Employee_ID=$id";

        if ($conn->query($sql) === TRUE) {
            // Store success message in session and redirect
            $_SESSION['success_message'] = "Employee updated successfully!";
            header('Location: employee_list.php');
            exit();
        } else {
            echo "Error updating record: " . $conn->error;
        }
    } else {
        // Store errors in session if there are any
        $_SESSION['error_message'] = implode("<br>", $errors);
        // Retain form data after submission for user to correct
        $_SESSION['form_data'] = $_POST;
        header("Location: edit_employee.php?id=$id");
        exit();
    }
}

// Fetch employee data for pre-filling the form
$sql = "SELECT * FROM Employee WHERE Employee_ID = $id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $employee = $result->fetch_assoc();
} else {
    echo "Employee not found.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Employee</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h2>Edit Employee Details</h2>

        <!-- Display Errors if any -->
        <?php
        if (isset($_SESSION['error_message'])) {
            echo "<div class='error'>" . $_SESSION['error_message'] . "</div>";
            unset($_SESSION['error_message']); // Clear the error message after displaying it
        }
        ?>

        <form method="POST" enctype="multipart/form-data">
            <!-- First Name -->
            <label for="first_name">First Name:</label>
            <input type="text" id="first_name" name="first_name" value="<?php echo isset($_SESSION['form_data']['first_name']) ? $_SESSION['form_data']['first_name'] : $employee['First_Name']; ?>" required>

            <!-- Last Name -->
            <label for="last_name">Last Name:</label>
            <input type="text" id="last_name" name="last_name" value="<?php echo isset($_SESSION['form_data']['last_name']) ? $_SESSION['form_data']['last_name'] : $employee['Last_Name']; ?>" required>

            <!-- Email -->
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo isset($_SESSION['form_data']['email']) ? $_SESSION['form_data']['email'] : $employee['Email']; ?>" required>

            <!-- Phone Number -->
            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone" value="<?php echo isset($_SESSION['form_data']['phone']) ? $_SESSION['form_data']['phone'] : $employee['Phone_Number']; ?>">

            <!-- Department -->
            <label for="department">Department:</label>
            <select name="department" id="department" required>
                <option value="1" <?php echo isset($_SESSION['form_data']['department']) && $_SESSION['form_data']['department'] == 1 ? 'selected' : ($employee['Department_ID'] == 1 ? 'selected' : ''); ?>>HR</option>
                <option value="2" <?php echo isset($_SESSION['form_data']['department']) && $_SESSION['form_data']['department'] == 2 ? 'selected' : ($employee['Department_ID'] == 2 ? 'selected' : ''); ?>>IT</option>
                <option value="3" <?php echo isset($_SESSION['form_data']['department']) && $_SESSION['form_data']['department'] == 3 ? 'selected' : ($employee['Department_ID'] == 3 ? 'selected' : ''); ?>>Finance</option>
                <!-- Add more departments here as needed -->
            </select>

            <!-- Current Profile Picture -->
            <div class="profile-picture">
                <label>Current Profile Picture:</label><br>
                <img src="<?php echo $employee['Profile_Picture']; ?>" alt="Profile Picture" width="100">
            </div>

            <!-- Upload New Profile Picture -->
            <label for="profile_picture">Upload New Profile Picture:</label>
            <input type="file" name="profile_picture" accept="image/*">

            <div class="btns">
                <button type="submit" class="update">Update Employee</button>
                <button class="cancle"><a href="employee_list.php">Cancel Update</a></button>
            </div>
        </form>
    </div>

    <?php unset($_SESSION['form_data']); // Clear form data after the page loads ?>
</body>

</html>

<?php $conn->close(); ?>
