<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["name"])) {
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
    
    $message = preg_replace('/\s+/', ' ', $message); 
    $message = trim($message); 

    $nameRegex = "/^[a-zA-Z\s]+$/";
    $emailRegex = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
    $ageRegex = "/^\d{1,2}$/"; 
    $phoneRegex = "/^(\+383|0)[\s\-\/\(\)]*\d{2}[\s\-\/\(\)]*\d{3}[\s\-\/\(\)]*\d{3}$/"; 
    if (!preg_match($nameRegex, $name)) {
        echo "Name is not valid! Only letters are allowed.<br />";
    } elseif (!preg_match($emailRegex, $email)) {
        echo "Email is not valid!<br />";
    } elseif (!empty($age) && !preg_match($ageRegex, $age)) {
        echo "Age is not valid. Must be a number between 1-99.<br />";
    } elseif (!empty($phone) && !preg_match($phoneRegex, $phone)) {
        echo "Phone number is not in the correct format!<br />";
    } else {
        echo "Data is correct! Message sent successfully.<br />";
    }
}
?>

<?php include 'includes/header.php'; ?>

<section id="contact">
    <div class="PlaceOfCoffee">
        <video autoplay loop muted src="assets/images/PlaceOfCoffee.mp4"></video>
    </div>
    <form id="contact-form" method="POST" action="sessions_cookies/cookies_contact.php">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required placeholder="Enter your name" autocomplete="on">

        <label for="email">Email address:</label>
        <input type="email" id="email" name="email" required placeholder="Enter your email address" form="contact-form" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">

        <label for="subject">Subject:</label>
        <input type="text" id="subject" name="subject" list="subjects" required placeholder="Message subject">
        <datalist id="subjects">
            <option value="Information">Information</option>
            <option value="Order">Order</option>
        </datalist>

        <label for="message">Message:</label>
        <textarea id="message" name="message" required placeholder="Write your message" rows="2"></textarea>

        <input type="number" id="age" name="age" min="18" max="99" placeholder="Enter your age">

        <label for="phone">Phone number:</label>
        <input type="text" id="phone" name="phone" placeholder="Phone number:">

        <button type="submit">Send Message</button>
    </form>

    <address>
        <ul>
            <li>Email our management: <a href="mailto:info@shembull.com">coffeeshopborcelle@gmail.com</a></li>
            <li>Phone: +123 456 789</li>
        </ul>
    </address>

    <?php
    if (isset($_POST['send_email_simple'])) {
       include 'admin/send_mail.php';
    }
    ?>
    <address>
        <form id="feedback-form" style="text-align: center;">
            <textarea name="custom_message" rows="4" cols="70" placeholder="Give your feedback for our shop!" style="color: black;" required></textarea><br>
            <button type="submit" class="btn btn-primary">Send your feedback</button>
        </form>
        <div id="feedback-response" style="margin-top: 10px; text-align: center;"></div>
    </address>
</section>

<section id="business-hours">
    <div id="drag-container">
        <h1><i>Working Hours</i></h1>
    </div>
    
    <ul>
        <li><strong>Monday:</strong> 9:00 AM - 5:00 PM</li>
        <li><strong>Tuesday:</strong> 9:00 AM - 5:00 PM</li>
        <li><strong>Wednesday:</strong> 9:00 AM - 5:00 PM</li>
        <li><strong>Thursday:</strong> 9:00 AM - 5:00 PM</li>
        <li><strong>Friday:</strong> 9:00 AM - 5:00 PM</li>
        <li><strong>Saturday:</strong> 10:00 AM - 2:00 PM</li>
        <li><strong>Sunday:</strong> Closed</li>
    </ul>
</section>

<?php include 'includes/footer.php'; ?>
