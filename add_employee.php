<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'leave_db');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function generateUsername($name) {
    $nameParts = explode(' ', strtolower($name));
    return $nameParts[0] . (isset($nameParts[1]) ? $nameParts[1] : '');
}

// Generate a simple random password (customize the logic as needed)
function generatePassword($length = 8) {
    return substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, $length);
}

// Add employee logic
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $conn->real_escape_string($_POST['name']);
    $position = $conn->real_escape_string($_POST['position']);
    $department = $conn->real_escape_string($_POST['department']);
    $contact = $conn->real_escape_string($_POST['contact']);
	$vacationleave = $conn->real_escape_string($_POST['vacationleave']);
	$sickleave = $conn->real_escape_string($_POST['sickleave']);
	$silleave = $conn->real_escape_string($_POST['silleave']);
	$illeave = $conn->real_escape_string($_POST['illeave']);

	
	// Generate username and password
$username = generateUsername($name);
$password = generatePassword();
$hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Hash the password for security
	


    $sql = "INSERT INTO employees (name, position, department, contact, vacationleave, sickleave, silleave, illeave, username, password) 
        VALUES ('$name', '$position', '$department', '$contact', '$vacationleave', '$sickleave', '$silleave', '$illeave', '$username', '$hashedPassword')";


    if ($conn->query($sql) === TRUE) {
        echo "Employee added successfully!";
        header("Location: view_employees.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Employee</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        form { max-width: 400px; margin: auto; }
        label { display: block; margin-bottom: 8px; }
        input[type="text"], input[type="submit"] { width: 100%; padding: 10px; margin-bottom: 10px; }
        .btn { background-color: #28a745; color: white; border: none; cursor: pointer; }
    </style>
</head>
<body>

    <h2>Add New Employee</h2>

    <form method="POST">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="position">Position:</label>
        <input type="text" id="position" name="position" required>

        <label for="department">Department:</label>
        <input type="text" id="department" name="department" required>

        <label for="contact">Contact:</label>
        <input type="text" id="contact" name="contact" required>
		
		<label for="vacationleave">vacationleave:</label>
        <input type="text" id="vacationleave" name="vacationleave" required>
		
		<label for="sickleave">sickleave:</label>
        <input type="text" id="sickleave" name="sickleave" required>
		
		<label for="silleave">silleave:</label>
        <input type="text" id="silleave" name="silleave" required>
		
		<label for="illeave">illeave:</label>
        <input type="text" id="illeave" name="illeave" required>
		


        <input type="submit" class="btn" value="Add Employee">
    </form>
    <a href="view_employees.php">Back to Employee List</a>
</body>
</html>
