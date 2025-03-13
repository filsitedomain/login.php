<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'leave_db');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get employee data from form
$id = $_POST['id'];
$name = $_POST['name'];
$position = $_POST['position'];
$department = $_POST['department'];
$contact = $_POST['contact'];
$Vacation = $_POST['Vacation'];
$Sick = $_POST['Sick'];
$SIL = $_POST['SIL'];
$IL = $_POST['IL'];

// Update query
$sql = "UPDATE employees SET name='$name', position='$position', department='$department', contact='$contact', Vacation='$Vacation', Sick='$Sick', SIL='$SIL', IL='$IL', WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    echo "Employee updated successfully!";
    header("Location: employee_list.php"); // Redirect to employee list page
} else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();
?>
