
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="images/logo1.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <script src="./script.js" defer></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
    table {
        width: 100%;
        border-spacing: 8px; 
    }

    th, td {
        text-align: left;
        padding: 12px; 
        border: 1px solid #ddd;
    }

    th {
        background-color: #f1f1f1; 
        color: #333; 
        font-weight: bold; 
    }

    td {
        background-color: #ffffff; 
        color: #555; 
    }
    </style>
</head>
<body onload="pershendetje1()">

<header>
    <a href="index.php" class="logo">
        <img src="images/logo1.png" alt="Logo" loading="lazy">
    </a>

    <ul class="navbar">
        <li><a href="index.php">Home</a></li>
        <li><a href="order.php">Order Now</a></li>
        <li><a href="about.php">About</a></li>
        <li><a href="products.php" class="active">Products</a></li>
        <li><a href="contact.php">Contact</a></li>
    </ul>

    <div class="header-icon">
        <i class='bx bx-cart' id="cart-icon"></i>
        <i class='bx bx-search' id="search-icon"></i>
        <i class='bx bx-user' id="user-icon"></i>
    </div>

    <div class="search-box">
        <form action="/search" method="GET">
            <input type="search" id="search" name="query" placeholder="Search Here..." required>
            <button type="submit">Search</button>
        </form>
    </div>

    <div class="cart" id="cart">
        <h2>Shporta</h2>
        <ul id="cart-items" aria-live="polite"></ul>
        <div class="cart-actions">
            <button id="checkout">Checkout</button>
            <button id="clear-cart">Pastro</button>
        </div>
    </div>

    <div class="user">
        <h2>Login Now</h2>
        <form action="/login" method="POST">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Your Email..." required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Password..." required>
            </div>

            <div class="form-group">
                <input type="submit" value="Login" class="login-btn">
            </div>

            <p>Forgot Password? <a href="/reset-password">Reset Now</a></p>
            <p>Don't have an account? <a href="/register">Create One</a></p>
        </form>
    </div>
</header>

<section class="products" id="products">
<div class="products-container">
    <?php
    class Product {
        public $name;
        public $price;
        public $image;

        public function __construct($name, $price, $image) {
            $this->name = $name;
            $this->price = $price;
            $this->image = $image;
        }

        public function __destruct() {
            // Opsionale
        }
    }

    $products = [
        new Product("Americano", 25, "images/menu-1.png"),
        new Product("Espresso", 20, "images/menu-2.png"),
        new Product("Cappuccino", 25, "images/menu-3.png"),
        new Product("Latte", 30, "images/menu-4.png"),
        new Product("Macchiato", 25, "images/menu-5.png"),
        new Product("Mocha", 15, "images/menu-6.png"),
        new Product("Cortado", 20, "images/menu-7.png"),
        new Product("Ristretto", 20, "images/menu-8.png"),
        new Product("Affogato", 30, "images/menu-9.png"),
        new Product("Turkish Coffee", 35, "images/cart-item1.png"),
        new Product("Coffee!", 25, "images/cart-item2.png"),
        new Product("Coffee#", 25, "images/cart-item3.png")
    ];

    usort($products, function($a, $b) {
        return $a->price - $b->price;
    });

    foreach ($products as $product) {
        echo '<div class="box">';
        echo '<img src="' . $product->image . '" alt="Kjo eshte ' . sanitizeProductName($product->name) . '">';
        echo '<h3>' . sanitizeProductName($product->name) . '</h3>';
        echo '<div class="content">';
        echo '<span>' . $product->price . '&euro;</span>';
        echo '<button class="btn add-to-cart" data-product-id="1" data-product-name="' . sanitizeProductName($product->name) . '" data-product-price="' . $product->price . '">Add to Cart</button>';
        echo '</div>';
        echo '</div>';
    }
    ?>
</div>
</section>

<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="footer-col">
                <h4>Company</h4>
                <ul>
                    <li><a href="about.php">About Us</a></li>
                    <li><a href="products.php">Our Services</a></li>
                    <li><a href="contact.php">Privacy Policy</a></li>
                    <li><a href="order.php">Order Now</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Get help</h4>
                <ul>
                    <li><a href="#">FAQ</a></li>
                    <li><a href="products.php" target="_blank">Shipping</a></li>
                    <li><a href="contact.php" target="_blank">Returns</a></li>
                    <li><a href="#">Payment Options</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Follow us</h4>
                <div class="social-links">
                    <ul>
                        <li><a href="https://www.facebook.com/" aria-label="Facebook"><i class='bx bxl-facebook'></i></a></li>
                        <li><a href="https://www.instagram.com/" aria-label="Instagram"><i class='bx bxl-instagram'></i></a></li>
                        <li><a href="https://www.twitter.com/" aria-label="Twitter"><i class='bx bxl-twitter'></i></a></li>
                        <li><a href="https://www.youtube.com/" aria-label="Youtube"><i class='bx bxl-youtube'></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>

</body>
</html>

