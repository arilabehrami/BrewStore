<?php
session_start();
header('Content-Type: application/json');

include '../database/db_connection.php'; // përfshi lidhjen me DB

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
        $quantity = $input['quantity'] ?? 1;

        if ($id === null) {
            echo json_encode(['status' => 'error', 'message' => 'Invalid product ID']);
            exit;
        }

        // Kontrollo në DB nëse produkti ekziston
        $stmt = $conn->prepare("SELECT name, price, image FROM products WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $row = $result->fetch_assoc()) {
            $name = $row['name'];
            $price = $row['price'];
            $image = $row['image'] ?? 'assets/images/default-product.png';

            if (!str_starts_with($image, 'assets/images/') && !str_starts_with($image, 'http')) {
                $image = 'assets/images/' . ltrim($image, '/');
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
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Product not found']);
        }

        $stmt->close();
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
