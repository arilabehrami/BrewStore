<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $address = $_POST['address'] ?? '';
    $productId = $_POST['product'] ?? '';
    $paymentMethod = $_POST['payment-method'] ?? '';
    $acceptTerms = $_POST['accept-terms'] ?? '';

    if (!$name || !$email || !$address || !$productId || !$paymentMethod || !$acceptTerms) {
        die('Please fill all required fields and accept terms.');
    }

    include '../database/db_connection.php'; 

    $stmt = $conn->prepare("INSERT INTO orders (name, email, address, product_id, payment_method) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssis", $name, $email, $address, $productId, $paymentMethod);

    if ($stmt->execute()) {
        // Pas suksesit, zbrazim karrocën
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
