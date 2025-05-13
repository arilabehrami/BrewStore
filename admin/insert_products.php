<?php
// Aktivizo raportimin e gabimeve
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Përdor require() për dependencies kritike
require '../database/db_connection.php';
include '../includes/header.php';

// Konfigurimi i paths
$base_dir = __DIR__ . '/../assets/images/products/';
$log_dir = __DIR__ . '/../logs/';

// Krijo directory nëse nuk ekzistojnë
if (!file_exists($base_dir) && !mkdir($base_dir, 0777, true)) {
    die("Failed to create products directory");
}

if (!file_exists($log_dir) && !mkdir($log_dir, 0777, true)) {
    die("Failed to create logs directory");
}

$log_file = $log_dir . 'product_inserts.log';

// Krijo/kontrollo skedarin log
$log_handle = fopen($log_file, 'a');
if ($log_handle === false) {
    die("Cannot open log file");
}

// Funksioni për të logguar operacionet
function log_operation($handle, $message) {
    $timestamp = date('Y-m-d H:i:s');
    fwrite($handle, "[$timestamp] $message\n");
}

// Lista e produkteve
$products = [
    ['Americano', 25, 'menu-1.png'],
    ['Espresso', 20, 'menu-2.png'],
    ['Cappuccino', 25, 'menu-3.png'],
    ['Latte', 30, 'menu-4.png'],
    ['Macchiato', 25, 'menu-5.png'],
    ['Mocha', 15, 'menu-6.png'],
    ['Cortado', 20, 'menu-7.png'],
    ['Ristretto', 20, 'menu-8.png'],
    ['Affogato', 30, 'menu-9.png'],
    ['Turkish Coffee', 35, 'cart-item1.png'],
    ['Coffee', 25, 'cart-item2.png'],
    ['Black Coffee', 25, 'cart-item3.png']
];

// Përgatit query për DB
$stmt = $conn->prepare("INSERT INTO products (name, price, image) VALUES (?, ?, ?)");
if (!$stmt) {
    log_operation($log_handle, "DB Error: " . $conn->error);
    die("Database error");
}

foreach ($products as $product) {
    $image_name = $product[2];
    $image_path = $base_dir . $image_name;
    
    // Trajtimi i skedarëve
    if (file_exists($image_path)) {
        $file_size = filesize($image_path);
        log_operation($log_handle, "File exists: $image_name ($file_size bytes)");
    } else {
        // Krijo imazh placeholder
        $im = imagecreatetruecolor(100, 100);
        $bg_color = imagecolorallocate($im, 220, 220, 220);
        imagefill($im, 0, 0, $bg_color);
        $text_color = imagecolorallocate($im, 0, 0, 0);
        imagestring($im, 5, 10, 45, $product[0], $text_color);
        
        $file_handle = fopen($image_path, 'w');
        if ($file_handle) {
            imagepng($im, $image_path);
            fclose($file_handle);
            log_operation($log_handle, "Created: $image_name");
        }
        imagedestroy($im);
    }

    // Insert në DB
    $stmt->bind_param("sis", $product[0], $product[1], $image_name);
    if (!$stmt->execute()) {
        log_operation($log_handle, "Insert failed: " . $stmt->error);
    }
}

// Mbyll burimet
fclose($log_handle);
$stmt->close();
$conn->close();
?>

<!-- Div kryesor për strukturimin e faqes -->
<div class="content-wrapper" style="margin-top: 20px; padding: 20px;">

<!-- Shfaq logun me stil të përmirësuar -->
<div class="log-container" style="margin-top: 30px; background: #f8f9fa; border: 1px solid #ddd; padding: 20px; border-radius: 5px;">
    <h2 style="color: #333; margin-bottom: 15px;">Operation Log</h2>
    <div style="max-height: 400px; overflow-y: auto; font-family: monospace; background: white; padding: 15px; border: 1px solid #eee; border-radius: 3px;">
        <?php readfile($log_file); ?>
    </div>
</div>

</div>