<?php
include 'db.php';

function addCategory($name, $description) {
    global $conn;
    $name = sanitizeInput($name);
    $description = sanitizeInput($description);

    $sql = "INSERT INTO categories (name, description) VALUES ('$name', '$description')";
    return $conn->query($sql);
}

function updateCategory($id, $name, $description) {
    global $conn;
    $id = intval($id);
    $name = sanitizeInput($name);
    $description = sanitizeInput($description);

    $sql = "UPDATE categories SET name='$name', description='$description' WHERE id=$id";
    return $conn->query($sql);
}
?>
