<?php
include 'db.php';

function addSupplier($name, $contact_info) {
    global $conn;
    $name = sanitizeInput($name);
    $contact_info = sanitizeInput($contact_info);

    $sql = "INSERT INTO suppliers (name, contact_info) VALUES ('$name', '$contact_info')";
    return $conn->query($sql);
}

function updateSupplier($id, $name, $contact_info) {
    global $conn;
    $id = intval($id);
    $name = sanitizeInput($name);
    $contact_info = sanitizeInput($contact_info);

    $sql = "UPDATE suppliers SET name='$name', contact_info='$contact_info' WHERE id=$id";
    return $conn->query($sql);
}
?>
