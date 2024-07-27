<?php
include 'db.php';

function addProduct($name, $description, $price, $quantity, $category_id, $supplier_id, $expiration_date, $barcode) {
    global $conn;
    $name = sanitizeInput($name);
    $description = sanitizeInput($description);
    $price = sanitizeInput($price);
    $quantity = sanitizeInput($quantity);
    $category_id = intval($category_id);
    $supplier_id = intval($supplier_id);
    $expiration_date = sanitizeInput($expiration_date);
    $barcode = sanitizeInput($barcode);

    $sql = "INSERT INTO products (name, description, price, quantity, category_id, supplier_id, expiration_date, barcode)
            VALUES ('$name', '$description', '$price', '$quantity', '$category_id', '$supplier_id', '$expiration_date', '$barcode')";
    return $conn->query($sql);
}

function updateProduct($id, $name, $description, $price, $quantity, $category_id, $supplier_id, $expiration_date, $barcode) {
    global $conn;
    $id = intval($id);
    $name = sanitizeInput($name);
    $description = sanitizeInput($description);
    $price = sanitizeInput($price);
    $quantity = sanitizeInput($quantity);
    $category_id = intval($category_id);
    $supplier_id = intval($supplier_id);
    $expiration_date = sanitizeInput($expiration_date);
    $barcode = sanitizeInput($barcode);

    $sql = "UPDATE products SET
            name='$name', description='$description', price='$price', quantity='$quantity',
            category_id='$category_id', supplier_id='$supplier_id', expiration_date='$expiration_date',
            barcode='$barcode' WHERE id=$id";
    return $conn->query($sql);
}

function searchProducts($search) {
    global $conn;
    $search = sanitizeInput($search);
    $sql = "SELECT * FROM products WHERE name LIKE '%$search%' OR barcode LIKE '%$search%'";
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}
?>
