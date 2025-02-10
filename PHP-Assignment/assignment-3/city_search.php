<?php
$q = intval($_GET['q']);  // Ensure $q is treated as an integer

// Connect to the database
$con = mysqli_connect('localhost', 'root', 'root', 'googlemap');
if (!$con) {
  die('Could not connect: ' . mysqli_error($con));
}

// Use prepared statements to prevent SQL injection
$sql = "SELECT * FROM city WHERE id = ?";
$stmt = mysqli_prepare($con, $sql);
mysqli_stmt_bind_param($stmt, "i", $q);  // "i" means integer
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) > 0) {
  // Output the states as options in the dropdown
  while($row = mysqli_fetch_array($result)) {
    echo "<option value='".$row['id']."'>".$row['city_name']."</option>";
  }
} else {
  echo "<option value=''>No states available</option>";
}

mysqli_close($con);
?>
