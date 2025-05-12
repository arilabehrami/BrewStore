<?php
// Përdor këtë rrugë për të përfshirë db_connection.php
require __DIR__ . '/../database/db_connection.php';

echo "<h2>Produktet e Regjistruara në Databazë:</h2>";

// Merr të gjitha produktet nga tabela 'products'
$query = "SELECT * FROM products";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    echo "<ul>";
    while ($row = $result->fetch_assoc()) {
        echo "<li>" . htmlspecialchars($row['name']) . " - " 
             . htmlspecialchars($row['price']) . "€ (Imazh: " 
             . htmlspecialchars($row['image']) . ")</li>";
    }
    echo "</ul>";
} else {
    echo "<p>Nuk ka produkte në databazë!</p>";
}

$conn->close();
?>