<?php
// Automatically set the cookie if it doesn't exist
if (!isset($_COOKIE['user_cookies'])) {
    setcookie('user_cookies', 'accepted', time() + 86400, "/");
}

// Handle the POST request for manual acceptance
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accept_cookies'])) {
    setcookie('user_cookies', 'accepted', time() + 86400, "/");
    echo json_encode(["success" => true]);
    exit();
}
?>