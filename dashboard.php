<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch user details including avatar
$user_query = $conn->query("SELECT username, avatar FROM users WHERE id = $user_id");
$user = $user_query->fetch_assoc();

// Fetch leave applications
$leaves = $conn->query("SELECT * FROM leaves WHERE user_id = $user_id");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Your Leave Requests</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .avatar-container {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
        }
        .avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
        }
        .username {
            font-size: 18px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="avatar-container">
	<img src="default_avatar.png" alt="Avatar" width="100" height="100">

		
        <span class="username">Welcome, <?= htmlspecialchars($user['username']) ?></span>
    </div>

    <h2>Your Leave Applications</h2>
    <table border="1">
        <tr>
            <th>Leave Type</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Status</th>
        </tr>
        <?php while ($row = $leaves->fetch_assoc()): ?>
        <tr>
            <td><?= htmlspecialchars($row['leave_type']) ?></td>
            <td><?= htmlspecialchars($row['start_date']) ?></td>
            <td><?= htmlspecialchars($row['end_date']) ?></td>
            <td><?= htmlspecialchars($row['status']) ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
    <a href="apply_leave.php">Apply for Leave</a> | <a href="logout.php">Logout</a>
</body>
</html>
