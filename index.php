<?php include 'includes/header.php'; ?>

<section id="audio-player">
    <audio controls autoplay loop>
        <source src="assets/images/videoplayback.weba" type="audio/mpeg">
        video of coffee
    </audio>
</section>

<section class="home" id="home">
    <div class="home-text">
       <h1><i>Start your day with coffee</i></h1>
       <div style="display: flex; justify-content: center;"> <!-- Vetëm kjo rresht është shtuar -->
           <a href="products.php" class="btn">Shop Now</a>
       </div>
    </div>
    <div class="home-video">
        <video autoplay loop muted src="assets/images/coffee.mp4"></video>
    </div>
</section>  

<?php include 'includes/footer.php'; ?>