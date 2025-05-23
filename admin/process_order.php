<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $address = trim($_POST['address'] ?? '');
    $productId = $_POST['product'] ?? '';
    $paymentMethod = $_POST['payment-method'] ?? '';
    $acceptTerms = $_POST['accept-terms'] ?? '';

    if (!$name || !$email || !$address || !$productId || !$paymentMethod || $acceptTerms !== 'on') {
        exit('Please fill all required fields and accept terms.');
    }

    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        exit('Invalid email address.');
    }

    include '../database/db_connection.php';

    $stmt = $conn->prepare("INSERT INTO orders (name, email, address, product_id, payment_method) VALUES (?, ?, ?, ?, ?)");
    if (!$stmt) {
        exit('Database error: ' . $conn->error);
    }

    // Supozoj që paymentMethod është string, productId integer
    $stmt->bind_param("sssis", $name, $email, $address, $productId, $paymentMethod);

    if ($stmt->execute()) {
        unset($_SESSION['cart']);
        echo "Order placed successfully!";
    } else {
        echo "Error placing order: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();

} else {
    echo "Invalid request.";
}
