<?php
include '../includes/order.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $items = $_POST['items']; // Assume items are sent as an array from the cashier panel
    $total = calculateTotal($items); // Implement this function in order.php

    $order_id = createOrder($items, $total); // Implement this function in order.php

    if ($order_id) {
        header('Location: print_receipt.php?order_id=' . $order_id);
    } else {
        echo "Error processing sale.";
    }
}
?>
