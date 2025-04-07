<?php
session_start();
require_once 'db.php';
require_once 'reservering.php';

if (!isset($_SESSION['reservering_id'])) {
    echo "Geen reservering gevonden!";
    exit;
}

$reserveringId = $_SESSION['reservering_id'];

$reserveringObj = new Reservering($myDb);
$reservering = $reserveringObj->getReserveringById($reserveringId);

if (!$reservering) {
    echo "Reservering niet gevonden!";
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Mijn Reservering</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Jouw Reservering</h1>
    <table class="table table-bordered">
        <tr><th>Naam</th><td><?= htmlspecialchars($reservering['naam']); ?></td></tr>
        <tr><th>Email</th><td><?= htmlspecialchars($reservering['email']); ?></td></tr>
        <tr><th>Telefoon</th><td><?= htmlspecialchars($reservering['telefoon']); ?></td></tr>
        <tr><th>Aankomst</th><td><?= $reservering['aankomst']; ?></td></tr>
        <tr><th>Vertrek</th><td><?= $reservering['vertrek']; ?></td></tr>
        <tr><th>Kamer Type</th><td><?= ucfirst($reservering['kamertype']); ?></td></tr>
    </table>
    <button onclick="window.print()" class="btn btn-primary">Print Reservering</button>
</div>
</body>
</html>
