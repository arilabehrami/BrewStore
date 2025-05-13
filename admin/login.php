<?php
// Debug - shfaq të dhënat e sesionit
echo "<pre>";
print_r($_SESSION);
echo "</pre>";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT id, name, password FROM users WHERE email = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 's', $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    if ($row = mysqli_fetch_assoc($result)) {
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_name'] = $row['name'];
            $_SESSION['logged_in'] = true;
            
            header("Location: ../index.php");
            exit();
        } else {
            $error = "Password incorrect!";
        }
    } else {
        $error = "Email not found!";
    }
}

include '../includes/header.php';
?>

<div class="login-page">
    <div class="login-box">
        <h2>Login Now</h2>
        <?php if (isset($error)): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>
        <form action="login.php" method="POST">
            <div class="form-group">
                <input type="email" name="email" placeholder="Your Email..." required>
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="Password..." required>
            </div>
            <button type="submit" class="login-btn">Login</button>
            <div class="login-links">
                <a href="forgot-password.php">Forgot Password?</a>
                <a href="register.php">Create Account</a>
                <a href="help.php">Help</a>
            </div>
        </form>
    </div>
</div>

<?php
// Në login.php, pas verifikimit të suksesshëm
$_SESSION['logged_in'] = true;
$_SESSION['user_id'] = $row['id'];
$_SESSION['user_name'] = $row['name'];

// Ridrejto me header dhe exit
header("Location: ../index.php");
exit();

include '../includes/footer.php';
?>

<!--
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/UEB25_CoffeeWebsite_/assets/css/style.css">
    <title>Login</title>
</head>
<body>
    <div class="user">
        <h2>Login Now</h2>
        <form action="login.php" method="POST">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Your Email..." required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Password..." required>
            </div>

            <div class="form-group">
                <input type="submit" value="Login" class="login-btn">
            </div>

            <p>Forgot Password? <a href="/reset-password">Reset Now</a></p>
            <p>Don't have an account? <a href="/register">Create One</a></p>
        </form>
    </div>
</body>
</html> -->