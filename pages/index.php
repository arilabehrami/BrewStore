
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Café Delight</title>
    <link rel="icon" href="assets/images/logo1.png" type="image/png">
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js">
    </script><script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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
                <!-- Email Field -->
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Your Email..." required>
                </div>
        
                <!-- Password Field -->
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Password..." required>
                </div>
        
                <!-- Submit Button -->
                <div class="form-group">
                    <input type="submit" value="Login" class="login-btn">
                </div>
        
                <!-- Links -->
                <p>Forgot Password? <a href="/reset-password">Reset Now</a></p>
                <p>Don't have an account? <a href="/register">Create One</a></p>
            </form>
        </div>
        
        
    </header>


    
    <section id="audio-player">
        <audio controls autoplay loop>
            <source src="images/videoplayback.weba" type="audio/mpeg">
            video of coffee
        </audio>
    </section>

    <section class="home" id="home">
        <div class="home-text">
           <h1> <i>Start your day<br>with coffee</i></h1>
            <a href="products.php" class="btn" >Shop Now</a>
        </div>
        <div class="home-video">
            <video  autoplay loop muted src="images/coffee.mp4"></video>
        </div>
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
    <div id="warningMessage" style="color: red;"></div>
    <button onclick="shfaqVerejtje()">Shfaq Vërejtjen</button>


</body>
</html>




