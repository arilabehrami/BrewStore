<?php 
include 'includes/header.php'; 
include 'database/db_connection.php'; 
?>

<section id="order-now">
    <div class="order-image">
        <img src="assets/images/about.jpg" alt="Order Image">
    </div>
    <div class="container">
        <h1>Order Now!</h1>
        
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
                <label for="product">Product</label>
                <select id="product" name="product" required>
                    <option value="" disabled selected>Select a product</option>
                    <?php
                    $sql = "SELECT * FROM products";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<option value="' . $row['id'] . '" data-price="' . $row['price'] . '">' . $row['name'] . ' - $' . $row['price'] . '</option>';
                        }
                    } else {
                        echo '<option value="" disabled>No products available</option>';
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="product-suggestion">Quantity</label>
                <input list="products" id="product-suggestion" name="product-suggestion" placeholder="Enter quantity" required>
                <datalist id="products">
                    <option value="1">
                    <option value="2">
                    <option value="3">
                </datalist>
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

            <div class="form-group">
                <label>
                    <input type="checkbox" id="accept-terms" name="accept-terms" required> I accept the terms and conditions
                </label>
                <button type="submit">Place Order</button>
            </div>

            <p id="total-price">Total price: $0.00</p>
        </form>
    </div>
</section>

<script>
document.getElementById("product").addEventListener("change", function() {
    var price = this.options[this.selectedIndex].getAttribute('data-price');
    document.getElementById("total-price").innerText = "Total price: $" + price;
});
</script>

<?php include 'includes/footer.php'; ?>