<?php
include 'db.php';

$id = $_GET['id'];

if ($conn->query("DELETE FROM products WHERE id = $id")) {
    $message = "<div class='message success'><p>Product deleted successfully!</p></div>";
} else {
    $message = "<div class='message error'><p>Error: " . $conn->error . "</p></div>";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Product</title>
    <style>

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f0f4f8;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 50%;
            margin: 50px auto;
            padding: 30px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h1 {
            color: #007bff;
            margin-bottom: 30px;
            font-size: 2.5em;
        }

        .message {
            text-align: center;
            margin-top: 20px;
            font-size: 1.2em;
            padding: 15px;
            border-radius: 5px;
        }

        .message p {
            margin: 0;
            padding: 15px;
            border-radius: 5px;
        }

        .message.success {
            background-color: #28a745;
            color: white;
        }

        .message.error {
            background-color: #dc3545;
            color: white;
        }

        a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 1.1em;
        }

        a:hover {
            background-color: #0056b3;
        }

    </style>
</head>
<body>

<div class="container">
    <h1>Delete Product</h1>

    <?php echo $message; ?>

    <a href="read.php">Back to Product List</a>
</div>

</body>
</html>
