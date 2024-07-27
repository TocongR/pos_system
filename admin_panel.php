<?php
include '../includes/nav.php'; // Include the navigation menu which handles session_start()

include '../includes/user.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Admin Panel</h1>

    <ul>
        <li><a href="manage_users.php">Manage Users</a></li>
        <li><a href="manage_products.php">Manage Products</a></li>
        <li><a href="manage_suppliers.php">Manage Suppliers</a></li>
        <li><a href="view_orders.php">View Orders</a></li>
        <!-- Add other admin links as needed -->
    </ul>

    <p><a href="logout.php">Logout</a></p>
</body>
</html>
