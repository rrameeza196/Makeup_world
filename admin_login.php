<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Makeup World</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to bottom right, #ff9a9e, #fad0c4);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-form {
            background: #fff;
            padding: 40px 30px;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            text-align: center;
            width: 100%;
            max-width: 400px;
        }

        .login-form h1 {
            margin-bottom: 20px;
            font-size: 2.2em;
            color: #333;
        }

        .login-form input {
            width: 100%;
            padding: 12px 15px;
            margin: 15px 0;
            border: 1px solid #ddd;
            border-radius: 50px;
            font-size: 1em;
            outline: none;
            transition: all 0.3s ease;
        }

        .login-form input:focus {
            border-color: #ff758c;
            box-shadow: 0 0 8px rgba(255, 117, 140, 0.3);
        }

        .login-form button {
            width: 100%;
            padding: 12px 20px;
            background: linear-gradient(to right, #ff758c, #ff7eb3);
            color: #fff;
            border: none;
            border-radius: 50px;
            font-size: 1.1em;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(255, 117, 140, 0.3);
        }

        .login-form button:hover {
            background: linear-gradient(to right, #ff5f75, #ff6a98);
            box-shadow: 0 8px 20px rgba(255, 95, 117, 0.5);
            transform: translateY(-2px);
        }

        .login-form button:active {
            transform: translateY(2px);
        }

        .error {
            color: red;
            font-size: 0.9em;
            margin-top: 10px;
        }

        @media (max-width: 768px) {
            .login-form h1 {
                font-size: 1.8em;
            }

            .login-form button {
                font-size: 1em;
                padding: 10px 18px;
            }

            .login-form input {
                padding: 10px 12px;
            }
        }
    </style>
</head>
<body>
    <div class="login-form">
        <h1>Admin Login</h1>
        <form action="validate_admin.php" method="POST">
            <input type="text" name="username" placeholder="Admin Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
