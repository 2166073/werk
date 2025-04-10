<?php
include '../db.php';
$db = new DB();

// Start sessie en controleer of gebruiker ingelogd is als leerling
session_start();
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'leerling') {
    header('Location: login.php');
    exit;
}

// Haal leerling_id op via gebruiker_id
$leerling = $db->execute(
    "SELECT leerling_id FROM leerling WHERE gebruiker_id = ?",
    [$_SESSION['gebruiker_id']]
)->fetch(PDO::FETCH_ASSOC);

if (!$leerling) {
    die("Leerling niet gevonden.");
}

$leerling_id = $leerling['leerling_id'];

// Controleer of een les_id is meegegeven
if (isset($_GET['les_id'])) {
    $les_id = $_GET['les_id'];

    // Haal de les op
    $les = $db->execute(
        "SELECT * FROM les WHERE les_id = ? AND leerling_id = ?",
        [$les_id, $leerling_id]
    )->fetch(PDO::FETCH_ASSOC);

    if (!$les) {
        die("Les niet gevonden of je hebt geen toestemming om deze les te verwijderen.");
    }

    // Verwijder de les door de gegevens op te slaan in 'verwijderd_les' tabel
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $reden = $_POST['reden'];

        // Sla de les op in de 'verwijderd_les' tabel
        $db->execute(
            "INSERT INTO verwijderd_les (les_id, reden) VALUES (?, ?)",
            [$les_id, $reden]
        );

        // Verwijder de les uit de 'les' tabel
        $db->execute(
            "DELETE FROM les WHERE les_id = ?",
            [$les_id]
        );

        $success = "Les succesvol verwijderd.";
        header("Location: leerling_viewles.php"); // Terug naar het lesrooster
        exit();
    }
} else {
    die("Geen les_id opgegeven.");
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Les Verwijderen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2>Les Verwijderen</h2>

    <?php if (isset($success)): ?>
        <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="mb-3">
            <label for="reden" class="form-label">Reden voor verwijdering</label>
            <textarea class="form-control" id="reden" name="reden" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-danger">Bevestigen</button>
        <a href="leerling_viewles.php" class="btn btn-secondary">Annuleren</a>
    </form>
</div>

</body>
</html>
