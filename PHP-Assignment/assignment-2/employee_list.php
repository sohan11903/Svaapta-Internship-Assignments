<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "registration_trainee";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM  Employee where deletedata=1 order by First_Name";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>Employee List</h2>";
    echo "<a href='index.php' style='display: block; margin: 20px auto; width: 100px; text-align: center; background-color: #4CAF50; color: white; padding: 10px; text-decoration: none; border-radius: 5px;'>Home</a>";
    echo "<table border='1'>
            <tr>
                <th>Full Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Department</th>
                <th>Profile Picture</th>
                <th>Action</th>
            </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["First_Name"] . " " . $row["Last_Name"] . "</td>
                <td>" . $row["Email"] . "</td>
                <td>" . $row["Phone_Number"] . "</td>
                <td>" . getDepartmentName($row["Department_ID"]) . "</td>
                <td><img src='" . $row["Profile_Picture"] . "' alt='Profile Picture' style='width: 80px; height: 80px;'></td>
                <td><a href='edit_employee.php?id=" . $row["Employee_ID"] . "' style='background-color: #2196F3; color: white; padding: 8px 12px; text-decoration: none; border-radius: 4px;'>Edit</a>
                <a href='delete_employee.php?id=" . $row["Employee_ID"] . "' style='background-color: red; color: white; padding: 8px 12px; text-decoration: none; border-radius: 4px;'>Delete</a>
                <a href='view_employee.php?id=" . $row["Employee_ID"] . "' style='background-color: green; color: white; padding: 8px 12px; text-decoration: none; border-radius: 4px;'>View</a>
                </td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "No records found!";
}

$conn->close();

function getDepartmentName($departmentID)
{
    switch ($departmentID) {
        case 1:
            return "IT";
        case 2:
            return "Electrical";
        case 3:
            return "Mechanical";
        default:
            return "Unknown";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee List</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        h2 {
            text-align: center;
            margin-top: 40px;
            color: #333;
        }

        table {
            width: 90%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        th {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            font-size: 16px;
        }

        td {
            padding: 12px 20px;
            font-size: 14px;
            color: #555;
            border-bottom: 1px solid #ddd;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .profile-img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 50%;
            border: 2px solid #ddd;
        }
    </style>
</head>

<body>
</body>

</html>