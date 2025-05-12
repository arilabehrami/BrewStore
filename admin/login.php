

<div class="login-container">
    <h2>Login Now</h2>
    <form action="admin/login.php" method="POST">
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
        <div class="login-links">
            <a href="reset-password.php">Forgot Password?</a>
            <a href="register.php">Create Account</a>
            <a href="help.php">Help</a>
        </div>
    </form>
</div>


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