<?php
session_start();
include '../includes/user.php';

if (!isset($_SESSION['user_id'])) {
    redirect('login.php');
}

$user = getUserById($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Welcome, <?php echo htmlspecialchars($user['username']); ?></h1>
    <p><a href="admin_panel.php">Admin Panel</a></p>
    <p><a href="cashier_panel.php">Cashier Panel</a></p>
    <p><a href="logout.php">Logout</a></p>
</body>
</html>
