<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "leave_db";

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get employee ID from URL
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // SQL to delete employee
    $sql = "DELETE FROM employees WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Employee deleted successfully!";
        header("Location: view_employees.php");
        exit();
    } else {
        echo "Error deleting employee: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Employee</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; text-align: center; }
        .btn-back { background-color: #6c757d; color: white; padding: 10px 20px; text-decoration: none; border: none; cursor: pointer; }
        .btn-back:hover { background-color: #5a6268; }
    </style>
</head>
<body>

    <h2>Employee Deleted</h2>
    <p>The selected employee has been removed from the system.</p>

    <!-- Back Button -->
    <a href="view_employees.php" class="btn-back">Back to Employee List</a>

</body>
</html>
