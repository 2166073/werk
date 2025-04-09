<?php
session_start();
require_once 'db.php';

// Controleer of gebruiker ingelogd is en de juiste rol heeft


// Gebruik bestaande databaseverbinding uit db.php
$pdo = $myDb->getConnection();

$feedback = "";

// Verwerk formulier bij POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $reden = $_POST['reden'] ?? '';
    $datum = date("Y-m-d H:i:s");

    if ($reden) {
        try {
            $stmt = $pdo->prepare("INSERT INTO mededeling (reden, datum) VALUES (?, ?)");
            $stmt->execute([$reden, $datum]);
            $feedback = "<div class='alert alert-success'>Mededeling toegevoegd.</div>";
        } catch (PDOException $e) {
            $feedback = "<div class='alert alert-danger'>Fout: " . $e->getMessage() . "</div>";
        }
    } else {
        $feedback = "<div class='alert alert-warning'>Vul het berichtveld in.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Mededeling Toevoegen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>


<div class="container mt-5" style="max-width: 700px;">
    <h2 class="mb-4">Mededeling Toevoegen</h2>
    <?= $feedback ?>

    <form method="POST" class="bg-light p-4 border rounded shadow-sm">
        <div class="mb-3">
            <label for="reden" class="form-label">Bericht</label>
            <textarea name="reden" id="reden" class="form-control" rows="5" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary w-100">Opslaan</button>
    </form>

    <div class="text-center mt-4">
        <a href="medlinmaken.php" class="btn btn-secondary">Terug naar Dashboard</a>
    </div>
</div>


</body>
</html>
