<?php
include '../includes/header.php';
include '../database/db_connection.php';

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validation
    if (empty($name) || empty($email) || empty($password)) {
        $error = "Ju lutem plotësoni të gjitha fushat!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Ju lutem shkruani një email valid!";
    } elseif (strlen($password) < 8) {
        $error = "Password-i duhet të ketë të paktën 8 karaktere!";
    } elseif ($password !== $confirm_password) {
        $error = "Password-et nuk përputhen!";
    } else {
        // Check if email exists
        $query = "SELECT id FROM users WHERE email = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, 's', $email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        
        if (mysqli_stmt_num_rows($stmt) > 0) {
            $error = "Ky email është i regjistruar tashmë!";
        } else {
            // Register user
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $query = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, 'sss', $name, $email, $hashed_password);
            
            if (mysqli_stmt_execute($stmt)) {
                $_SESSION['success'] = "Regjistrimi u krye me sukses! Tani mund të hyni.";
                header("Location: login.php");
                exit();
            } else {
                $error = "Gabim në regjistrim: " . mysqli_error($conn);
            }
        }
    }
}
?>

<div class="login-page">
    <div class="login-box">
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

            <button type="submit" class="login-btn">Register</button>
            
            <div class="login-links">
                <p>Already have an account? <a href="login.php">Login Here</a></p>
            </div>
        </form>
    </div>
</div>

<?php include '../includes/footer.php'; ?>