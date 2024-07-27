<?php
include '../includes/db.php';
include '../includes/user.php';
include '../includes/nav.php';

if ($_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit();
}

$users = getUsers();
$editingUser = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['add_user'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $role = $_POST['role'];
        addUser($username, $password, $role);
        header("Location: manage_users.php");
        exit();
    } elseif (isset($_POST['edit_user'])) {
        $id = $_POST['id'];
        $editingUser = getUserById($id);
    } elseif (isset($_POST['update_user'])) {
        $id = $_POST['id'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $role = $_POST['role'];
        updateUser($id, $username, $password, $role);
        header("Location: manage_users.php");
        exit();
    } elseif (isset($_POST['delete_user'])) {
        $id = $_POST['id'];
        deleteUser($id);
        header("Location: manage_users.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Users</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Manage Users</h1>

    <?php if ($editingUser): ?>
        <h2>Edit User</h2>
        <form action="manage_users.php" method="post">
            <input type="hidden" name="update_user" value="1">
            <input type="hidden" name="id" value="<?php echo $editingUser['id']; ?>">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($editingUser['username']); ?>" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <label for="role">Role:</label>
            <select id="role" name="role" required>
                <option value="admin" <?php if ($editingUser['role'] == 'admin') echo 'selected'; ?>>Admin</option>
                <option value="cashier" <?php if ($editingUser['role'] == 'cashier') echo 'selected'; ?>>Cashier</option>
            </select>
            <button type="submit">Update User</button>
        </form>
    <?php else: ?>
        <h2>Add User</h2>
        <form action="manage_users.php" method="post">
            <input type="hidden" name="add_user" value="1">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <label for="role">Role:</label>
            <select id="role" name="role" required>
                <option value="admin">Admin</option>
                <option value="cashier">Cashier</option>
            </select>
            <button type="submit">Add User</button>
        </form>
    <?php endif; ?>

    <h2>Existing Users</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?php echo $user['id']; ?></td>
                    <td><?php echo $user['username']; ?></td>
                    <td><?php echo $user['role']; ?></td>
                    <td>
                        <form action="manage_users.php" method="post" style="display:inline;">
                            <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                            <button type="submit" name="edit_user">Edit</button>
                        </form>
                        <form action="manage_users.php" method="post" style="display:inline;">
                            <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                            <button type="submit" name="delete_user" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
