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
    <title>View Employee Details</title>
    <link rel="stylesheet" href="all_css/view_detail.css">
</head>

<body>
    <div class="card">
        <h2>View Employee Details</h2>

        <form method="POST" enctype="multipart/form-data">
            <!-- Profile Picture Section -->
            <div class="profile-picture">
                <img src="<?php echo $row['profile_pic']; ?>" alt="Profile Picture">
            </div>

            <!-- Employee Details Section -->
            <div class="form-group">
                <label for="first_name">First Name:</label>
                <p><?php echo $row['first_name']; ?></p>
            </div>

            <div class="form-group">
                <label for="last_name">Last Name:</label>
                <p><?php echo !empty($row['last_name']) ? $row['last_name'] : 'N/A'; ?></p>
            </div>


            <div class="form-group">
                <label for="email">Email:</label>
                <p><?php echo $row['email']; ?></p>
            </div>

            <div class="form-group">
                <label for="gender">Gender:</label>
                <p><?php echo !empty($row['gender']) ? $row['gender'] : 'N/A'; ?></p>
            </div>

            <div class="form-group">
                <label for="address1">Address:</label>
                <p><?php echo $row['address1']; ?></p>
                <p><?php echo $row['address2']; ?></p>
            </div>

            <div class="form-group">
                <label for="technology">Technology:</label>
                <p><?php echo !empty($row['technology']) ? $row['technology'] : 'N/A';  ?></p>
            </div>

            <!-- Location Section -->
            <div class="location-container">
                <div class="form-group">
                    <label for="country">Country:</label>
                    <p><?php echo $row['country']; ?></p>
                </div>
                <div class="form-group">
                    <label for="state">State:</label>
                    <p><?php echo $row['state']; ?></p>
                </div>
                <div class="form-group">
                    <label for="city">City:</label>
                    <p><?php echo $row['city']; ?></p>
                </div>
            </div>

            <div class="form-group">
                <label for="username">Username:</label>
                <p><?php echo $row['username']; ?></p>
            </div>

            <!-- Cancel Button -->
            <div class="button-container">
                <a href="display_details.php" class="view">Cancel View</a>
            </div>
        </form>
    </div>
</body>

</html>