<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<nav>
    <ul class="nav-list">
        <?php if (isset($_SESSION['user_id']) && $_SESSION['role'] == 'admin'): ?>
            <li><a href="/pos_system/public/admin_panel.php">Admin Panel</a></li>
            <li><a href="/pos_system/public/manage_users.php">Manage Users</a></li>
            <!-- Add other admin links as needed -->
        <?php endif; ?>
        <?php if (isset($_SESSION['user_id']) && $_SESSION['role'] == 'cashier'): ?>
            <li><a href="/pos_system/public/cashier_panel.php">Cashier Panel</a></li>
            <!-- Add other cashier links as needed -->
        <?php endif; ?>
        <?php if (isset($_SESSION['user_id'])): ?>
            <li><a href="/pos_system/public/logout.php">Logout</a></li>
        <?php endif; ?>
    </ul>
</nav>
