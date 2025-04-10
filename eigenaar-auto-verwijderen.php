<?php
session_start();
include 'db.php';

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
    // Verwijder de auto
    $db->execute("DELETE FROM auto WHERE auto_id = ?", [$auto_id]);
    header("Location: eigenaar-wagenpark.php?success=Auto succesvol verwijderd!");
} catch (Exception $e) {
    die("Fout bij verwijderen van auto: " . $e->getMessage());
}
?>