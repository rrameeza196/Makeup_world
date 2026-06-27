<?php
session_start();

$users = [
    ['username' => 'Maryam', 'password' => '1234'],
];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    foreach ($users as $user) {
        if ($user['username'] == $username && $user['password'] == $password) {
            $_SESSION['user_logged_in'] = true;
            $_SESSION['username'] = $username;
            header('Location: products.php');
            exit();
        }
    }
    $error = "Invalid Username or Password!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(to bottom right,#ff9a9e, #fad0c4);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-form {
            background-color: #ffffff;
            padding: 40px 35px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 380px;
            text-align: center;
        }

        .login-form h1 {
            font-size: 2em;
            color: #333;
            margin-bottom: 25px;
            font-weight: bold;
        }

        .login-form input {
            width: 100%;
            padding: 14px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1em;
            transition: 0.3s ease;
        }

        .login-form input:focus {
            border-color: #ff5f75;
            outline: none;
        }

        .login-form button {
            width: 100%;
            padding: 14px;
            background-color: #ff5f75;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 1.1em;
            cursor: pointer;
            transition: 0.3s;
        }

        .login-form button:hover {
            background-color: #ff5f75;
        }

        .login-form .error {
            color: red;
            font-size: 0.9em;
            margin-top: 15px;
            display: block;
        }

        .login-form .forgot-password {
            color: #888;
            font-size: 0.9em;
            text-decoration: none;
            margin-top: 10px;
            display: inline-block;
            transition: 0.3s ease;
        }

        .login-form .forgot-password:hover {
            color: #ff5f75;
        }

        .login-form input, .login-form button {
            opacity: 0;
            animation: fadeIn 1s forwards;
        }

        .login-form input:nth-child(1) {
            animation-delay: 0.3s;
        }

        .login-form input:nth-child(2) {
            animation-delay: 0.6s;
        }

        .login-form button {
            animation-delay: 0.9s;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
    </style>
</head>
<body>
    <div class="login-form">
        <h1>User Login</h1>
        <form method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        <?php if (isset($error)): ?>
            <div class="error"><?= $error ?></div>
        <?php endif; ?>
    </div>
</body>
</html>
