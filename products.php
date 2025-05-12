<?php include 'includes/header.php'; ?>
    
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
        new Product("Americano", 25, "assets/images/menu-1.png"),
        new Product("Espresso", 20, "assets/images/menu-2.png"),
        new Product("Cappuccino", 25, "assets/images/menu-3.png"),
        new Product("Latte", 30, "assets/images/menu-4.png"),
        new Product("Macchiato", 25, "assets/images/menu-5.png"),
        new Product("Mocha", 15, "assets/images/menu-6.png"),
        new Product("Cortado", 20, "assets/images/menu-7.png"),
        new Product("Ristretto", 20, "assets/images/menu-8.png"),
        new Product("Affogato", 30, "assets/images/menu-9.png"),
        new Product("Turkish Coffee", 35, "assets/images/cart-item1.png"),
        new Product("Coffee", 25, "assets/images/cart-item2.png"),
        new Product("Black Coffee", 25, "assets/images/cart-item3.png")
    ];

    usort($products, function($a, $b) {
        return $a->price - $b->price;
    });

    function sanitizeProductName($name) {
        return htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
    }

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


 <?php include 'includes/footer.php'; ?>
