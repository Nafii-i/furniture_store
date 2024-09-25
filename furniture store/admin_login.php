<?php
session_start();
include('db.php');

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    
    // Check if the admin is in the users table
    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password' AND role='admin'";
    $result = $conn->query($sql);
    
    if ($result->num_rows == 1) {
        $_SESSION['admin'] = $username;
        header("Location: dashboard.php");  // Redirect to admin dashboard
    } else {
        echo "Invalid admin credentials!";
    }
}
?>
