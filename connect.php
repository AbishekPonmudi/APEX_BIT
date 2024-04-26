<?php
// Change these values according to your MySQL configuration
$host = "localhost"; // Assuming MySQL is running on the same server
$username = "phpmyadmin"; // Your phpMyAdmin username
$password = "admin"; // Your phpMyAdmin password
$database = "login_database"; // Your database name

// Create connection
$con = mysqli_connect($host, $username, $password, $database);

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

