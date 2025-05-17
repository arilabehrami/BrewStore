<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/../vendor/autoload.php';

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'albiikallaba@gmail.com';
    $mail->Password = 'rqft hxrq hyct fpbd'; // vendose këtu app password që e gjenerove
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail->setFrom('albiikallaba@gmail.com', 'UEB25_CoffeeWebsite_');
    $mail->addAddress('albiikallaba@gmail.com'); // mundesh me vendos email tjetër për test
    $mail->Subject = 'Feedback from costumer';

    // ✅ Custom message from form
    $mail->Body = isset($_POST['custom_message']) && !empty(trim($_POST['custom_message']))
        ? trim($_POST['custom_message'])
        : 'No message';

    $mail->send();
    echo '<div style="text-align: center; color: green; font-weight: bold; margin-top: 20px;">Emaili u dërgua me sukses.</div>';
} catch (Exception $e) {
    echo "Dështoi dërgimi i emailit. Error: {$mail->ErrorInfo}";
}
?>
