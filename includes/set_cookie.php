<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accept_cookies'])) {
    setcookie('user_cookies', 'accepted', time() + 86400, "/");
    echo json_encode(["success" => true]);
    exit();
}