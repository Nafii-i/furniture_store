<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: index.php");
    exit();
}
include('db.php');

if (isset($_POST['add_product'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $image = $_FILES['image']['name'];
    $target = "uploads/" . basename($image); // Save in the uploads folder

    // Validate price and other fields (optional)
    if (is_numeric($price) && !empty($image)) {
        $sql = "INSERT INTO products (name, description, price, image) VALUES ('$name', '$description', '$price', '$image')";
        if ($conn->query($sql) === TRUE) {
            if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
                header("Location: dashboard.php");
            } else {
                echo "Failed to upload image.";
            }
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "Please enter valid details and select an image.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h2>Add New Product</h2>
        <form method="POST" enctype="multipart/form-data">
            <label>Product Name</label><br>
            <input type="text" name="name" required><br>
            <label>Description</label><br>
            <textarea name="description"></textarea><br>
            <label>Price (MYR)</label><br>
            <input type="text" name="price" required><br>
            <label>Product Image</label><br>
            <input type="file" name="image" required><br><br>
            <input type="submit" name="add_product" value="Add Product">
        </form>
    </div>
</body>
</html>
