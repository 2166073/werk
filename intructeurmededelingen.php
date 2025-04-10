<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php
session_start();

include_once 'instructeur.php';
include_once '../db.php';

// Controleer of de gebruiker ingelogd is als instructeur
if (!isset($_SESSION['gebruiker_id']) || $_SESSION['rol'] !== 'instructeur') {
    header("Location: instructeurmededelingen.php");
    exit;
}

// Instantieer het Instructeur object
$instructeur = new Instructeur($dbh);

// Haal alle mededelingen op
$mededelingen = $instructeur->haalAlleMededelingenOp();
?>

<h2>Mededelingen van andere leerlingen</h2>  <!-- Correcte sluiting van <h2> -->

<?php
// Loop door de mededelingen en toon ze
foreach ($mededelingen as $mededeling): ?>
<div style="border:1px solid #ccc; padding:10px; margin-bottom:10px;">
    <strong><?= htmlspecialchars($mededeling['naam']) ?></strong> schreef op <?= $mededeling['datum'] ?>
</div>
<?php endforeach ?>

</body>
</html>
