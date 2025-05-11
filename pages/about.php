
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="icon" href="assets/images/logo1.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> 
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../assets/js/script.js"></script>
</head>
<body>
    <header>
     <a href="index.php" class="logo">
        <img src="assets/images/logo1.png" alt="Logo" loading="lazy">
    </a>

    <ul class="navbar">
        <li><a href="index.php">Home</a></li>
        <li><a href="order.php">Order Now</a></li>
        <li><a href="about.php"class="active">About</a></li>
        <li><a href="products.php" >Products</a></li>
        <li><a href="contact.php">Contact</a></li>
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
    
    
    <section id="about">
        <h1>Reth nesh</h1>
        <div class="about-text">
            <a href="#company-timeline" class="btn">Rreth nesh!</a>
            <p>Kafe-ja jonë ka filluar si një ëndërr e vogël për të sjellë shije të freskëta dhe të veçanta në zemër të qytetit. Që nga viti 2020, kemi ofruar një përvojë unike për çdo klient që hap derën tonë.</p>

            
        </div>
    </section>

    <section id="company-timeline">
        <h2 style="text-align: center;"><i>Historia Jonë</i></h2>
        <div class="timeline">
            <div class="timeline-item">
                <h3><abbr title="Filluam">2020</abbr></h3>
                <p><i>Filluam të ofrojmë shërbime online dhe të mundësojmë blerjet më të lehta për klientët tanë.
                    Kafeneja jonë është e lindur në vitin 2020, një vit që ndryshoi gjithçka për të gjithë ne. Ndërsa bota po kalonte një periudhë të pasigurtë dhe të vështirë, ne e pamë mundësinë për të krijuar një vend ku komuniteti mund të ndihej sërish i lidhur, i qetë dhe i mbështetur.
                    Në mes të sfidave të pandemisë, vendosëm të hapim një hapësirë ku çdo filxhan kafeje do të ishte një shenjë shprese dhe kujdesi për klientët tanë. Për ne, çdo kafe është më shumë se një pije – është një mundësi për t’u larguar nga stresi dhe për të krijuar momente të paharrueshme, qoftë përmes një takimi me miqtë apo një pushimi të shkurtër gjatë ditës.
                    Kjo kafene është një vend ku mund të ndiheni në shtëpi, ku mund të <span style="font-weight: bold;">shijoni kafenë tuaj </span>të preferuar, të shoqëruar me një atmosferë ngrohtë dhe të ngushëlluar. Kemi menduar gjithçka – nga zgjedhja e kafeve të cilësisë më të lartë deri tek krijimi i një ambienti që e bën çdo vizitë të veçantë.
                    Edhe pse fillimi ynë u ndikua nga ndryshimet dhe pasiguria që solli pandemia, qëllimi ynë ishte dhe mbetet i qartë: të krijojmë një hapësirë të sigurt dhe mikpritëse për të gjithë ata që duan të ndajnë një moment të thjeshtë kënaqësie në një botë gjithnjë e më të ngutshme.
                </i>
            </p>
            </div>
            <div class="timeline-item">
                <h3><abbr title="Gjatë procesit...">2022</abbr></h3>
                <p><i>Hapëm filialin tonë <mark class="highlight"> të parë ndërkombëtar </mark> për të ofruar shërbime në më shumë shtete.
                    Kafeneja jonë ka nisur në vitin 2020, kur bota ishte përballur me sfida të papara. Pas një periudhe të vështirë, në vitin 2022, ne rifilluam me entuziazëm dhe vendosmëri, duke ofruar një vend ku mund të riktheheshin lidhjet sociale dhe shijet e preferuara të kafes. Ky vit ishte një periudhë rikuperimi, ku përkushtimi ynë ndaj cilësisë dhe mikpritjes u theksua edhe më shumë.
                    Në vitin 2022, ne ndihmuam klientët të gjenin ngushëllim dhe qetësi në mes të pasigurisë që kishte sjellë pandemia. Hapësira jonë u bë një vend ku mund të shijoheshin momente të thjeshta, por të rëndësishme – një filxhan kafeje i mirë, një bisedë e ngrohtë dhe një ambient që ofronte një frymë të re.
                    Edhe pse vitet ishin të vështira, ne qëndruam të fokusuar në krijimin e një hapësire mikpritëse dhe të sigurt. Ne besojmë që kafeja ka fuqinë të bashkojë dhe të krijojë kujtime të bukura, dhe kjo është ajo që e ka bërë këtë vit të paharrueshëm për ne.
                </i>
            </p>
            </div>
            <div class="timeline-item">
                <h3><abbr title="Sukseset tona!">2024</abbr></h3>
                <p ><i>Pas suksesit të vazhdueshëm, jemi gati të zgjerim operacionet tona dhe të sjellim produkte të reja inovative.
                    Në vitin 2024, kafeneja jonë është më shumë se një vend ku shijohen kafe dhe pije të tjera. Pas kaq shumë sfidash dhe momentesh ndryshimi që kemi kaluar që nga hapja jonë në vitin 2020, ne jemi krenarë që kemi mundur të krijojmë një hapësirë ku çdo vizitor ndjen ngrohtësinë dhe përkushtimin tonë për t’ju ofruar eksperiencën më të mirë.
                    Viti 2024 është një vit i mbushur me mundësi të reja dhe inovacion. Kafeneja jonë ka evoluar dhe është bërë një vend ku teknologjia dhe tradita bashkohen për të ofruar një eksperiencë të veçantë. Me një koleksion të pasur të kafeve të zgjedhura dhe produkteve lokale, ne po vazhdojmë të krijojmë hapësira ku mund të takoheni, të relaksoheni dhe të ndani momente të paharrueshme me miqtë, kolegët apo familjen.
                    Në vitin 2024, ne jemi gjithashtu të angazhuar për mjedisin dhe qëndrueshmërinë, duke ofruar mundësi që u përshtaten mënyrës tuaj të jetesës, si dhe mbështesim produkte që janë të mirë për natyrën dhe shëndetin. Ne besojmë që kafeja është një mundësi për të reflektuar dhe për të krijuar lidhje – dhe, duke mbajtur këtë filozofi, po vazhdojmë të krijojmë një komunitet të fortë dhe të qëndrueshëm.
                    Për ne, kafeja është më shumë se një pije – është një mundësi për t'u ndjerë si pjesë e diçkaje të bukur dhe të domosdoshme. Falë mbështetjes suaj, ne jemi këtu për të ofruar më të mirën dhe për t'ju mbajtur të ngrohtë për shumë vite të tjera!
                    Këto përshkrime pasqyrojnë një zhvillim dhe rritje të vazhdueshme të kafenes në vitet 2022 dhe 2024, duke u fokusuar në risitë dhe përkushtimin ndaj cilësisë, komunitetit dhe qëndrueshmërisë. Mund t'i personalizoni më tej në varësi të karakteristikave të biznesit tuaj.
                </i>
            </p>
            </div>
        </div>
    </section>

    
    <section id="testimonials">
        <h2><i>Çfarë Thonë Klientët Tanë</i></h2>
        <div class="testimonial-container">
            <div class="testimonial">
                <p>"Shërbimi ishte fantastik! Kisha një përvojë të shkëlqyer dhe do të rikthehem sërish." - Klienti 1</p>
            </div>
            <div class="testimonial">
                <p>"Produktet që kam blerë janë të shkëlqyera dhe të shpejta për t'u dërguar." - Klienti 2</p>
            </div>
            <div class="testimonial">
                <p>"Në çdo rast kur kam pasur nevojë për mbështetje, ekipi ishte aty për të ndihmuar." - Klienti 3</p>
            </div>
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
                        <li><a href="products.php" target="_blank" >Shipping</a></li>
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
        </div>
    </footer>
</body>
</html>
