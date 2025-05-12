<?php
session_start(); // KRIJIMI ose vazhdimi i sesionit

// KONTROLLON nëse të gjitha të dhënat janë dërguar
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['name'] = $_POST['name'];
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['address'] = $_POST['address'];
    $_SESSION['product'] = $_POST['product'];
    $_SESSION['quantity'] = $_POST['product-suggestion'];
    $_SESSION['payment'] = $_POST['payment-method'];

    // Llogaritja e çmimit total
    $prices = [
        "Americano" => 20,
        "Esspreso" => 30,
        "Cappuccino" => 40
    ];

    $product = $_SESSION['product'];
    $quantity = intval($_SESSION['quantity']);
    $price = isset($prices[$product]) ? $prices[$product] : 0;
    $total = $price * $quantity;
    $_SESSION['total_price'] = $total;

    // Shfaqja e të dhënave të porosisë
    echo "<h2>Faleminderit për porosinë, {$_SESSION['name']}!</h2>";
    echo "<p>Email: {$_SESSION['email']}</p>";
    echo "<p>Adresa: {$_SESSION['address']}</p>";
    echo "<p>Produkt: $product</p>";
    echo "<p>Sasia: $quantity</p>";
    echo "<p>Pagesa: {$_SESSION['payment']}</p>";
    echo "<p>Çmimi total: $$total</p>";

    // RIDREJTIMI pas disa sekondash në faqen "thankyou.php"
    header("Location: thankyou.php"); 
    exit(); // Siguron që skripti të ndalojë këtu dhe të mos ekzekutohet më tej
}
?>

