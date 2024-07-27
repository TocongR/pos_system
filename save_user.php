<?php
session_start();
include '../includes/user.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header('Location: login.php');
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    $user_id = $_POST['user_id'] ?? null; // Check if updating an existing user

    if ($user_id) {
        updateUser($user_id, $username, $role); // Function to update user
    } else {
        addUser($username, $password, $role); // Function to add new user
    }

    header('Location: manage_users.php');
    exit();
}
?>
