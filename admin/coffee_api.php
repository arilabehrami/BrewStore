<?php
$url = "funfacts.json";
$response = file_get_contents($url);
$data = json_decode($response, true);

if ($data) {
    $fact = $data[array_rand($data)]['fact'];
    echo '<div style="text-align: center; margin: 200px auto 20px auto; padding: 15px; border: 2px solid #ffa500; border-radius: 10px; background-color: #fff3cd; color: #333; max-width: 400px;">';
    echo "<h3 style='color: #ff8c00;'>☕ Fun Fact about Coffee ☕</h3>";
    echo "<p style='font-size: 1.2em;'><strong>" . htmlspecialchars($fact) . "</strong></p>";
    echo "</div>";
} else {
    echo '<div style="text-align: center; margin: 200px auto 20px auto; padding: 15px; border: 2px solid red; border-radius: 10px; background-color: #ffe6e6; color: red; max-width: 400px;">';
    echo "Could not retrieve fun facts about coffee.";
    echo "</div>";
}
?>
