<?php
session_start();
include '../includes/user.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header('Location: login.php');
    exit();
}

if (isset($_GET['id'])) {
    $user_id = intval($_GET['id']);
    $user = getUser($user_id); // Function to get a single user
}

if (!$user) {
    header('Location: manage_users.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit User</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Edit User</h1>
    
    <form action="save_user.php" method="post">
        <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" value="<?php echo $user['username']; ?>" required>
        <label for="role">Role:</label>
        <select id="role" name="role">
            <option value="admin" <?php echo $user['role'] == 'admin' ? 'selected' : ''; ?>>Admin</option>
            <option value="cashier" <?php echo $user['role'] == 'cashier' ? 'selected' : ''; ?>>Cashier</option>
        </select>
        <button type="submit">Update User</button>
    </form>

    <p><a href="manage_users.php">Back to Manage Users</a></p>
</body>
</html>
