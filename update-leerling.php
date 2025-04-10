<?php
session_start();
require_once 'db.php';
require_once 'Leerling.php';

if (!isset($_SESSION['gebruiker_id'])) {
    header("Location: login.php");
    exit;
}

$gebruiker_id = $_SESSION['gebruiker_id'];

$naam = $_POST['naam'] ?? '';
$achternaam = $_POST['achternaam'] ?? '';
$adres = $_POST['adres'] ?? '';
$telefoon = $_POST['telefoon'] ?? '';
$geboortedatum = $_POST['geboortedatum'] ?? '';


if ($naam && $achternaam && $adres) {
    $leerling = new Leerling($myDb);
    $result = $leerling->updateLeerlingByGebruikerId($naam, $achternaam,$geboortedatum, $adres, $telefoon, $gebruiker_id);

    if ($result) {
        header("Location: leerling-profiel.php?success=1");
    } else {
        header("Location: leerling-profiel.php?error=1");
    }
    exit;
} else {
    header("Location: leerling-profiel.php?error=1");
    exit;
}
