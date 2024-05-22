<?php
$servername = "localhost"; // Replace 'localhost' with your MySQL server hostname
$username = "id22081343_root"; // Replace 'id22081343_root' with your MySQL username
$password = "Polomolok123!"; // Replace 'your_password' with your MySQL password
$database = "id22081343_ims480"; // Replace 'your_database' with your MySQL database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
