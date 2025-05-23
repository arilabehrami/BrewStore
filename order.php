<?php 
session_start();
include 'includes/header.php'; 
include 'database/db_connection.php'; 

// Llogarit totalin e shportës
$total = 0;
if (!empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $index => $item) {
        $price = floatval($item['price']);
        $quantity = $item['quantity'] ?? 1;
        $subtotal = $price * $quantity;
        $total += $subtotal;
    }
}
?>

<link rel="stylesheet" href="assets/css/order.css">

<section id="order-now">
    <div class="order-image"></div>

    <div class="container">
        <h1>Order Now!</h1>

        <!-- Forma me te dhenat e klientit -->
        <form id="order-form" action="sessions_cookies/process_order.php" method="POST">

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" placeholder="Enter your name" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" required>
            </div>

            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" id="address" name="address" placeholder="Enter your address" required>
            </div>

            <div class="form-group">
                <label for="payment-method">Payment Method</label>
                <select id="payment-method" name="payment-method" required>
                    <option value="" disabled selected>Select payment method</option>
                    <option value="Credit Card">Credit Card</option>
                    <option value="PayPal">PayPal</option>
                    <option value="Cash">Cash</option>
                </select>
            </div>

            <!-- Shtimi i produkteve në shporte -->
            <h2>Add Product to Cart</h2>

            <div class="form-group">
                <label for="product">Product</label>
                <select id="product" name="product" required>
                    <option value="" disabled selected>Select a product</option>
                    <?php
                    $sql = "SELECT * FROM products";
                    $result = $conn->query($sql);

                    if ($result && $result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<option value="' . $row['id'] . '" ' 
                               . 'data-price="' . $row['price'] . '" '
                               . 'data-name="' . htmlspecialchars($row['name']) . '" '
                               . 'data-image="' . htmlspecialchars($row['image'] ?? 'assets/img/default-product.png') . '" >' 
                               . htmlspecialchars($row['name']) . ' - $' . number_format($row['price'], 2) 
                               . '</option>';
                        }
                    } else {
                        echo '<option value="" disabled>No products available</option>';
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="product-quantity">Quantity</label>
                <input type="number" id="product-quantity" name="product-quantity" value="1" min="1" required>
            </div>

            <!-- Butoni për shtimin në shportë (jashtë formularit) -->
            <div style="margin-bottom: 30px;">
                <button type="button" id="btn-add-to-cart">Add Selected Product to Cart</button>
            </div>

            <h2>Your Cart</h2>
            <div id="cart-items">
                <?php if (!empty($_SESSION['cart'])): ?>
                    <?php foreach ($_SESSION['cart'] as $index => $item): 
                        $price = floatval($item['price']);
                        $quantity = $item['quantity'] ?? 1;
                    ?>
                    <div class="cart-item" data-index="<?= $index ?>">
                        <div class="cart-item-info">
                            <img src="<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['name']) ?>" width="60" height="60">
                            <div>
                                <div class="cart-item-name"><?= htmlspecialchars($item['name']) ?></div>
                                <div class="cart-item-price">$<?= number_format($price, 2) ?></div>
                            </div>
                        </div>
                        <input type="number" min="1" class="cart-item-quantity" value="<?= $quantity ?>" onchange="updateQuantity(<?= $index ?>, this.value)">
                        <button type="button" class="btn-remove" onclick="removeFromCart(<?= $index ?>)">Remove</button>
                    </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>Your cart is empty.</p>
                <?php endif; ?>
            </div>

            <p id="total-price">Total price: $<?= number_format($total, 2) ?></p>

            <div class="form-group" style="margin-top: 30px;">
                <label>
                    <input type="checkbox" id="accept-terms" name="accept-terms" required> I accept the terms and conditions
                </label>
                <button type="submit">Place Order</button>
            </div>

        </form>
    </div>
</section>

<script>
document.getElementById('btn-add-to-cart').addEventListener('click', function() {
    const productSelect = document.getElementById('product');
    const selectedOption = productSelect.options[productSelect.selectedIndex];
    const productId = selectedOption.value;
    const productName = selectedOption.getAttribute('data-name');
    const productPrice = parseFloat(selectedOption.getAttribute('data-price'));
    const productImage = selectedOption.getAttribute('data-image') || '/assets/images/products/default-product.png';
    const productQuantity = parseInt(document.getElementById('product-quantity').value);

    if (!productId || !productPrice || productQuantity < 1) {
        alert("Please select a valid product and quantity.");
        return;
    }

    fetch('admin/cart_actions.php?action=add', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
            id: productId,
            name: productName,
            price: productPrice,
            quantity: productQuantity,
            image: productImage
        })
    })
    .then(res => res.text())
    .then(msg => {
        alert('Product added to cart!');
        location.reload();
    })
    .catch(err => {
        console.error('Error:', err);
        alert('Could not add product to cart.');
    });
});

function updateQuantity(index, newQuantity) {
    fetch('admin/cart_actions.php?action=update', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ index: index, quantity: parseInt(newQuantity) })
    })
    .then(res => res.text())
    .then(msg => {
        location.reload();
    })
    .catch(err => {
        console.error('Error:', err);
        alert('Could not update quantity.');
    });
}

function removeFromCart(index) {
    fetch('admin/cart_actions.php?action=delete', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ index: index })
    })
    .then(res => res.text())
    .then(msg => {
        location.reload();
    })
    .catch(err => {
        console.error('Error:', err);
        alert('Could not remove product.');
    });
}

function calculateTotal() {
    let total = 0;
    document.querySelectorAll('.cart-item').forEach(item => {
        let priceText = item.querySelector('.cart-item-price').textContent;
        let price = parseFloat(priceText.replace('$', '')) || 0;
        let quantityInput = item.querySelector('.cart-item-quantity');
        let quantity = parseInt(quantityInput.value) || 1;
        total += price * quantity;
    });
    document.getElementById('total-price').textContent = 'Total price: $' + total.toFixed(2);
}

document.querySelectorAll('.cart-item-quantity').forEach(input => {
    input.addEventListener('input', calculateTotal);
});

window.addEventListener('load', calculateTotal);
</script>

<?php include 'includes/footer.php'; ?>
