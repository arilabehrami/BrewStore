<?php include '../includes/header.php'; ?>

<div class="login-page">
    <div class="login-box">
        <h2>Login Now</h2>
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

<?php include '../includes/footer.php'; ?>

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