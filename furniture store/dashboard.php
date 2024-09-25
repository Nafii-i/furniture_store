<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: index.php");
    exit();
}
include('db.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h2>Welcome, <?php echo $_SESSION['admin']; ?>!</h2>
        <a href="add_product.php" class="btn">Add Product</a>
        <a href="logout.php" class="btn">Logout</a>
        <h3>Product List</h3>

        <table>
            <tr>
                <th>ID</th>
                <th>Product Name</th>
                <th>Price (MYR)</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
            <?php
            $sql = "SELECT * FROM products";
            $result = $conn->query($sql);

            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>{$row['id']}</td>";
                echo "<td>{$row['name']}</td>";
                echo "<td>MYR {$row['price']}</td>";
                // Make sure to use the correct path for images in the 'uploads' directory
                echo "<td><img src='uploads/{$row['image']}' alt='Product Image' width='100'></td>";
                echo "<td><a href='edit_product.php?id={$row['id']}'>Edit</a> | <a href='delete_product.php?id={$row['id']}'>Delete</a></td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>
