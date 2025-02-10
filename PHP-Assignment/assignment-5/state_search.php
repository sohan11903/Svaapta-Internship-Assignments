<?php
$q = $_GET['q']; // Get the country from the query string

// Connect to the database
$con = mysqli_connect('localhost', 'root', 'root', 'googlemap');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

// Query to get states for the selected country
$sql = "SELECT * FROM state WHERE country_name = ?";
$stmt = mysqli_prepare($con, $sql);
mysqli_stmt_bind_param($stmt, 's', $q); // Bind the country to the query
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) > 0) {
    // Output the states as options in the 
    echo "<option value=''>Select your State</option>";
    while($row = mysqli_fetch_array($result)) {
        echo "<option value='" . $row['state_name'] . "'>" . $row['state_name'] . "</option>";
    }
} else {
    echo "<option value=''>No states available</option>";
}

mysqli_close($con);
?>
