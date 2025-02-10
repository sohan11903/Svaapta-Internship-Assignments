<?php
// Database connection
include('connect_database.php');


if (isset($_GET['id'])) {
    $employee_id = $_GET['id'];

    $sql = "SELECT * FROM user_data WHERE id = $employee_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "No employee found with this ID.";
        exit;
    }
} else {
    echo "Invalid request.";
    exit;
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Employee</title>
    <link rel="stylesheet" href="all_css/edit_detail.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="all_js/edit_validation.js"></script>
    <style>
    /* Add some basic styling for the error messages */
    .error {
        color: red;
        font-size: 12px;
        margin-top: -15px;
    }
    </style>
</head>

<body>
    <h2>Edit Employee Details</h2>

    <form method="POST" enctype="multipart/form-data">
        <input type="hidden" id="id" name="id" value="<?php echo $row['id']; ?>">

        <label for="first_name">First Name:</label>
        <input type="text" id="firstName" name="first_name" value="<?php echo $row['first_name']; ?>" required>
        <div id="firstNameError" class="error"></div> <br>

        <label for="last_name">Last Name:</label>
        <input type="text" id="lastName" name="last_name" value="<?php echo $row['last_name']; ?>" required>
        <div id="lastNameError" class="error"></div><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $row['email']; ?>" required>
        <div id="emailError" class="error"></div><br>

        <label for="gender">Gender:</label>
        <div class="gender-options">
            <input type="radio" id="male" name="gender" value="Male"
                <?php if ($row['gender'] == 'Male') echo 'checked'; ?>>
            <label for="male">Male</label>

            <input type="radio" id="female" name="gender" value="Female"
                <?php if ($row['gender'] == 'Female') echo 'checked'; ?>>
            <label for="female">Female</label>
        </div><br>

        <label for="address1">Address Line 1:</label>
        <input type="text" id="address1" name="address1" value="<?php echo $row['address1']; ?>" required>
        <div id="address1Error" class="error"></div><br>


        <label for="address2">Address Line 2:</label>
        <input type="text" id="address2" name="address2" value="<?php echo $row['address2']; ?>">
        <div id="address2Error" class="error"></div>
        <br>

        <label for="technology">Technology:</label><br>
        <div class="technology-options">
            <?php
                $technologies = ['JavaScript', 'Python', 'Java', 'C++', 'php'];
                if (isset($row['technology']) && is_string($row['technology'])) {
                    $savedTechnologies = explode(',', $row['technology']);
                } else {
                    $savedTechnologies = []; 
                }
                foreach ($technologies as $technology) {
                    $checked = in_array($technology, $savedTechnologies) ? 'checked' : '';
                    echo '<input type="checkbox" id="' . strtolower($technology) . '" name="technology[]" value="' . $technology . '" ' . $checked . '>';
                    echo '<label for="' . strtolower($technology) . '">' . $technology . '</label>';
                }
            ?>
        </div><br>

        <label for="username">Username:</label>
        <input type="text" id="username" name="username" value="<?php echo $row['username']; ?>" required>
        <div id="usernameError" class="error"></div><br>

        <label for="profile_pic">Profile Picture:</label>
        <input type="file" name="profile_pic" id="profilepic">
        <br>

        <div class="button-container">
            <button class="sub">Edit Data</button>
            <button class="view">Cancle Edit</button>
        </div>
        <script src="all_js/live_error.js"></script>
    </form>
</body>

</html>