<?php
session_start();
header('Content-Type: application/json');
include '../database/db_connection.php';

$data = json_decode(file_get_contents("php://input"), true);
$productId = $data['id'] ?? null;

if ($productId === null) {
    echo json_encode(["status" => "error", "message" => "Invalid product ID."]);
    exit;
}

$found = false;
if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $index => $item) {
        if ($item['id'] == $productId) {
            unset($_SESSION['cart'][$index]);
            $found = true;
            break;
        }
    }
}

if (!$found) {
    echo json_encode(["status" => "error", "message" => "Product not found in cart."]);
    exit;
}

$stmt = $conn->prepare("DELETE FROM cart_items WHERE product_id = ?");
$stmt->bind_param("i", $productId);

if ($stmt->execute()) {
    echo json_encode(["status" => "success", "message" => "Product removed from cart."]);
} else {
    echo json_encode(["status" => "error", "message" => "Database error while deleting."]);
}

$stmt->close();
$conn->close();
?>