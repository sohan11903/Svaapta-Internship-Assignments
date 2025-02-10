<?php
    include('fatch_session.php')
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details</title>
    <link rel="stylesheet" href="displaydetail.css">
</head>
<body>
<div class="details-container">
    <h2>User Registration Details</h2>
    <div class="profile-img-container">
        <img src="<?= htmlspecialchars($profile_picture) ?>" alt="Profile Picture">
    </div>
    <ul class="info-list">
        <li>
            <strong>First Name:</strong> <span><?= htmlspecialchars($first_name) ?></span>
        </li>
        <li>
            <strong>Middle Name:</strong> 
            <span><?= !empty($middle_name) ? htmlspecialchars($middle_name) : "N/A" ?></span>
        </li>
        <li>
            <strong>Last Name:</strong> <span><?= htmlspecialchars($last_name) ?></span>
        </li>
        <li>
            <strong>Email Address:</strong> <span><?= htmlspecialchars($email) ?></span>
        </li>
        <li>
            <strong>Year Born:</strong> <span><?= htmlspecialchars($formatted_date) ?></span>
        </li>
        <li>
        <strong>Form Submitted On:</strong> 
        <span><?= htmlspecialchars($submit_time)?></span>
        </li>
    </ul>
</div>
</body>
</html>
 