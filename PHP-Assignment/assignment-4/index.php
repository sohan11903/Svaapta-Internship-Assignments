<?php
    include('send_mail.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="form-container">
        <h2>User Registration Form</h2>
        <form method="POST" enctype="multipart/form-data">
            <label for="first_name">First Name:</label>
            <input type="text" id="first_name" name="first_name"
                value="<?= isset($first_name) ? htmlspecialchars($first_name) : (isset($_SESSION['form_data']['first_name']) ? htmlspecialchars($_SESSION['form_data']['first_name']) : '') ?>"
                required>
            <div class="error"><?= isset($errors['first_name']) ? $errors['first_name'] : '' ?></div><br>

            <label for="middle_name">Middle Name:</label>
            <input type="text" id="middle_name" name="middle_name"
                value="<?= isset($middle_name) ? htmlspecialchars($middle_name) : (isset($_SESSION['form_data']['middle_name']) ? htmlspecialchars($_SESSION['form_data']['middle_name']) : '') ?>">
            <div class="error"><?= isset($errors['middle_name']) ? $errors['middle_name'] : '' ?></div><br>

            <label for="last_name">Last Name:</label>
            <input type="text" id="last_name" name="last_name"
                value="<?= isset($last_name) ? htmlspecialchars($last_name) : (isset($_SESSION['form_data']['last_name']) ? htmlspecialchars($_SESSION['form_data']['last_name']) : '') ?>"
                required>
            <div class="error"><?= isset($errors['last_name']) ? $errors['last_name'] : '' ?></div><br>
            <label for="year_born">Year Born:</label>
            <select name="year_born" id="year_born" required>
                <option value="">Select Year</option>
                <?php
                    $current_year = date("Y");
                    for ($year = 1980; $year <= $current_year; $year++) {
                        $selected = ($year == $year_born) ? "selected" : (isset($_SESSION['form_data']['year_born']) && $_SESSION['form_data']['year_born'] == $year ? "selected" : "");
                        echo "<option value='$year' $selected>$year</option>";
                    }
                ?>
            </select>
            <div class="error"><?= isset($errors['year_born']) ? $errors['year_born'] : '' ?></div><br>

            <label for="email">Email Address</label>
            <input type="email" id="email" name="email"
                value="<?= isset($email) ? htmlspecialchars($email) : (isset($_SESSION['form_data']['email']) ? htmlspecialchars($_SESSION['form_data']['email']) : '') ?>"
                required>
            <div class="error"><?= isset($errors['email']) ? $errors['email'] : '' ?></div><br>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <div class="error"><?= isset($errors['password']) ? $errors['password'] : '' ?></div><br>

            <label for="confirm_password">Confirm Password:</label>
            <input type="password" id="confirm_password" name="confirm_password" required>
            <div class="error"><?= isset($errors['confirm_password']) ? $errors['confirm_password'] : '' ?></div><br>

            <label for="profile_picture">Profile Picture:</label>
            <input type="file" id="profile_picture" name="profile_picture" accept="image/*" required>
            <div class="error"><?= isset($errors['profile_picture']) ? $errors['profile_picture'] : '' ?></div><br>
        
            <input type="submit" value="Register" id="registrationForm">
        </form>
    </div>
</body>

</html>