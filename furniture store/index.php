<?php
session_start();
include('db.php');

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM admins WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $_SESSION['admin'] = $username;
        header("Location: dashboard.php");
    } else {
        $error = "Invalid login credentials";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="css/style.css">
    
</head>

<body>
<div style="text-align: right; margin: 20px;">
    <a href="user_login.php">
        <button style="padding: 10px 20px; margin-right: 10px;">User Login</button>
    </a>
    <a href="user_register.php">
        <button style="padding: 10px 20px;">User Registration</button>
    </a>
</div>
    <div class="container">
        <h2>Admin Login</h2>
        <form method="POST" action="">
            <label>Username</label>
            <input type="text" name="username" required><br>
            <label>Password</label>
            <input type="password" name="password" required><br>
            <input type="submit" name="login" value="Login">
            <?php if (isset($error)) { echo "<p style='color:red; text-align:center;'>$error</p>"; } ?>
        </form>
    </div>
   
</div>
</body>
</html>
