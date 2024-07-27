<?php
include 'db.php'; // Make sure the path is correct
include 'functions.php'; // Make sure the path is correct

function registerUser($username, $password, $role) {
    global $conn;
    $username = sanitizeInput($username);
    $passwordHash = password_hash($password, PASSWORD_BCRYPT);
    $role = sanitizeInput($role);
    $sql = "INSERT INTO users (username, password, role) VALUES ('$username', '$passwordHash', '$role')";
    return $conn->query($sql);
}

function authenticateUser($username, $password) {
    global $conn;
    $username = sanitizeInput($username);
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            return $user;
        }
    }
    return false;
}
function getUsers() {
    global $conn;
    $sql = "SELECT * FROM users";
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}

function getUserById($id) {
    global $conn;
    $sql = "SELECT * FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}




function addUser($username, $password, $role) {
    global $conn;
    $username = sanitizeInput($username);
    $password = password_hash(sanitizeInput($password), PASSWORD_DEFAULT);
    $role = sanitizeInput($role);

    $sql = "INSERT INTO users (username, password, role) VALUES ('$username', '$password', '$role')";
    return $conn->query($sql);
}

function updateUser($id, $username, $password, $role) {
    global $conn;
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $sql = "UPDATE users SET username = ?, password = ?, role = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $username, $hashedPassword, $role, $id);
    $stmt->execute();
    $stmt->close();
}


function deleteUser($id) {
    global $conn;
    $id = intval($id);

    $sql = "DELETE FROM users WHERE id = $id";
    return $conn->query($sql);
}?>
