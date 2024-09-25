<?php
session_start();
include('db.php');

if (!isset($_SESSION['user'])) {
    header("Location: user_login.php");
    exit();
}

if (isset($_POST['checkout'])) {
    // Simple checkout logic: Clear cart and redirect to success page
    unset($_SESSION['cart']);
    header("Location: success.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h2>Checkout</h2>
        <form method="POST">
            <p>Your total is MYR <?php echo $_SESSION['total_price']; ?></p>
            <input type="submit" name="checkout" value="Checkout">
        </form>
    </div>
</body>
</html>
