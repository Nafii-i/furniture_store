<?php
session_start();
include('db.php');

if (!isset($_SESSION['user'])) {
    header("Location: user_login.php");
    exit();
}

$cart_items = [];
$total_price = 0;

if (isset($_SESSION['cart'])) {
    $cart_ids = implode(',', $_SESSION['cart']);
    
    if (!empty($cart_ids)) {
        $sql = "SELECT * FROM products WHERE id IN ($cart_ids)";
        $result = $conn->query($sql);
        
        while ($row = $result->fetch_assoc()) {
            $cart_items[] = $row;
            $total_price += $row['price'];
        }
    }
}

// Clear cart logic
if (isset($_GET['clear_cart'])) {
    unset($_SESSION['cart']);
    header("Location: cart.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h2>Your Cart</h2>
        <?php if (!empty($cart_items)): ?>
            <table>
                <tr>
                    <th>Product</th>
                    <th>Price (MYR)</th>
                </tr>
                <?php foreach ($cart_items as $item): ?>
                    <tr>
                        <td><?php echo $item['name']; ?></td>
                        <td>MYR <?php echo $item['price']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <h3>Total Price: MYR <?php echo $total_price; ?></h3>
            <a href="checkout.php" class="btn">Proceed to Checkout</a>
            <a href="cart.php?clear_cart" class="btn">Clear Cart</a>
        <?php else: ?>
            <p>Your cart is empty.</p>
        <?php endif; ?>
        <a href="products.php" class="btn">Back to Products</a>
    </div>
</body>
</html>
