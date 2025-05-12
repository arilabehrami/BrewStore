<?php
include 'includes/header.php';
include 'includes/db.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validimi
    if (empty($name) || empty($email) || empty($password)) {
        $error = "Ju lutem plotësoni të gjitha fushat!";
    } elseif ($password !== $confirm_password) {
        $error = "Password-et nuk përputhen!";
    } else {
        // Kontrollo nëse email ekziston
        $query = "SELECT id FROM users WHERE email = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, 's', $email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        
        if (mysqli_stmt_num_rows($stmt) > 0) {
            $error = "Ky email është i regjistruar tashmë!";
        } else {
            // Regjistro perdoruesin
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $query = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, 'sss', $name, $email, $hashed_password);
            
            if (mysqli_stmt_execute($stmt)) {
                $success = "Regjistrimi u krye me sukses! Tani mund të hyni.";
                header("Refresh: 2; url=login.php");
            } else {
                $error = "Gabim në regjistrim. Ju lutem provoni përsëri!";
            }
        }
    }
}
?>

<div class="user">
    <h2>Create Account</h2>
    <?php if ($error): ?>
        <div class="error"><?php echo $error; ?></div>
    <?php endif; ?>
    <?php if ($success): ?>
        <div class="success"><?php echo $success; ?></div>
    <?php endif; ?>
    <form action="register.php" method="POST">
        <div class="form-group">
            <label for="name">Full Name</label>
            <input type="text" id="name" name="name" placeholder="Your Name..." required>
        </div>
        
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Your Email..." required>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Password..." required>
        </div>

        <div class="form-group">
            <label for="confirm_password">Confirm Password</label>
            <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password..." required>
        </div>

        <div class="form-group">
            <input type="submit" value="Register" class="login-btn">
        </div>

        <p>Already have an account? <a href="login.php">Login Here</a></p>
    </form>
</div>

<?php include 'includes/footer.php'; ?>