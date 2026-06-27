<?php
include 'db.php';

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM products WHERE id = $id");
$product = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $stock = $_POST['stock'];

    $stmt = $conn->prepare("UPDATE products SET name = ?, category = ?, price = ?, description = ?, stock = ? WHERE id = ?");
    $stmt->bind_param("ssdsii", $name, $category, $price, $description, $stock, $id);

    if ($stmt->execute()) {
        echo "<p class='message success'>Product updated successfully!</p>";
    } else {
        echo "<p class='message error'>Error: " . $stmt->error . "</p>";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7f6;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 60%;
            margin: 50px auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }
        .container:hover {
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.2);
        }
        h1 {
            text-align: center;
            color: #ff6f61;
            font-size: 2.5em;
            margin-bottom: 20px;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        input, textarea {
            padding: 14px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 1.1em;
            transition: all 0.3s ease;
        }
        input[type="number"]:focus, input[type="text"]:focus, textarea:focus {
            border-color: #ff6f61;
            outline: none;
        }
        textarea {
            height: 120px;
            resize: vertical;
        }
        button {
            background-color: #ff6f61;
            color: white;
            padding: 15px;
            border: none;
            border-radius: 8px;
            font-size: 1.2em;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #ff3e2a;
        }
        .message {
            text-align: center;
            margin-top: 20px;
            font-size: 1.2em;
            padding: 10px;
            border-radius: 5px;
            color: #fff;
        }
        .message.success {
            background-color: #28a745;
        }
        .message.error {
            background-color: #dc3545;
        }
        .message p {
            margin: 0;
        }
        .product-image {
            width: 100%;
            max-width: 400px;
            height: auto;
            border-radius: 8px;
            margin-bottom: 20px;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Update Product</h1>
    <?php if ($product['image_url']): ?>
        <img src="<?= $product['image_url'] ?>" alt="Product Image" class="product-image">
    <?php else: ?>
        <p>No image available.</p>
    <?php endif; ?>

    <form method="POST">
        <input type="text" name="name" value="<?= $product['name'] ?>" placeholder="Product Name" required>
        <input type="text" name="category" value="<?= $product['category'] ?>" placeholder="Category" required>
        <input type="number" step="0.01" name="price" value="<?= $product['price'] ?>" placeholder="Price" required>
        <textarea name="description" placeholder="Description" required><?= $product['description'] ?></textarea>
        <input type="number" name="stock" value="<?= $product['stock'] ?>" placeholder="Stock" required>
        <button type="submit">Update Product</button>
    </form>
</div>

</body>
</html>
