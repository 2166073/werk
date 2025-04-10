<?php
session_start();
include 'db.php';

// Controleer of de gebruiker is ingelogd als eigenaar
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'eigenaar') {
    header('Location: login.php');
    exit;
}

$db = new DB();

// Controleer of er een pakket_id is opgegeven
if (!isset($_GET['pakket_id'])) {
    die("Geen pakket geselecteerd.");
}

$pakket_id = $_GET['pakket_id'];

try {
    // Verwijder het pakket
    $db->execute("DELETE FROM pakket WHERE pakket_id = ?", [$pakket_id]);
    header("Location: eigenaar-pakketten.php?success=Pakket succesvol verwijderd!");
    exit;
} catch (Exception $e) {
    die("Fout bij verwijderen van pakket: " . $e->getMessage());
}
?>