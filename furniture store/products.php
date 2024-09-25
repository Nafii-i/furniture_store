<?php
session_start();
include('db.php');

// Check if user is logged in
if (!isset($_SESSION['user'])) {
    header("Location: user_login.php");
    exit();
}

// Add to cart logic
if (isset($_GET['add_to_cart'])) {
    $product_id = $_GET['add_to_cart'];
    
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
    
    // Add product ID to cart
    $_SESSION['cart'][] = $product_id;
    
    header("Location: cart.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h2>Products</h2>
        <a href="cart.php" class="btn">View Cart</a>
        <a href="logout.php" class="btn">Logout</a>
        <table>
            <tr>
                <th>Product</th>
                <th>Price (MYR)</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
            <?php
            $sql = "SELECT * FROM products";
            $result = $conn->query($sql);
            
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>{$row['name']}</td>";
                echo "<td>MYR {$row['price']}</td>";
                echo "<td><img src='uploads/{$row['image']}' width='100'></td>";
                echo "<td><a href='products.php?add_to_cart={$row['id']}'>Add to Cart</a></td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>
