<?php
session_start();
include '../includes/user.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header('Location: login.php');
    exit();
}

if (isset($_GET['id'])) {
    $user_id = intval($_GET['id']);
    deleteUser($user_id); // Function to delete user
}

header('Location: manage_users.php');
exit();
?>
