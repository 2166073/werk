<?php
session_start();
include '../db.php';

// Controleer of de gebruiker is ingelogd als eigenaar
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'eigenaar') {
    header('Location: login.php');
    exit;
}

$db = new DB();

// Controleer of er een auto_id is opgegeven
if (!isset($_GET['auto_id'])) {
    die("Geen auto geselecteerd.");
}

$auto_id = $_GET['auto_id'];

try {
    // Zet de auto in onderhoud
    $db->execute("UPDATE auto SET onderhoud = 1 WHERE auto_id = ?", [$auto_id]);
    header("Location: eigenaar-wagenpark.php?success=Auto staat nu in onderhoud!");
} catch (Exception $e) {
    die("Fout bij het aanpassen van de onderhoudsstatus: " . $e->getMessage());
}
?>