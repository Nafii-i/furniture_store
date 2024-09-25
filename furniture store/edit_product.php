<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: index.php");
    exit();
}
include('db.php');

$id = $_GET['id'];
$sql = "SELECT * FROM products WHERE id=$id";
$result = $conn->query($sql);
$product = $result->fetch_assoc();

if (isset($_POST['update_product'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $image = $_FILES['image']['name'];
    $target = "uploads/" . basename($image);

    if ($image) {
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
        $sql = "UPDATE products SET name='$name', description='$description', price='$price', image='$image' WHERE id=$id";
    } else {
        $sql = "UPDATE products SET name='$name', description='$description', price='$price' WHERE id=$id";
    }

    if ($conn->query($sql) === TRUE) {
        header("Location: dashboard.php");
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h2>Edit Product</h2>
        <form method="POST" enctype="multipart/form-data">
            <label>Product Name</label><br>
            <input type="text" name="name" value="<?php echo $product['name']; ?>" required><br>
            <label>Description</label><br>
            <textarea name="description"><?php echo $product['description']; ?></textarea><br>
            <label>Price</label><br>
            <input type="text" name="price" value="<?php echo $product['price']; ?>" required><br>
            <label>Product Image</label><br>
            <input type="file" name="image"><br><br>
            <img src="uploads/<?php echo $product['image']; ?>" width="100"><br><br>
            <input type="submit" name="update_product" value="Update Product">
        </form>
    </div>
</body>
</html>
