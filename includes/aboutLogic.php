<?php
//Definimi i konstantes per emrin e kafenese dhe daten e themelimit
define("coffeeShopName", "Delight");
define("foundedYear", "2020");

//Variablat globale
$misioniKafenese = "To provide the best coffee experience to our customers.";
$teamMembers = ["Arila", "Agnesa", "Albi", "Erina"];
$lokacionet = [
    "Prishtine" => ["Adresa" => "Agim Ramadani Str", "Nr. Tel" => "+38349552378"],
    "Mitrovice" => ["Adresa" => "Shemsi Ahmeti Str", "Nr. Tel" => "+38344778535"],
    "Peje" => ["Adresa" => "Enver Hadri Str", "Nr. Tel" => "+38349522332"]
];

//Funksioni qe shfaq te dhenat e kompanise (vitin e themelimit, si dhe nje mesazh mireseardhje)
function shfaqCompInfo() {
    echo "<h1  style='margin: 20px; font-weight: bold; text-align: center; color: white;'>Welcome to " . coffeeShopName . "! Here's all you need to know about us.</h1>";
    echo "<p >Founded in " . foundedYear . ", our mission is: " . $GLOBALS['misioniKafenese'] . "</p>";
}
//Funksioni qe shfaq team members
function shfaqTeamMembers($members) {
    echo "<h2>Meet Our Team</h2><ul>";
    foreach($members as $member) {
        echo "<li>" . $member . "</li>";
    }
    echo "</ul>";
}

//Funksioni qe shfaq lokacionet
function shfaqLokacionet($locations) {
    echo "<h2>Our Locations</h2>";
    foreach($locations as $city => $info) {
        echo "<h3>" . $city . "</h3>";
        echo "<p>Address: " . $info['Adresa'] . "</p>";
        echo "<p>Phone: " . $info['Nr. Tel'] . "</p>";
    }
}

//Kushtezimet qe kontrollojne nese kafeneja eshte nje kompani e re
if(date("Y") - (int)foundedYear < 5) {
    echo "<p>We are a new Coffee Shop, but we are passionate about all types of coffee!</p>";
} else {
    echo "<p>With years of experience, we know how to serve the best coffee to our customers!</p>";
}

//Thirrja e funksioneve
shfaqCompInfo();
shfaqTeamMembers($teamMembers);
shfaqLokacionet($lokacionet);

//Debugging me funksionin var_dump()
ob_start(); //Fillimi i marrjes se output-it
var_dump($teamMembers);
var_dump($lokacionet);
$output = ob_get_clean(); //Marrja e output-it dhe pastrimi i buffer-it
?>