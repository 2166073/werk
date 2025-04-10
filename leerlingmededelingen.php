<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    

<?php
// Start de sessie
session_start();

// Inclusies

include_once 'leerling.php';
include_once 'db.php';

// Controleer of de gebruiker ingelogd is als 'leerling'
if (!isset($_SESSION['gebruiker_id']) || $_SESSION['rol'] !== 'leerling') {
    header("Location: leerlingmededelingen.php");
    exit;
}

// Haal alle mededelingen op voor de leerling
$mededelingen = $leerling->haalAlleMededelingenOp();
?>

<h2>Mededelingen van andere leerlingen</h2>  <!-- Correcte sluittag voor <h2> -->

<?php
// Loop door de mededelingen en toon ze
foreach ($mededelingen as $mededeling): ?>
<div style="border:1px solid #ccc; padding:10px; margin-bottom:10px;">
    <strong><?= htmlspecialchars($mededeling['naam']) ?></strong> schreef op <?= $mededeling['datum'] ?>
</div>
<?php endforeach ?>

</body>
</html>
