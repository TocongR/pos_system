<?php
session_start();
include '../includes/order.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    redirect('login.php');
}

$orders = getOrders(); // Implement this function in order.php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order List</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Order List</h1>
    
    <form method="get" action="view_orders.php">
        <label for="start_date">Start Date:</label>
        <input type="date" id="start_date" name="start_date">
        <label for="end_date">End Date:</label>
        <input type="date" id="end_date" name="end_date">
        <button type="submit">Filter</button>
    </form>
    
    <table>
        <tr>
            <th>Order ID</th>
            <th>User</th>
            <th>Total</th>
            <th>Date</th>
        </tr>
        <?php
        foreach ($orders as $order) {
            echo "<tr>
                    <td>{$order['id']}</td>
                    <td>{$order['user_id']}</td>
                    <td>{$order['total']}</td>
                    <td>{$order['created_at']}</td>
                  </tr>";
        }
        ?>
    </table>

    <p><a href="admin_panel.php">Back to Admin Panel</a></p>
</body>
</html>
