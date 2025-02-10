<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $server = 'localhost';
        $username = 'root';
        $password = 'root';
        $databaseName = 'registration_trainee';
        $conn = new mysqli($server,$username,$password);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        echo "Connected successfully";
        $sql = "CREATE DATABASE $databaseName";
        if ($conn->query($sql) === TRUE) {
          echo "Database created successfully";
        } else {
          echo "Error creating database: " . $conn->error;
        }
        $conn1 = new mysqli($server, $username, $password, $databaseName);
        // Check connection
        if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        }
        // sql to create table
        $sql = "CREATE TABLE Department (
                   
  ID INT AUTO_INCREMENT PRIMARY KEY,  -- id is the primary key
  Name VARCHAR(255) NOT NULL          -- Department name (HR, IT, etc.)                   
        )";

        if ($conn1->query($sql) === TRUE) {
          echo "Table Department created successfully";
        } else {
        echo "Error creating table: " . $conn->error;
        }

        $conn1->close();
        $conn->close();

    ?>
</body>
</html>