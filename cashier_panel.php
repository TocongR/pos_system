<?php
session_start();
include '../includes/user.php';
include '../includes/product.php';
include '../includes/order.php';
include '../includes/nav.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'cashier') {
    redirect('login.php');
}

// Handle sales transactions and product searches
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cashier Panel</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Cashier Panel</h1>
    
    <h2>Search Products</h2>
    <form method="post" action="search_product.php">
        <input type="text" name="search" placeholder="Enter product name or barcode" required>
        <button type="submit">Search</button>
    </form>
    
    <h2>Current Sale</h2>
    <form method="post" action="process_sale.php">
        <div id="sale-items">
            <!-- Add sale items dynamically here -->
        </div>
        <button type="submit">Complete Sale</button>
    </form>

    <p><a href="logout.php">Logout</a></p>
</body>
</html>
