<?php 
include 'includes/header.php'; 
include 'database/db_connection.php'; 
?>

<section id="order-now">
    <div class="order-image">
        <img src="assets/images/about.jpg" alt="Order Image">
    </div>
    <div class="container">
        <h1>Porosit tani!</h1>
        
        <form id="order-form" action="sessions_cookies/process_order.php" method="POST">
            <div class="form-group">
                <label for="name">Emri</label>
                <input type="text" id="name" name="name" placeholder="Shkruani emrin tuaj" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Shkruani email-in tuaj" required>
            </div>

            <div class="form-group">
                <label for="address">Adresa</label>
                <input type="text" id="address" name="address" placeholder="Shkruani adresën tuaj" required>
            </div>

            <div class="form-group">
                <label for="product">Produkt</label>
                <select id="product" name="product" required>
                    <option value="" disabled selected>Zgjidhni nje produkt</option>
                    <?php
                    $sql = "SELECT * FROM products";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<option value="' . $row['id'] . '" data-price="' . $row['price'] . '">' . $row['name'] . ' - $' . $row['price'] . '</option>';
                        }
                    } else {
                        echo '<option value="" disabled>Asnjë produkt i disponueshëm</option>';
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="product-suggestion">Sasia</label>
                <input list="products" id="product-suggestion" name="product-suggestion" placeholder="Shkruani sasine" required>
                <datalist id="products">
                    <option value="1">
                    <option value="2">
                    <option value="3">
                </datalist>
            </div>

            <div class="form-group">
                <label for="payment-method">Mënyra e Pagesës</label>
                <select id="payment-method" name="payment-method" required>
                    <option value="" disabled selected>Zgjidhni një mënyrë pagese</option>
                    <option value="Credit Card">Kartë krediti</option>
                    <option value="PayPal">PayPal</option>
                    <option value="Cash">Cash</option>
                </select>
            </div>

            <div class="form-group">
                <label>
                    <input type="checkbox" id="accept-terms" name="accept-terms" required> Pranoj kushtet dhe rregullat
                </label>
                <button type="submit">Dërgo Porosinë</button>
            </div>

            <p id="total-price">Çmimi total: $0.00</p>
        </form>
    </div>
</section>

<script>
document.getElementById("product").addEventListener("change", function() {
    var price = this.options[this.selectedIndex].getAttribute('data-price');
    document.getElementById("total-price").innerText = "Çmimi total: $" + price;
});
</script>

<?php include 'includes/footer.php'; ?>
