<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $stock = $_POST['stock'];
    $image_url = $_POST['image_url'];

    if (isset($_POST['price']) && is_numeric($_POST['price'])) {
        $price = (float) $_POST['price'];  
    } else {
        echo "<p>Error: Price is invalid.</p>";
        exit;
    }

    if (!filter_var($image_url, FILTER_VALIDATE_URL)) {
        echo "<p>Error: Invalid image URL.</p>";
        exit;
    }
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($stmt = $conn->prepare("INSERT INTO products (name, category, price, description, stock, image_url) VALUES (?, ?, ?, ?, ?, ?)")) {
     
        $stmt->bind_param("ssdssi", $name, $category, $price, $description, $stock, $image_url);

        
        if ($stmt->execute()) {
            echo "<p>Product added successfully!</p>";
        } else {
            echo "<p>Error: " . $stmt->error . "</p>";
        }
        $stmt->close();
    } else {
        echo "<p>Error: Failed to prepare SQL statement. " . $conn->error . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
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
            margin: 30px auto;
            padding: 30px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #007bff;
            margin-bottom: 30px;
            font-size: 2.5em;
        }
        form {
            display: flex;
            flex-direction: column;
        }

        input, textarea {
            padding: 15px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1.1em;
            transition: border-color 0.3s ease;
        }

        input[type="url"] {
            height: 45px;
        }

        input:focus, textarea:focus {
            border-color: #007bff;
            outline: none;
        }

        textarea {
            height: 120px;
            resize: vertical;
        }

        button {
            background-color: #007bff;
            color: white;
            padding: 14px;
            border: none;
            border-radius: 5px;
            font-size: 1.1em;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
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

        @media (max-width: 768px) {
            .container {
                width: 80%;
            }

            h1 {
                font-size: 2em;
            }
        }

    </style>
</head>
<body>

<div class="container">
    <h1>Add a New Product</h1>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($stmt) && $stmt->execute()) {
        echo "<div class='message success'><p>Product added successfully!</p></div>";
    }
    ?>

    <form method="POST">
        <input type="text" name="name" placeholder="Product Name" required>
        <input type="text" name="category" placeholder="Category" required>
        <input type="number" step="0.01" name="price" placeholder="Price" required>
        <textarea name="description" placeholder="Description" required></textarea>
        <input type="number" name="stock" placeholder="Stock" required>
        <input type="url" name="image_url" placeholder="Image URL" required>
        <button type="submit">Add Product</button>
    </form>
</div>

</body>
</html>
