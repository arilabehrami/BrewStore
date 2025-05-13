<?php
// Përdor header për ridrejtim të menjëhershëm
header("Location: ../contact.php#contact");
exit(); // Sigurohemi që skripti ndalon pas ridrejtimit

// Ose mund të përdorim JavaScript për ridrejtim nëse header nuk funksionon
//echo '<script>window.location.href = "../contact.php#contact";</script>';
?>