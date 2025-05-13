<?php
session_start();
$currentPage = basename($_SERVER['PHP_SELF']);
$base_url = 'http://' . $_SERVER['HTTP_HOST'] . '/UEB25_CoffeeWebsite_/';
?> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/style.css">
    <link rel="icon" href="<?php echo $base_url; ?>assets/images/logo1.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> 
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="<?php echo $base_url; ?>assets/js/script.js"></script>
</head>
<body>
    <header>
        <a href="<?php echo $base_url; ?>index.php" class="logo">
            <img src="<?php echo $base_url; ?>assets/images/logo1.png" alt="Logo" loading="lazy">
        </a>

        <ul class="navbar">
            <li><a href="<?php echo $base_url; ?>index.php" class="<?= $currentPage == 'index.php' ? 'active' : '' ?>">Home</a></li>
            <li><a href="<?php echo $base_url; ?>order.php" class="<?= $currentPage == 'order.php' ? 'active' : '' ?>">Order Now</a></li>
            <li><a href="<?php echo $base_url; ?>about.php" class="<?= $currentPage == 'about.php' ? 'active' : '' ?>">About</a></li>
            <li><a href="<?php echo $base_url; ?>products.php" class="<?= $currentPage == 'products.php' ? 'active' : '' ?>">Products</a></li>
            <li><a href="<?php echo $base_url; ?>contact.php" class="<?= $currentPage == 'contact.php' ? 'active' : '' ?>">Contact</a></li>
            <li><a href="<?php echo $base_url; ?>admin/login.php" class="<?= ($currentPage == 'login.php' || $currentPage == 'register.php' || $currentPage == 'forgot-password.php') ? 'active' : '' ?>">Login</a></li>
        </ul>

        <div class="header-icon">
            <a href="<?php echo $base_url; ?>cart.php"><i class='bx bx-cart' id="cart-icon"></i></a>
            <i class='bx bx-search' id="search-icon"></i>
            <a href="<?php echo $base_url; ?>admin/login.php"><i class='bx bx-user' id="user-icon"></i></a>
        </div>

        <div class="search-box">
            <form action="<?php echo $base_url; ?>search.php" method="GET">
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
    </header>