<?php
$servername = "localhost";
$username = "root"; // Your MySQL username (default is "root" in XAMPP)
$password = ""; // Your MySQL password (default is empty in XAMPP)
$dbname = "leave_db"; // Ensure this matches your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
