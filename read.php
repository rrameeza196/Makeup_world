<?php
include 'db.php';

$result = $conn->query("SELECT * FROM products");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            padding: 20px;
        }
        .product-card {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 16px;
            background-color: #f9f9f9;
            text-align: center;
        }
        .product-card img {
            width: 100%;
            height: auto;
            border-radius: 8px;
        }
        .product-card h3 {
            font-size: 1.2em;
            margin: 10px 0;
        }
        .product-card p {
            color: #666;
        }
        .product-card .price {
            font-size: 1.5em;
            color: #007bff;
        }
        .product-card a {
            text-decoration: none;
            color: white;
            background-color: #007bff;
            padding: 10px 15px;
            border-radius: 5px;
            margin-top: 10px;
            display: inline-block;
        }
    </style>
</head>
<body>
    <header>
        <h1>Makeup World - Products</h1>
        <nav>
            <a href="index.html">Home</a>
            <a href="create.php">Add Product</a>
        </nav>
    </header>
    <main>
        <?php
        if ($result->num_rows > 0) {
            echo "<h2>Our Products</h2>";
            echo "<div class='product-grid'>";
            
            while ($row = $result->fetch_assoc()) {
                echo "<div class='product-card'>
                        <img src='{$row['image_url']}' alt='{$row['name']}'>
                        <h3>{$row['name']}</h3>
                        <p>Category: {$row['category']}</p>
                        <p class='price'>{$row['price']}</p>
                        <a href='{$row['image_url']}' target='_blank'>View Product</a>
                        <div class='actions'>
                            <a href='update.php?id={$row['id']}'>Edit</a> | 
                            <a href='delete.php?id={$row['id']}'>Delete</a>
                        </div>
                    </div>";
            }
            echo "</div>";
        } else {
            echo "<p>No products found.</p>";
        }

        $conn->close();
        ?>
    </main>
    <footer>
        <p>&copy; 2024 Makeup World. All rights reserved.</p>
    </footer>
</body>
</html>
