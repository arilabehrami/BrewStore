<?php
session_start();

// Kontrollo nëse sesioni ka të dhëna të ruajtura
if (!isset($_SESSION['name'])) {
    header("Location: order.php"); // Nëse nuk ka të dhëna, kthehu te faqja e porosisë
    exit();
}

echo "<h1>Faleminderit për porosinë, {$_SESSION['name']}!</h1>";
echo "<p>Email: {$_SESSION['email']}</p>";
echo "<p>Adresa: {$_SESSION['address']}</p>";
echo "<p>Produkt: {$_SESSION['product']}</p>";
echo "<p>Sasia: {$_SESSION['quantity']}</p>";
echo "<p>Pagesa: {$_SESSION['payment']}</p>";
echo "<p>Çmimi total: {$_SESSION['total_price']}</p>";
?>