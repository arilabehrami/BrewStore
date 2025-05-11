<?php include 'includes/header.php'; ?>

<section id="thank-you">
    <h1>Faleminderit për mesazhin tuaj!</h1>
    <?php
    // Kontrollojmë nëse cookies janë të vendosura
    if (isset($_COOKIE['user_data'])) {
        // Dekodojmë të dhënat nga JSON
        $user_data = json_decode($_COOKIE['user_data'], true); // Kthehet si array asociativ
        
        echo "Faleminderit për mesazhin, " . htmlspecialchars($user_data['name']) . "!<br>";
        echo "Email: " . htmlspecialchars($user_data['email']) . "<br>";
        echo "Subjekti: " . htmlspecialchars($user_data['subject']) . "<br>";
        echo "Mesazhi: " . htmlspecialchars($user_data['message']) . "<br>";
    } else {
        echo "Nuk ka të dhëna të ruajtura në cookies.";
    }
    ?>
</section>

<?php include 'includes/footer.php'; ?>


