<?php
session_start();
header('Content-Type: application/json');
$action = $_GET['action'] ?? '';
$input = json_decode(file_get_contents('php://input'), true);

if (!$input) {
    echo json_encode(['status' => 'error', 'message' => 'No data received']);
    exit;
}

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

switch ($action) {
    case 'add':
        $id = $input['id'] ?? null;
        $name = $input['name'] ?? null;
        $price = $input['price'] ?? 0;
        $quantity = $input['quantity'] ?? 1;
        $image = $input['image'] ?? 'assets/images/default-product.png';

        if (!str_starts_with($image, 'assets/images/') && !str_starts_with($image, 'http')) {
            $image = 'assets/images/' . ltrim($image, '/');
        }

        if ($id === null || $name === null || $name === '') {
            echo json_encode(['status' => 'error', 'message' => 'Invalid product data']);
            exit;
        }

        $found = false;
        foreach ($_SESSION['cart'] as &$item) {
            if ($item['id'] == $id) {
                $item['quantity'] += $quantity;
                $found = true;
                break;
            }
        }
        unset($item);

        if (!$found) {
            $_SESSION['cart'][] = [
                'id' => $id,
                'name' => $name,
                'price' => floatval($price),
                'quantity' => intval($quantity),
                'image' => $image
            ];
        }

        echo json_encode(['status' => 'success', 'message' => 'Product added']);
        break;

    case 'update':
        $index = $input['index'] ?? null;
        $quantity = $input['quantity'] ?? 1;

        if ($index === null || !isset($_SESSION['cart'][$index])) {
            echo json_encode(['status' => 'error', 'message' => 'Invalid index']);
            exit;
        }

        if ($quantity < 1) $quantity = 1;

        $_SESSION['cart'][$index]['quantity'] = intval($quantity);

        echo json_encode(['status' => 'success', 'message' => 'Quantity updated']);
        break;

    case 'delete':
        $index = $input['index'] ?? null;

        if ($index === null || !isset($_SESSION['cart'][$index])) {
            echo json_encode(['status' => 'error', 'message' => 'Invalid index']);
            exit;
        }

        array_splice($_SESSION['cart'], $index, 1);

        echo json_encode(['status' => 'success', 'message' => 'Product removed']);
        break;

    default:
        echo json_encode(['status' => 'error', 'message' => 'Invalid action']);
        break;
}
