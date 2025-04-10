<?php
session_start();
include '../db.php';

$db = new DB("drivesmart");

// Controleer of alle velden zijn ingevuld
if (
    empty($_POST['datum']) ||
    empty($_POST['starttijd']) ||
    empty($_POST['eindtijd']) ||
    empty($_POST['ophaallocatie']) ||
    empty($_POST['instructeur_opmerking']) ||
    empty($_POST['pakket']) ||
    empty($_POST['leerling_id'])
) {
    die("Alle velden zijn verplicht.");
}

// Haal waarden op uit het formulier
$datum = $_POST['datum'];
$starttijd = $_POST['starttijd'];
$eindtijd = $_POST['eindtijd'];
$ophaallocatie = $_POST['ophaallocatie'];
$opmerking = $_POST['instructeur_opmerking'];
$pakket = $_POST['pakket'];
$leerling_id = $_POST['leerling_id'];

// Zorg dat je een geldige instructeur_id hebt uit de sessie
if (!isset($_SESSION['gebruiker_id'])) {
    die("Niet ingelogd als instructeur.");
}

$instructeur = $db->execute(
    "SELECT instructeur_id FROM instructeur WHERE gebruiker_id = ?",
    [$_SESSION['gebruiker_id']]
)->fetch(PDO::FETCH_ASSOC);

if (!$instructeur) {
    die("Instructeur niet gevonden.");
}

$instructeur_id = $instructeur['instructeur_id'];

// (Optioneel) Een auto selecteren
$auto = $db->execute("SELECT auto_id FROM auto LIMIT 1")->fetch(PDO::FETCH_ASSOC);
$auto_id = $auto ? $auto['auto_id'] : null;

// Voeg de les toe aan de database
$db->execute("
    INSERT INTO les (datum, starttijd, eindtijd, ophaallocatie, instructeur_opmerking, pakket, leerling_id, instructeur_id, auto_id)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
", [
    $datum,
    $starttijd,
    $eindtijd,
    $ophaallocatie,
    $opmerking,
    $pakket,
    $leerling_id,
    $instructeur_id,
    $auto_id
]);

// ✅ Redirect naar leerling_viewles.php
header("Location: dag_rooster.php");
exit;
