<?php 
session_start();
include 'includes/header.php'; 
include 'database/db_connection.php'; 

$total = 0;
if (!empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $price = floatval($item['price']);
        $quantity = $item['quantity'] ?? 1;
        $subtotal = $price * $quantity;
        $total += $subtotal;
    }
}
?>
<?php include 'includes/order_content.php';?>

<!-- Pjesa e feedback-ut e marrë nga contact_content.php -->
<?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true): ?>
    <section style="margin-top: 20px;">
        <address style="text-align: center;">
            <form id="feedback-form">
                <textarea name="custom_message" rows="4" cols="70" placeholder="Give your feedback for our shop!" style="color: black;" required></textarea><br>
                <button type="submit" class="btn btn-primary">Send your feedback</button>
            </form>
            <div id="feedback-response" style="margin-top: 10px;"></div>
        </address>
    </section>
<?php else: ?>
    <section style="margin-top: 20px; text-align: center;">
        <p style="color: red; font-weight: bold;">
            You must be logged in to send feedback.
        </p>
        <a href="admin/login.php" class="btn btn-outline-primary">Login here</a>
    </section>
<?php endif; ?>

<script src="assets/js/order_process.js"></script>
<?php include 'includes/footer.php'; ?>
