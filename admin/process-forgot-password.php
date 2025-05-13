<?php
session_start();
include '../database/db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    
    // Email validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Invalid email!";
        header("Location: forgot-password.php");
        exit();
    }
    
    // Check if email exists in database
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 0) {
        $_SESSION['error'] = "No account exists with this email!";
        header("Location: forgot-password.php");
        exit();
    }
    
    // Create token and store in database
    $token = bin2hex(random_bytes(32));
    $expires = date("Y-m-d H:i:s", strtotime("+1 hour"));
    
    $stmt = $conn->prepare("UPDATE users SET reset_token = ?, reset_expires = ? WHERE email = ?");
    $stmt->bind_param("sss", $token, $expires, $email);
    $stmt->execute();
    
    // Send email with reset link (actual implementation depends on your email service)
    $resetLink = $base_url . "admin/reset-password.php?token=" . $token;
    $subject = "Password Reset";
    $message = "To reset your password, click on the following link:\n\n" . $resetLink;
    
    // In practice, use a dedicated library for sending emails
    // mail($email, $subject, $message);
    
    $_SESSION['message'] = "We have sent you an email with instructions to reset your password.";
    header("Location: login.php");
    exit();
}

header("Location: forgot-password.php");
exit();
?>