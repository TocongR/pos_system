<?php
include '../includes/supplier.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $contact_info = $_POST['contact_info'];

    if (isset($_POST['id'])) {
        // Update supplier
        $id = $_POST['id'];
        updateSupplier($id, $name, $contact_info);
    } else {
        // Add new supplier
        addSupplier($name, $contact_info);
    }
    header('Location: admin_panel.php');
}
?>
