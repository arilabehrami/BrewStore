<?php
// Kontrollojmë nëse formulari është dërguar
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Marrim të dhënat nga forma
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $subject = trim($_POST["subject"]);
    $message = trim($_POST["message"]);

    // Vendosim cookies për 30 ditë
    setcookie("user_name", $name, time() + (30 * 24 * 60 * 60), "/"); // 30 ditë
    setcookie("user_email", $email, time() + (30 * 24 * 60 * 60), "/");
    setcookie("user_subject", $subject, time() + (30 * 24 * 60 * 60), "/");
    setcookie("user_message", $message, time() + (30 * 24 * 60 * 60), "/");

    // Mund ta dërgojmë mesazhin që dërguam me sukses:
    header("Location: thanks_contact.php"); // Ridrejtojmë përdoruesin pas dërgimit
    exit();
}
?>
