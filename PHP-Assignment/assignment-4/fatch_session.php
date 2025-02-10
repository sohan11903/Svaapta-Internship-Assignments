<?php
// Start the session to access form data
session_start();

// Check if the session contains form data
if (!isset($_SESSION['form_data'])) {
    echo "No data found. Please fill out the form first.";
    exit;
}

// Retrieve data from session
$form_data = $_SESSION['form_data'];
$first_name = $form_data['first_name'];
$middle_name = $form_data['middle_name'];
$last_name = $form_data['last_name'];
$year_born = $form_data['year_born'];
$email = $form_data['email'];
$password = $form_data['password'];
$profile_picture = $form_data['profile_picture'];
$submit_time = $form_data['submit_time'];

// Format the year born (to a more readable format)
$date_of_birth = "$year_born"; 

// Format the date
$formatted_date = date('d M Y', strtotime($date_of_birth)); // Format the year as '29 Apr 2014'
?>
