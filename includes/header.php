<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$currentPage = basename($_SERVER['PHP_SELF']);
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/UEB25_CoffeeWebsite_/assets/css/style.css">
    <link rel="icon" href="/UEB25_CoffeeWebsite_/assets/images/logo1.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> 
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="/UEB25_CoffeeWebsite_/assets/js/script.js"></script>
</head>
<body>
    <header>
        <a href="/UEB25_CoffeeWebsite_/index.php" class="logo">
            <img src="/UEB25_CoffeeWebsite_/assets/images/logo1.png" alt="Logo" loading="lazy">
        </a>

        <ul class="navbar">
            <li><a href="index.php" class="<?= $currentPage == 'index.php' ? 'active' : '' ?>">Home</a></li>
            <li><a href="order.php" class="<?= $currentPage == 'order.php' ? 'active' : '' ?>">Order Now</a></li>
            <li><a href="about.php" class="<?= $currentPage == 'about.php' ? 'active' : '' ?>">About</a></li>
            <li><a href="products.php" class="<?= $currentPage == 'products.php' ? 'active' : '' ?>">Products</a></li>
            <li><a href="contact.php" class="<?= $currentPage == 'contact.php' ? 'active' : '' ?>">Contact</a></li>
            
            <!-- Pjesa e login/logout -->
            <?php if (isset($_SESSION['user_logged_in'])): ?>
                <li class="nav-user">
                    <a href="dashboard.php"><?php echo $_SESSION['user_email']; ?></a>
                    <a href="logout.php">Logout</a>
                </li>
            <?php else: ?>
                <li><a href="login.php">LOGIN</a></li>
            <?php endif; ?>
        </ul>

        <div class="header-icon">
            <i class='bx bx-cart' id="cart-icon"></i>
            <i class='bx bx-search' id="search-icon"></i>
            <!-- Heqim ikonën e përdoruesit pasi e kemi në navbar -->
        </div>

        <div class="search-box">
            <form action="/search" method="GET">
                <input type="search" id="search" name="query" placeholder="Search Here..." required>
                <button type="submit">Search</button>
            </form>
        </div>

        <div class="cart" id="cart">
            <h2>Shporta</h2>
            <ul id="cart-items" aria-live="polite">
                <!-- Përmbajtja e shportës -->
            </ul>
            <div class="cart-actions">
                <button id="checkout">Checkout</button>
                <button id="clear-cart">Pastro</button>
            </div>
        </div>
    </header>