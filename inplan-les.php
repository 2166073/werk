<?php
session_start();
require_once 'db.php';

$db = new DB("drivesmart");

// Controleer of de leerling is ingelogd
$gebruiker_id = $_SESSION['gebruiker_id'] ?? null;
if (!$gebruiker_id) {
    die("Je moet ingelogd zijn om een les in te plannen.");
}

// Haal leerling_id op
$leerling = $db->execute("SELECT leerling_id FROM leerling WHERE gebruiker_id = ?", [$gebruiker_id])->fetch(PDO::FETCH_ASSOC);
if (!$leerling) {
    die("Leerling niet gevonden.");
}
$leerling_id = $leerling['leerling_id'];

// Formuliergegevens valideren
$instructeur_id = $_POST['instructeur_id'] ?? null;
$auto_id = $_POST['auto_id'] ?? null;
$datum = $_POST['datum'] ?? null;
$starttijd = $_POST['starttijd'] ?? null;
$eindtijd = $_POST['eindtijd'] ?? null;

if (!$instructeur_id || !$auto_id || !$datum || !$starttijd || !$eindtijd) {
    die("Vul alle velden in.");
}

// Combineer datum en tijd
$start_datetime = DateTime::createFromFormat('Y-m-d H:i', $datum . ' ' . $starttijd);
$eind_datetime = DateTime::createFromFormat('Y-m-d H:i', $datum . ' ' . $eindtijd);

if (!$start_datetime || !$eind_datetime) {
    die("Ongeldige datum/tijd.");
}

if ($eind_datetime <= $start_datetime) {
    die("Eindtijd moet na starttijd liggen.");
}

// Controleer auto-onderhoud
$auto = $db->execute("SELECT onderhoud FROM auto WHERE auto_id = ?", [$auto_id])->fetch();
if ($auto && $auto['onderhoud']) {
    die("Deze auto is in onderhoud.");
}

// Controleer instructeur-rooster
$rooster = $db->execute("
    SELECT * FROM rooster 
    WHERE instructeur_id = ? 
    AND datum = ? 
    AND starttijd <= ? 
    AND eindtijd >= ?
", [$instructeur_id, $datum, $starttijd, $eindtijd])->fetch();

// Debugging: Toon de ingevoerde waarden en queryresultaten
if (!$rooster) {
    die("Instructeur is niet beschikbaar op dit tijdstip. Debug info: " . 
        "Instructeur ID: $instructeur_id, Datum: $datum, Starttijd: $starttijd, Eindtijd: $eindtijd. " .
        "Controleer of deze gegevens overeenkomen met de beschikbaarheid in de rooster-tabel.");
}

// Controleer les-overlap voor instructeur
$overlap_instructeur = $db->execute("
    SELECT * FROM les 
    WHERE instructeur_id = ? 
    AND (
        (starttijd < ? AND eindtijd > ?) OR 
        (starttijd < ? AND eindtijd > ?) OR 
        (starttijd >= ? AND eindtijd <= ?)
    )
", [
    $instructeur_id,
    $eind_datetime->format('Y-m-d H:i:s'),
    $start_datetime->format('Y-m-d H:i:s'),
    $start_datetime->format('Y-m-d H:i:s'),
    $eind_datetime->format('Y-m-d H:i:s'),
    $start_datetime->format('Y-m-d H:i:s'),
    $eind_datetime->format('Y-m-d H:i:s')
])->fetch();

if ($overlap_instructeur) {
    die("Instructeur heeft al een les op dit tijdstip.");
}

// Controleer les-overlap voor auto
$overlap_auto = $db->execute("
    SELECT * FROM les 
    WHERE auto_id = ? 
    AND (
        (starttijd < ? AND eindtijd > ?) OR 
        (starttijd < ? AND eindtijd > ?) OR 
        (starttijd >= ? AND eindtijd <= ?)
    )
", [
    $auto_id,
    $eind_datetime->format('Y-m-d H:i:s'),
    $start_datetime->format('Y-m-d H:i:s'),
    $start_datetime->format('Y-m-d H:i:s'),
    $eind_datetime->format('Y-m-d H:i:s'),
    $start_datetime->format('Y-m-d H:i:s'),
    $eind_datetime->format('Y-m-d H:i:s')
])->fetch();

if ($overlap_auto) {
    die("Auto is al ingepland op dit tijdstip.");
}

// Voeg les toe
try {
    $db->execute("
        INSERT INTO les 
        (leerling_id, instructeur_id, auto_id, starttijd, eindtijd) 
        VALUES (?, ?, ?, ?, ?)
    ", [
        $leerling_id,
        $instructeur_id,
        $auto_id,
        $start_datetime->format('Y-m-d H:i:s'),
        $eind_datetime->format('Y-m-d H:i:s')
    ]);
    echo "Les succesvol ingepland!";
} catch (PDOException $e) {
    die("Fout bij inplannen: " . $e->getMessage());
}