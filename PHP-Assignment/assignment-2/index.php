<?php
session_start();

include('connect_database.php');

// Check if form is submitted
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

    // Validate Phone Number
    if (!empty($phone) && !preg_match("/^[0-9]{10}$/", $phone)) {
        $errors[] = "Phone number must be exactly 10 digits.";
        $isValid = false;
    }

    // Handle Profile Picture upload
    if (empty($_FILES['profile_picture']['name'])) {
        $errors[] = "Profile Picture empty.";
        $isValid = false;
    } else {
        // File upload logic for profile picture (similar to the one in the update form)
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

    // Insert new employee data if everything is valid
    if ($isValid) {
        $stmt = $conn->prepare("INSERT INTO Employee (First_Name, Last_Name, Email, Phone_Number, Department_ID, Profile_Picture) 
        VALUES (?, ?, ?, ?, ?, ?)");

        // Bind parameters to the prepared statement
        $stmt->bind_param("ssssis", $firstName, $lastName, $email, $phone, $departmentID, $profile_picture);

        if ($stmt->execute()) {
        $_SESSION['success_message'] = "Employee added successfully!";
        header('Location: employee_list.php');
        exit();
        } else {
            echo "Error inserting record: " . $conn->error;
        }
    } else {
            // Store errors in session if there are any
            $_SESSION['error_message'] = implode("<br>", $errors);
            // Retain form data after submission for user to correct
            $_SESSION['form_data'] = $_POST;
            header("Location: index.php"); // Redirect back to the insert form
            exit();
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Employee</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h2>Insert Employee Details</h2>

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
            <input type="text" id="first_name" name="first_name" value="<?php echo isset($_SESSION['form_data']['first_name']) ? $_SESSION['form_data']['first_name'] : ''; ?>" required>

            <!-- Last Name -->
            <label for="last_name">Last Name:</label>
            <input type="text" id="last_name" name="last_name" value="<?php echo isset($_SESSION['form_data']['last_name']) ? $_SESSION['form_data']['last_name'] : ''; ?>" required>

            <!-- Email -->
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo isset($_SESSION['form_data']['email']) ? $_SESSION['form_data']['email'] : ''; ?>" required>

            <!-- Phone Number -->
            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone" value="<?php echo isset($_SESSION['form_data']['phone']) ? $_SESSION['form_data']['phone'] : ''; ?>">

            <!-- Department -->
            <label for="department">Department:</label>
            <select name="department" id="department" required>
                <option value="1" <?php echo isset($_SESSION['form_data']['department']) && $_SESSION['form_data']['department'] == 1 ? 'selected' : ''; ?>>HR</option>
                <option value="2" <?php echo isset($_SESSION['form_data']['department']) && $_SESSION['form_data']['department'] == 2 ? 'selected' : ''; ?>>IT</option>
                <option value="3" <?php echo isset($_SESSION['form_data']['department']) && $_SESSION['form_data']['department'] == 3 ? 'selected' : ''; ?>>Finance</option>
                <!-- Add more departments here as needed -->
            </select>

            <!-- Upload Profile Picture -->
            <label for="profile_picture">Upload Profile Picture:</label>
            <input type="file" name="profile_picture" accept="image/*">

            <div class="btns">
                <button type="submit" class="update">Add Data</button>
                <button class="cancle"><a href="employee_list.php">View Employees</a></button>
            </div>
        </form>
    </div>

    <?php unset($_SESSION['form_data']); // Clear form data after the page loads ?>
</body>

</html>

<?php $conn->close(); ?>
