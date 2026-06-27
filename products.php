<?php
session_start();
if (!isset($_SESSION['user_logged_in']) || $_SESSION['user_logged_in'] !== true) {
    header("Location: user_login.php");
    exit();
}

$pdo = new PDO('mysql:host=localhost;dbname=makeup_db', 'root', ''); 
$stmt = $pdo->query("SELECT * FROM products");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
    $_SESSION['total_price'] = 0;
}

if (isset($_GET['add_to_cart'])) {
    $product_id = $_GET['add_to_cart'];
    foreach ($products as $product) {
        if ($product['id'] == $product_id) {
            $_SESSION['cart'][] = $product;
            $_SESSION['total_price'] += $product['price'];
            break;
        }
    }
    header("Location: products.php");
    exit();
}

if (isset($_GET['remove_from_cart'])) {
    $product_id = $_GET['remove_from_cart'];
    foreach ($_SESSION['cart'] as $key => $product) {
        if ($product['id'] == $product_id) {
           
            $_SESSION['total_price'] -= $product['price'];
         
            unset($_SESSION['cart'][$key]);
            break;
        }
    }

    $_SESSION['cart'] = array_values($_SESSION['cart']);
    header("Location: products.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products - Makeup World</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .container {
            display: flex;
            justify-content: space-between;
            margin: 50px auto;
            width: 90%;
            max-width: 1200px;
        }

        .products {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 30px;
            justify-items: center;
            width: 75%;
        }

        .product {
            background: #fff;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            width: 100%;
            max-width: 300px;
            text-align: center;
        }

        .product:hover {
            transform: translateY(-10px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        }

        .product img {
            width: 100%;
            height: auto;
            border-radius: 10px;
            margin-bottom: 15px;
            object-fit: cover;
        }

        .product h2 {
            font-size: 1.5em;
            margin-bottom: 15px;
            color: #333;
        }

        .product p {
            font-size: 1.1em;
            margin-bottom: 20px;
            color: #777;
        }

        .product button {
            padding: 12px 20px;
            background-color: #ff4d4d;
            color: white;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            font-size: 1.1em;
            transition: 0.3s;
        }

        .product button:hover {
            background-color: #e60000;
        }

        .product .no-image {
            font-size: 1.2em;
            color: #888;
            margin: 15px 0;
        }

        .cart-summary {
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
            position: sticky;
            top: 50px;
            width: 20%;
            height: auto;
        }

        .cart-summary h3 {
            font-size: 1.5em;
            margin-bottom: 20px;
            text-align: center;
        }

        .cart-summary p {
            font-size: 1.2em;
            color: #555;
            text-align: center;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #fff;
            padding: 15px 25px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .header h1 {
            color: #333;
            font-size: 1.8em;
        }

        .logout-button {
            background-color: #ff4d4d;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 25px;
            cursor: pointer;
            font-size: 1em;
            transition: 0.3s;
        }

        .logout-button:hover {
            background-color: #e60000;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>Welcome, <?= $_SESSION['username']; ?></h1>
        <form method="POST" action="logout.php">
            <button type="submit" class="logout-button">Logout</button>
        </form>
    </div>

    <div class="container">
     
        <div class="products">
            <?php foreach ($products as $product): ?>
                <div class="product">
                    <h2><?= $product['name']; ?></h2>
                    <p>Price: $<?= $product['price']; ?></p>

                    <?php if (!empty($product['image_url'])): ?>
                        <img src="<?= $product['image_url']; ?>" alt="<?= $product['name']; ?>">
                    <?php else: ?>
                        <p class="no-image">No image available</p>
                    <?php endif; ?>

                    <a href="?add_to_cart=<?= $product['id']; ?>">
                        <button>Add to Cart</button>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="cart-summary">
            <h3>Your Cart</h3>
            <p>Total Items: <?= count($_SESSION['cart']); ?></p>
            <p>Total Price: $<?= $_SESSION['total_price']; ?></p>

            <h4>Items in Cart</h4>
            <ul>
                <?php foreach ($_SESSION['cart'] as $product): ?>
                    <li>
                        <?= $product['name']; ?> - $<?= $product['price']; ?>
                        <a href="?remove_from_cart=<?= $product['id']; ?>" style="color: red; text-decoration: none;">Remove</a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>

</body>
</html>
