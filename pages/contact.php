<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $subject = trim($_POST["subject"]);
    $message = trim($_POST["message"]);
    $age = trim($_POST["age"]);
    if (isset($_POST["phone"])) {
        $phone = $_POST["phone"];
    } else {
        $phone = "";
    }
    
    $message = preg_replace('/\s+/', ' ', $message); // Zëvendëson hapësirat e tepërta me një të vetme
    $message = trim($message); // Largon hapësirat nga fillimi/fundi

    // Validime me regex të ndara dhe të shpjeguara
    $nameRegex = "/^[a-zA-Z\s]+$/"; // Lejon vetëm shkronja dhe hapësira
    $emailRegex = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";// Email i thjeshtuar
    $ageRegex = "/^\d{1,2}$/"; // Lejon vetëm numra 1 deri 2 shifra
    $phoneRegex = "/^(\+383|0)[\s\-\/\(\)]*\d{2}[\s\-\/\(\)]*\d{3}[\s\-\/\(\)]*\d{3}$/"; 

    // Emri
    if (!preg_match($nameRegex, $name)) {
        echo "Emri nuk është valid! Vetëm shkronja lejohen.<br />";
    }

    // Emaili
    elseif (!preg_match($emailRegex, $email)) {
        echo "Emaili nuk është valid!<br />";
    }

    // Mosha
    elseif (!empty($age) && !preg_match($ageRegex, $age)) {
        echo "Mosha nuk është valide. Duhet të jetë një numër 1-99.<br />";
    }
    // Numri i telefonit (nëse është futur)
    elseif (!empty($phone) && !preg_match($phoneRegex, $phone)) {
        echo "Numri i telefonit nuk është në format të saktë!<br />";
    }

    // Nëse të gjitha janë OK
    else {
        echo "Të dhënat janë të sakta! Mesazhi u dërgua me sukses.<br />";
    }
}

?>
<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Faqja e kontaktit për kafenin tuaj. Na kontaktoni për informacione të mëtejshme.">
    <title>Contact Us</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="icon" href="assets/images/logo1.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="assets/js/script.js"></script>
</head>
<body>
    <header>
    <a href="index.php" class="logo">
        <img src="assets/images/logo1.png" alt="Logo" loading="lazy">
    </a>

    <ul class="navbar">
        <li><a href="pages/index.php">Home</a></li>
        <li><a href="pages/order.php">Order Now</a></li>
        <li><a href="pages/about.php">About</a></li>
        <li><a href="pages/products.php" class="active">Products</a></li>
        <li><a href="pages/contact.php">Contact</a></li>
    </ul>

        <div class="header-icon">
            <i class='bx bx-cart'id="cart-icon"></i>
            <i class='bx bx-search' id="search-icon"></i>
            <i class='bx bx-user' id="user-icon"></i>
        </div>


        <div class="search-box">
            <form action="/search" method="GET">
                <input type="search" id="search" name="query" placeholder="Search Here..." required>
                <button type="submit">Search</button>
            </form>
        </div>


        <div class="cart" id="cart">
            <h2>Shporta</h2>
            <ul id="cart-items" aria-live="polite">
 
            </ul>
            <div class="cart-actions">
                <button id="checkout">Checkout</button>
                <button id="clear-cart">Pastro</button>
            </div>
        </div>

        <div class="user">
            <h2>Login Now</h2>
            <form action="/login" method="POST">
               <!--   Email Field -->
                <!-- <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Your Email..." required>
                </div> -->
       
                <!-- Password Field -->
                <!-- <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Password..." required>
                </div> -->
        
                <!-- Submit Button -->
                <!-- <div class="form-group">
                    <input type="submit" value="Login" class="login-btn">
                </div> -->
        
                <!-- Links -->
                <p>Forgot Password? <a href="/reset-password">Reset Now</a></p>
                <p>Don't have an account? <a href="/register">Create One</a></p>
            </form>
        </div> 
    </header>

    <section id="contact">
        <div class="PlaceOfCoffee">
            <video  autoplay loop muted src="images/PlaceOfCoffee.mp4"></video>
        </div>
        <form id="contact-form" method="POST" onsubmit="return kontrollo();">
            <label for="name">Emri:</label>
            <input type="text" id="name" name="name" required placeholder="Shkruani emrin tuaj" autocomplete="on">
    
            <label for="email">Adresa e emailit:</label>
            <input type="email" id="email" name="email" required placeholder="Shkruani adresën tuaj të emailit" form="contact-form" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">
    
            <label for="subject">Subjekti:</label>
            <input type="text" id="subject" name="subject" list="subjects" required placeholder="Subjekti i mesazhit">
            <datalist id="subjects">
                <option value="Informacion">Informacion</option>
                <option value="Përporosi">Përporosi</option>
            </datalist>

            <label for="message">Mesazhi:</label>
            <textarea id="message" name="message" required placeholder="Shkruani mesazhin tuaj" rows="2"></textarea>

            <input type="number" id="age" name="age" min="18" max="99" placeholder="Shkruani moshën tuaj">

            <label for="phone">Numri i telefonit:</label>
            <input type="text" id="phone" name="phone" placeholder="Numri i telefonit:">


            <button type="submit">Dërgo Mesazhin</button>
        </form>


    <address>
     <ul>
        <li>Email: <a href="mailto:info@shembull.com">coffeeshop@hotmail.com</a></li>
        <li>Telefon: +123 456 789</li>
    </ul>
    <a href="mailto:email@example.com">Dërgo një email</a>
    </address>
    

     <section id="business-hours">
        <div id="drag-container">
            <h1 ><i> Orari i Punes</i></h1>
            <!-- <div id="dropzone" ondragover="allowDrop(event)" ondrop="drop(event)"></div> -->
            <!-- <div id="dropzone" ondragover="allowDrop(event)" ondrop="drop(event)"></div> -->
            
        </div>
        
        
        <ul>
            <li><strong>Për të Hënën:</strong> 9:00 AM - 5:00 PM</li>
            <li><strong>Për të Martën:</strong> 9:00 AM - 5:00 PM</li>
            <li><strong>Për të Mërkurën:</strong> 9:00 AM - 5:00 PM</li>
            <li><strong>Për të Enjten:</strong> 9:00 AM - 5:00 PM</li>
            <li><strong>Për të Premten:</strong> 9:00 AM - 5:00 PM</li>
            <li><strong>Për të Shtunën:</strong> 10:00 AM - 2:00 PM</li>
            <li><strong>Për të Dielën:</strong> Mbyllur</li>
        </ul>
    </section>

    
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="footer-col">
                    <h4>Company</h4>
                    <ul>
                        <li><a href="about.php">About Us</a></li>
                        <li><a href="products.php">Our Services</a></li>
                        <li><a href="contact.php">Privacy Policy</a></li>
                        <li><a href="order.php">Order Now</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Get help</h4>
                    <ul>
                        <li><a href="#">FAQ</a></li>
                        <li><a href="products.php" target="_blank">Shipping</a></li>
                        <li><a href="contact.php" target="_blank">Returns</a></li>
                        <li><a href="#">Payment Options</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Follow us</h4>
                    <div class="social-links">
                    <ul>
                        <li><a href="https://www.facebook.com/" aria-label="Facebook"><i class='bx bxl-facebook'></i></a></li>
                        <li><a href="https://www.instagram.com/" aria-label="Instagram"><i class='bx bxl-instagram'></i></a></li>
                        <li><a href="https://www.twitter.com/" aria-label="Twitter"><i class='bx bxl-twitter'></i></a></li>
                        <li><a href="https://www.youtube.com/" aria-label="Youtube"><i class='bx bxl-youtube'></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>