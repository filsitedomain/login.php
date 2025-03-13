<?php
session_start();

// Sample credentials for testing
$valid_username = "admin";
$valid_password = "password";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === $valid_username && $password === $valid_password) {
        $_SESSION['username'] = $username;
        header("Location: dashboard.php");
    } else {
        header("Location: login.php?error=true");
    }
    exit();
}
?>
