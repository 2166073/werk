<?php
include 'db.php';
session_start();

// Controleer of de gebruiker een instructeur is
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'leerling') {
    die("Je moet ingelogd zijn als instructeur.");
}

// Haal het instructeur_id uit de sessie
$instructeur_id = $_SESSION['rol_id'];

$database = new DB();

// Verkrijg de gegevens uit het formulier
$datum = $_POST['datum'] ?? null;
$ophaallocatie = $_POST['ophaallocatie'] ?? null;
$pakket = $_POST['pakket'] ?? null;
$instructeur_opmerking = $_POST['instructeur_opmerking'] ?? null;
$leerling_id = $_POST['leerling_id'] ?? null;

if (!$datum || !$ophaallocatie || !$pakket || !$instructeur_opmerking || !$instructeur_id || !$leerling_id) {
    die("Alle velden zijn verplicht.");
}

// SQL-query om de les toe te voegen
$sql = "INSERT INTO les (datum, ophaallocatie, pakket, instructeur_opmerking, instructeur_id, leerling_id) 
        VALUES (:datum, :ophaallocatie, :pakket, :instructeur_opmerking, :instructeur_id, :leerling_id)";

$params = [
    ':datum' => $datum,
    ':ophaallocatie' => $ophaallocatie,
    ':pakket' => $pakket,
    ':instructeur_opmerking' => $instructeur_opmerking,
    ':instructeur_id' => $instructeur_id,
    ':leerling_id' => $leerling_id
];

// Voer de query uit
$stmt = $database->execute($sql, $params);

if ($stmt) {
    header("Location: instructeur-dashboard.php");
    exit;
} else {
    echo "Er is een fout opgetreden bij het toevoegen van de les.";
}
?>
