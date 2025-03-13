<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'leave_db');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch employee data
$sql = "SELECT * FROM employees";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee List</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f4f4f4; }
        .btn { padding: 8px 12px; text-decoration: none; margin-right: 5px; border: none; border-radius: 4px; }
        .add { background-color: #28a745; color: white; }
        .edit { background-color: #ffc107; color: black; }
        .delete { background-color: #dc3545; color: white; }
    </style>
</head>
<body>

    <h2>Employee List</h2>
    <a href="add_employee.php" class="btn add">Add New Employee</a>
    <br><br>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Position</th>
                <th>Department</th>
                <th>Contact</th>
				<th>vacationleave</th>
				<th>sickleave</th>
				<th>silleave</th>
				<th>illeave</th>
				<th>Actions</th>
				
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['name']}</td>
                            <td>{$row['position']}</td>
                            <td>{$row['department']}</td>
                            <td>{$row['contact']}</td>
							<td>{$row['vacationleave']}</td>
							<td>{$row['sickleave']}</td>
							<td>{$row['silleave']}</td>
							<td>{$row['illeave']}</td>
                            <td>
                                <a href='edit_employee.php?id={$row['id']}' class='btn edit'>Edit</a>
                                <a href='delete_employee.php?id={$row['id']}' class='btn delete' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No employees found</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <a href="admin_dashboard.php">Leave Request</a>
</body>
</html>

<?php
$conn->close();
?>
