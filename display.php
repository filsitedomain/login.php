<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Leave Applications</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
        }
        .container {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 700px;
            animation: fadeIn 1s ease-out;
        }
        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #6c63ff;
            color: white;
        }
        tr {
            transition: all 0.3s ease;
        }
        tr:hover {
            background-color: #f1f1f1;
            transform: scale(1.02);
        }
        a {
            display: inline-block;
            margin-right: 10px;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }
        .apply-leave {
            background-color: #28a745;
            color: white;
        }
        .apply-leave:hover {
            background-color: #218838;
            transform: scale(1.1);
        }
        .logout {
            background-color: #dc3545;
            color: white;
        }
        .logout:hover {
            background-color: #c82333;
            transform: scale(1.1);
        }

        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Your Leave Applications</h2>

        <table>
            <thead>
                <tr>
                    <th>Leave Type</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Sick Leave</td>
                    <td>2025-03-10</td>
                    <td>2025-03-12</td>
                    <td>Pending</td>
                </tr>
                <tr>
                    <td>Vacation</td>
                    <td>2025-04-01</td>
                    <td>2025-04-10</td>
                    <td>Approved</td>
                </tr>
            </tbody>
        </table>

        <a href="apply_leave.php" class="apply-leave">Apply for Leave</a>
        <a href="logout.php" class="logout">Logout</a>
    </div>

</body>
</html>
