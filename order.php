<?php
include 'db.php';

function createOrder($items, $total) {
    global $conn;
    $user_id = $_SESSION['user_id'];
    
    $sql = "INSERT INTO orders (user_id, total) VALUES ($user_id, $total)";
    if ($conn->query($sql)) {
        $order_id = $conn->insert_id;
        foreach ($items as $item) {
            $product_id = $item['product_id'];
            $quantity = $item['quantity'];
            $price = $item['price'];
            $sql = "INSERT INTO order_items (order_id, product_id, quantity, price) VALUES ($order_id, $product_id, $quantity, $price)";
            $conn->query($sql);
        }
        return $order_id;
    }
    return false;
}

function calculateTotal($items) {
    $total = 0;
    foreach ($items as $item) {
        $total += $item['quantity'] * $item['price'];
    }
    return $total;
}

function getOrder($order_id) {
    global $conn;
    $sql = "SELECT * FROM orders WHERE id = $order_id";
    $result = $conn->query($sql);
    $order = $result->fetch_assoc();

    $sql = "SELECT * FROM order_items WHERE order_id = $order_id";
    $result = $conn->query($sql);
    $items = $result->fetch_all(MYSQLI_ASSOC);

    $order['items'] = $items;
    return $order;
}

function getOrders($start_date = null, $end_date = null) {
    global $conn;
    $sql = "SELECT * FROM orders";
    if ($start_date && $end_date) {
        $sql .= " WHERE created_at BETWEEN '$start_date' AND '$end_date'";
    }
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}
?>
