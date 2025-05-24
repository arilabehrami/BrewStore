<?php
$json = file_get_contents("funfacts.json");
$data = json_decode($json, true);

if ($data) {
    $fact = $data[array_rand($data)]['fact'];
    echo '<div style="text-align: center; margin: 20px auto; padding: 15px; border: 2px solid #ffa500; border-radius: 10px; background-color: #fff3cd; color: #333; max-width: 400px;">';
    echo "<h3 style='color: #ff8c00;'>☕ Fun Fact about Coffee ☕</h3>";
    echo "<p><strong>" . htmlspecialchars($fact) . "</strong></p>";
    echo "</div>";
} else {
    echo '<div style="text-align: center; margin: 20px auto; padding: 15px; border: 2px solid red; border-radius: 10px; background-color: #ffe6e6; color: red; max-width: 400px;">';
    echo "Unable to load fun fact.";
    echo "</div>";
}
?>
