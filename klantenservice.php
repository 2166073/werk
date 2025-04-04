<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Klantenservice | Hotel der Duin</title>
    <link rel="stylesheet" href="styles/klantenservice.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;600;700&display=swap"rel="stylesheet"><link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>
    
<!-- Header -->
    <div class="banner">
        <div class="navbar">
            <img src="images/logo.jpg" class="logo">

        <ul>
            <li><a href="homepage.php">HOME</a></li>
            <li><a href="klantenservice.php">KLANTENSERVICE</a></li>
            <li><a href="onzeservice.php">ONZE SERVICE</a></li>
            <li><a href="login.php">INLOGGEN</a></li>
        </ul>
    </div>

<header>
    <h1>Klantenservice</h1>
    <p>Wij staan klaar om u te helpen! Neem contact met ons op.</p>
</header>

<section class="contact-info">
    <div class="info-box">
        <h2>Contactgegevens</h2>
        <p><strong>📍 Adres:</strong> Strandweg 12, 1234 AB Duinbergen</p>
        <p><strong>📞 Telefoon:</strong> <a href="tel:+31201234567">+31 20 123 4567</a></p>
        <p><strong>📧 E-mail:</strong> <a href="mailto:info@hotelderduin.nl">info@hotelderduin.nl</a></p>
        <p><strong>🕒 Openingstijden:</strong> Ma - Za: 08:00 - 22:00 | Zo: 09:00 - 20:00</p>
    </div>
</section>

<section class="contact-form">
    <h2>Neem contact op</h2>
    <form action="verwerk_contact.php" method="POST">
        <label for="name">Naam:</label>
        <input type="text" id="name" name="name" required>

        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" required>

        <label for="message">Bericht:</label>
        <textarea id="message" name="message" rows="5" required></textarea>

        <button type="submit">Verstuur</button>
    </form>
</section>

<section class="map">
    <h2>Onze locatie</h2>
    <iframe 
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2417.6222291609134!2d4.894054315818919!3d52.37795697978669!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c6096f06a5b0eb%3A0x8d481a5ff3076787!2sAmsterdam!5e0!3m2!1snl!2snl!4v1614768265093!5m2!1snl!2snl" 
        width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy">
    </iframe>
</section>

</body>
</html>
