<?php
session_start();
header('Content-Type: application/json');

include '../database/db_connection.php';

$action = $_GET['action'] ?? '';
$input = json_decode(file_get_contents('php://input'), true);

function renderCartHTML() {
    ob_start();
    include '../includes/cart_items_partial.php';
    return ob_get_clean();
}

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

        $stmt = $conn->prepare("SELECT name, price, image FROM products WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $row = $result->fetch_assoc()) {
            $name = $row['name'];
            $price = $row['price'];
            $price = round($price * 1.10, 2); // Me TVSH
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

                // ➕ INSERT në DB
                $cartId = $_SESSION['user_id'] ?? 1; // ose vendos ID-në reale të user-it nëse ke login
                $productId = $id;
                $quantityDb = intval($quantity);
                $priceDb = floatval($price);

                $stmtInsert = $conn->prepare("INSERT INTO cart_items (cart_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");
                $stmtInsert->bind_param("iiid", $cartId, $productId, $quantityDb, $priceDb);
                $stmtInsert->execute();
                $stmtInsert->close();
            }

            echo json_encode([
                'status' => 'success',
                'message' => 'Product added',
                'cart_html' => renderCartHTML()
            ]);
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

        echo json_encode([
            'status' => 'success',
            'message' => 'Quantity updated',
            'cart_html' => renderCartHTML()
        ]);
        break;

    case 'delete':
        $index = $input['index'] ?? null;

        if ($index === null || !isset($_SESSION['cart'][$index])) {
            echo json_encode(['status' => 'error', 'message' => 'Invalid index']);
            exit;
        }

        array_splice($_SESSION['cart'], $index, 1);

        echo json_encode([
            'status' => 'success',
            'message' => 'Product removed',
            'cart_html' => renderCartHTML()
        ]);
        break;

    default:
        echo json_encode(['status' => 'error', 'message' => 'Invalid action']);
        break;
}
