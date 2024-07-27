<?php
include '../includes/product.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $search = $_POST['search'];
    $products = searchProducts($search); // Implement this function in product.php

    foreach ($products as $product) {
        echo "<p>{$product['name']} - {$product['price']}</p>";
    }
}
?>
