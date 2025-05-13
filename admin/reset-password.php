<?php
session_start();
include '../includes/db_connection.php';

if (!isset($_GET['token'])) {
    header("Location: forgot-password.php");
    exit();
}

$token = $_GET['token'];

// Kontrollo nëse token është valid dhe nuk ka skaduar
$stmt = $conn->prepare("SELECT id, email FROM users WHERE reset_token = ? AND reset_expires > NOW()");
$stmt->bind_param("s", $token);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    $_SESSION['error'] = "Linku i rivendosjes është i pavlefshëm ose ka skaduar!";
    header("Location: forgot-password.php");
    exit();
}

$user = $result->fetch_assoc();
$user_id = $user['id'];

include '../includes/header.php';
?>

<div class="login-page">
    <div class="login-box">
        <h2>Vendosni Fjalëkalimin e Ri</h2>
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
        <?php endif; ?>
        
        <form action="process-reset-password.php" method="POST">
            <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">
            <input type="hidden" name="user_id" value="<?= $user_id ?>">
            
            <div class="form-group">
                <input type="password" name="password" placeholder="Fjalëkalimi i ri" required>
            </div>
            <div class="form-group">
                <input type="password" name="confirm_password" placeholder="Konfirmo fjalëkalimin" required>
            </div>
            <button type="submit" class="login-btn">Rivendos Fjalëkalimin</button>
        </form>
    </div>
</div>

<?php include '../includes/footer.php'; ?>