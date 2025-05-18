<?php
session_start();
header('Content-Type: application/json');

// Marrim veprimin (add, update, delete)
$action = $_GET['action'] ?? '';

$input = json_decode(file_get_contents('php://input'), true);

if (!$input) {
    echo json_encode(['status' => 'error', 'message' => 'No data received']);
    exit;
}

// Inicializojmë shportën nëse nuk ekziston
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

switch ($action) {
    case 'add':
        $id = $input['id'] ?? null;
        $name = $input['name'] ?? null;
        $price = $input['price'] ?? 0;
        $quantity = $input['quantity'] ?? 1;
        $image = $input['image'] ?? '/assets/images/default-product.png';

        if (!$id || !$name) {
            echo json_encode(['status' => 'error', 'message' => 'Invalid product data']);
            exit;
        }

        // Kontrollojmë nëse produkti ekziston në shportë, nëse po, shtojmë sasinë
        $found = false;
        foreach ($_SESSION['cart'] as &$item) {
            if ($item['id'] == $id) {
                $item['quantity'] += $quantity;
                $found = true;
                break;
            }
        }
        unset($item);

        // Nëse nuk u gjet, e shtojmë të ri
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
