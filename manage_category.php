<?php
include '../includes/category.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $description = $_POST['description'];

    if (isset($_POST['id'])) {
        // Update category
        $id = $_POST['id'];
        updateCategory($id, $name, $description);
    } else {
        // Add new category
        addCategory($name, $description);
    }
    header('Location: admin_panel.php');
}
?>
