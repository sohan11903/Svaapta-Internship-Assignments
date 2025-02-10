<?php
// Database connection
include('connect_database.php');

// Initialize search term
$searchTerm = '';
if (isset($_GET['search'])) {
    $searchTerm = $_GET['search'];
}

// Count total users with deleteVal = 1
$countSql = "SELECT COUNT(*) AS userCount FROM user_data WHERE deleteVal = 1";
if (!empty($searchTerm)) {
    $countSql .= " AND (First_Name LIKE '%$searchTerm%' OR Last_Name LIKE '%$searchTerm%')";
}
$countResult = $conn->query($countSql);

// Get the user count
$userCount = 0;
if ($countResult->num_rows > 0) {
    $countRow = $countResult->fetch_assoc();
    $userCount = $countRow['userCount'];
}

// Fetch user data
$sql = "SELECT * FROM user_data WHERE deleteVal = 1";
if (!empty($searchTerm)) {
    $sql .= " AND (First_Name LIKE '%$searchTerm%' OR Last_Name LIKE '%$searchTerm%')";
}
$sql .= " ORDER BY First_Name";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee List</title>
    <link rel="stylesheet" href="all_css/display_detail.css">
</head>

<body>
    <h2>Employee List (Total: <?php echo $userCount; ?>)</h2>

    <div class="search-form">
        <form method="GET" action="">
            <input type="text" name="search" placeholder="Search by name"
                value="<?php echo htmlspecialchars($searchTerm); ?>">
            <button type="submit">Search</button>
            <a href="display_details.php">Clear</a>
        </form>
    </div>

    <a href='index.php'
        style='display: block; margin: 20px auto; width: 100px; text-align: center; background-color: #4CAF50; color: white; padding: 10px; text-decoration: none; border-radius: 5px;'>Home</a>

    <?php
    if ($result->num_rows > 0) {
        echo "<table border='1'>
                <tr>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Gender</th>
                    <th>Address</th>
                    <th>Technology</th>
                    <th>Username</th>
                    <th>Profile Picture</th>
                    <th>Action</th>
                </tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
            <td class='sametd'>" . $row["first_name"] . " " . $row["last_name"] . "</td>
            <td class='sametd'>" . $row["email"] . "</td>
            <td class='sametd'>" . (($row["gender"] === 'Other') ? 'N/A' : $row["gender"]) . "</td>
            <td class='sametd'>" . $row['address1'] . " " . $row['address2'] . "</td>
            <td class='sametd'>" . (($row["technology"] === '') ? "N/A" : $row["technology"]) . "</td>
            <td class='sametd'>" . $row["username"] . "</td>
            <td class='sametd'><img src='" . $row["profile_pic"] . "' alt='Profile Picture' style='width: 80px; height: 80px;'></td>
            <td class='action-buttons'>
                <a href='edit_employee.php?id=" . $row["id"] . "' class='edit'>Edit</a>
                <a href='delete_employee.php?id=" . $row["id"] . "' class='delete'>Delete</a>
                <a href='view_employee.php?id=" . $row["id"] . "' class='view'>View</a>
            </td>
        </tr>";
        
    }
    echo "</table>";
    } else {
    echo "No records found!";
    }

    $conn->close();
    ?>
</body>

</html>