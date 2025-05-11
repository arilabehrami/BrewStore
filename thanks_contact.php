<?php include 'includes/header.php'; ?>

<section id="thank-you">
    <h1>Faleminderit për mesazhin tuaj!</h1>
    <?php
    // Kontrollojmë nëse cookies janë të vendosura
    if (isset($_COOKIE['user_name']) && isset($_COOKIE['user_email']) && isset($_COOKIE['user_subject'])) {
        echo "Faleminderit për mesazhin, " . htmlspecialchars($_COOKIE['user_name']) . "!<br>";
        echo "Email: " . htmlspecialchars($_COOKIE['user_email']) . "<br>";
        echo "Subjekti: " . htmlspecialchars($_COOKIE['user_subject']) . "<br>";
        echo "Mesazhi: " . htmlspecialchars($_COOKIE['user_message']) . "<br>";
    } else {
        echo "Nuk ka të dhëna të ruajtura në cookies.";
    }
    ?>
</section>

<?php include 'includes/footer.php'; ?>

