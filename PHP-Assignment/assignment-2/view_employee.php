<?php
include('connect_database.php');
// Get employee ID
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$sql = "SELECT * FROM Employee WHERE Employee_ID = $id";
$result = $conn->query($sql);

// Fetch employee data
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Employee Details</title>
    <style>
    /* General Styles */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Arial", sans-serif;
    }

    body {
        background: #f4f4f4;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    /* Container */
    .container {
        background: white;
        padding: 20px 30px;
        border-radius: 10px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 400px;
        text-align: center;
    }

    /* Heading */
    h2 {
        margin-bottom: 15px;
        color: #333;
    }

    /* Profile Picture */
    .profile-picture {
        display: flex;
        justify-content: center;
        margin-bottom: 15px;
    }

    .profile-picture img {
        width: 120px;
        height: 120px;
        object-fit: cover;
        border-radius: 50%;
        border: 3px solid #007bff;
        box-shadow: 0px 2px 6px rgba(0, 0, 0, 0.2);
    }

    /* Labels & Employee Data */
    label {
        font-weight: bold;
        color: #555;
        display: block;
        text-align: left;
        margin-top: 10px;
    }

    p {
        background: #f9f9f9;
        padding: 8px;
        border-radius: 5px;
        font-size: 16px;
        text-align: left;
    }

    /* Buttons */
    button {
        border: none;
        padding: 10px 15px;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
        transition: 0.3s ease;
        width: 100%;
        margin-top: 15px;
    }

    .cancle a {
        text-decoration: none;
        color: white;
        display: block;
        text-align: center;
    }

    .cancle {
        background: #dc3545;
    }

    .cancle:hover {
        background: #c82333;
    }

    /* Responsive */
    @media (max-width: 480px) {
        .container {
            padding: 15px;
        }

        .profile-picture img {
            width: 100px;
            height: 100px;
        }

        button {
            width: 100%;
        }
    }
    </style>
</head>

<body>
    <div class="container">
        <h2>View Employee Details</h2>

        <form method="POST" enctype="multipart/form-data">
            <div class="profile-picture">
                <img src="<?php echo $row['Profile_Picture']; ?>" alt="Profile Picture">
            </div>

            <label>First Name:</label>
            <p><?php echo $row['First_Name']; ?></p>

            <label>Last Name:</label>
            <p><?php echo $row['Last_Name']; ?></p>

            <label>Email:</label>
            <p><?php echo $row['Email']; ?></p>

            <label>Phone Number:</label>
            <p><?php echo $row['Phone_Number']; ?></p>

            <label>Department:</label>
            <p>
                <?php 
                    if ($row['Department_ID'] == 1) {
                        echo "I.T";
                    } elseif ($row['Department_ID'] == 2) {
                        echo "Electrical";
                    } else {
                        echo "Mechanical";
                    }
                ?>
            </p>

            <button class="cancle"><a href="employee_list.php">Cancel View</a></button>
        </form>
    </div>
</body>

</html>

<?php $conn->close(); ?>