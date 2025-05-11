<?php include 'includes/header.php'; ?>
    

    <section id="order-now">
        <div class="order-image">
            <img src="images/about.jpg" alt="Order Image" >
        </div>
        <div class="container">
            <h1>Porosit tani!</h1>
            
            <form id="order-form">
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
                    <select id="product" name="product">
                        <option value="" disabled selected>Zgjidhni nje produkt</option>
                        <option value="Americano" data-price="20">Americano - $20</option>
                        <option value="Esspreso" data-price="30">Espresso - $30</option>
                        <option value="Cappuccino" data-price="40">Cappuccino - $40</option>
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
                    <select id="payment-method" name="payment-method">
                        <option value="" disabled selected>Zgjidhni një mënyrë pagese</option>
                        <option value="Credit Card">Kartë krediti</option>
                        <option value="PayPal">PayPal</option>
                        <option value="Cash">Cash</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>
                        <input type="checkbox" id="accept-terms" > Pranoj kushtet dhe rregullat
                    </label>
                    <button type="button" onclick="kontrolloPorosine()">Dërgo Porosinë</button>
                
                </div>

                <!-- <div class="form-group">
                    <label for="order-date">Data e Porosisë</label>
                    <input type="date" id="order-date" name="order-date" readonly>
                </div>
                 -->
                <p id="total-price">Çmimi total: $0.00</p>

               

            </form>
        </div>
    </section>
    



<?php
include 'includes/orderOOP.php';


$coffees = [
    new SpecialtyCoffee("Espresso", "Italy", "Dark", "Bold, Smooth"),
    new SpecialtyCoffee("Latte", "France", "Medium", "Creamy, Mild"),
    new SpecialtyCoffee("Cappuccino", "Brazil", "Medium-Dark", "Frothy, Rich"),
    new SpecialtyCoffee("Americano", "USA", "Light", "Smooth, Mellow")
];

echo "<div style='margin: 20px; font-weight: bold; text-align: center; color: white;'>";
echo "<h2 style='margin-bottom: 30px;'>“You can't buy happiness, but you can buy coffee, and that's pretty close.” ☕</h2>";

foreach ($coffees as $coffee) {
    echo "<div style='margin-bottom: 10px;'>" . $coffee->displayInfo() . "</div>";
}

echo "</div>";
?>

 <?php include 'includes/footer.php'; ?>


