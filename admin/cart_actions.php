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

// Kontroll lidhje DB
if (!$conn) {
    echo json_encode(['status' => 'error', 'message' => 'Database connection error']);
    exit;
}

if (!$input) {
    echo json_encode(['status' => 'error', 'message' => 'No data received']);
    exit;
}

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Funksione ndihmëse për sinkronizim me DB
function addOrUpdateCartItemInDB($conn, $cartId, $productId, $quantity, $price) {
    // Kontrollojmë nëse ekziston artikulli për këtë user/cart
    $stmtCheck = $conn->prepare("SELECT quantity FROM cart_items WHERE cart_id = ? AND product_id = ?");
    $stmtCheck->bind_param("ii", $cartId, $productId);
    $stmtCheck->execute();
    $result = $stmtCheck->get_result();

    if ($result && $row = $result->fetch_assoc()) {
        // Update sasi
        $newQuantity = $row['quantity'] + $quantity;
        $stmtUpdate = $conn->prepare("UPDATE cart_items SET quantity = ?, price = ? WHERE cart_id = ? AND product_id = ?");
        $stmtUpdate->bind_param("idii", $newQuantity, $price, $cartId, $productId);
        $stmtUpdate->execute();
        $stmtUpdate->close();
    } else {
        // Insert produkt te ri
        $stmtInsert = $conn->prepare("INSERT INTO cart_items (cart_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");
        $stmtInsert->bind_param("iiid", $cartId, $productId, $quantity, $price);
        $stmtInsert->execute();
        $stmtInsert->close();
    }

    $stmtCheck->close();
}

function updateCartItemInDB($conn, $cartId, $productId, $quantity, $price) {
    $stmtUpdate = $conn->prepare("UPDATE cart_items SET quantity = ?, price = ? WHERE cart_id = ? AND product_id = ?");
    $stmtUpdate->bind_param("idii", $quantity, $price, $cartId, $productId);
    $stmtUpdate->execute();
    $stmtUpdate->close();
}

function deleteCartItemInDB($conn, $cartId, $productId) {
    $stmtDelete = $conn->prepare("DELETE FROM cart_items WHERE cart_id = ? AND product_id = ?");
    $stmtDelete->bind_param("ii", $cartId, $productId);
    $stmtDelete->execute();
    $stmtDelete->close();
}

$cartId = $_SESSION['user_id'] ?? 1; // Nëse ke login, përdor ID reale

switch ($action) {
    case 'add':
        $id = $input['id'] ?? null;
        $quantity = max(1, intval($input['quantity'] ?? 1));

        if ($id === null) {
            echo json_encode(['status' => 'error', 'message' => 'Invalid product ID']);
            exit;
        }

        // Merr të dhënat e produktit nga DB
        $stmt = $conn->prepare("SELECT name, price, image FROM products WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $row = $result->fetch_assoc()) {
            $name = $row['name'];
            $price = round($row['price'] * 1.10, 2); // me TVSH
            $image = $row['image'] ?? 'assets/images/default-product.png';

            if (!str_starts_with($image, 'assets/images/') && !str_starts_with($image, 'http')) {
                $image = 'assets/images/' . ltrim($image, '/');
            }

            // Kontroll në session
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
                    'quantity' => $quantity,
                    'image' => $image
                ];
            }

            // Sinkronizo me DB
            addOrUpdateCartItemInDB($conn, $cartId, $id, $quantity, $price);

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
        $quantity = max(1, intval($input['quantity'] ?? 1));

        if ($index === null || !isset($_SESSION['cart'][$index])) {
            echo json_encode(['status' => 'error', 'message' => 'Invalid index']);
            exit;
        }

        $_SESSION['cart'][$index]['quantity'] = $quantity;

        // Përditëso në DB
        $productId = $_SESSION['cart'][$index]['id'];
        $price = $_SESSION['cart'][$index]['price'];
        updateCartItemInDB($conn, $cartId, $productId, $quantity, $price);

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

        $productId = $_SESSION['cart'][$index]['id'];

        // Hiq nga session
        array_splice($_SESSION['cart'], $index, 1);

        // Hiq nga DB
        deleteCartItemInDB($conn, $cartId, $productId);

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
