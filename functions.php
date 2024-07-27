<?php
function sanitizeInput($data) {
    global $conn; // Ensure $conn is accessible
    return mysqli_real_escape_string($conn, trim($data));
}

function redirect($url) {
    header("Location: $url");
    exit();
}
?>
