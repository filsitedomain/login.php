<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "leave_db";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get employee ID from URL
$id = $_GET['id'] ?? '';

if (!$id) {
    die("Invalid employee ID.");
}

// Fetch employee data
$sql = "SELECT * FROM employees WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$employee = $result->fetch_assoc();

if (!$employee) {
    die("Employee not found.");
}

// Update employee details
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $position = $_POST['position'];
    $department = $_POST['department'];
    $contact = $_POST['contact'];
	$vacationleave = $_POST['vacationleave'];
	$sickleave = $_POST['sickleave'];
	$silleave = $_POST['silleave'];
	$illeave = $_POST['illeave'];

    $update_sql = "UPDATE employees SET name = ?, position = ?, department = ?, contact = ?, vacationleave = ?, sickleave = ?, silleave = ?, illeave = ? WHERE id = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("ssssssssi", $name, $position, $department, $contact, $vacationleave, $sickleave, $silleave, $illeave, $id);

    if ($update_stmt->execute()) {
        echo "Employee updated successfully!";
        header("Location: view_employees.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Employee</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Edit Employee Details</h2>
    <form method="POST">
        <label>Name:</label>
        <input type="text" name="name" value="<?php echo htmlspecialchars($employee['name']); ?>" required><br>

        <label>Position:</label>
        <input type="text" name="position" value="<?php echo htmlspecialchars($employee['position']); ?>" required><br>

        <label>Department:</label>
        <input type="text" name="department" value="<?php echo htmlspecialchars($employee['department']); ?>" required><br>

        <label>Contact:</label>
        <input type="text" name="contact" value="<?php echo htmlspecialchars($employee['contact']); ?>" required><br>
		
		<label>vacationleave:</label>
        <input type="text" name="vacationleave" value="<?php echo htmlspecialchars($employee['vacationleave']); ?>" required><br>
		
		<label>sickleave:</label>
        <input type="text" name="sickleave" value="<?php echo htmlspecialchars($employee['sickleave']); ?>" required><br>
		
		<label>silleave:</label>
        <input type="text" name="silleave" value="<?php echo htmlspecialchars($employee['silleave']); ?>" required><br>
		
		<label>illeave:</label>
        <input type="text" name="illeave" value="<?php echo htmlspecialchars($employee['illeave']); ?>" required><br>

        <button type="submit">Update Employee</button>
    </form>
    <a href="view_employees.php">Back to Employee List</a>
</body>
</html>
