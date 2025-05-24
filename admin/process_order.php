<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

function processOrderData(string &$name, string &$email, string &$address): void {
    $name = trim($name);
    $email = trim($email);
    $address = trim($address);

    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        exit('Invalid email address.');
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $address = $_POST['address'] ?? '';
    $productId = $_POST['product'] ?? '';
    $paymentMethod = $_POST['payment-method'] ?? '';
    $acceptTerms = $_POST['accept-terms'] ?? '';

    if (!$name || !$email || !$address || !$productId || !$paymentMethod || $acceptTerms !== 'on') {
        exit('Please fill all required fields and accept terms.');
    }

    processOrderData($name, $email, $address);

    include '../database/db_connection.php';

    $stmt = $conn->prepare("INSERT INTO orders (name, email, address, product_id, payment_method) VALUES (?, ?, ?, ?, ?)");
    if (!$stmt) {
        exit('Database error: ' . $conn->error);
    }

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
?>