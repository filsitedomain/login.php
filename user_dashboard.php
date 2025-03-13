<?php
// Database connection
include 'db_connect.php';

session_start();
$user_id = $_SESSION['user_id'];

// Count sick and vacation leaves
$query = "SELECT 
            SUM(CASE WHEN leave_type = 'Sick' THEN 1 ELSE 0 END) AS sick_leave_count,
            SUM(CASE WHEN leave_type = 'Vacation' THEN 1 ELSE 0 END) AS vacation_leave_count
          FROM leaves
          WHERE user_id = $user_id AND status = 'Approved'";

$result = $conn->query($query);
$leaveCounts = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave Summary</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Your Leave Summary</h2>
        <form>
            <div class="form-group">
                <label for="sick_leave">Sick Leaves Taken:</label>
                <input type="text" id="sick_leave" value="<?php echo $leaveCounts['sick_leave_count'] ?? 0; ?>" readonly>
            </div>

            <div class="form-group">
                <label for="vacation_leave">Vacation Leaves Taken:</label>
                <input type="text" id="vacation_leave" value="<?php echo $leaveCounts['vacation_leave_count'] ?? 0; ?>" readonly>
            </div>
        </form>
        <a href="user_dashboard.php" class="back-btn">Back</a>
    </div>
</body>
</html>
