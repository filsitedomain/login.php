<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $leave_type = $_POST['leave_type'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    $conn->query("INSERT INTO leaves (user_id, leave_type, start_date, end_date, status) VALUES ('$user_id', '$leave_type', '$start_date', '$end_date', 'Pending')");
    echo "<p class='success'>Leave request submitted successfully!</p>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apply for Leave</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background: #fff;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }
        h2 {
            text-align: center;
            margin-bottom: 1.5rem;
            color: #333;
        }
        label {
            font-weight: bold;
            display: block;
            margin-bottom: 0.5rem;
        }
        select, input[type="date"] {
            width: 100%;
            padding: 0.75rem;
            margin-bottom: 1rem;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            width: 100%;
            padding: 0.75rem;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 1rem;
            cursor: pointer;
        }
        button:hover {
            background-color: #218838;
        }
        .dashboard-link {
            display: block;
            text-align: center;
            margin-top: 1rem;
            text-decoration: none;
            color: #007bff;
        }
        .dashboard-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Apply for Leave</h2>
        <form method="POST">
            <label for="leave_type">Leave Type:</label>
            <select name="leave_type" id="leave_type">
                <option value="Vacationleave">Vacationleave</option>
                <option value="Sickleave">Sickleave</option>
                <option value="Silleave">Silleave</option>
				<option value="Illeave">Illeave</option>
            </select>

            <label for="start_date">Start Date:</label>
            <input type="date" name="start_date" id="start_date" required>

            <label for="end_date">End Date:</label>
            <input type="date" name="end_date" id="end_date" required>

            <button type="submit">Apply</button>
        </form>
        <a href="dashboard.php" class="dashboard-link">Dashboard</a>
    </div>
</body>
</html>