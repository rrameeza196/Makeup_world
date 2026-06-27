<?php
session_start();

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Makeup World</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to right, #ff9a9e, #fad0c4);
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .dashboard {
            background-color: #fff;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            text-align: center;
            max-width: 500px;
            width: 90%;
        }

        .dashboard h1 {
            font-size: 2.5em;
            margin-bottom: 20px;
            color: #333;
        }

        .dashboard p {
            font-size: 1.2em;
            margin-bottom: 30px;
            color: #666;
        }

        .dashboard a {
            display: inline-block;
            padding: 12px 25px;
            margin: 10px 0;
            font-size: 1.1em;
            font-weight: 600;
            color: #fff;
            background: linear-gradient(to right, #ff758c, #ff7eb3);
            text-decoration: none;
            border-radius: 50px;
            box-shadow: 0 5px 15px rgba(255, 117, 140, 0.3);
            transition: all 0.3s ease;
        }

        .dashboard a:hover {
            background: linear-gradient(to right, #ff5f75, #ff6a98);
            box-shadow: 0 8px 20px rgba(255, 95, 117, 0.5);
            transform: translateY(-2px);
        }

        .dashboard a:active {
            transform: translateY(2px);
        }

        @media (max-width: 768px) {
            .dashboard h1 {
                font-size: 2em;
            }

            .dashboard p {
                font-size: 1em;
            }

            .dashboard a {
                font-size: 1em;
                padding: 10px 20px;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard">
        <h1>Welcome, Admin!</h1>
        <p>Manage your Makeup World website with the options below.</p>
        <a href="read.php">📦 View Products</a>
        <a href="create.php">➕ Add Products</a>
        <a href="logout.php">🚪 Logout</a>
    </div>
</body>
</html>
