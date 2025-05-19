<?php
// cookie_banner.php

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accept_cookies'])) {
    // Vendos cookie për 30 ditë
    setcookie('user_cookies', 'accepted', time() + (86400 * 30), "/");
    // Rifresko faqen
    header("Location: " . $_SERVER['REQUEST_URI']);
    exit();
}
?>

<?php if (!isset($_COOKIE['user_cookies'])): ?>
    <div id="cookie-banner" style="
        position: fixed;
        bottom: 0;
        width: 100%;
        background-color: #222;
        color: white;
        text-align: center;
        padding: 15px;
        z-index: 9999;
    ">
        <form method="POST">
            <p>We use cookies to ensure you get the best experience on our website.</p>
            <button type="submit" name="accept_cookies" class="btn btn-light">Accept All Cookies</button>
        </form>
    </div>
<?php endif; ?>
