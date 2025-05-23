<?php
session_start();
include '../database/db_connection.php';

$email = $_POST['email'] ?? '';

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['error'] = "Invalid email address.";
    header("Location: forgot-password.php");
    exit;
}

$stmt = $conn->prepare("SELECT request_count FROM forgot_password_requests WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    $stmt = $conn->prepare("UPDATE forgot_password_requests SET request_count = request_count + 1, last_request = NOW() WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $count = $row['request_count'] + 1;
} else {
    $stmt = $conn->prepare("INSERT INTO forgot_password_requests (email) VALUES (?)");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $count = 1;
}
$_SESSION['success'] = "This is your #$count time requesting a password reset.";
header("Location: forgot-password.php");
exit;
