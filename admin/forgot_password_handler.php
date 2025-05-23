<?php
session_start();
include '../database/db_connection.php'; // sigurohu që kjo rrugë është e saktë

$email = $_POST['email'] ?? '';

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['error'] = "Invalid email address.";
    header("Location: forgot-password.php");
    exit;
}

// Kontrollo nëse ekziston
$stmt = $conn->prepare("SELECT request_count FROM forgot_password_requests WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    // ekziston – e rrit numrin
    $stmt = $conn->prepare("UPDATE forgot_password_requests SET request_count = request_count + 1, last_request = NOW() WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $count = $row['request_count'] + 1;
} else {
    // nuk ekziston – e shton për herë të parë
    $stmt = $conn->prepare("INSERT INTO forgot_password_requests (email) VALUES (?)");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $count = 1;
}

// Mundesh këtu me vazhdu me dërgu emailin e reset-it, si në process-forgot-password.php
$_SESSION['success'] = "This is your #$count time requesting a password reset.";
header("Location: forgot-password.php");
exit;
