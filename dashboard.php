<?php
session_start();

// Zorg ervoor dat de gebruiker is ingelogd
if (!isset($_SESSION['gebruiker_id'])) {
    header('Location: login.php');
    exit;
}

$gebruiker_id = $_SESSION['gebruiker_id'];

// Inclusief het bestand waar de Mededeling klasse gedefinieerd is
include_once 'mededeling.php';

// Maak een nieuwe instantie van de Mededeling klasse
$mededelingClass = new Mededeling();

// Haal de mededelingen op via de Mededeling klasse
$mededelingen = $mededelingClass->get_mededelingen($gebruiker_id);
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
</head>
<body>
    <h1>Welkom, gebruiker met ID: <?php echo htmlspecialchars($gebruiker_id); ?></h1>
    <a href="login.php">Uitloggen</a>

    <!-- Pop-up voor mededelingen -->
    <?php if (count($mededelingen) > 0) : ?>
        <div id="popup" style="display:block; position:fixed; top:20%; left:50%; transform:translateX(-50%);
            background:white; padding:20px; border:1px solid #ccc; border-radius:10px; z-index:1000;">
            <h3>Mededelingen</h3>
            <div id="popupInhoud">
                <?php foreach ($mededelingen as $mededeling) : ?>
                    <strong><?php echo $mededeling['inhoud']; ?></strong>
                    <p><?php echo $mededeling['tekst']; ?></p>
                    <hr>
                <?php endforeach; ?>
            </div>
            <button onclick="document.getElementById('popup').style.display='none'">Sluiten</button>
        </div>
    <?php endif; ?>

</body>
</html>
