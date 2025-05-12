<?php
// Kontrollojmë nëse formulari është dërguar
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Marrim të dhënat nga forma
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $subject = trim($_POST["subject"]);
    $message = trim($_POST["message"]);

    // Ruajmë të dhënat në një array dhe i kodifikojmë në JSON
    $user_data = array(
        'name' => $name,
        'email' => $email,
        'subject' => $subject,
        'message' => $message
    );
    
    // Kodifikojmë të dhënat në JSON dhe i vendosim në cookie
    setcookie("user_data", json_encode($user_data), time() + (30 * 24 * 60 * 60), "/");

    // Mund ta dërgojmë mesazhin që dërguam me sukses:
    header("Location: thanks_contact.php"); // Ridrejtojmë përdoruesin pas dërgimit
    exit();
}
?>

