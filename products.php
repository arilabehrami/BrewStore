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

    $id = 0;
    foreach ($products as $product) {
        echo '<div class="box" 
            data-id="' . $id++ . '" 
            data-name="' . sanitizeProductName($product->name) . '" 
            data-price="' . $product->price . '" 
            data-image="' . $product->image . '">';
        echo '<img src="' . $product->image . '" alt="Kjo eshte ' . sanitizeProductName($product->name) . '">';
        echo '<h3>' . sanitizeProductName($product->name) . '</h3>';
        echo '<div class="content">';
        echo '<span>' . $product->price . '&euro;</span><br>';
        echo '<button class="btn" onclick="addToCart(this)">Add</button> ';
        echo '<button class="btn" onclick="removeFromCart(this)">Delete</button>';
        echo '</div>';
        echo '</div>';
    }
    ?>
</div>
</section>

<script>
function addToCart(button) {
    const product = button.closest('.box');
    const data = {
        id: product.getAttribute('data-id'),     
        name: product.getAttribute('data-name'),
        price: parseFloat(product.getAttribute('data-price')),
        quantity: 1,
        image: product.getAttribute('data-image')
    };
    fetch('admin/cart_actions.php?action=add', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(data)
    })
    .then(res => res.text())
    .then(msg => {
<<<<<<< HEAD
    try {
        const response = JSON.parse(msg);
        if (response.status === "success") {
            window.location.href = 'order.php';
        } else {
            console.error("Error:", response.message);
        }
    } catch (e) {
        console.error("Unexpected response:", msg);
    }
})

=======
        alert(msg);
        window.location.href = 'order.php';  
    })
>>>>>>> a0a5572ab1d6fff482584e480877a2e52a0e05a1
    .catch(err => console.error('Gabim:', err));
}

function removeFromCart(index) {
    fetch('admin/cart_actions.php?action=delete', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ index: index })
    })
    .then(res => res.text())
    .then(data => {
        console.log(data);
        location.reload(); 
    })
    .catch(error => {
        console.error('Gabim:', error);
    });
}

</script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const urlParams = new URLSearchParams(window.location.search);
    const searchQuery = urlParams.get("search");

    if (searchQuery) {
        const products = document.querySelectorAll(".box");

        let found = false;
        products.forEach(product => {
            const name = product.getAttribute("data-name");
            if (name && name.toLowerCase().includes(searchQuery.toLowerCase())) {
                product.scrollIntoView({ behavior: "smooth", block: "center" });
                product.style.outline = "3px solid gold";
                product.style.borderRadius = "12px";
                product.style.transition = "outline 0.3s ease";

                setTimeout(() => {
                    product.style.outline = "none";
                }, 3000);

                found = true;
            }
        });

        if (!found) {
            console.log("Product not found.");
        }
    }
});
</script>

<?php include 'includes/footer.php'; ?>