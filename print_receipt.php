<?php
// Code for generating and printing receipts
include '../includes/order.php';

if (isset($_GET['order_id'])) {
    $order_id = intval($_GET['order_id']);
    $order = getOrder($order_id); // Implement this function in order.php

    if ($order) {
        echo "<h1>Receipt</h1>";
        echo "<p>Order ID: " . $order['id'] . "</p>";
        echo "<p>Date: " . $order['created_at'] . "</p>";
        echo "<p>Products:</p>";
        echo "<ul>";
        foreach ($order['items'] as $item) {
            echo "<li>" . $item['name'] . " - " . $item['quantity'] . " x " . $item['price'] . "</li>";
        }
        echo "</ul>";
        echo "<p>Total: " . $order['total'] . "</p>";
        // Add functionality for different receipt sizes
    } else {
        echo "Order not found.";
    }
} else {
    echo "No order ID provided.";
}
?>
