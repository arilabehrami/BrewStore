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

<?php include 'includes/header.php'; ?>


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

    
    <?php include 'includes/footer.php'; ?>
    