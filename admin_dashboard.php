<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$result = $conn->query("SELECT role FROM users WHERE id = $user_id");
$user = $result->fetch_assoc();

if ($user['role'] != 'admin') {
    echo "Access denied!";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['leave_id'], $_POST['action'])) {
    $leave_id = intval($_POST['leave_id']);
    $action = $_POST['action'];

    if (in_array($action, ['Approved', 'Rejected'])) {
        $stmt = $conn->prepare("UPDATE leaves SET status = ? WHERE id = ?");
        $stmt->bind_param('si', $action, $leave_id);
        $stmt->execute();
        echo "<p class='success'>Leave request has been $action successfully.</p>";
    }
}

$leaves = $conn->query("SELECT leaves.id, users.username, leave_type, start_date, end_date, status FROM leaves JOIN users ON leaves.user_id = users.id");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #007BFF;
            color: white;
        }
        .success {
            color: green;
        }
        .action-buttons {
            display: flex;
            gap: 5px;
            justify-content: center;
        }
    </style>
</head>
<body>
    <h2>Leave Requests</h2>
    <a href="view_employees.php">Employee List</a>
    <table>
        <tr>
            <th>Username</th>
            <th>Leave Type</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        <?php while ($row = $leaves->fetch_assoc()): ?>
        <tr>
            <td><?= htmlspecialchars($row['username']) ?></td>
            <td><?= htmlspecialchars($row['leave_type']) ?></td>
            <td><?= htmlspecialchars($row['start_date']) ?></td>
            <td><?= htmlspecialchars($row['end_date']) ?></td>
            <td><?= htmlspecialchars($row['status']) ?></td>
            <td>
                <?php if ($row['status'] == 'Pending'): ?>
                    <form method="POST" class="action-buttons">
                        <input type="hidden" name="leave_id" value="<?= $row['id'] ?>">
                        <button type="submit" name="action" value="Approved">Approve</button>
                        <button type="submit" name="action" value="Rejected">Reject</button>
                    </form>
                <?php else: ?>
                    <?= htmlspecialchars($row['status']) ?>
                <?php endif; ?>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
    <a href="logout.php">Logout</a>
</body>
</html>
